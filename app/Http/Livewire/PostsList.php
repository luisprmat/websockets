<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class PostsList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '5';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => '5'],
    ];

    public function clear()
    {
        $this->resetPage();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.posts-list', [
            'posts' => Post::where('title', 'LIKE', "%{$this->search}%")
                ->orWhereHas('user', function (Builder $query) {
                    $query->where('name', 'LIKE', "%{$this->search}%")
                        ->orWhere('email', 'LIKE', "%{$this->search}%");
                })
                ->paginate($this->perPage)
        ]);
    }
}
