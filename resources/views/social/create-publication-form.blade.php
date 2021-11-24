<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($cnd)
            {{ __('Modificar Publicacion') }}
            @else
            {{ __('Nueva Publicacion') }}
            @endif
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('social.index') }}" class="text-decoration-none">{{ __('Publicaciones') }}</a>
            </li>
            <li class="breadcrumb-item active">
            @if($cnd)
                <span>{{ __('Modificar Publicacion') }}</span>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{ $publication['publication']['title'] }}</strong>
            @else
                <strong>{{ __('Nueva publicacion') }}</strong>
            @endif
            </li>
        </ol>
    </x-slot>
    <x-slot name="slot">
        <div class="container animated fadeInDown">
            <div class="mt-3">
                <div class="row py-3 bg-white shadow-sm px-3">
                    <h2 class="text-center"> Informacion </h2>
                    <form @if(!$cnd) action="{{ route('social.store') }}" @else action="{{ route('social.update', $publication['publication']['id'] ) }}" @endif method="POST" enctype="multipart/form-data" class="row align-items-center">
                        @if($cnd)   @method('PUT')   @endif
                        @csrf
                        <div class="col-3">
                            <div class="row">
                                <img alt="image" src="{{ asset('storage/'.$publication['user']['profile_photo_path'] ) }}" class="rounded-full object-cover w-75"> 
                            </div>
                            <div class="row col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="name" value="{{ __('Nombre') }}" class="form-label" />
                                <x-jet-input id="name" name="name" type="text" class="mt-1 block w-full form-control" placeholder="{{ $publication['user']['name'] }}" value="{{ $publication['user']['name'] }}" disabled autocomplete="name" />
                            </div>
                            @if($cnd)
                            <div class="row">
                                <div class="row mt-4">
                                    <x-jet-label for="created_at" value="{{ __('Fecha de creacion') }}" class="form-label" />
                                    <x-jet-input id="created_at" name="created_at" type="text" class="mt-1 block w-full form-control" placeholder="{{ $publication['publication']['created_at'] }}" disabled/>
                                </div>
                                @if( $publication['publication']['created_at'] === $publication['publication']['updated_at'] )
                                <div class="row mt-4">
                                    <x-jet-label for="updated_at" value="{{ __('Ultima modificacion') }}" class="form-label" />
                                    <x-jet-input id="updated_at" name="updated_at" type="text" class="mt-1 block w-full form-control" placeholder="{{ $publication['publication']['updated_at'] }}" disabled/>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="col">
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="title" value="{{ __('Titulo') }}" class="form-label" />
                                @if($cnd)
                                <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full form-control" value="{{ $publication['publication']['title'] }}" /> 
                                @else
                                <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full form-control" /> 
                                @endif
                                <x-jet-input-error for="title" class="mt-2" />
                            </div>
                            <!-- Description -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="description" value="{{ __('Descripcion') }}" class="form-label" />
                                <textarea name="description" id="description" class="form-control border-gray-300 rounded-md shadow-sm" cols="15" rows="4">@if($cnd){{ $publication['publication']['description']}}@endif </textarea>
                            </div>
                            <!-- Imagen -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="image[]" value="{{ __('Imagen') }}" class="form-label" />
                                <input type="file" name="image[]" id="image[]" class="form-control border-gray-300 rounded-md shadow-sm" onchange="previewFiles()" multiple>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-dark"> {{ __('Guardar')}} </button>
                        </div>
                    </form>
                </div>
                <div class="row m-3 p-3 container bg-white shadow-sm" >
                    <!-- Previsualizacion de imagenes -->
                    <div id="title" class="d-none">
                        <h3 class="d-flex justify-content-center">{{ __('Imagenes Seleccionadas') }}</h3>
                    </div>
                    <div id="preview" class="row"></div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/img/preview-img.js') }}"></script>
    </x-slot>
</x-app-layout>