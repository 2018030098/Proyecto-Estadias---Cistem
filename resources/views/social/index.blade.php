<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Social') }} </h2>
    </x-slot>
    <x-slot name="slot">
        <div>
            <a href="{{ route('social.create') }}" class="btn btn-dark">Crear nueva publicacion</a>
        </div>
        <div class="">
            @foreach($publication as $public)
            <div class="card my-5">
                <div class="card-header">
                    {{ $public->title }}
                </div>
                <div class="card-body">
                    <p class="card-text"> {{ $public->description }} </p>
                </div>
            </div>
            @endforeach
        </div>
        @if(session('status'))
            <div style="position: absolute; top: 20px; right: 20px;">
                <div class="alert alert-dismissible" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header {{ session('classTitle') }}">
                        <div class="col"> 
                            <i class="{{ session('icon') }}"> </i>
                            <strong class="mr-auto m-l-sm">{{ session('title') }}</strong> 
                        </div>
                        <div class="col-auto">
                            <button type="button" class="ml-2 mb-1 close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="toast-body {{ session('classBody') }}">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
        @endif
    </x-slot>
</x-app-layout>