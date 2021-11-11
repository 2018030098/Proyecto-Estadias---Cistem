<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Social') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="">
            @foreach($users as $user)
            <div class="card my-5">
                <div class="card-header">
                    {{ $user->id }}
                </div>
                <div class="card-body">
                    <h5 class="card-title"> {{ $user->name }} </h5>
                    <p class="card-text"> {{ $user->email }} </p>
                    <a href="#" class="btn btn-primary"> {{ $user->password }} </a>
                </div>
            </div>
            @endforeach
        </div>
    </x-slot>
</x-app-layout>