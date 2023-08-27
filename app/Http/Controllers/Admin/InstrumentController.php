<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instrument;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Tag;

class InstrumentController extends Controller
{
    //validazione dati
    protected $validationRule = [
        "name" => "required|string|max:100",
        // ****REGEX**** /^\d{1,6} accetta numeri da uno a 6 cifre
        // (\,\d{1,2})?$/ parentesi opzionale / separatore virgola / accetta da 1 a 2 numeri dopo il separatore / $ fine espressione  
        "price" => "numeric|regex:/^\d{1,6}(\.\d{1,2})?$/",
        "left_handed_version" => "sometimes|accepted",
        "available" => "sometimes|accepted",
        "category_id" => "nullable|exists:categories,id",
        "image" => "nullable|image|mimes:jpeg,bmp,png|max:2048",
        "tags" => "nullable|exists:tags,id"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instruments = Instrument::all();

        return view("admin.instruments.index", compact("instruments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.instruments.create", compact("categories", "tags"));
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
        $request->validate([
            "code" => "required|string|max:30|unique:instruments,code"
        ]);

        //aggiunta nuovo strumento da submit
        $data = $request->all();

        $newInstrument = new Instrument();
        $newInstrument->name = $data["name"];
        $newInstrument->code = $data["code"];

        $slug = Str::of($newInstrument->name)->slug("-");
        $count = 1;
        // prendi il primo post il cui slug è uguale a $slug
        // se c'è genera un nuovo slug aggiungendo -$count
        while (Instrument::where("slug", $slug)->first()) {
            $slug = Str::of($newInstrument->name)->slug("-") . "-{$count}";
            $count++;
        }
        $newInstrument->slug = $slug;
        
        $newInstrument->description = $data["description"];
        $newInstrument->price = $data["price"];
        $newInstrument->left_handed_version = isset($data["left_handed_version"]);
        $newInstrument->available = isset($data["available"]);
        $newInstrument->category_id = $data["category_id"];

        // salvo l'immagine se è presente
        if (isset($data['image'])) {
            $path_image = Storage::put("uploads", $data["image"]);
            $newInstrument->image = $path_image;
        }

        $newInstrument->save();

        // aggiungo i tag
        if (isset($data["tags"])) {
            $newInstrument->tags()->sync($data["tags"]); //tags() metodo Model
        }

        //redirect allo strumento appena aggiunto
        return redirect()->route("instruments.show", $newInstrument->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Instrument $instrument)
    {
        return view("admin.instruments.show", compact("instrument"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrument $instrument)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.instruments.edit', compact("instrument", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instrument $instrument)
    {
        //validazione dei dati
        $request->validate($this->validationRule);
        $request->validate([
            "code" => "required|string|max:30|unique:instruments,code,{$instrument->id}"
        ]);        

        // aggiorno lo strumento
        $data = $request->all();

        // se cambia il nome aggiorno lo slug
        if ($instrument->name != $data['name']) {
            $instrument->name = $data["name"];

            $slug = Str::of($instrument->name)->slug("-");

            // se lo slug generato è diverso dallo slug attualmente salvato nel db
            if ($slug != $instrument->slug) {
                $count = 1;

                while (Instrument::where("slug", $slug)->first()) {
                    $slug = Str::of($instrument->name)->slug("-") . "-{$count}";
                    $count++;
                }
                $instrument->slug = $slug;
            }
        }

        if($instrument->code != $data["code"]) {
            $instrument->code = $data["code"];
        }
        
        $instrument->description = $data["description"];
        $instrument->price = $data["price"];
        $instrument->left_handed_version = isset($data["left_handed_version"]);
        $instrument->available = isset($data["available"]);
        $instrument->category_id = $data["category_id"];

        if (isset($data["image"])) {
            // cancello l'immagine
            Storage::delete($instrument->image);
            // salvo la nuova immagine
            $path_image = Storage::put("uploads", $data["image"]);
            $instrument->image = $path_image;
        }

        $instrument->save();

        // aggiungo i tag
        if (isset($data["tags"])) {
            $instrument->tags()->sync($data["tags"]); //tags() metodo Model
        }

        //redirect allo strumento modificato
        return redirect()->route("instruments.show", $instrument->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrument $instrument)
    {
        if ($instrument->image) {
            // cancello prima l'immagine
            Storage::delete($instrument->image);
        }

        $instrument->delete();

        return redirect()->route("instruments.index");
    }
}
