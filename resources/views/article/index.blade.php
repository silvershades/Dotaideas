@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3">

            <section class="px-6 lg:px-0">
                <article class="shadow-lg shadow-primary-accent-sub bg-primary-card rounded flex items-center justify-center p-4 flex-col relative">
                    <div class="flex-grow mx-auto">
                        <div class="flex items-center justify-center flex-col text-center">
                            @include('svgs',['svg' => 'articles','classes' => 'h-10 w-10 text-primary-icon my-2'])
                            <h1 class="text-5xl uppercase shadow_titulo font-black mb-2">DOTA 2 MEGA GUIDE</h1>
                        </div>

                    </div>
                    <div class="h-96 w-full">
                        <img src="{{asset("/img/banner_guide.jpg")}}" alt="Dota Ideas Dota 2 Mega Guide" class="object-cover w-full h-full rounded-2xl shadow_titulo">
                    </div>
                    <p class="font-semibold text-lg uppercase text-primary-accent mt-6">Master the craft of Dota 2 at your full potential</p>
                    <div class="grid grid-cols-5 gap-4  mt-4">
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Objectives</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Attributes</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Heroes</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Abilities</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Items</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Timings</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Vision</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Buildings</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Roshan</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                        <div class="flex items-center justify-center space-y-4 flex-col rounded bg-primary-card-sub p-6 shadow_caja">
                            <h2 class="font-bold text-xl text-center uppercase shadow_titulo">Tactics</h2>
                            @include('svgs',['svg' => 'attack_time','classes' => 'h-10 w-10 text-primary-icon'])
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-center space-x-4">
                        <x-a-button href="{{route('article.mega_guide')}}" :icon="''">View guide</x-a-button>
                        <x-a-button href="{{route('article.mega_guide')}}" :icon="'share'">SHARE</x-a-button>
                    </div>

                </article>

                {{--                @foreach($articles as $article)--}}
                {{--                    <article class="shadow_caja bg-primary-card rounded flex items-center justify-center p-4 flex-col space-y-4 relative">--}}

                {{--                        <div class="flex-grow mx-auto">--}}
                {{--                            <p class="text-sm text-primary-text-muted text-center ">DOTA 2 ARTICLE</p>--}}
                {{--                            <div class="flex items-center justify-center flex-col text-center">--}}
                {{--                                @include('svgs',['svg' => 'articles','classes' => 'h-10 w-10 text-primary-icon my-2'])--}}
                {{--                                <h1 class="text-4xl font-semibold">{{$article->title}}</h1>--}}
                {{--                                <h2 class="text-lg text-primary-accent">{{$article->subtitle}}</h2>--}}
                {{--                            </div>--}}
                {{--                            <div class="flex items-center justify-center my-4">--}}
                {{--                                @include('svgs',['svg' => $article->svg,'classes' => 'h-16 w-16 text-primary-icon'])--}}
                {{--                            </div>--}}
                {{--                            <p class="">{{$article->bajada}}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="p-4 flex items-center justify-center space-x-4">--}}
                {{--                            <x-a-button href="{{route('article.show',['article'=>$article->id])}}" :icon="''">View Article</x-a-button>--}}
                {{--                            <x-a-button href="{{route('article.show',['article'=>$article->id])}}" :icon="'share'">SHARE</x-a-button>--}}
                {{--                        </div>--}}
                {{--                    </article>--}}
                {{--                @endforeach--}}

            </section>

        </div>
        <div>
            <x-sidebar></x-sidebar>
        </div>
    </div>


@endsection
