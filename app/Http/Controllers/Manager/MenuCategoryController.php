<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\MenuCategory\StoreRequest;
use App\Http\Requests\Manager\MenuCategory\UpdateRequest;
use App\Models\Dish;
use App\Models\MenuCategory;
use Inertia\Inertia;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Manager/Menu/Index', [
            'categories' => MenuCategory::with('dishes')->get(['id', 'name'])->map(function (MenuCategory $category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'dishes_count' => $category->dishes()->withTrashed()->count('id'),
                    'dishes_preview' => $category->dishes->take(3)->pluck('name'),
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Manager/Menu/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Manager\MenuCategory\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $category = MenuCategory::create([
            'name' => $data['name'],
            'extra_option' => $data['extra_option'],
        ]);

        if ($category != null) {
            return redirect()->route('manager.menus.index')->with('success', 'De categorie is succesvol aangemaakt');
        }

        return redirect()->back()->with('error', 'De categorie is kon niet worden bijgewerkt');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MenuCategory $category
     * @return \Inertia\Response
     */
    public function show(MenuCategory $category)
    {
        return Inertia::render('Manager/Menu/Show', [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'extra_option' => $category->extra_option,
                'dishes' => $category->dishes()->withTrashed()->get()->map(function (Dish $dish) {
                    return [
                        'id' => $dish->id,
                        'name' => $dish->name,
                        'number' => $dish->number,
                        'addition' => $dish->addition,
                        'price' => $dish->base_price,
                        'btw' => $dish->btw,
                        'deleted' => $dish->trashed(),
                    ];
                }),
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Manager\MenuCategory\UpdateRequest $request
     * @param \App\Models\MenuCategory $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, MenuCategory $category)
    {
        $data = $request->validated();

        $success = $category->update([
            'name' => $data['name'],
            'extra_option' => $data['extra_option'],
        ]);

        if ($success) {
            return redirect()->back()->with('success', 'De categorie is succesvol bijgewerkt');
        }

        return redirect()->back()->with('error', 'De categorie kon niet worden bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MenuCategory $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(MenuCategory $category)
    {
        if ($category->dishes()->withTrashed()->count('id') > 0) {
            return redirect()->back()->with('error', 'De categorie heeft nog gerechten');
        }

        if ($category->delete()) {
            return redirect()->back()->with('success', 'De categorie is succesvol verwijderd');
        }

        return redirect()->back()->with('error', 'De categorie is kon niet worden verwijderd');
    }
}
