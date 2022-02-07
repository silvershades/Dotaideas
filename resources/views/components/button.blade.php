<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-sm no-animation']) }}>
    {{ $slot }}
</button>
