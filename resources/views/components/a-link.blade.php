<a href="{{$href}}"
        {{ $attributes->merge(['class' =>
    "font-semibold text-primary-accent transition-all drop-shadow duration-200 hover:decoration-primary-icon hover:underline  "
    ]) }}


>{{$slot}}</a>
