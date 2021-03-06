<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function imagePath()
    {
        //   $path = '/storage/images';
        $path = env('IMAGE_PATH', '/storage/images/');
        $imageFile = $this->image ?? 'no_image.png';
        return $path . $imageFile;
    }
    
    public function viewers(){
        $this->belongsToMany(User::class, 'post_user', 'post_id', 
            'user_id', 'id', 'id', 'users' );
    }
    /*user
    public function viewed_posts(){
        // return $this->belongsToMany(Post::class);
        return $this->belongsToMany(Post::class, 'post_user', 
                    'user_id', 'post_id', 'id', 'id', 'posts');
    }
    */
}
