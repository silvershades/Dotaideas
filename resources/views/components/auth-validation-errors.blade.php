@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }} >
        <div class="font-medium text-off">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-off">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif