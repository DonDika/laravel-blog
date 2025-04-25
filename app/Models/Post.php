<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'status',
        'thumbnail',
        'user_id'
    ];

    //dari tabel Post relasi ke tabel User, 
    //untuk access data yg ada di tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
