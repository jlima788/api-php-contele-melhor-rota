<?php

namespace App\Http\Controllers;

use App\Rota;
use Illuminate\Http\Request;

class RotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message'  => "OK",
        ], 200);
    }

}
