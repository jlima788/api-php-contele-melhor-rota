<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rota extends Model
{
    public static function dijkstra($source, $target, $autonomy, $fuel_price)
    {
        $graph_array = array(
            array("A", "B", 10),
            array("B", "D", 15),
            array("A", "C", 20),
            array("C", "D", 30),
            array("B", "E", 50),
            array("D", "E", 30)
        );

        $vertices = array();
        $neighbours = array();
        foreach ($graph_array as $edge) {
            array_push($vertices, $edge[0], $edge[1]);
            $neighbours[$edge[0]][] = array("end" => $edge[1], "cost" => $edge[2]);
            $neighbours[$edge[1]][] = array("end" => $edge[0], "cost" => $edge[2]);
        }
        $vertices = array_unique($vertices);


        foreach ($vertices as $vertex) {
            $dist[$vertex] = INF;
            $previous[$vertex] = NULL;
        }

        $dist[$source] = 0;
        $Q = $vertices;
        while (count($Q) > 0) {

            $min = INF;
            foreach ($Q as $vertex){
                if ($dist[$vertex] < $min) {
                    $min = $dist[$vertex];
                    $u = $vertex;
                }
            }

            $Q = array_diff($Q, array($u));
            if ($dist[$u] == INF or $u == $target) {
                break;
            }

            if (isset($neighbours[$u])) {
                foreach ($neighbours[$u] as $arr) {
                    $alt = $dist[$u] + $arr["cost"];
                    if ($alt < $dist[$arr["end"]]) {
                        $dist[$arr["end"]] = $alt;
                        $previous[$arr["end"]] = $u;
                    }
                }
            }
        }
        $path = array();
        $u = $target;
        while (isset($previous[$u])) {
            array_unshift($path, $u);
            $u = $previous[$u];
        }
        array_unshift($path, $u);
        array_unshift($path, $dist[$target]);
        array_unshift($path, $autonomy);
        array_unshift($path, $fuel_price);

        return $path;
    }
}
