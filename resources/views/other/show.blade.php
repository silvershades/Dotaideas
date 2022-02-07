@extends('layout')

@section('content')

    <!-- GENERAL DESCRIPTION --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow_caja pb-6">
        <x-section-header>GENERAL</x-section-header>
        <div class="flex items-center justify-around px-6 my-2 flex-wrap space-x-4">
            <!-- TITULO -->

            <div class="flex-grow items-center justify-start flex space-x-2">
                @include('svgs',['svg' => 'post_other','classes' => 'h-6 w-6 text-primary-accent shrink-0'])
                <p class="text-3xl font-semibold py-2 shadow_titulo">{{$other->name}}</p>
            </div>
            <div>
                <div class="flex items-center justify-center space-x-4 ">
                    @if(Auth::check() && Auth::id() == $other->post->user->id)
                        <x-a-button href="{{route('other.edit',$other->id)}}" :icon="'edit'">EDIT POST</x-a-button>
                    @endif
                    <x-a-button href="#vote" :icon="'vote'">VOTE</x-a-button>
                    <x-a-button href="#" :icon="'share'">Share this post</x-a-button>
                </div>
            </div>
            <x-score-post-header>
                <x-slot name="score">{{$other->post->votes_total()}}</x-slot>
                <x-slot name="awards">{{$other->post->awards->count()}}</x-slot>
            </x-score-post-header>
        </div>
        <div class="px-6 grid lg:grid-cols-2 gap-4">
            <div class="flex items-start justify-center">
                <div class="w-full">
                    <!-- HERO PORTRAIT -->
                    <div class="rounded shadow-lg shadow-primary-accent-sub">
                        <div class="w-full h-96 gradient_placeholder rounded">
                            @if($other->img_is_uploaded)
                                <img src="{{$other->img_path}}" alt="Other idea image" class="object-cover w-full h-full object-top rounded">
                            @endif
                        </div>
                    </div>


                </div>
            </div>
            <div class="px-1 space-y-4">

                <div class="">

                    <p class="label_title mb-4 lg:mb-1">Flag</p>
                    <div class="rounded flex flex-col items-center justify-center  bg-primary-card-sub space-y-1 py-1 my-4">
                        @include('svgs',['svg' => 'flag','classes' => 'h-5 w-5 text-primary-icon'])
                        <p>{{$other->other_flags->name}}</p>
                    </div>
                    <p class="label_title mb-4">Description</p>
                    <div class="long_text text_html">{!! $other->description!!}</div>
                </div>
            </div>
        </div>
    </div>


    <!-- CREDITS & VOTING --------------------------------------------------------------------------------------------------------------->
    <x-credits :post="$other->post"></x-credits>
    <!-- COMMENTS --------------------------------------------------------------------------------------------------------------->
    <x-comments :post="$other->post"></x-comments>


@endsection
