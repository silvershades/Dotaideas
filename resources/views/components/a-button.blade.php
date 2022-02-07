<a href="{{$href}}"
    {{ $attributes->merge(['class' =>
"shadow h-[35px] pb-0.5 pr-0.5
bg-gradient-to-br from-prim_a to-prim_b
cursor-pointer rounded transition-all
hover:shadow-md hover:brightness-110
hover:shadow-primary-accent font-title"
]) }}>
    <div class="space-x-2 px-3 flex items-center  h-[33px] bg-gradient-to-r from-prim_c to-prim_d transition-all shadow-inner">
        @include('svgs',['svg' => $icon,'classes' => 'w-5 h-5'])
        <p class="drop-shadow font-semibold uppercase ">{{$slot}}</p>
    </div>
</a>
