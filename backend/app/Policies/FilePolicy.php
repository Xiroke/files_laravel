<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FilePolicy
{
    public function owner(User $user, File $file): bool
    {
        Log::info("{$user->id}:{$file->user_id}");
        return $file->user_id == $user->id;
    }

    public function granted(User $user, File $file): bool
    {
        return $file->canAccessBy($user->id);
    }

}
