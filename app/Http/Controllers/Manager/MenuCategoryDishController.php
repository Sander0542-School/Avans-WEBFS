<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\MenuCategory\Dish\StoreRequest;
use App\Http\Requests\Manager\MenuCategory\Dish\UpdateRequest;
use App\Models\Allergy;
use App\Models\Dish;
use App\Models\MenuCategory;
use Inertia\Inertia;

class MenuCategoryDishController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\MenuCategory $category
     * @return \Inertia\Response
     */
    public function create(MenuCategory $category)
    {
        return Inertia::render('Manager/Menu/Dish/Create', [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'extra_option' => $category->extra_option,
            ],
            'defaults' => [
                'number' => (Dish::withTrashed()->whereRaw('`number` REGEXP \'^-?[0-9]+$\'')
                            ->orderByRaw('ceil(`number`) DESC')->value('number') ?? 0) + 1,
            ],
            'allergies' => Allergy::all(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Manager\MenuCategory\Dish\StoreRequest $request
     * @param \App\Models\MenuCategory $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request, MenuCategory $category)
    {
        $data = $request->validated();

        $dish = $category->dishes()->create([
            'number' => $data['number'],
            'addition' => $data['addition'],
            'name' => $data['name'],
            'description' => $data['description'] ?? '',
            'base_price' => $data['price'],
            'btw' => $data['btw'],
            'spiciness_level' => $data['spiciness_level'],
        ]);

        if ($dish != null) {
            $success = $dish->dish_allergies()->createMany(collect($data['allergies'])->map(function ($allergy) {
                return [
                    'allergy_id' => $allergy,
                ];
            }));

            if ($success) {
                return redirect()->route('manager.menus.show', $category->id)
                    ->with('success', 'Het gerecht is succesvol aangemaakt.');
            }
        }

        return redirect()->back()->with('error', 'Het gerecht kon niet worden aangemaakt.');
    }

    /**
     * Edit the specified resource.
     *
     * @param \App\Models\MenuCategory $category
     * @param \App\Models\Dish $dish
     * @return \Inertia\Response
     */
    public function edit(MenuCategory $category, Dish $dish)
    {
        return Inertia::render('Manager/Menu/Dish/Edit', [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'extra_option' => $category->extra_option,
            ],
            'dish' => [
                'id' => $dish->id,
                'number' => $dish->number,
                'addition' => $dish->addition,
                'name' => $dish->name,
                'description' => $dish->description,
                'price' => $dish->base_price,
                'btw' => $dish->btw,
                'spiciness_level' => $dish->spiciness_level,
                'allergies' => $dish->allergies->map(function (Allergy $allergy) {
                    return $allergy->id;
                }),
                'deleted' => $dish->trashed(),
            ],
            'allergies' => Allergy::all(['id', 'name']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Manager\MenuCategory\Dish\UpdateRequest $request
     * @param \App\Models\MenuCategory $category
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, MenuCategory $category, Dish $dish)
    {
        $data = $request->validated();

        $success = $dish->update([
            'number' => $data['number'],
            'addition' => $data['addition'],
            'name' => $data['name'],
            'description' => $data['description'] ?? '',
            'base_price' => $data['price'],
            'btw' => $data['btw'],
            'spiciness_level' => $data['spiciness_level'],
        ]);

        if ($success) {
            $dish->dish_allergies()->delete();
            $success = $dish->dish_allergies()->createMany(collect($data['allergies'])->map(function ($allergy) {
                return [
                    'allergy_id' => $allergy,
                ];
            }));

            if ($success) {
                return redirect()->back()->with('success', 'Het gerecht is succesvol bijgewerkt.');
            }
        }

        return redirect()->back()->with('error', 'Het gerecht kon niet worden bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MenuCategory $category
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MenuCategory $category, Dish $dish)
    {
        if ($dish->delete()) {
            return redirect()->back()->with('success', 'Het gerecht is succesvol verwijderd.');
        }

        return redirect()->back()->with('error', 'Het gerecht kon niet worden verwijderd.');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param \App\Models\MenuCategory $category
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(MenuCategory $category, Dish $dish)
    {
        if ($dish->restore()) {
            return redirect()->back()->with('success', 'Het gerecht is succesvol teruggezet.');
        }

        return redirect()->back()->with('success', 'Het gerecht kon niet worden teruggezet.');
    }
}
