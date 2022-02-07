@extends('layout')

@section('content')
    <div class="rounded shadow_caja bg-primary-card p-6">
        <p class="gradient_full_di text-2xl mb-6 font-black">MONTHLY REWORK CHALLENGES - DIRECTORY</p>

        <div>
            @foreach($mrcs as $mrc)
                @if($mrc->is_active)
                    <div class="grid lg:grid-cols-3 gap-10 p-6 border-2 border-primary-icon mb-6 rounded  bg-primary-card-sub shadow-lg shadow-primary-icon">
                        @else
                            <div class="grid lg:grid-cols-3 gap-10 p-4 mx-4 border-2 border-primary-accent mb-4 rounded  bg-primary-card-sub shadow-inner">
                                @endif

                                <div class="relative">
                                    <img src="{{asset($mrc->img_path)}}" alt="mrc pick img" class="w-full h-44 object-cover rounded shadow_titulo">
                                    <img src="{{asset($mrc->spell_img_path)}}" alt="mrc pick img" class="w-24 h-24 absolute -bottom-2 -right-2 rounded shadow_titulo">
                                </div>
                                <div class="flex items-start justify-center flex-col">
                                    <p class="text-primary-text-muted text-sm">HERO OR ITEM NAME</p>
                                    <p class="gradient_full_di text-2xl">{{$mrc->name}}</p>
                                    <p class="text-primary-text-muted text-sm">ABILITY NAME</p>
                                    <p class="gradient_full_di text-2xl">{{$mrc->spell_name}}</p>
                                    <p class="text-primary-text-muted text-sm">STATUS</p>
                                    @if($mrc->is_active)
                                        <p class=" text-on text-2xl">OPEN</p>
                                    @else
                                        <p class=" text-off text-2xl">FINISHED</p>
                                    @endif
                                </div>
                                <div class="flex items-start justify-center flex-col space-y-4">
                                    <div>
                                        <p class="text-primary-text-muted text-sm">START DATE</p>
                                        <p class="">{{$mrc->start_date->format('d-m-Y')}}</p>
                                        <p class="text-primary-text-muted text-sm">END DATE</p>
                                        <p class="">{{$mrc->end_date->format('d-m-Y')}}</p>
                                        @if(!$mrc->is_active)
                                            <p class="text-primary-text-muted text-sm">WINNER</p>
                                            <p class="">{{$mrc->winner()}}</p>
                                        @endif

                                    </div>
                                    <div class="flex items-start justify-center space-x-4">

                                        @if($mrc->is_active)
                                            <x-a-button href="{{route('mrc.index')}}" :icon="''">PARTICIPATE NOW</x-a-button>
                                            <x-a-button href="{{route('mrc.show',['mrc'=>$mrc->id])}}" :icon="''">VOTE!</x-a-button>
                                        @else
                                            <x-a-button href="{{route('mrc.show',['mrc'=>$mrc->id])}}" :icon="''">VIEW ENTRIES</x-a-button>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                    </div>
        </div>

@endsection
