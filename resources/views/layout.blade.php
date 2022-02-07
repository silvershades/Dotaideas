<!DOCTYPE html>
<html lang="en" class="scrollbar scrollbar-thin scrollbar-thumb-primary-accent-sub-dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="{{env('GOOGLE_CLIENT_ID')}}">
    <title>Dota Ideas</title>

    <!-- CSS -->
    <link rel="icon" type="image/x-icon" href="{{asset("/img/favicon.ico")}}">
    <link rel="stylesheet" href="{{asset("/css/app.css")}}">
    <link rel="stylesheet" href="{{asset("/skins/skins/ui/custom/skin.css")}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&family=Poppins:wght@300;400;500;600;700&family=Roboto+Mono&display=swap" rel="stylesheet">


    {{--    <script src="https://apis.google.com/js/platform.js" async defer></script>--}}
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    {{--    <script src="https://www.paypal.com/sdk/js?client-id=AXg5LN1Ws6o1gNvmACWYwnIMomoAuoVksihSAL3Wv9OygVRKvWsqxxokf7MBPaBPrBjL-NOYUXawhiJM&currency=USD"></script>--}}


</head>
<body class="font-serif bg-gradient-to-br from-zinc-800 to-indigo-500 text-primary-text ">
<header class="bg-gradient-to-r from-prim_a to-prim_b pb-0.5  ">
    <div class="bg-gradient-to-r from-prim_d/90 to-prim_d text-primary-text  overflow-hidden">
        <div class="container mx-auto flex items-center justify-between h-[60px]">
            <div>
                @include('svgs',['svg' => 'logo','classes' => 'h-10 w-10 text-primary-accent  bg-indigo-900 rounded-xl overflow-hidden'])
            </div>
            <h1 class="flex-1 px-2 mx-2  font-title">
                <a href="/" class="lg:text-3xl xl:text-4xl leading-none gradient_full_di font-black flex items-start flex-col justify-center ">
                    DOTA IDEAS
                    <span class="text-xs tracking-wider text-primary-accent font-semibold">
                    THE DOTA 2 INTERACTIVE FORUM
                    </span>
                </a>

            </h1>
            <div class="flex-none hidden px-2 mx-2 lg:flex h-full">
                <nav class="flex items-center h-full" id="nav_principal">
                    <ul class="flex items-center justify-center h-full">
                        <li class="h-full">
                            <x-nav-a-link href="{{route('post.create')}}" :icon="'plus'" class="pl-0.5">CREATE IDEA</x-nav-a-link>
                        </li>
                        <li class="h-full">
                            <x-nav-a-link href="{{route('shop.index')}}" :icon="'shop'">SIDESHOP</x-nav-a-link>
                        </li>
                        <li class="h-full">
                            <x-nav-a-link href="{{route('mrc.dir')}}" :icon="'articles'">MRC</x-nav-a-link>
                        </li>
                        @if(!Auth::check())
                            <li class="h-full">
                                <x-nav-a-link href="{{route('register')}}" :icon="'register'">REGISTER</x-nav-a-link>
                            </li>
                            <li class="h-full">
                                <x-nav-a-link href="{{route('login')}}" :icon="'login'">LOGIN</x-nav-a-link>
                            </li>
                        @else
                            <li class="h-full">
                                <x-nav-a-link href="{{route('user.show',['user'=>Auth::id()])}}" :icon="'user'">PROFILE</x-nav-a-link>
                            </li>
                            <form method="post" action="{{route('logout')}}" class="m-0 p-0 flex items-center justify-center h-full">
                                @csrf
                                <li class="h-full">
                                    <span class="group flex items-center justify-center transition-all duration-300  h-full pr-0.5 rounded-none
                                            bg-gradient-to-b from-prim_a to-prim_b hover:shadow-lg hover:shadow-primary-accent-sub">
                                    <span class="bg-gradient-to-br from-prim_d to-prim_c h-full">
                                    <button type="submit" class="flex items-center justify-center  px-4 py-1 h-full skew-x-12 xl:w-44 font-title
                                    font-semibold  decoration-primary-accent decoration-1 hover:underline hover:decoration-2 hover:decoration-primary-icon
                                    focus:underline focus:decoration-2 focus:decoration-primary-icon shadow_titulo text-primary-text">
                                    @include('svgs',['svg' => 'logout','classes' => 'w-5 h-5 mr-1 text-primary-accent'])
                                        LOGOUT
                                    </button>
                                    </span>
                                    </span>
                                </li>
                            </form>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="flex-none lg:hidden">
                <button class="btn btn-square btn-ghost">
                    @include('svgs',['svg' => 'menu','classes' => 'inline-block w-6 h-6 stroke-current'])
                </button>
            </div>
        </div>
    </div>
</header>
<main class="container mx-auto mt-6 px-1 pb-10  rounded relative min-h-screen" id="app">
    <video autoplay muted loop id="myVideo">
        <source src="{{asset('/img/video.mp4')}}" type="video/mp4">
    </video>
    @yield('content')
</main>
<script type="module" src="{{mix("/js/app.js")}}"></script>
{{--<script>--}}
{{--    var id_token = '';--}}
{{--    function onSignIn(googleUser) {--}}
{{--        id_token = googleUser.getAuthResponse().id_token;--}}
{{--        console.log(id_token)--}}

{{--        var xhr = new XMLHttpRequest();--}}
{{--        xhr.open('POST', '/api/check-google');--}}

{{--        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');--}}
{{--        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token()}}');--}}

{{--        xhr.onload = function() {--}}
{{--            console.log('Signed in as: ' + xhr.responseText);--}}
{{--        };--}}
{{--        xhr.send('idtoken=' + id_token  );--}}
{{--    }--}}




{{--</script>--}}
</body>
</html>
