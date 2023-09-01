<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index() {
        $instruments = Instrument::all();

        return response()->json($instruments);
    }
}
