<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentPost extends Component
{
    public $post;
    public $user;


    public function render()
    {
        return view('livewire.comment-post');
    }
}
