<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = [
        'title',
        'details',
        'status',
        'user_id',
        'file'
    ];

    public function user() {
    return $this->belongsTo(User::class);
}

    public function reactions() {
    return $this->hasMany(Reaction::class);
}

public function comments() {
    return $this->hasMany(Comment::class);
}

     // ================= Helper Methods =================
    // Check if a user has reacted with a specific type
    public function userReacted($userId, $type)
    {
        if(!$userId) return false;

        return $this->reactions()
                    ->where('user_id', $userId)
                    ->where('type', $type)
                    ->exists();
    }

}
