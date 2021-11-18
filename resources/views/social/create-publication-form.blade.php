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
                        <div class="col">
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
                            {{-- <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="description" value="{{ __('Imagen') }}" class="form-label" />
                                <input type="file" name="description" id="description" class="form-control border-gray-300 rounded-md shadow-sm" value="{{ old('description', $publish->description) }}" cols="15" rows="4"></textarea>
                            </div> --}}
                        </div>
                        <div>
                            <button class="btn btn-dark"> {{ __('Guardar')}} </button>
                        </div>
                    </form>
                </div>
                <div class="row my-3">
                <!-- img -->
                    <!-- <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <h2>
                                    Images
                                </h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="image-crop">
                                            <img src="img/p3.jpg">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Preview image</h4>
                                        <div class="img-preview img-preview-sm"></div>
                                        <h4>Comon method</h4>
                                        <p>
                                            You can upload new image to crop container and easy download new cropped image.
                                        </p>
                                        <div>
                                            <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                <input type="file" accept="image/*" name="file" id="inputImage" style="display:none">
                                                Upload image
                                            </label>
                                        </div>
                                        <a href="" id="download" class="btn btn-primary">Download</a>
                                        <h4>Other method</h4>
                                        <p>
                                            You may set cropper options with <code>$(image}).cropper(options)</code>
                                        </p>
                                        <div class="btn-group">
                                            <button class="btn btn-white" id="zoomIn" type="button">Zoom In</button>
                                            <button class="btn btn-white" id="zoomOut" type="button">Zoom Out</button>
                                            <button class="btn btn-white" id="rotateLeft" type="button">Rotate Left</button>
                                            <button class="btn btn-white" id="rotateRight" type="button">Rotate Right</button>
                                            <button class="btn btn-warning" id="setDrag" type="button">New crop</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- img -->
                </div>
                <div class="row">
                    <!-- los botones -->
                </div>
            </div>
           
        </div>

    </x-slot>
</x-app-layout>