@component('mail::message')
# Welcome friend!

We are glad you join us.
You can start creating your ideas right away.

@component('mail::button', ['url' => 'https://www.dotaideas.com/post/create'])
CREATE IDEA
@endcomponent

Or join our Monthly Rework Challenge, where once a month you all rework a existing ability from Dota 2 and users select a winner!

@component('mail::button', ['url' => 'https://www.dotaideas.com/mrc-dir'])
    JOIN MRC
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
