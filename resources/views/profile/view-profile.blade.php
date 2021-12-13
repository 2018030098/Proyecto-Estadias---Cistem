<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Perfil de usuario') }} </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="container mt-4">
            <div class="md:grid md:grid-cols-3 md:gap-4">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Visualizar usuario') }}</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Informaacion de usuario') }}
                        </p>
                    </div>
                    <div class="px-4 sm:px-0"></div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="row">
                        <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                            <div class="row">
                                <div class="col-4">
                                    <div class="">
                                        <img src="{{ asset('storage/'.$user['profile_photo_path']) }}" alt="foto de perfil" class="img-fluid rounded-full">
                                    </div>
                                    <div class="mt-5">
                                        <label for="kind" class="form-label">{{ __('Tipo de usuario') }}</label>
                                        <input type="text" name="kind" class="form-control" value="{{ $user['kind'] }}" disabled>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="mt-3">
                                        <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                        <input type="text" name="name" class="form-control" value="{{ $user['name'] }}" disabled>
                                    </div>
                                    <div class="mt-3">
                                        <label for="email" class="form-label">{{ __('Nombre') }}</label>
                                        <input type="email" name="email" class="form-control" value="{{ $user['email'] }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>