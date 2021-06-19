<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Discount\StoreRequest;
use App\Http\Requests\Manager\Discount\UpdateRequest;
use App\Models\Discount;
use App\Models\Dish;
use App\Models\DishDiscount;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Manager/Discounts/Index', [
            'discounts' => Discount::all()->map(fn(Discount $discount) => [
                'id' => $discount->id,
                'name' => $discount->name,
                'discount' => $discount->discount,
                'valid_until' => $discount->valid_until,
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Manager/Discounts/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Manager\Discounts\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $discount = Discount::create([
            'name' => $data['name'],
            'discount' => $data['discount'],
            'valid_until' => $data['valid_until'],
        ]);

        if ($discount != null) {
            return redirect()->route('manager.discounts.edit', $discount->id)
                ->with('success', 'De korting is succesvol aangemaakt');
        }

        return redirect()->back()->with('error', 'De korting kon niet worden aangemaakt, probeer het opnieuw');
    }

    /**
     * Edit the specified resource.
     *
     * @param \App\Models\Discount $discount
     * @return \Inertia\Response
     */
    public function edit(Discount $discount)
    {
        return Inertia::render('Manager/Discounts/Edit', [
            'discount' => [
                'id' => $discount->id,
                'name' => $discount->name,
                'discount' => $discount->discount,
                'valid_until' => $discount->valid_until,
                'dishes' => $discount->dishes->map(fn(Dish $dish) => [
                    'id' => $dish->id,
                    'number' => $dish->number,
                    'addition' => $dish->addition,
                    'name' => $dish->name,
                    'price' => $dish->price,
                    'base_price' => $dish->base_price,
                ]),
            ],
            'dishes' => Dish::all()->map(fn(Dish $dish) => [
                'id' => $dish->id,
                'number' => $dish->number,
                'addition' => $dish->addition,
                'name' => $dish->name,
                'base_price' => $dish->base_price,
            ]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Discount $discount
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Discount $discount)
    {
        $data = $request->validated();

        $success = $discount->update([
            'name' => $data['name'],
            'discount' => $data['discount'],
            'valid_until' => $data['valid_until'],
        ]);

        if ($success) {
            return redirect()->back()->with('success', 'De korting is succesvol bijgewerkt');
        }

        return redirect()->back()->with('error', 'De korting kon niet worden bijgewerkt');
    }

    /**
     * Add the specified dish to the specified resource in storage
     *
     * @param \App\Models\Discount $discount
     * @param $dish_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addDish(Discount $discount, $dishId)
    {
        $dish = Dish::find($dishId);

        if ($dish != null) {
            $dishDiscount = DishDiscount::create([
                'dish_id' => $dish->id,
                'discount_id' => $discount->id,
            ]);

            if ($dishDiscount != null) {
                return redirect()->back()->with('success', 'Het gerecht is succesvol toegevoegd aan de korting');
            }
        }

        return redirect()->back()->with('error', 'Het gerecht kon niet worden toegevoegd aan de korting');
    }

    /**
     * Remove the specified dish to the specified resource in storage
     *
     * @param \App\Models\Discount $discount
     * @param $dish_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeDish(Discount $discount, $dishId)
    {
        $dish = Dish::find($dishId);

        if ($dish != null) {
            $success = DishDiscount::where('discount_id', $discount->id)->where('dish_id', $dish->id)->delete();

            if ($success) {
                return redirect()->back()->with('success', 'Het gerecht is succesvol verwijderd aan de korting');
            }
        }

        return redirect()->back()->with('error', 'Het gerecht kon niet worden verwijderd van de korting');
    }
}
