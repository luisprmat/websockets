<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $post, $comments = [];

    public $newComment;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    protected function loadComments()
    {
        $this->comments = $this->post->comments()
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function store()
    {
        $this->validate([
            'newComment' => 'required|min:3'
        ], [], [
            'newComment' => 'comentario'
        ]);

        $this->post->comments()->create([
            'body' => $this->newComment,
            'user_id' => auth()->id()
        ]);

        $this->reset('newComment');
        $this->loadComments();
    }

    public function render()
    {
        return view('livewire.show-post');
    }
}
