<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl mb-2">{{ $post->title }}</h1>
                <p class="text-sm text-gray-500">
                    {{ $post->updated_at }}
                    <span class="text-gray-700 italic">Por {{ $post->user->name }}</span>
                    @if ($post->published)
                        <span
                            class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Publicado
                        </span>
                    @else
                        <span
                            class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Borrador
                        </span>
                    @endif
                </p>
                <hr class="my-4">
                <p class="text-gray-500">{{ $post->content }}</p>
                <hr class="my-4">
                <h2 class="text-xl mb-2">Comentarios:</h2>
                <div class="my-2">
                    @auth
                        <livewire:write-comment :post="$post" />
                    @else
                        <p class="text-gray-700">¡Usted debe estar logueado para enviar un comentario! <a class="text-blue-500" href="{{ route('login') }}">{{ __('Log in') }}</a></p>
                    @endauth
                    <livewire:show-comments :post="$post" />
                </div>

                {{-- Comments --}}
                {{-- @if ($comments->count())
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
                @endif --}}
            </div>
        </div>
        {{-- @push('events')
            @php
                $channel = "post-{$post->id}";
            @endphp
            <script>
                Echo.channel('{{ $channel }}')
                    .listen('CommentSent', comment => {
                        console.log('Mensaje enviado')
                        alert('Escuchando '+comment.body)
                        Livewire.emit('refreshComments', comment)
                    })
            </script>
        @endpush --}}
    </div>
</x-app-layout>
