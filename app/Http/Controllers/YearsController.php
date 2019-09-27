<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Charts\Years;



class YearsController extends Controller
{
    public function index() {
        $charts = new Years;
        $chart->labels(['2014', '2015', '2016', '2017']);
        $charts->dataset('Example1', 'line', [1,2,3,4]);
        $charts->dataset('Example2', 'line', [4,3,2,1]);
    }
}
 