<div class="rounded  flex shadow mb-4 shadow-md overflow-hidden">
    <!-- POST TYPE -->
    @switch($post_type)
        @case('Hero')
        <div class="flex items-center justify-start flex-grow space-x-1 bg-primary-card rounded w-24 px-6 space-x-4 white_corners">
            @include('svgs',['svg' => 'post_hero','classes' => 'h-8 w-8 text-primary-text '])
            <p class="text-3xl font-semibold text-primary-text">HERO</p>
        </div>
        @break
        @case('Item')
        <div class="flex items-center justify-start flex-grow space-x-1 bg-primary-card rounded-l w-24 px-6 space-x-4">
            @include('svgs',['svg' => 'post_item','classes' => 'h-8 w-8 text-primary-text '])
            <p class="text-3xl font-semibold text-primary-text">ITEM</p>
        </div>
        @break
        @case('Other')
        <div class="flex items-center justify-start flex-grow space-x-1 bg-primary-card rounded-l w-24 px-6 space-x-4">
            @include('svgs',['svg' => 'post_other','classes' => 'h-8 w-8 text-primary-text '])
            <p class="text-3xl font-semibold text-primary-text">OTHER</p>
        </div>
        @break
        @case('Creep')
        <div class="flex items-center justify-start flex-grow space-x-1 bg-primary-card rounded-l w-24 px-6 space-x-4">
            @include('svgs',['svg' => 'creep','classes' => 'h-8 w-8 text-primary-text '])
            <p class="text-3xl font-semibold text-primary-text">CREEP CAMP</p>
        </div>
    @break
@endswitch


<!-- POST SCORE -->
    <div class="flex items-center justify-start w-48 bg-primary-card-sub rounded-r">
        <div class="w-24 h-full">
            <div class="text-center flex items-start justify-center">
                <div class="bg-primary-accent  px-2 h-6 flex items-center justify-center w-full">
                    <p class="text-xs text-primary-text w-full  font-semibold">SCORE</p>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-1 h-12">
{{--                @include('svgs',['svg' => 'vote','classes' => 'h-5 w-5 text-primary-icon'])--}}
                <p class="font-semibold text-2xl">{{$votes}}</p>
            </div>
        </div>
        <div class="w-24 h-full">
            <div class="text-center flex items-start justify-center">
                <div class="bg-primary-accent rounded-tr px-2 h-6 flex items-center justify-center w-full ">
                    <p class="text-xs text-primary-text w-full font-semibold">AWARDS</p>
                </div>
            </div>
            <div class="flex items-center justify-center h-12 space-x-1">
                @include('svgs',['svg' => 'award','classes' => 'h-5 w-5 text-primary-icon'])
                <p class="">{{$awards}}</p>
            </div>
        </div>
    </div>
</div>
