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
            // 'comment-added-from-network' => 'refresh',
            "echo:post-{$this->post->id},CommentSent" => 'refresh',
        ];
    }

    public function refresh()
    {
        $this->post = $this->post->fresh();
    }

    public function render()
    {
        $postId = $this->post->id;
        $comments = $this->post->comments()
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('livewire.show-comments', compact('comments', 'postId'));
    }
}
