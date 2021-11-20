<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Social') }} </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="row container">
            <div class="col-9">
                @foreach($publication as $public)
                <div class="social-feed-box shadow my-3">
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
                            <div class="text-center col h5">
                            {{ $public['publication']['title'] }}
                            </div>
                        </div>
                    </div>
                    <div class="social-body">
                        <p>
                            {{ $public['publication']['description'] }}
                        </p>
                        <div class="container">
                            @if($public['images'] != @null)
                                @foreach($public['images'] as $image)
                            <img src="{{ asset('storage/'.$image) }}" alt="imagen" class="img-fluid">    
                                @endforeach
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
                @endforeach
            </div>
            <div class="col container ms-5">
                <div class="position-sticky">
                    <div class="d-flex justify-content-center my-5">
                        <a href="{{ route('social.create') }}" class="btn btn-success">Crear nueva publicacion</a>
                    </div>
                    <div class="card shadow-sm rounded my-3">
                        <div class="card-header">
                            Mecanicas
                        </div>
                        <div class="card-body ">
                            Configuraciones
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