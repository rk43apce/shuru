<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;


class RestaurantControllerV1 extends Controller
{
    
    function store(Request $request) {


    $resutl = Restaurant::all();

    print_r($resutl);


    exit();

    }
}
