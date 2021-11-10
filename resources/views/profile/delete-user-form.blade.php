<x-jet-action-section>
    <x-slot name="title">
        {{ __('Eliminar Cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Elimina de manera permanente tu cuenta.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Una ves tu cuenta sea eliminada, todos los recursos he informacion seran permanentemente borrados. Porfavor, descarga toda informacion que desees conservar.') }}           
        </div>

        <div class="mt-5">
            <x-jet-danger-button data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Eliminar Cuenta') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Eliminar Cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Estas seguro que deseas eliminar tu cuenta? Una ves sea eliminada, todos los recursos he informacion seran permanentemente eliminados. Porfavor ingrese su contraseña para confirmar que desea eliminar permanentemente su cuenta.') }}
                        
                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" data-bs-dismiss="modal" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Eliminar Cuenta') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
