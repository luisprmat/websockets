<?php

namespace App\Http\Livewire;

use App\Events\CommentSent;
use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $post, $comments = [];

    public $newComment;

    // protected $listeners = ['refreshComments'];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function getListeners()
    {
        return [
            "echo-private:post-{$this->post->id},CommentSent" => 'refreshComments',
            // "newMessage" => 'refreshComments'
        ];
    }

    public function loadComments()
    {
        $this->comments = $this->post->comments()
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function refreshComments()
    {
        dd('Escuchando');
        $this->loadComments();
    }

    public function store()
    {
        $this->validate([
            'newComment' => 'required|min:3'
        ], [], [
            'newComment' => 'comentario'
        ]);

        $comment = $this->post->comments()->create([
            'body' => $this->newComment,
            'user_id' => auth()->id()
        ]);

        $this->reset('newComment');
        $this->loadComments();

        broadcast(new CommentSent($comment))->toOthers();
        $this->emitSelf('newMessage');
    }

    public function render()
    {
        return view('livewire.show-post');
    }
}
