<div>
    <div x-data="alpine" x-init="start">
        @if (isset($comments) && $comments->count())
            <hr class="mt-4">
            @foreach ($comments as $item)
                <div class="mt-3 flex items-center justify-between text-sm bg-white overflow-hidden">
                    <div>
                        <img class="h-10 w-10 rounded-full" src="{{ $item->user->profile_photo_url }}"
                            alt="{{ $item->user->name }}">
                    </div>
                    <div class="ml-3 flex-1 items-center justify-between text-sm border border-gray-200 rounded-md">
                        <div class="p-3 text-sm text-gray-500">
                            {{ $item->body }}
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        const alpine = () => ({
            start() {
                Echo.join("post-{{ $postId }}")
                    .listen('CommentSent', (comment) => {
                        Livewire.emitTo('show-comments', 'comment-added')
                    })
            }
        })
    </script>
</div>
