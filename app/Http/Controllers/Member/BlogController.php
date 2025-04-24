<?php

namespace App\Http\Controllers\Member;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //menampilkan data berdasarkan user yg login
        $user = Auth::user();
        $search = $request->search;

        $postData = Post::where('user_id',$user->id)
                ->where(function($query) use ($search){
                    if($search){
                        $query->where('title', 'like', "%{$search}%")
                                ->orWhere('content', 'like',"%{$search}%");
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->withQueryString();
         
        return view('member.blogs.index', compact('postData'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.blogs.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:10240'
        ],[
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Konten wajib diisi',
            'thumbnail.image' => 'Hanya gambar yang diperbolehkan',
            'thumbnail.mimes' => 'Ekstensi yang diperbolehkan hanya jpeg, jpg, png',
            'thumbnail.max' => 'Ukuran maksimum untuk thumbnail 10MB'
        ]);

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $imageName = time(). "-" .$image->getClientOriginalName();
            $destinationPath = public_path(getenv('CUSTOM_THUMBNAIL_LOCATION'));
            $image->move($destinationPath, $imageName);
        }

        $createPostData = [
            'title' => $request->title,
            'description' => $request->description,
            'content'=> $request->content,
            'status'=> $request->status,
            'thumbnail'=> isset($imageName) ? $imageName : null,
            'slug'=> $this->generateSlug($request->title),
            'user_id' => Auth::user()->id
        ];

        Post::create($createPostData);

        return redirect()
                ->route('member.blogs.index')
                ->with('success', 'Data berhasil ditambahkan');
        
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //print_r($post);
        //dd($post);
        $postData = $post;
        return view('member.blogs.edit', compact('postData'));
    }

        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:10240'
        ],[
            'title.required' => 'Judul wajib diisi',
            'content.required' => 'Konten wajib diisi',
            'thumbnail.image' => 'Hanya gambar yang diperbolehkan',
            'thumbnail.mimes' => 'Ekstensi yang diperbolehkan hanya jpeg, jpg, png',
            'thumbnail.max' => 'Ukuran maksimum untuk thumbnail 10MB'
        ]);


        //thumbnail
        if ($request->hasFile('thumbnail')) {
            //mengganti image dengan yg baru
            if (isset($post->thumbnail) && file_exists(public_path(getenv('CUSTOM_THUMBNAIL_LOCATION')).'/'.$post->thumbnail)) {
                unlink(public_path(getenv('CUSTOM_THUMBNAIL_LOCATION')).'/'.$post->thumbnail);
            }
            $image = $request->file('thumbnail');
            $image_name = time() . "_" . $image->getClientOriginalName();
            //menyimpan file image di public path
            $destination_path = public_path(getenv('CUSTOM_THUMBNAIL_LOCATION'));
            $image->move($destination_path, $image_name);
        }


        //menyimpan data
        $updatePostData = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' => $request->status,
            'thumbnail' => isset($image_name) ? $image_name: $post->thumbnail,
            'slug'=> $this->generateSlug($request->title, $post->id)
        ];

        Post::where('id', $post->id)
                ->update($updatePostData);

        return redirect()
                ->route('member.blogs.index')
                ->with('success', 'Data berhasil di-update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //delete image
        if (isset($post->thumbnail) && file_exists(public_path(getenv('CUSTOM_THUMBNAIL_LOCATION')).'/'.$post->thumbnail)) {
            unlink(public_path(getenv('CUSTOM_THUMBNAIL_LOCATION')).'/'.$post->thumbnail);
        }

        Post::where('id',$post->id)->delete();
        return redirect()
                ->route('member.blogs.index')
                ->with('success','Data berhasil dihapus');
    }


    private function generateSlug($title, $id = null)
    {
        $slug = Str::slug($title);
        $count = Post::where('slug', $slug)
                    ->when($id, function($query, $id){
                        return $query->where('id', '!=', $id);
                    })
                    ->count();
        if($count > 0){
            $slug = $slug."-".($count+1);
        
        }

        return $slug;
    }

}
