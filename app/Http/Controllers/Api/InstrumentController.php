<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index() {
        $instruments = Instrument::with(["category", "tags"])->get();

        return response()->json($instruments);
    }

    public function show($slug)
    {
        $instrument = Instrument::where("slug", $slug)->with(["category", "tags"])->first();

        return response()->json($instrument);
    }
}
