<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;


class BlogDetailController extends Controller
{
    // Data parameter didapatkan dari route parameter URL, 
    // jika parameter URL hanya 1, maka parameter function juga hanya bisa 1
    // nama boleh beda
    public function detail($slug){
        //mencari data ke database
        $detailData = Post::where('status', operator: 'publish')
                        ->where('type', 'blog')
                        ->where('slug',$slug)
                        ->firstOrFail();

        $paginationData = $this->pagination($detailData->id);

        //data ditampilkan di halaman detail
        return view('components.front.blog-detail', compact('detailData','paginationData'));
    }


    private function pagination($id)
    {
        $dataPrev = Post::where('status', 'publish')
                        ->where('type', 'blog')
                        ->where('id', '<', $id)
                        ->orderBy('id', 'desc')
                        ->first();
        $dataNext = Post::where('status', 'publish')
                        ->where('type', 'blog')
                        ->where('id','>',$id)
                        ->orderBy('id', 'desc')
                        ->first();

        $dataPagination = [
            'prev' => $dataPrev,
            'next' => $dataNext
        ];

        return $dataPagination;
    }

}
