<div>
    <textarea wire:model.defer="newComment"
        class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        rows="3" placeholder="Dejar un comentario ..."></textarea>
    <x-jet-input-error for="newComment" />

    <x-jet-button class="mt-2" type="button" wire:click="store">
        Enviar
    </x-jet-button>
</div>
