@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3">
            <div class="p-0.5 bg-gradient-to-br from-prim_a to-prim_b rounded   mb-4">
                <div class="rounded bg-waves bg-cover drop-shadow text-center grid grid-cols-2 gap-6  relative">
                    <div class="flex items-center justify-center flex-col space-y-2  p-6 relative z-10">
                        <p class="text-5xl font-semibold gradient_full_di font-bold">CREATE YOUR <br> DOTA IDEA</p>
                    </div>
                    <div class="overflow-hidden p-6 flex items-center justify-center">
                        <img src="{{asset("/img/tide_idea2.png")}}" alt="tidehunter having an idea" class="max-h-[250px] object-contain drop-shadow">
                    </div>
                </div>
            </div>
            <section class="grid grid-cols-3 gap-4">
                <div class="bg-primary-card rounded drop-shadow flex items-center justify-around flex-col p-6 shadow_caja relative">
                    <div class="bg-waves  bg-cover absolute inset-0 opacity-10 bg-bottom"></div>
                    <div class="flex items-center justify-center w-10 h-10 flex-shrink-0">
                        @include('svgs',['svg' => 'post_hero','classes' => 'h-8 w-8 text-primary-accent'])
                    </div>
                    <div class="my-4  relative z-50 flex-grow flex flex-col items-center justify-center">
                        <p class="text-xl font-semibold  text-center text-primary-text">CREATE YOUR</p>
                        <p class="text-5xl font-bold gradient_full_di text-center">HERO</p>
                    </div>
                    <p class="py-2  text-center">Create your own hero and all of it's aspects. Manage it's attributes, abilities, talents, description and more.
                    </p>
                    <div class="flex items-center justify-center text-center space-x-4 shrink-0  relative z-50">
                        @if(Auth::check())
                            <x-a-button :icon="'plus'" href="{{route('hero.create')}}">CREATE IDEA</x-a-button>
                        @else
                            <x-login-required-button :icon="'login'" href="{{route('login')}}">LOGIN TO CREATE</x-login-required-button>
                        @endif
                    </div>

                </div>
                <div class="bg-primary-card rounded drop-shadow flex items-center justify-around flex-col p-6 shadow_caja relative">
                    <div class="bg-waves  bg-cover absolute inset-0 opacity-10 bg-center"></div>
                    <div class="flex items-center justify-center  w-10 h-10 flex-shrink-0">
                        @include('svgs',['svg' => 'post_item','classes' => 'h-8 w-8 text-primary-accent'])
                    </div>
                    <div class="my-4  relative z-50 flex-grow flex flex-col items-center justify-center">
                        <p class="text-xl font-semibold  text-center text-primary-text">CREATE YOUR</p>
                        <p class="text-5xl font-bold gradient_full_di text-center">ITEM</p>
                    </div>
                    <p class="py-2 text-center">Create your own item with full description. Manage it's attributes, cost, recipe, abilities, description and more.
                    </p>
                    <div class="flex items-center justify-center text-center space-x-4 shrink-0 relative z-50">
                        @if(Auth::check())
                            <x-a-button :icon="'plus'" href="{{route('item.create')}}">CREATE IDEA</x-a-button>
                        @else
                            <x-login-required-button :icon="'login'" href="{{route('login')}}">LOGIN TO CREATE</x-login-required-button>
                        @endif
                    </div>
                </div>
                <div class="bg-primary-card rounded drop-shadow flex items-center justify-around flex-col p-6 shadow_caja relative">
                    <div class="bg-waves  bg-cover absolute inset-0 opacity-10 bg-top"></div>
                    <div class="flex items-center justify-center  w-10 h-10 flex-shrink-0">
                        @include('svgs',['svg' => 'post_other','classes' => 'h-8 w-8 text-primary-accent'])
                    </div>
                    <div class="my-4  relative z-50 flex-grow flex flex-col items-center justify-center">
                        <p class="text-xl font-semibold  text-center text-primary-text">CREATE</p>
                        <p class="text-5xl font-bold gradient_full_di text-center">OTHER</p>
                        <p class="text-xl font-semibold  text-center text-primary-text">IDEA</p>
                    </div>
                    <p class="py-2 text-center">You can create your own idea or concept no matter what it is. Manage it's description and more.
                    </p>
                    <div class="flex items-center justify-center text-center space-x-4 shrink-0 relative z-50">
                        @if(Auth::check())
                            <x-a-button :icon="'plus'" href="{{route('other.create')}}">CREATE IDEA</x-a-button>
                        @else
                            <x-login-required-button :icon="'login'" href="{{route('login')}}">LOGIN TO CREATE</x-login-required-button>
                        @endif
                    </div>
                </div>

            </section>

        </div>
        <div>
            <x-sidebar></x-sidebar>
        </div>
    </div>


@endsection
