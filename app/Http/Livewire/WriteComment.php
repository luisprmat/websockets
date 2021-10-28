<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Events\CommentSent;

class WriteComment extends Component
{
    public Post $post;

    public $newComment = '';

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

        // broadcast(new CommentSent($comment))->toOthers();
        broadcast(new CommentSent($comment));
        $this->emitTo('show-comments', 'comment-added');
    }

    public function render()
    {
        return view('livewire.write-comment');
    }
}
