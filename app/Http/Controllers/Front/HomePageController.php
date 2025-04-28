<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $lastData = $this->displayLatesData();

        $postData = Post::where('status','publish')
                    ->where('id','!=',$lastData->id)
                    ->orderBy('id', 'desc')
                    ->paginate('5');

        return view('components.front.home-page', compact('postData','lastData'));
    }

    private function displayLatesData()
    {
        $data = Post::where('status', 'publish')
                ->orderBy('id', 'desc')
                ->latest()
                ->first();
        return $data;
    }

}
