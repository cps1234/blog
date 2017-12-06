<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostComment;
use App\User;

class Post extends Model
{
	public function comments() {
		return $this->hasMany(PostComment::class, 'post_id', 'id')->latest();
	}

	public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public $fillable = ['title','description','user_id'];

}