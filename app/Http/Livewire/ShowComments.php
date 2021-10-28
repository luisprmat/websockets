<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowComments extends Component
{
    public Post $post;

    public function getListeners()
    {
        return [
            'comment-added' => 'refresh',
            "echo:post-{$this->post->id},CommentSent" => 'refresh',
        ];
    }

    public function refresh()
    {
        $this->post = $this->post->fresh();
    }

    public function render()
    {
        return view('livewire.show-comments');
    }
}
