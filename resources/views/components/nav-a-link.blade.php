<span {{ $attributes->merge(['class' =>
    "group flex items-center justify-center transition-all duration-300  h-full pr-0.5 rounded-none
        bg-gradient-to-b from-prim_a to-prim_b
        hover:shadow-lg hover:shadow-primary-accent-sub"
    ]) }}>
<span class="bg-gradient-to-br from-prim_d to-prim_c h-full">
<a href="{{$href}}" class="flex items-center justify-center  px-4 py-1 h-full skew-x-12 xl:w-44 font-title
font-semibold  decoration-primary-accent decoration-1 hover:underline hover:decoration-2 hover:decoration-primary-icon
focus:underline focus:decoration-2 focus:decoration-primary-icon
focus:ring-0 shadow_titulo text-primary-text">
{{--@include('svgs',['svg' => $icon,'classes' => 'w-5 h-5 mr-1 text-primary-accent'])--}}
    {{$slot}}
</a>
</span>
</span>
