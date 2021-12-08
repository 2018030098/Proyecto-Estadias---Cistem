<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Social') }} </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="row container">
            <div class="col-9">
                <span class="d-none" hidden>{{$inc=0}}</span>
                @if($publication != 0)
                @foreach($publication as $public)
                    <div class="social-feed-box shadow my-3 animated fadeInDown">
                            <div class="float-end social-action dropdown dropstart">
                                <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent"></button>
                                <ul class="dropdown-menu m-t-xs">
                                    <li><a class="dropdown-item" href="{{ route('social.edit',$public['publication']['id']) }}">{{ __('Modificar') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('social.show',$public['publication']['id']) }}">{{ __('Abrir') }}</a></li>
                                    <hr>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete{{$public['publication']['id']}}">{{ __('Eliminar') }}</a></li>
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
                                        <div id="carousel_{{$inc}}" class="carousel slide" data-bs-ride="carousel">
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
                                                        <img src="{{ asset('storage/'.$image) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 60vh; margin: 0 auto;">
                                                    </div>
                                                @else
                                                    <div class="carousel-item ">
                                                        <img src="{{ asset('storage/'.$image) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 60vh; margin: 0 auto;">
                                                    </div>
                                                @endif
                                                <span class="d-none" hidden>{{$i++}}</span>
                                            @endforeach
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel_{{$inc}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon bg-dark bg-opacity-75" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel_{{$inc}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon bg-dark bg-opacity-75" aria-hidden="true"></span>
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
                                    <input id="publication_Id" name="publication_Id" value="{{ $public['publication']['id'] }}" hidden>
                                    <div class="position-relative"> 
                                        <button class="btn btn-primary end-0"> {{ __('Guardar')}} </button> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <span class="d-none" hidden>{{$inc++}}</span>

                    <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->
                    <div class="modal fade" id="delete{{$public['publication']['id']}}" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteLabel">Eliminar Publicacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('social.destroy',$public['publication']['id']) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        una ves eliminada una publicacion, no mostrara de nuevo 
                                        <hr>
                                        <label for="form-label">Ingrese su contraseña para eliminar</label>
                                        <input type="password" id="passwordDelete" name="passwordDelete" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->   <!--  -->
                @endforeach
                @else
                <div class="bg-transparent text-center mt-5">
                    <h1 class="animated fadeInUp">Sin publicaciones activas</h1>
                </div>
                @endif
            </div>
            <div class="col container ms-5">
                <div class="position-sticky">
                    <div class="d-flex justify-content-center my-5">
                        <a href="{{ route('social.create') }}" class="btn btn-success btn-rounded btn-lg h3">Crear nueva publicacion</a>
                    </div>
                    <div class="card shadow-sm rounded my-3 d-flex">
                        <div class="card-header">
                            Orden
                        </div>
                        <form action="{{ route('social.index') }}" method="GET" class="p-3">
                            @csrf
                            <button type="submit" class="form-check my-2 abc-radio-primary">
                                <input class="form-check-input iCheck" type="radio" name="order" id="order_desc" value="0" @if($order == 0) checked @endif>
                                <label class="form-check-label" for="order_desc">
                                    Descendente
                                </label>
                            </button>
                            <button type="submit" class="form-check my-2 abc-radio-primary">
                                <input class="form-check-input iCheck" type="radio" name="order" id="order_asc" value="1" @if($order == 1) checked @endif>
                                <label class="form-check-label" for="order_asc">
                                    Ascendente
                                </label>
                            </button>
                        </form>
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
            <div class="alert alert-dismissible animated d-none shadow-sm {{ session('class') }}" role="alert" aria-live="assertive" aria-atomic="true" id="loadToast" style="position: absolute; top: 20px; right: 20px;">
                <div class="alert-heading row">
                    <div class="col-10">
                        <i class="{{ session('icon') }}"></i>
                        <strong class="mr-auto m-l-sm">   {{ session('title') }}   </strong>
                    </div>
                    <div class="col-2">
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" onclick="closeToast()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <hr>
                <div>
                    {{ session('message') }}
                </div>
            </div>
        @endif
    </x-slot>
</x-app-layout>