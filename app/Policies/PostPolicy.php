<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determina si un usuario puede eliminar un modelo
     * 
     * @param \APP\Models\User $user
     * @param \APP\Models\Post $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user,Post $post)
    {
        return $user->id === $post->user_id;
    }
}
