<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailPageController extends Controller
{
    public function detail($slug){
        echo $slug;
    }
}
