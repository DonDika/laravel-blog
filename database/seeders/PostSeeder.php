<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'Indonesia Tanah Air Beta',
            'Pusaka Abadi Nan Jaya',
            'Indonesia Sejak Dulu Kala',
            'Selalu Dipuja-puja Bangsa'
        ];

        foreach($titles as $title){
            $slug = Str::slug($title);
            $slugOri = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->exists()) {
                $slug = $slugOri .'-'.$count;
                $count++;
            }

            Post::create([
                'title' => $title,
                'slug' => $slug,
                'description' => 'Deskripsi untuk ' .$title,
                'content' => 'Konten untuk ' .$title,
                'status' => 'publish',
                'user_id' => '1'
            ]);
        }

    }

}
