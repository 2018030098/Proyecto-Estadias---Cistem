<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publicacion') }}
        </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('social.index',['order'=>'0']) }}" class="text-decoration-none">{{ __('Publicaciones') }}</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>{{ $publication['publication']['title'] }}</strong>
            </li>
        </ol>
    </x-slot>
    <x-slot name="slot">
        <div class="row container">
            <div class=""> <!-- col-9 -->
                <div class="social-feed-box shadow my-3 animated fadeInDown">
                        <div class="float-end social-action">
                            @if($publication['auth']['user'])
                                <button type="button" class="btn btn-success" aria-expanded="false">Mi Publicacion</button>
                            @else
                                <button type="button" class="btn btn-danger" aria-expanded="false">{{ $publication['user']['name'] }}</button>
                            @endif
                        </div>
                    <div class="social-avatar">
                        <div class="media-body row">
                            <div class="col-auto row">
                                <div class="col-auto">
                                    <img alt="image" src="{{ asset('storage/'.$publication['user']['profile_photo_path'] ) }}" class="rounded-full object-cover"> 
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="text-decoration-none">                   
                                        {{ $publication['user']['name'] }}
                                    </a>
                                    <small class="text-muted">{{ $publication['user']['email'] }}</small>
                                    <br>
                                    <small class="text-muted"> {{ $publication['publication']['updated_at'] }} </small>
                                </div>
                            </div>
                            <div class="col text-center h5">
                                {{ $publication['publication']['title'] }}
                            </div>
                        </div>
                    </div>
                    <div class="social-body">
                        <p>
                            {{ $publication['publication']['description'] }}
                        </p>
                        <div class="container row d-flex justify-content-center">
                            @if($publication['images'] != @null)
                                @if($publication['numero_de_imagenes'] > 1)
                                    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                        @for($i=0;$i<$publication['numero_de_imagenes'];$i++)
                                            @if($i == 0)
                                                <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{$i}}" class="active" aria-current="true" aria-label="Slide {{$i}}"></button>
                                            @else
                                                <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{$i}}" aria-label="Slide {{$i}}"></button>
                                            @endif
                                        @endfor
                                        </div>
                                        <div class="carousel-inner">
                                            <span class="d-none" hidden>{{$i = 0}}</span>
                                        @foreach($publication['images'] as $image)
                                            @if($i == 0)
                                                <div class="carousel-item active ">
                                                    <img src="{{ asset('storage/'.$image['img_path']) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 60vh; margin: 0 auto;">
                                                </div>
                                            @else
                                                <div class="carousel-item ">
                                                    <img src="{{ asset('storage/'.$image['img_path']) }}" alt="imagen" class="img-fluid" style="width: fit-content; height: 60vh; margin: 0 auto;">
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
                                @else
                                    <img src="{{ asset('storage/'.$public['images']['0']) }}" alt="imagen" class="img-fluid w-auto">
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="social-footer">
                        @if($publication['comments'] != @null)
                        @foreach($publication['comments'] as $comment)
                        <div class="social-comment">
                            <div class="media-body row">
                                <div class="col-auto d-flex justify-content-center">
                                    <img alt="image" src="{{ asset('storage/'.$comment['user']['profile_photo_path']) }}" class="rounded-full object-cover">
                                </div>
                                <div class="col">
                                    <a href="#" class="text-decoration-none">
                                        {{ $comment['user']['name'] }}
                                    </a>
                                    <span> {{ $comment['comment']['comment'] }} </span>
                                    <br/>
                                    <small class="text-muted">{{ $comment['comment']['updated_at'] }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        @endif
                        <div class="social-comment row">
                            <div class="col-auto">
                                <img alt="image" src="{{ asset('storage/'.$publication['auth']['profile_photo_path']) }}" class="rounded-full object-cover">
                            </div>
                            <form class="media-body col" action="{{ route('social.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <textarea class="form-control" id="comment" name="comment" placeholder="Write comment..."></textarea>
                                <input id="publication_Id" name="publication_Id" value="{{ $publication['publication']['id'] }}" hidden>
                                <div class="position-relative"> 
                                    <button class="btn btn-primary end-0"> {{ __('Guardar')}} </button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col container ms-5">
                <div class="card">websocket</div>
            </div> -->
        </div>
    </x-slot>
</x-app-layout>
