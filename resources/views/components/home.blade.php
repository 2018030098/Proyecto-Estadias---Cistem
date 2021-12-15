<div class="row">
    <div class="col me-3">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($info as $data)
            <a href="{{ route('social.show',$data['id']) }}" class="text-decoration-none text-black">
                <div class="col">
                    <div class="widget-head-color-box p-lg text-white text-center" style="background-color: #294056;"> <!-- navy-bg -->
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                {{ $data['title'] }}
                            </h2>
                            <small>{{ $data['name'] }}</small>
                        </div>
                        <div>
                            {{ $data['date'] }}
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
<div class="row col mt-5">
    <form action="{{ route('social.index') }}" method="GET">
        @csrf
        <div class="mx-auto d-grid col-2">
            <button class="btn btn-dark btn-lg">Ver mas</button>
        </div>
    </form>
</div>