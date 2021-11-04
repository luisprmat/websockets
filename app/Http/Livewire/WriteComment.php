<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Events\CommentSent;

class WriteComment extends Component
{
    public Post $post;

    public $newComment = '';

    public $user;

    public function getListeners()
    {
        return [
            "echo-presence:post-{$this->post->id},here" => 'here',
            "echo-presence:post-{$this->post->id},joining" => 'joining',
            "echo-presence:post-{$this->post->id},leaving" => 'leaving',
        ];
    }

    public function here($users)
    {
        $this->emit('here', $users);
    }

    public function joining($user)
    {
        $this->emit('join', $user);
    }

    public function leaving($user)
    {
        $this->emit('leave', $user);
    }

    public function writing($user)
    {
        $this->user = $user;
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

        broadcast(new CommentSent($comment))->toOthers();
        $this->emitTo('show-comments', 'comment-added');
    }

    public function render()
    {
        return view('livewire.write-comment', [
            'postId' => $this->post->id
        ]);
    }
}
