<div class="flex items-center flex-nowrap overflow-hidden h-8 ">
{{--    @include('svgs',['svg' => 'user','classes' => 'h-4 w-4 mr-1'])--}}
    {{--    <img src="{{asset("/img/shop_items/avatars/avatar_1.jpg")}}" class="h-7 rounded" alt="dota ideas supporter's badge">--}}
    <div class="h-14 w-14 rounded-full overflow-hidden p-0.5 bg-gradient-to-br from-prim_a to-prim_b  mr-2">
        <img src="{{$avatar}}" alt="" class="rounded-full">
    </div>
    @if($medal)
        <img src="{{asset("/img/shop_items/unlocks/badge.png")}}" class="w-4 h-4 shadow_titulo mr-2" alt="dota ideas supporter's badge">
    @endif
    <x-a-link href="{{$href}}" class="flex items-center">{{$name}} <div class="flex items-center ml-1 space-x-1 ">
            @include('svgs',['svg' => 'points','classes' => 'h-4 w-4 '])
            <p class="">{{$points}}</p>
        </div></x-a-link>


</div>
<div class="flex items-center space-x-1 ">
    @include('svgs',['svg' => 'views','classes' => 'h-4 w-4 '])
    <p class="">{{$views}} <span class="hidden lg:inline-block">views</span></p>
</div>
<div class="flex items-center space-x-1 ">
    @include('svgs',['svg' => 'text','classes' => 'h-4 w-4 '])
    <p class="">{{$comments}} <span class="hidden lg:inline-block">comments</span></p>
</div>
