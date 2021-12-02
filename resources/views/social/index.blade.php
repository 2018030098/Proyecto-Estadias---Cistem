<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Social') }} </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="row container">
            <div class="col-9">
                <span class="d-none" hidden>{{$inc=0}}</span>
                @foreach($publication as $public)
                <div class="social-feed-box shadow my-3">
                        <div class="float-end social-action dropdown">
                            <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent"></button>
                            <ul class="dropdown-menu m-t-xs">
                                <li><a class="dropdown-item" href="{{ route('social.edit',$public['publication']['id']) }}">{{ __('Modificar') }}</a></li>
                                <li><a class="dropdown-item" href="{{-- route('social.destroy',$public['publication']['id']) --}}" disabled>{{ __('Eliminar') }}</a></li>
                            </ul>
                        </div>
                    <div class="social-avatar">                                    
                        <div class="media-body row">
                            <div class="col-auto row">
                                <div class="col">
                                    <img alt="image" src="{{ asset('storage/'.$public['user']['profile_photo_path'] ) }}" class="rounded-full object-cover"> 
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="text-decoration-none">                   
                                        {{ $public['user']['name'] }}
                                    </a>
                                    <small class="text-muted"> {{ $public['publication']['updated_at'] }} </small>
                                </div>
                            </div>
                            <div class="col text-center h5">
                                {{ $public['publication']['title'] }}
                            </div>
                        </div>
                    </div>
                    <div class="social-body">
                        <p>
                            {{ $public['publication']['description'] }}
                        </p>
                        <div class="container row d-flex justify-content-center">
                            @if($public['images'] != @null)
                                @if($public['numero_de_imagenes'] > 1)
                                    <div id="carousel_{{$inc}}" class="carousel slide gray-bg" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                        @for($i=0;$i<$public['numero_de_imagenes'];$i++)
                                            @if($i == 0)
                                                <button type="button" data-bs-target="#carousel_{{$inc}}" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i}}"></button>
                                            @else
                                                <button type="button" data-bs-target="#carousel_{{$inc}}" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i}}"></button>
                                            @endif
                                        @endfor
                                        </div>
                                        <div class="carousel-inner">
                                            <span class="d-none" hidden>{{$i = 0}}</span>
                                        @foreach($public['images'] as $image)
                                            @if($i == 0)
                                                <div class="carousel-item active ">
                                                    <img src="{{ asset('storage/'.$image) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 40vh; margin: 0 auto;">
                                                </div>
                                            @else
                                                <div class="carousel-item ">
                                                    <img src="{{ asset('storage/'.$image) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 40vh; margin: 0 auto;">
                                                </div>
                                            @endif
                                            <span class="d-none" hidden>{{$i++}}</span>
                                        @endforeach
                                        </div>
                                        <button class="carousel-dark carousel-control-prev" type="button" data-bs-target="#carousel_{{$inc}}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-dark carousel-control-next" type="button" data-bs-target="#carousel_{{$inc}}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/'.$public['images']['0']) }}" alt="imagen" class="img-fluid w-auto">
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="social-footer">
                        @if($public['comments'] != @null)
                        @foreach($public['comments'] as $comment)
                        <div class="social-comment">
                            <div class="media-body row">
                                <div class="col-auto d-flex justify-content-center">
                                    <img alt="image" src="{{ asset('storage/'.$comment['profile_photo_path']) }}" class="rounded-full object-cover">
                                </div>
                                <div class="col">
                                    <a href="#" class="text-decoration-none">
                                        {{ $comment['name'] }}
                                    </a>
                                    <span> {{ $comment['comment'] }} </span>
                                    <br/>
                                    <small class="text-muted">{{ $comment['updated_at'] }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        @endif
                        <div class="social-comment row">
                            <div class="col-auto">
                                <img alt="image" src="{{ asset('storage/'.$public['auth']['profile_photo_path']) }}" class="rounded-full object-cover">
                            </div>
                            <form class="media-body col" action="{{ route('social.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <textarea class="form-control" id="comment" name="comment" placeholder="Write comment..."></textarea>
                                <input id="publish_Id" name="publish_Id" value="{{ $public['publication']['id'] }}" hidden>
                                <div class="position-relative"> 
                                    <button class="btn btn-primary end-0"> {{ __('Guardar')}} </button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <span class="d-none" hidden>{{$inc++}}</span>
                @endforeach
            </div>
            <div class="col container ms-5">
                <div class="position-sticky">
                    <div class="d-flex justify-content-center my-5">
                        <a href="{{ route('social.create') }}" class="btn btn-success">Crear nueva publicacion</a>
                    </div>
                    <div class="card shadow-sm rounded my-3">
                        <div class="card-header">
                            Ordenar
                        </div>
                        <div class="card-body ">
                            <div class="row col-6 d-grid">
                                <a href="{{ route('social.index',['order'=>'1']) }}" class="btn btn-dark">Ascendente</a>
                            </div>
                            <div class="row col-6 d-grid">
                                <a href="{{ route('social.index',['order'=>'0']) }}" class="btn btn-dark">Descendente</a>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-sm rounded my-3">
                        <div class="card-header">
                            Mecanicas
                        </div>
                        <div class="card-body">
                            Configuraciones
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->
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