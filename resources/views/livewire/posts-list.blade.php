<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div class="flex bg-white px-4 py-3 border-gray-200 sm:px-6">
                                    <input wire:model="search"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        type="text"
                                        placeholder="Buscar..."
                                    >
                                    <select wire:model="perPage"
                                        class="form-input rounded-md shadow-sm mt-1 text-gray-500 text-sm ml-4 block"
                                    >
                                        <option value="5">5 por página</option>
                                        <option value="10">10 por página</option>
                                        <option value="15">15 por página</option>
                                        <option value="25">25 por página</option>
                                        <option value="50">50 por página</option>
                                        <option value="100">100 por página</option>
                                    </select>
                                    @if ($search != '')
                                        <button wire:click="clear"
                                            class="ml-4 px-3 rounded-md shadow-sm mt-1 block border border-gray-500 text-gray-500"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                                @if ($posts->count())
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    ID
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Title') }}
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Author') }}
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Status') }}
                                                </th>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                    {{ __('Updated at') }}
                                                </th>

                                                @auth
                                                    <th class="px-6 py-3 bg-gray-50"></th>
                                                @endauth
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500">
                                                        {{ $post->id }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-gray-500 cursor-default">
                                                        <a class="hover:text-gray-900" href="{{ route('posts.show', $post) }}">{{ Str::limit($post->title, 30, '...') }}</a>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img class="h-10 w-10 rounded-full" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                                    {{ $post->user->name }}
                                                                </div>
                                                                <div class="text-sm leading-5 text-gray-500">
                                                                    {{ $post->user->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if ($post->published)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                {{ __('Published') }}
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                {{ __('Draft') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500">
                                                        {{ $post->updated_at->diffForHumans() }}
                                                    </td>
                                                    @auth
                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm leading-5 font-medium">
                                                            <a href="#" class="text-gray-900">Edit</a>
                                                        </td>
                                                    @endauth
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                        {{ $posts->links() }}
                                    </div>
                                @else
                                    <div class="bg-white px-4 py-3 border-t border-gray-200 text-gray-500 sm:px-6">
                                        No hay resultados para la búsqueda "{{ $search }}" en la página {{ $page }} al mostrar {{ $perPage }} por página.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
