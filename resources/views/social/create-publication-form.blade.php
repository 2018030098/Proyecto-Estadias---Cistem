<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Nueva Publicacion') }} </h2>
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('social.index') }}" class="text-decoration-none">Publicaciones</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Nueva publicacion</strong>
            </li>
        </ol>
    </x-slot>
    <x-slot name="slot">
        <div class="container animated fadeInDown">
            <div class="mt-3">
                <div class="row py-3 bg-white shadow-sm px-3">
                    <h2> Informacion </h2>
                    <form action="{{ route('social.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-2">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="name" value="{{ __('Nombre') }}" class="form-label" />
                                <x-jet-input id="name" type="text" class="mt-1 block w-full form-control" placeholder="{{ $name }}" value="{{ old('title', $publish->title) }}" disabled autocomplete="name" />
                                <x-jet-input-error for="name" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="title" value="{{ __('Titulo') }}" class="form-label" />
                                <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full form-control" value="{{ old('title', $publish->title) }}" />
                                <x-jet-input-error for="title" class="mt-2" />
                            </div>
                            <!-- Description -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="description" value="{{ __('Descripcion') }}" class="form-label" />
                                <textarea name="description" id="description" class="form-control border-gray-300 rounded-md shadow-sm" value="{{ old('description', $publish->description) }}" cols="15" rows="4"></textarea>
                            </div>
                            <!-- Imagen -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="image[]" value="{{ __('Imagen') }}" class="form-label" />
                                <input type="file" name="image[]" id="image[]" class="form-control border-gray-300 rounded-md shadow-sm" onchange="previewFiles()" multiple>
                            </div> 
                            <div class="container">
                                <!-- Aqui iran la imagenes que se selecionen -->
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-dark"> {{ __('Guardar')}} </button>
                        </div>
                    </form>
                </div>
                <div class="row my-3" id="preview">
                    <!-- Previsualizacion de imagenes -->
                </div>
                <div class="row">
                    <!-- los botones -->
                </div>
            </div>
           
        </div>

        <script src="{{ asset('js/img/preview-img.js') }}"></script>

    </x-slot>
</x-app-layout>