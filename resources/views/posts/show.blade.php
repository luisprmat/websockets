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
                    {{ $post->updated_at->format('M d, Y') }}
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
            </div>
        </div>

        @push('events')
            <script>
                Livewire.on('here', users => {
                    console.log('Here')
                    console.log(users)
                })
                Livewire.on('join', user => {
                    console.log('Joining')
                    console.log(user)
                })
                Livewire.on('leave', user => {
                    console.log('Leaving')
                    console.log(user)
                })
            </script>
        @endpush
    </div>
</x-app-layout>
