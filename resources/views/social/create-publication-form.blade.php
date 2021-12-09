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
                <a href="{{ route('social.index',['order'=>'0']) }}" class="text-decoration-none">{{ __('Publicaciones') }}</a>
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
                                @if( $publication['publication']['created_at'] !== $publication['publication']['updated_at'] )
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
                                <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full form-control" value="{{ $publication['publication']['title'] }}" require/> 
                                @else
                                <x-jet-input id="title" name="title" type="text" class="mt-1 block w-full form-control" require/> 
                                @endif
                                <x-jet-input-error for="title" class="mt-2" />
                            </div>
                            <!-- Description -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="description" value="{{ __('Descripcion') }}" class="form-label" />
                                <textarea name="description" id="description" class="form-control border-gray-300 rounded-md shadow-sm" cols="15" rows="4" require>@if($cnd){{ $publication['publication']['description']}}@endif </textarea>
                            </div>
                            <!-- Imagen -->
                            <div class="col-span-6 sm:col-span-4 mt-4">
                                <x-jet-label for="image[]" value="{{ __('Imagen') }}" class="form-label" />
                                <div id="divImg">
                                    <input type="file" name="image[]" id="image[]" accept="image/*" class="form-control border-gray-300 rounded-md shadow-sm" value="@if($cnd) @if($publication['image'] != @null) @foreach($publication['image'] as $img) {{ asset('storage/'.$img) }} @endforeach @endif @endif" onchange="previewFiles()" multiple>
                            </div>                                                         <!-- jpeg, image/jpg, image/png, image/gif, image/svg, image/webp -->
                                <div class="text-danger mt-3 ms-2 d-none" id="errorImg">
                                    <span><em>El archivo seleccionado no tiene el formato adecuado, solo suba imagenes</em></span>
                                    <i class="far fa-question-circle h6"data-bs-toggle="tooltip" data-bs-placement="right" title="Tipos permitidos: jpg,jpeg,png,gif,webp,svg, bmp,eps"></i>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-grid row mx-auto">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary col-5 me-2"> {{ __('Guardar')}} </button>
                                <a href="{{ route('social.index',['order'=>'0']) }}" class="btn btn-secondary col-4"> Cancelar </a>
                            </div>
                            @if($cnd)
                                <span class="btn btn-danger col-2 ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Completar</span>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="row m-3 p-3 container bg-white shadow-sm" >
                    <!-- Previsualizacion de imagenes -->
                    <div id="imgTitle" class="d-none">
                        <h3 class="d-flex justify-content-center">{{ __('Imagenes Seleccionadas') }}</h3>
                    </div>
                    <div id="preview" class="row">
                        @if($cnd)
                            @if($publication['image'] != @null)
                            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @for($i=0; $i < count($publication['image']); $i++ )
                                    @if($i == 0)
                                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i}}"></button>
                                    @else 
                                        <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i}}"></button>
                                    @endif
                                    @endfor
                                </div>
                                <div class="carousel-inner">
                                    <span class="d-none" hidden>{{$i = 0}}</span>
                                    @foreach( $publication['image'] as $img)
                                    @if($i == 0)
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/'.$img) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 80vh; margin: 0 auto;">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img src="{{ asset('storage/'.$img) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 80vh; margin: 0 auto;">
                                        </div>
                                    @endif
                                        <span class="d-none" hidden>{{$i++}}</span>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-dark bg-opacity-75" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-dark bg-opacity-75" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <!-- <script src="{{ asset('js/img/preview-img.js') }}"></script> --> --}}
        @if($cnd)
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar estado de la publicacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Al cambiar el estado de la publicacion 
                        <br>
                        estarias diciendo que el tema tratado en la publicacion se ha completado, por lo que esta yo no apareceria mas dentro de las demas publicaciones
                        <br>
                        ¿Estas seguro que desea marcar como completado el tema de la publicacion?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('changeStatus', [$publication['publication']['id'],$publication['publication']['status']=0] ) }}" method="post">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-primary">Cambiar estado</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </x-slot>
</x-app-layout>