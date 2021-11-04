<div x-data="data" x-init="start">
    <textarea wire:model.defer="newComment"
        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        rows="3" placeholder="Dejar un comentario ..." x-on:keydown="typingComment"></textarea>
    <x-jet-input-error for="newComment" />

    <div class="flex justify-between items-center">
        <x-jet-button class="mt-2" type="button" wire:click="store">
            Enviar
        </x-jet-button>

        <div class="text-gray-500 text-sm italic" x-show="userTyping">
            <span class="font-bold not-italic" x-text="userTyping"></span> está escribiendo un comentario
        </div>
    </div>

    <script>
        const data = () => ({
            user: null,
            userTyping: false,
            typingComment() {
                Echo.join("post-{{ $postId }}")
                    .whisper('typing', this.user)
            },
            start() {
                this.user = "{{ auth()->user()->name }}"
                Echo.join("post-{{ $postId }}")
                    .listenForWhisper('typing', (user) => {
                        this.userTyping = user

                        setTimeout(() => this.userTyping = false, 2000)
                    })
            },
        })
    </script>
</div>
