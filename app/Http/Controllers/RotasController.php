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
    public function index($source, $target, $autonomy, $fuel_price)
    {
        $path = Rota::dijkstra($source, $target, $autonomy, $fuel_price);

        $vl_combustivel = array_shift($path);
        $autonomia = array_shift($path);
        $total = array_shift($path);

        $custo = ( $total / $autonomia ) * $vl_combustivel;

        return response()->json([
            'error' => false,
            'message'  => "A melhor rota é: ".implode(", ", $path)." com custo de R$ {$custo}",
        ], 200);
    }

}
