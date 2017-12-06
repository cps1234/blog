<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class PostComment extends Model
{
	public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public $fillable = ['text','post_id','user_id'];

}