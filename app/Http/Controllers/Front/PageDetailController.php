<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;


class PageDetailController extends Controller
{
    // Data parameter didapatkan dari route parameter URL, 
    // jika parameter URL hanya 1, maka parameter function juga hanya bisa 1
    // nama boleh beda
    public function detail($slug){
        //mencari data ke database
        $detailData = Post::where('status', operator: 'publish')
                        ->where('type', 'page')
                        ->where('slug',$slug)
                        ->firstOrFail();

        //data ditampilkan di halaman detail
        return view('components.front.page-detail', compact('detailData'));
    }


}
