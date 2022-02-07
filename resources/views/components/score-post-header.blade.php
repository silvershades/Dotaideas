<div>
    <div class="flex items-center justify-start w-48 bg-primary-card-sub rounded">
        <div class="w-24 h-full">
            <div class="text-center flex items-start justify-center">
                <div class="bg-primary-accent  px-2 h-6 flex items-center justify-center w-full rounded-tl">
                    <p class="text-xs text-primary-text-accent w-full  font-semibold">SCORE</p>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-1 h-8">
                <p class="font-semibold text-2xl">{{$score}}</p>
            </div>
        </div>
        <div class="w-24 h-full">
            <div class="text-center flex items-start justify-center">
                <div class="bg-primary-accent rounded-tr px-2 h-6 flex items-center justify-center w-full ">
                    <p class="text-xs text-primary-text-accent w-full font-semibold">AWARDS</p>
                </div>
            </div>
            <div class="flex items-center justify-center h-8 space-x-1">
                @include('svgs',['svg' => 'award','classes' => 'h-5 w-5 text-primary-icon'])
                <p class="">{{$awards}}</p>
            </div>
        </div>
    </div>
</div>