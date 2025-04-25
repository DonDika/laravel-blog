<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $postData = Post::where('status','publish')
                    ->orderBy('id', 'desc')
                    ->paginate('5');

        return view('components.front.home-page', compact('postData'));
    }

}
