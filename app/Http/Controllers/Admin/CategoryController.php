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
        'name' => 'required|string|max:100|unique:categories,name,{$category->id}'
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
        $request->validate(["name" => "required|string|max:100|unique:categories,name"]);

        //aggiunta nuova categoria da submit
        $data = $request->all();

        $newCategory = new Category();
        $newCategory->name = $data["name"];
        $newCategory->slug = Str::of($newCategory->name)->slug("-");

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
        $request->validate([
            "name" => "required|string|max:100|unique:categories,name,{$category->id}"
        ]);

        // aggiorno la categoria
        $data = $request->all();

        $category->name = $data["name"];
        $category->slug = Str::of($category->name)->slug("-");

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
