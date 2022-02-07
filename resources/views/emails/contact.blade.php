@switch($type)
    @case('1')
    @component('mail::message')
    # New REQUEST email from DotaIdeas
    From: {{$contact['name']}}
    Email: {{$contact['email']}}
    @if($user)Is user: {{$user->id}} - {{$user->name}}@endif

    Message: {{$contact['message']}}
    @endcomponent
    @break
    @case('2')
    @component('mail::message')
    # New BUG email from DotaIdeas
    From: {{$contact['name']}}
    Email: {{$contact['email']}}
    @if($user)Is user: {{$user->id}} - {{$user->name}}@endif

    Message: {{$contact['message']}}
    @endcomponent
    @break
    @case('3')
    @component('mail::message')
    # New REQUEST email from DotaIdeas
    From: {{$contact['name']}}
    Email: {{$contact['email']}}
    @if($user)Is user: {{$user->id}} - {{$user->name}}@endif

    Message: {{$contact['message']}}
    @endcomponent
    @break
    @case('4')
    @component('mail::message')
        # New PUBLIC OPINION email from DotaIdeas
        @if($user)Is user: {{$user->id}} - {{$user->name}}@endif

        Message: {{$contact}}
    @endcomponent
    @break
@endswitch

