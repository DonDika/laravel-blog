<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userData = User::where(function($query) use ($request){
                            if($request->search){
                                $query->where('name', 'like',"%{$request->search}%")
                                        ->orWhere('email', 'like', "%{$request->search}%");
                            }
                        })
                        ->orderBy('id','desc')
                        ->paginate(2)
                        ->withQueryString();

        return view('member.users.index', compact('userData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userData = $user;
        return view('member.users.edit', compact('userData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'new_password' => 'nullable|min:8|same:new_password_confirmation|required_with:new_password_confirmation',
            'new_password_confirmation' => 'required_with:new_password'

        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email '.$request->email.' tidak sesuai',
            'email.unique' => 'Email sudah digunakan, silahkan gunakan email yang lain',
            'new_password.required_with' => 'Password belum diisi',
            'new_password_confirmation.required_with' => 'Konfirmasi password belum diisi'
        ]);

        $verifiedEmail = $user->email_verified_at ? $user->email_verified_at : Carbon::now();

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $verifiedEmail,
            'password' => $request->new_password ? bcrypt($request->new_password) : $user->password
        ];

        User::where('id', $user->id)
                ->update($updateData);

        return redirect()->route('member.users.index')->with('success','Berhasil memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $posts = Post::where('user_id', $user->id)->get();
        foreach($posts as $post){
            if (file_exists(public_path(getenv('CUSTOM_THUMBNAIL_LOCATION').'/'.$post->thumbnail )) &&
                isset($post->thumbnail)
            ) {
                unlink(public_path(getenv('CUSTOM_THUMBNAIL_LOCATION').'/'.$post->thumbnail));
            }
        }

        User::where('id',$user->id)->delete();
        return redirect()->back()->with('success','Data berhasil dihapus');
    }


    public function toggleBlock(User $user){
        $message = '';

        if ($user->blocked_at == null) {
            $blockedUser = [
                'blocked_at' => now()
            ];
            $message = 'User ' .$user->name. ' telah di-block';
        } else {
            $blockedUser = [
                'blocked_at' => null
            ];
            $message = 'User ' .$user->name. ' telah di-unblock';
        }

        User::where('id', $user->id)
                ->update($blockedUser);

        return redirect()->back()->with('success', $message);
    }





}
