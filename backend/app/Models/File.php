<?php

namespace App\Models;

use Database\Factories\FileFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /** @use HasFactory<FileFactory> */
    use HasFactory;

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function canAccessBy(int $userId)
    {
        return $this->user_id == $userId || $this->sharedUsers()->where('user_id', '=', $userId)->exists();
    }

    public function sharedUsers()
    {
        return $this->belongsToMany(User::class, 'file_user');
    }
}
