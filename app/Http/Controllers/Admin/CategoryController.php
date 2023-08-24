<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //validazione dati
    protected $validationRule = [
        'name' => 'required|string|max:100'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validazione dei dati
        $request->validate($this->validationRule);

        //aggiunta nuova categoria da submit
        $data = $request->all();

        $newCategory = new Category();
        $newCategory->name = $data["name"];

        //generazione slug
        $slug = Str::of($newCategory->name)->slug("-");
        $count = 1;
        // prendi il primo post il cui slug è uguale a $slug
        // se c'è genera un nuovo slug aggiungendo -$count
        while (Category::where("slug", $slug)->first()) {
            $slug = Str::of($newCategory->name)->slug("-") . "-{$count}";
            $count++;
        }
        $newCategory->slug = $slug;

        $newCategory->save();

        //redirect alla categoria appena aggiunta
        return redirect()->route("categories.show", $newCategory->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //validazione dei dati
        $request->validate($this->validationRule);

        // aggiorno la categoria
        $data = $request->all();

        // se cambia il nome aggiorno lo slug
        if ($category->name != $data['name']) {
            $category->name = $data["name"];

            $slug = Str::of($category->name)->slug("-");

            // se lo slug generato è diverso dallo slug attualmente salvato nel db
            if ($slug != $category->slug) {
                $count = 1;

                while (Category::where("slug", $slug)->first()) {
                    $slug = Str::of($category->name)->slug("-") . "-{$count}";
                    $count++;
                }
                $category->slug = $slug;
            }
        }

        $category->save();

        //redirect alla categoria modificato
        return redirect()->route("categories.show", $category->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route("categories.index");

    }
}
