@extends("layout")

@section("content")
    <user-profile inline-template v-cloak>

        <div>
            <div class="container mx-auto rounded bg-primary-card mb-6 shadow_caja">
                <x-section-header>GENERAL</x-section-header>
                <div class="p-6 grid xl:grid-cols-3 gap-6">
                    <div>
                        <div class="flex items-center justify-start mb-4">
                            @if(Auth::check() && Auth::id() ==  $user->id)
                                <div class="flex items-center justify-around space-x-2 w-full h-9 overflow-hidden">
                                    <input type="text" v-model="user_name" class="" maxlength="20">
                                    <transition-group name="slide-fade" mode="in-out">
                                        <div :key="1" v-if="!loading_rename">
                                            <x-di-button :icon="''" type="button" @click="rename">Change</x-di-button>
                                        </div>
                                        <div :key="2" v-if="loading_rename">
                                            <x-loading></x-loading>
                                        </div>
                                    </transition-group>
                                </div>
                            @else
                                <p class="text-3xl font-semibold  shadow_titulo mx-2">{{$user->name}}</p>
                            @endif
                            @if($user->has_supporters_medal())
                                <img src="{{asset("/img/shop_items/unlocks/badge.png")}}" class="w-8 h-8 shadow_titulo" alt="dota ideas supporter's badge">
                            @endif
                        </div>
                        <div class="mb-6">
                            <div class="mx-auto max-w-[248px] w-full aspect-square rounded shadow-lg shadow-primary-accent-sub gradient_placeholder relative">
                                <img :src="user_avatar" alt="User profile avatar" class="object-contain w-full rounded" v-if="user_avatar != ''">
                                @if(Auth::check() && Auth::id() == $user->id)
                                    <div>
                                        <a href="#stash" class="rounded-full bg-primary-icon
                                 text-primary-text-accent p-2 drop-shadow -bottom-1 -right-1 absolute
                                   hover:bg-primary-accent transition-all">
                                            @include('svgs',['svg' => 'edit','classes' => 'w-10 h-10 '])
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center justify-start flex-col bg-primary-card-sub rounded">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-1">
                                    USER SCORE
                                </p>
                                <div class="flex items-center justify-around w-full">

                                    <div class="flex items-center justify-center p-2 space-x-4">
                                        @include('svgs',['svg' => 'points','classes' => 'w-12 h-12 text-primary-icon'])
                                        <p class="text-4xl font-bold shadow_titulo">{{$user->get_total_points()}}</p>
                                    </div>
                                    <div class="flex items-center justify-center p-2 space-x-4">
                                        @include('svgs',['svg' => 'award','classes' => 'w-12 h-12 text-primary-icon'])
                                        <p class="text-4xl font-bold shadow_titulo">{{$user->awards()}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-3 gap-4 text-center">


                            <div class="col-span-3 h-[192px] rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'post_create','classes' => 'w-4 h-4 mr-1'])
                                    Posts made</p>
                                <div class="flex items-center justify-center space-x-0.5 flex-grow">
                                    <p class="text-5xl font-bold shadow_titulo">{{$user->post->count()}}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_points_where('Created HERO post') + $user->get_points_where('Created ITEM post') + $user->get_points_where('Created OTHER post')}}
                                </p>
                            </div>
                            <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'vote','classes' => 'w-4 h-4 mr-1'])
                                    Votes given</p>
                                <div class="flex items-center justify-center space-x-0.5">
                                    <p class="text-xl">{{$user->votes->count()}}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_points_where('VOTED on a post')}}
                                </p>
                            </div>
                            <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'vote','classes' => 'w-4 h-4 mr-1'])
                                    Votes received</p>
                                <div class="flex items-center justify-center space-x-0.5">
                                    <p class="text-xl">{{$user->get_votes_received_count()}}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_votes_received_points()}}
                                </p>
                            </div>
                            <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'award','classes' => 'w-4 h-4 mr-1'])
                                    Awards</p>
                                <div class="flex items-center justify-center space-x-0.5">
                                    <p class="text-xl">{{$user->get_awards_received_count()}}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_points_where('Received an AWARD')}}
                                </p>
                            </div>
                            <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'comments','classes' => 'w-4 h-4 mr-1'])
                                    Comments</p>
                                <div class="flex items-center justify-center space-x-0.5">
                                    <p class="text-xl">{{$user->comments->count() + $user->comment_replies->count() }}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_points_where('COMMENTED on post')}}
                                </p>
                            </div>
                            <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'challenge','classes' => 'w-4 h-4 mr-1'])
                                    M.R.C.</p>
                                <div class="flex items-center justify-center space-x-0.5">
                                    <p class="text-xl">{{$user->mrc_spells->count()}}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_points_where('Participated on MRC')}}
                                </p>
                            </div>
                            <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    @include('svgs',['svg' => 'challenge_won','classes' => 'w-4 h-4 mr-1'])
                                    M.R.C. Wins</p>
                                <div class="flex items-center justify-center space-x-0.5">
                                    <p class="text-xl">{{$user->get_mrc_wins()}}</p>
                                </div>
                                <p class="text-sm text-on inline-flex items-center">
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    +{{$user->get_points_where('WON MRC - Congratz!')}}
                                </p>
                            </div>

                        </div>
                    </div>
                    <div>
                        <p class="label_title mb-4">Shards</p>
                        <div class="flex items-center justify-between bg-primary-card-sub rounded px-6 py-4 mb-4">
                            <div class="flex items-center justify-center w-1/3">
                                {{--                            @include('svgs',['svg' => 'coin','classes' => 'w-16 h-16 text-primary-icon mr-1'])--}}
                                <img src="{{asset("/img/icons/gems.png")}}" alt="dota ideas shards" class="w-16 h-16">
                            </div>
                            <div>
                                <div class="flex items-center justify-end ">
                                    <p class="text-xl mr-2">Shards earned</p>
                                    <p class="text-xl  text-on">+{{$user->coins_income->sum('amount')}}</p>
                                </div>
                                <div class="flex items-center justify-end mb-2">
                                    <p class="text-xl mr-2">Shards spent</p>
                                    <p class="text-xl  text-strength">{{$user->coins_spent->sum('amount')}}</p>
                                </div>
                                <div class="flex items-center justify-end  border-t pt-2 border-primary-accent">
                                    <p class="text-xl mr-2">Available</p>
                                    <p class="text-xl text-primary-icon font-black">{{$user->coins->sum('amount')}}</p>
                                </div>
                                <div class="flex items-center justify-end ">
                                    <x-a-link href="#shards_log" class="text-sm">view log</x-a-link>
                                </div>
                            </div>
                        </div>
                        <p class="label_title mb-4">Achievements</p>
                        <div class="flex items-center justify-between bg-primary-card-sub rounded px-6 py-4 min-h-[143px]">
                            <div class="flex items-center justify-center w-1/3">
                                @include('svgs',['svg' => 'achievements','classes' => 'w-16 h-16 text-primary-icon mr-1'])
                            </div>
                            <div class="flex items-end justify-end flex-col">
                                <p class="text-primary-accent text-4xl font-semibold mb-1">{{$user_achievements_completed->count()}} <span
                                        class="text-primary-text-muted">/ {{$achievements->count()}}</span></p>
                                <p class="text-sm text-on inline-flex items-center">
                                    <span class="text-primary-text-muted">Completed</span>
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mx-1 text-primary-icon '])
                                    +{{$user_achievements_completed_points}}
                                </p>
                                <div class="flex items-center justify-end ">
                                    <x-a-link href="#achievements" class="text-sm">view achievements</x-a-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto rounded bg-primary-card mb-6 shadow_caja" id="achievements">
                <x-section-header>ACHIEVEMENTS</x-section-header>
                <div class="p-6 grid grid-cols-2 xl:grid-cols-4 gap-4 long_text ">
                    @foreach($user_achievements as $ua)
                        <div
                            class="rounded bg-primary-card-sub p-4 border-2  border-primary-accent shadow-md  flex items-start justify-start flex-col @if(!$ua->is_completed) brightness-[0.8]  @endif">
                            <p class="font-semibold text-left">{{$ua->achievement->name}}</p>
                            @if($ua->is_completed)
                                <p class="text-sm text-primary-accent font-semibold mb-2">COMPLETED - PRIZE CLAIMED</p>
                            @else
                                <p class="text-primary-text-muted text-sm flex items-center justify-center mb-2"> REWARD
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 ml-3 mr-1 text-primary-icon '])
                                    <span>{{$ua->achievement->completion_points}}</span>
                                    <img src="{{asset("/img/icons/gems.png")}}" alt="dota ideas shards" class="w-4 h-4 ml-3 mr-1 ">
                                    <span>{{$ua->achievement->completion_coins}}</span>
                                </p>
                            @endif
                            <p class="text-sm my-1 text-left h-full">{{$ua->achievement->description}}</p>
                            <div class="h-3 rounded-3xl w-full bg-primary-card my-3">
                                <div class="h-3 rounded-3xl bg-primary-accent" style="width:{{$ua->completed}}% ;"></div>
                            </div>
                            <p class="text-sm  inline-flex items-center justify-center w-full">
                                @if($ua->is_completed)
                                    @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 mr-1 text-primary-icon '])
                                    <span class="text-primary-accent-sub">+{{$ua->achievement->completion_points}}</span>
                                    @include('svgs',['svg' => 'coin','classes' => 'w-4 h-4 ml-3 mr-1 text-primary-icon '])
                                    <span class="text-primary-accent-sub">+{{$ua->achievement->completion_coins}}</span>
                                @else
                                    <span class="@if($ua->is_completed) text-primary-accent-sub @else text-primary-accent @endif">{{$ua->completed}}%</span>
                                @endif
                            </p>
                        </div>
                    @endforeach

                </div>
            </div>
            @if(Auth::check() && Auth::id() == $user->id)
                <div class="grid grid-cols-3 gap-6" id="stash">
                    <div class="container mx-auto rounded bg-primary-card mb-6 shadow_caja col-span-2">
                        <x-section-header>STASH</x-section-header>
                        <div class="p-6">
                            <div class="long_text max-h-screen">
                                <p class="label_title mb-4">Avatars</p>
                                <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                                    <div v-for="item in stash_avatars" class="rounded bg-primary-card-sub p-4 flex items-center flex-col space-y-2 justify-center shadow_caja">
                                        <img :src="item.shop_item.img_path" class="w-full aspect-square rounded shadow_titulo">
                                        <p class="font-semibold text-sm  text-cente flex-grow">@{{item.shop_item.name}}</p>
                                        <div class="">
                                            @if(Auth::check() && $user->id == Auth::id() )
                                                <x-di-button :icon="''" type="button" @click="equipAvatar(item)">EQUIP</x-di-button>
                                            @else
                                                <p class="gradient_full_di text-xl mt-1">UNLOCKED</p>
                                            @endif
                                        </div>
                                    </div>
                                    <p v-if="stash_avatars.length == 0" class="text-sm italic">No avatars on user.</p>
                                </div>
                                <p class="label_title my-4">Post Backgrounds</p>
                                <div class="grid grid-cols-3 lg:grid-cols-2 gap-4">
                                    <div v-if="stash_post_bg_emerald.length > 0" class="rounded bg-primary-card-sub p-4 flex items-center flex-col space-y-2 justify-center shadow_caja">
                                        <img src="{{asset("/img/shop_items/post_bg/a.png")}}" class="w-full rounded shadow_titulo">
                                        <div class="text-center">
                                            <p class="font-semibold text-sm  text-center flex-grow  flex items-center">
                                                <img src="{{asset("/img/icons/emerald.png")}}" alt="emerald idea icon" class="w-6 h-6 mr-2 drop-shadow">
                                                EMERALD BACKGROUND</p>
                                            <p class="text-sm text-primary-text-muted">Uses left <span class="font-semibold text-primary-icon">@{{ stash_post_bg_emerald.length }}</span></p>
                                        </div>
                                        <div class="">
                                            @if(Auth::check() && $user->id == Auth::id() )
                                                {{--                                                <x-di-button :icon="''" type="button" @click="useBg(1)">USE</x-di-button>--}}
                                                <x-a-link :href="'#creations'">go to Creations to use</x-a-link>
                                            @else
                                                <p class="gradient_full_di text-xl mt-1">UNLOCKED</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div v-if="stash_post_bg_golden.length > 0" class="rounded bg-primary-card-sub p-4 flex items-center flex-col space-y-2 justify-center shadow_caja">
                                        <img src="{{asset("/img/shop_items/post_bg/b.png")}}" class="w-full rounded shadow_titulo">
                                        <div class="text-center">
                                            <p class="font-semibold text-sm  text-center flex-grow flex items-center">
                                                <img src="{{asset("/img/icons/golden.png")}}" alt="emerald idea icon" class="w-6 h-6 mr-2 drop-shadow">
                                                GOLDEN BACKGROUND</p>
                                            <p class="text-sm text-primary-text-muted">Uses left <span class="font-semibold text-primary-icon">@{{ stash_post_bg_golden.length }}</span></p>
                                        </div>
                                        <div class="">
                                            @if(Auth::check() && $user->id == Auth::id() )
                                                {{--                                                <x-di-button :icon="''" type="button" @click="useBg(2)">USE</x-di-button>--}}
                                                <x-a-link :href="'#creations'">go to Creations to use</x-a-link>
                                            @else
                                                <p class="gradient_full_di text-xl mt-1">UNLOCKED</p>
                                            @endif
                                        </div>
                                    </div>
                                    <p v-if="stash_post_bg_golden.length == 0  && stash_post_bg_emerald.length == 0 " class="text-sm italic">No backgrounds on user.</p>
                                </div>
                                <p class="label_title my-4">Unlocks</p>
                                <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                                    <div v-for="item in stash_unlocks" class="rounded bg-primary-card-sub p-4 flex items-center flex-col space-y-2 justify-center shadow_caja">
                                        <img :src="item.shop_item.img_path" class="w-full aspect-square rounded shadow_titulo">
                                        <p class="font-semibold text-sm text-center flex-grow">@{{item.shop_item.name}}</p>
                                        <div class="">
                                            <p class="gradient_full_di text-xl mt-1">UNLOCKED</p>
                                        </div>
                                    </div>
                                    <p v-if="stash_unlocks.length == 0" class="text-sm italic">No unlocks on user.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container mx-auto rounded bg-primary-card mb-6 shadow_caja">
                        <x-section-header>SHARDS LOG</x-section-header>
                        <div class="p-6">
                            <p class="text-primary-text-muted text-xs">Newest on top</p>
                            <div class="" id="shards_log">
                                <ul class="list-inside list-disc long_text max-h-screen w-full">
                                    @foreach($user->coins->sortByDesc('created_at') as $co)
                                        @if($co->amount >= 0)
                                            <li class="text-on rounded p-2 bg-gradient-to-r from-prim_c to-prim_d mb-2 flex items-center">+{{$co->amount}}
                                                <img src="{{asset("/img/icons/gems.png")}}" alt="dota ideas shards" class="w-5 h-5 ml-1 mr-2">
                                                <span class="text-primary-text-muted text-xs mr-1">from</span><span class="text-primary-text">{{$co->reason}}</span></li>
                                        @else
                                            <li class="text-off rounded p-2 bg-gradient-to-r from-prim_c to-prim_d mb-2 flex items-center">{{$co->amount}}
                                                <img src="{{asset("/img/icons/gems.png")}}" alt="dota ideas shards" class="w-5 h-5 ml-1 mr-2">
                                                <span class="text-primary-text-muted text-xs mr-2">from</span><span class="text-primary-text">{{$co->reason}}</span></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="container mx-auto rounded bg-primary-card mb-6 shadow_caja" id="creations">
                    <x-section-header>CREATIONS</x-section-header>
                    <div class="p-6 grid gap-4 ">
                        <div>
                            <p>You have created <span class="font-semibold text-primary-accent">{{$user_posts->count()}}</span> ideas.</p>
                        </div>

                        <div v-for="post in posts" class="rounded border-2 border-primary-accent  grid lg:grid-cols-5 gap-10 min-h-[200px]">
                            <div class="rounded">
                                <div class="w-full h-full gradient_placeholder rounded-l">
                                    <img :src="post.post.img_path" alt="hero image" class="object-cover w-full h-full" v-if="post.post.img_path ">
                                </div>
                            </div>
                            <div class="lg:col-span-2 p-4">
                                <p class="text-2xl font-semibold flex items-center justify-start">
                                    {{--                                    @include('svgs',['svg' => 'post_hero','classes' => 'w-6 h-6 mr-1 text-primary-accent shrink-0'])--}}
                                    @{{post.post.name}} <span class="text-primary-accent ml-1">@{{post.post.post_type}}</span>
                                </p>

                                <p class="text-sm text-primary-text-muted mb-2">CREATED ON <span class="text-primary-text font-semibold">@{{post.created_at}}</span></p>
                                <div class="flex items-center justify-start space-x-4">
                                    <div v-if="post.is_published" class="rounded bg-primary-card-sub p-2 w-full">
                                        <p class="text-sm flex items-center">@include('svgs',['svg' => 'upload','classes' => 'w-4 h-4 mr-1 text-primary-accent shrink-0']) STATUS</p>
                                        <p class="text-sm font-semibold text-on ml-1">PUBLISHED ON @{{post.is_published}}</p>
                                    </div>
                                    <div v-else class="rounded bg-primary-card-sub p-2 w-full">
                                        <p class="text-sm flex items-center">@include('svgs',['svg' => 'upload','classes' => 'w-4 h-4 mr-1 text-primary-accent shrink-0']) STATUS</p>
                                        <p class="text-sm font-semibold text-off ml-1">NOT PUBLISHED YET</p>
                                        <p class="text-xs text-primary-text-muted">To publish your post for the first time, you must go to your post and click on publish.</p>
                                    </div>
                                </div>
                                <div v-if="post.is_published" class="rounded bg-primary-card-sub p-2 mt-4 w-full">
                                    <div v-if="post.is_active == 1" class="rounded bg-primary-card-sub p-2">
                                        <p class="text-sm flex items-center">@include('svgs',['svg' => 'public','classes' => 'w-4 h-4 mr-1 text-primary-accent shrink-0']) VISIBILITY <span
                                                class="text-sm font-semibold text-on ml-1">PUBLIC</span></p>
                                        <p class="text-xs text-primary-text-muted">This post is visible to the world, everyone can see it.</p>

                                    </div>
                                    <div v-if="post.is_active == 0" class="rounded bg-primary-card-sub p-2">
                                        <p class="text-sm flex items-center">@include('svgs',['svg' => 'private','classes' => 'w-4 h-4 mr-1 text-primary-accent shrink-0']) VISIBILITY <span
                                                class="text-sm font-semibold text-off ml-1">PRIVATE</span>
                                        </p>
                                        <p class="text-xs text-primary-text-muted">This post is hidden from the world, only you can see it.</p>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <transition name="slide-fade" mode="out-in">
                                            <x-di-button v-if="post.is_active == 1" :icon="'private'" type="button" @click="changeVisibility(0,post)">MAKE PRIVATE</x-di-button>
                                            <x-di-button v-if="post.is_active == 0" :icon="'public'" type="button" @click="changeVisibility(1,post)">MAKE PUBLIC</x-di-button>
                                        </transition>
                                    </div>
                                </div>
                                <div v-if="post.is_flagged == 1" class="rounded bg-red-200 p-2 mt-4 w-full text-red-600 text-center">
                                    <p>This post is banned for;</p>
                                    <p class="font-semibold">@{{ post.flag_reason }}</p>
                                </div>

                            </div>
                            <div class="lg:col-span-2 p-4">
                                <div class="grid grid-cols-4 gap-4">
                                    <div class="bg-primary-card-sub rounded p-2 flex items-center justify-center space-y-4 flex-col">
                                        <p class="font-semibold text-primary-text">@{{post.comments}}</p>
                                        <p class="text-sm text-primary-text-muted">COMMENTS</p>
                                    </div>
                                    <div class="bg-primary-card-sub rounded p-2 flex items-center justify-center space-y-4 flex-col">
                                        <p class="font-semibold text-primary-text">@{{post.votes}}</p>
                                        <p class="text-sm text-primary-text-muted">VOTE SCORE </p>
                                    </div>
                                    <div class="bg-primary-card-sub rounded p-2 flex items-center justify-center space-y-4 flex-col">
                                        <p class="font-semibold text-primary-text">@{{post.awards}}</p>
                                        <p class="text-sm text-primary-text-muted">AWARDS</p>
                                    </div>
                                    <div class="bg-primary-card-sub rounded p-2 flex items-center justify-center space-y-4 flex-col">
                                        <p class="font-semibold text-primary-text">@{{post.views}}</p>
                                        <p class="text-sm text-primary-text-muted">VIEWS </p>
                                    </div>


                                </div>
                                <div class="flex items-center justify-center space-x-4 mt-4">
                                    <x-a-button v-if="post.post_type == 1" :icon="'edit'" type="button" href="''" v-bind:href="post.post_link_edit">EDIT POST</x-a-button>
                                    <x-a-button v-if="post.post_type == 1" :icon="'arrow_right'" type="button" href="''" v-bind:href="post.post_link_show">GO TO POST</x-a-button>
                                    <x-a-button v-if="post.post_type == 2" :icon="'edit'" type="button" href="''" v-bind:href="post.post_link_edit">EDIT POST</x-a-button>
                                    <x-a-button v-if="post.post_type == 2" :icon="'arrow_right'" type="button" href="''" v-bind:href="post.post_link_show">GO TO POST</x-a-button>
                                    <x-a-button v-if="post.post_type == 3" :icon="'edit'" type="button" href="''" v-bind:href="post.post_link_edit">EDIT POST</x-a-button>
                                    <x-a-button v-if="post.post_type == 3" :icon="'arrow_right'" type="button" href="''" v-bind:href="post.post_link_show">GO TO POST</x-a-button>
                                </div>
                                <div class="flex items-center justify-center space-x-4 mt-4" v-if="!post.is_golden && !post.is_emerald">
                                    <div v-if="post.loading">
                                        <x-loading></x-loading>
                                    </div>
                                    <x-di-button :icon="''" type="button" @click="makePro(1,post)" class="text-primary-text-accent emerald_btn" v-if="stash_post_bg_emerald.length >0">MAKE IT EMERALD
                                    </x-di-button>

                                    <x-di-button :icon="''" type="button" @click="makePro(2,post)" class="text-primary-text-accent golden_btn" v-if="stash_post_bg_golden.length >0">MAKE IT GOLDEN
                                    </x-di-button>
                                </div>
                                <p class="p-2 mt-4 rounded bg-gradient-to-r from-yellow-800 to-yellow-700 text-center font-semibold text-yellow-400" v-if="post.is_golden">This post is golden</p>
                                <p class="p-2 mt-4 rounded bg-gradient-to-r from-emerald-800 to-emerald-700 text-center font-semibold text-emerald-400" v-if="post.is_emerald">This post is emerald</p>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
        @endif
        </div>
    </user-profile>
@endsection
