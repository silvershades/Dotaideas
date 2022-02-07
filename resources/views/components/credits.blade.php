<div class="grid lg:grid-cols-2 gap-4 mt-4 ">
    <div class="rounded bg-primary-card shadow_caja ">
        <x-section-header>CREDITS</x-section-header>
        <div class="grid grid-cols-2 gap-4 m-4">
            <div class="p-6  rounded bg-primary-card-sub">
                <p class="text-sm text-center">Created <span class="font-semibold text-primary-accent text-xl">{{$post->created_at_days_ago()}}</span></p>
            </div>
            <div class="p-6  rounded bg-primary-card-sub">
                <p class="text-sm text-center">Last edit <span class="font-semibold text-primary-accent  text-xl">{{$post->edited_at_days_ago()}}</span></p>
            </div>

        </div>
        <!-- CREDITS -->
        <div class="grid lg:grid-cols-2 gap-4 px-6 pb-6 ">
            <div class="flex items-center justify-center">
                <div class="rounded shadow_titulo h-36 w-36 overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{$post->user->di_avatar}}">
                </div>
            </div>
            <div class="flex flex-col items-center justify-center h-full p-6 space-y-1 text-center  ">
                <p class="text-xs text-primary-text-muted">Created by</p>
                <div class="flex items-center justify-center space-x-2">
                    <x-a-link href="{{route('user.show',['user' => $post->user->id])}}" class="text-2xl">{{$post->user->name}}</x-a-link>
                    @if($post->user->has_supporters_medal())
                        <img src="{{asset("/img/shop_items/unlocks/badge.png")}}" class="w-5 h-5 shadow_titulo" alt="dota ideas supporter's badge">
                    @endif
                </div>
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center justify-center space-x-1">
                        @include('svgs',['svg' => 'points','classes' => 'h-5 w-5 text-primary-icon '])
                        <p class="">{{$post->user->get_total_points()}}</p>
                    </div>
                    <div class="flex items-center justify-center space-x-1">
                        @include('svgs',['svg' => 'award','classes' => 'h-5 w-5 text-primary-icon '])
                        <p class="">{{$post->user->awards()}}</p>
                    </div>
                </div>
                <p class="text-xs pt-2 text-primary-text-muted">{{$post->user->post->count()}} posts made - Member since {{$post->user->created_at->format('Y')}}</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col rounded bg-primary-card shadow_caja  h-full" id="vote">
        <x-section-header>Voting Results</x-section-header>
        @if(Auth::check() && $post->user->id == Auth::id())
            <div class="grid lg:grid-cols-2 gap-4">
                <div class="flex items-center justify-center flex-col space-y-4 p-6">
                    <div>
                        <ul class="space-y-4">
                            <li>
                                <div class="px-6 py-3 rounded bg-primary-card-sub flex items-center justify-center space-x-2">
                                    <p><b class="mr-2">{{$post->votes_neg->count()}}</b> voted</p>
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-strength'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-strength'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-strength'])
                                </div>
                            </li>
                            <li>
                                <div class="px-6 py-3 rounded bg-primary-card-sub flex items-center justify-center space-x-2">
                                    <p><b class="mr-2">{{$post->votes_one->count()}}</b> voted</p>
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-primary-icon'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-primary-icon'])
                                </div>
                            </li>
                            <li>
                                <div class="px-6 py-3 rounded bg-primary-card-sub flex items-center justify-center space-x-2">
                                    <p><b class="mr-2">{{$post->votes_two->count()}}</b> voted</p>
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-primary-icon'])
                                </div>
                            </li>
                            <li>
                                <div class="px-6 py-3 rounded bg-primary-card-sub flex items-center justify-center space-x-2">
                                    <p><b class="mr-2">{{$post->votes_three->count()}}</b> voted</p>
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                    @include('svgs',['svg' => 'award','classes' => 'w-8 h-8 text-primary-accent'])
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="grid grid-cols-2 gap-4 pb-6">
                    <div class="flex items-center justify-center flex-col space-y-4">
                        <p class="text-lg gradient_full_di">SCORE</p>
                        <p class="text-4xl shadow_titulo flex items-center justify-center">
                            @include('svgs',['svg' => 'points','classes' => 'w-8 h-8 text-primary-icon mr-2'])
                            {{$post->votes_total()}}</p>
                    </div>
                    <div class="flex items-center justify-center flex-col space-y-4">
                        <p class="text-lg gradient_full_di">AWARDS</p>
                        <p class="text-4xl shadow_titulo flex items-center justify-center space-x-2">
                            @include('svgs',['svg' => 'award','classes' => 'w-8 h-8 text-primary-icon mr-2'])
                            {{$post->awards->count()}}</p>
                    </div>
                </div>
            </div>
        @else
            <post-credits inline-template v-cloak>
                <!-- VOTE -->
                <div class="flex items-center justify-center flex-grow p-6">
                    <div class="flex flex-col  space-y-6">
                        <div>
                            <p class="gradient_full_di text-2xl text-center">What is your VOTE on this idea</p>
                            <p class="text-center text-sm text-primary-text-muted flex items-center justify-center">You can change it at any time. You get <span class="font-semibold ml-1">8</span>
                                @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon mx-1']) for voting once.</p>
                            <p class="text-center text-sm text-primary-text-muted mt-1">Voting points:
                                <span class="text-strength  font-semibold" v-if="has_voted == 0">NOT CLAIMED! VOTE!</span>
                                <span class="text-on font-semibold" v-if="has_voted != 0">CLAIMED!</span>
                            </p>

                        </div>
                        <input type="hidden" v-model="post" v-init:post="'<?=($post->id) ?>'">
                        <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 ">
                            <div>
                                <input name="complexity" type="radio" id="vote1" class="hidden" value="-1" v-model="vote">
                                <label for="vote1" class="radio_label">
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-strength'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-strength'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-strength'])
                                </label>
                                <p class="text-center text-xs mt-2 text-primary-text-muted flex items-center justify-center font-semibold">-10
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon ml-1'])
                                </p>
                            </div>
                            <div>
                                <input name="complexity" type="radio" id="vote2" class="hidden" value="1" v-model="vote">
                                <label for="vote2" class="radio_label">
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-primary-icon'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-primary-icon'])
                                </label>
                                <p class="text-center text-xs mt-2 text-primary-text-muted flex items-center justify-center font-semibold">+10
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon ml-1'])
                                </p>
                            </div>
                            <div>
                                <input name="complexity" type="radio" id="vote3" class="hidden" value="2" v-model="vote">
                                <label for="vote3" class="radio_label">
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                    @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                    @include('svgs',['svg' => 'star_empty','classes' => 'w-7 h-7 text-primary-icon'])
                                </label>
                                <p class="text-center text-xs mt-2 text-primary-text-muted flex items-center justify-center font-semibold">+20
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon ml-1'])
                                </p>
                            </div>
                            @if(Auth::check() && Auth::user()->has_unlocked_three_votes())
                                <div>
                                    <input name="complexity" type="radio" id="vote4" class="hidden" value="3" v-model="vote">
                                    <label for="vote4" class="radio_label border-2 border-transparent px-1 ">
                                        @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                        @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                        @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                        @include('svgs',['svg' => 'award','classes' => 'w-8 h-8 text-primary-accent'])
                                    </label>
                                    <p class="text-center text-xs mt-2 text-primary-text-muted flex items-center justify-center font-semibold">
                                        +30
                                        @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon ml-1 mr-3'])
                                        +1
                                        @include('svgs',['svg' => 'award','classes' => 'w-4 h-4 text-primary-icon ml-1'])
                                    </p>
                                </div>
                            @else
                                <div>
                                    <input name="complexity" type="radio" id="vote4" class="hidden" value="0" v-model="vote" disabled>
                                    <label for="vote4" class="radio_label border-2 border-transparent px-1 opacity-25">
                                        @include('svgs',['svg' => 'star','classes' => 'w-8 h-8  text-primary-icon'])
                                        @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                        @include('svgs',['svg' => 'star','classes' => 'w-8 h-8 text-primary-icon'])
                                        @include('svgs',['svg' => 'award','classes' => 'w-8 h-8 text-primary-accent'])
                                    </label>
                                    <p class="text-center text-xs mt-2 text-primary-text-muted flex items-center justify-center font-semibold">
                                        +30
                                        @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon ml-1 mr-3'])
                                        +1
                                        @include('svgs',['svg' => 'award','classes' => 'w-4 h-4 text-primary-icon ml-1'])
                                    </p>
                                    <p class="text-xs text-center mt-1 text-primary-accent">UNLOCK VOTE OPTION AT SIDESHOP</p>
                                </div>
                            @endif
                        </div>
                        <div v-if="publishing" class="p-2">
                            <x-loading></x-loading>
                        </div>
                        <div v-if="response == 1 || has_voted != 0" class="">
                            <p class="text-center gradient_full_di text-2xl animate-pulse">VOTED!</p>
                        </div>
                        <div v-if="response == 2">
                            <div class="flex items-center justify-center flex-col max-h-[300px] bg-red-100 p-2 rounded">
                                <p class="block text-sm font-semibold text-off">We encountered some errors</p>
                                <ul class="block text-sm list-disc text-left ml-6 long_text">
                                    <li v-for="ajax_error in ajax_errors" class="text-primary-text-accent">@{{ ajax_error[0] }}</li>
                                </ul>
                            </div>
                        </div>
                        <div v-if="response == 3">
                            <div class="flex items-center justify-center flex-col ax-h-[300px] bg-red-100 p-2 rounded">
                                <p class="text-primary-text-accent">You must login to use this feature</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center text-center space-x-4">
                            @if(Auth::check())
                                <x-di-button :icon="'vote'" type="submit" @click="checkAuth">VOTE</x-di-button>
                                <x-a-link :icon="'report'" href="''">Report this post</x-a-link>
                            @else
                                <x-login-required-button :icon="'login'" href="{{route('login')}}">LOGIN TO VOTE</x-login-required-button>
                            @endif
                        </div>
                    </div>
                </div>
            </post-credits>
        @endif
    </div>
</div>
