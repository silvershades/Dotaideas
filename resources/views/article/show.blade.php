@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3">
            <article class="rounded bg-primary-card px-6 py-10 shadow_caja ">
                <div class="flex items-center justify-center mb-10">
                    @include('svgs',['svg' => 'articles','classes' => 'h-10 w-10 text-primary-icon'])
                </div>
                <div class="prose lg:prose-xl mx-auto text-primary-text">
                    <h1 class="">{{$article->title}}</h1>
                    @include("article.htmls.".$article->body_html)
                    <h2>Credits</h2>
                    <p>Posted by <span class="gradient_full_di">DOTA IDEAS</span></p>
                    <div class="flex items-center justify-center mb-10">
                        @include('svgs',['svg' => 'articles','classes' => 'h-5 w-5 text-primary-icon mr-2'])
                        <x-a-link href="{{route('article.index')}}">view more articles</x-a-link>
                    </div>

                </div>

            </article>

        </div>
        <div>
            <x-sidebar></x-sidebar>
        </div>
    </div>


@endsection
