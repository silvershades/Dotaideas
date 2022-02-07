@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 ">
        <!-- MAIN -->
        <section class="lg:col-span-3">
            <!-- FILTERS -->
            <sort-and-filter inline-template>
                <form method="get" ref="form" class="p-[1px] bg-gradient-to-br from-prim_a to-prim_b flex  text-sm  mb-6 rounded">
                    <div class="bg-primary-card rounded w-full grid lg:grid-cols-2 gap-10 px-6 py-2">

                        <div class="flex items-center justify-center space-x-5 w-full md:w-auto ">
                            <p class="mr-2 font-semibold leading-none  text-primary-accent pt-0.5">SORT</p>
                            <label class="inline-flex items-center">
                                <input type="radio" class="rounded text-primary-accent-sub bg-stone-600" v-on:input="submitGets" name="sort" value="date" checked/>
                                <span class="ml-1">Newest</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="rounded text-primary-accent-sub bg-stone-600" v-on:input="submitGets" name="sort" value="score" @if(request()->has('sort') && request()->input('sort') == 'score') checked @endif />
                                <span class="ml-1">Highest score</span>
                            </label>

                        </div>
                        <div class="flex items-center justify-center space-x-5 w-full md:w-auto ">
                            <p class="mr-2 font-semibold leading-none  text-primary-accent pt-0.5">FILTER</p>
                            <label class="inline-flex items-center">
                                <input type="radio" class="rounded text-primary-accent-sub bg-stone-600" v-on:input="submitGets" name="filter" value="all" checked/>
                                <span class="ml-1">All</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="rounded text-primary-accent-sub bg-stone-600" v-on:input="submitGets" name="filter" value="heroes" @if(request()->has('filter') && request()->input('filter') == 'heroes') checked @endif />
                                <span class="ml-1">Heroes</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="rounded text-primary-accent-sub bg-stone-600" v-on:input="submitGets" name="filter" value="items" @if(request()->has('filter') && request()->input('filter') == 'items') checked @endif />
                                <span class="ml-1">Items</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="rounded text-primary-accent-sub bg-stone-600" v-on:input="submitGets" name="filter" value="others" @if(request()->has('filter') && request()->input('filter') == 'others') checked @endif />
                                <span class="ml-1">Other</span>
                            </label>
                        </div>

                    </div>
                </form>
            </sort-and-filter>
            <!-- POSTS -->
            <div class="grid gap-6 px-6 lg:px-0">
                @foreach($posts as $post)
                    <article class="bg-primary-card  rounded flex flex-col md:flex-row  relative
                     @if($post->has_golden_bg())
                            golden
                     @elseif($post->has_emerald_bg())
                            emerald
                     @else
                            traditional
                     @endif">
                    {{--                        @if($post->has_golden_bg())--}}
                    {{--                            <div class="absolute right-[120px] -top-3 flex items-center justify-center space-x-1">--}}
                    {{--                                <img src="{{asset("/img/icons/golden.png")}}" alt="emerald idea icon" class="w-6 h-6 relative z-[100] drop-shadow" >--}}
                    {{--                                <p class="font-semibold font-title text-sm text-yellow-500 shadow_titulo3 relative z-[100]">GOLDEN</p>--}}
                    {{--                            </div>--}}
                    {{--                        @endif--}}
                    {{--                            @if($post->has_emerald_bg())--}}
                    {{--                                <div class="absolute right-[120px] -top-3 flex items-center justify-center space-x-1">--}}
                    {{--                                    <img src="{{asset("/img/icons/emerald.png")}}" alt="emerald idea icon" class="w-6 h-6 relative z-[100] drop-shadow" >--}}
                    {{--                                    <p class="font-semibold font-title text-sm text-emerald-400 shadow_titulo3 relative z-[100]">EMERALD</p>--}}
                    {{--                                </div>--}}
                    {{--                        @endif--}}
                    @switch($post->post_type_id)
                        @case(1)
                        <!-- POST IMAGE -->
                            <div class="flex flex-col items-center justify-center relative rounded ">
                            {{--                                <!-- POST IMAGE FRAME / SHOP -->--}}
                            {{--                                <div class="absolute -inset-1">--}}
                            {{--                                    <img src="{{asset("/img/frame.png")}}" alt="" class="h-full">--}}
                            {{--                                </div>--}}
                            <!-- POST IMAGE -->
                                <div class="h-44 md:h-full w-full md:w-40 shrink-0 gradient_placeholder shadow-inner rounded-l overflow-hidden ">
                                    @if($post->hero->img_is_uploaded)
                                        <img src="{{asset($post->hero->img_path)}}" alt="hero" class=" shadow-inner  object-cover object-center h-full w-full rounded md:rounded-l md:rounded-r-none">
                                    @endif
                                </div>
                            </div>
                            <!-- HERO BODY -->
                            <div class="flex-grow flex items-center justify-center flex-col ">
                                <!-- NAME -->
                                <div class="px-2 w-full  flex items-end justify-start">
                                    <x-a-button-home href="{{route('hero.show',$post->hero->id)}}" :icon="'post_hero'">{{$post->hero->name}} <span class="text-primary-accent">HERO</span>
                                    </x-a-button-home>
                                </div>
                                <div class="flex items-center justify-between w-full px-2 my-4 lg:my-2 space-y-5 xl:space-x-5 xl:space-y-0 flex-wrap xl:flex-nowrap ">
                                    <!-- BASICS -->
                                    <div class="w-full xl:w-1/5 grid grid-cols-2 text-xs gap-1 ">
                                        <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub box space-y-1 py-2">
                                            @if($post->hero->attack_type == 1)
                                                @include('svgs',['svg' => 'melee','classes' => 'h-4 w-4 text-primary-icon'])
                                                <p>Melee</p>
                                            @else
                                                @include('svgs',['svg' => 'ranged','classes' => 'h-4 w-4 text-primary-icon'])
                                                <p>Ranged</p>
                                            @endif
                                        </div>
                                        <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub box space-y-1 py-2">
                                            <div class="flex items-center justify-center">
                                                @switch($post->hero->complexity)
                                                    @case(1)
                                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @include('svgs',['svg' => 'rombo_empty','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @include('svgs',['svg' => 'rombo_empty','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @break
                                                    @case(2)
                                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @include('svgs',['svg' => 'rombo_empty','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @break
                                                    @case(3)
                                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-4 w-4 text-primary-icon'])
                                                    @break
                                                @endswitch
                                            </div>
                                            @switch($post->hero->complexity)
                                                @case(1)
                                                <p>Easy</p>
                                                @break
                                                @case(2)
                                                <p>Medium</p>
                                                @break
                                                @case(3)
                                                <p>Hard</p>
                                                @break
                                            @endswitch

                                        </div>
                                        @switch($post->hero->primary_attribute)
                                            @case(1)
                                            <div class="col-span-2 rounded flex items-center space-x-2 justify-center bg-primary-card-sub box text-sm py-2">
                                                @include('svgs',['svg' => 'strength','classes' => 'h-5 w-5 text-strength'])
                                                <p class="text-strength text-xs uppercase">Strength</p>
                                            </div>
                                            @break
                                            @case(2)
                                            <div class="col-span-2 rounded flex items-center space-x-2 justify-center bg-primary-card-sub box text-sm py-2">
                                                @include('svgs',['svg' => 'agility','classes' => 'h-5 w-5 text-agility'])
                                                <p class="text-agility text-xs uppercase">Agility</p>
                                            </div>
                                            @break
                                            @case(3)
                                            <div class="col-span-2 rounded flex items-center space-x-2 justify-center bg-primary-card-sub box text-sm py-2">
                                                @include('svgs',['svg' => 'intelligence','classes' => 'h-5 w-5 text-intelligence'])
                                                <p class="text-intelligence text-xs uppercase">Intelligence</p>
                                            </div>
                                            @break
                                        @endswitch

                                    </div>
                                    <!-- ROLES -->
                                    <div class="w-full xl:w-2/5 flex items-center justify-center ">
                                        <div class="grid grid-cols-3 gap-x-3 gap-y-2 w-full mb-1">
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_carry == 3) shadow_titulo  @endif">
                                                    Carry</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_carry >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_carry >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_carry >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_support == 3) shadow_titulo  @endif">
                                                    Support</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_support >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_support >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_support >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_nuker == 3) shadow_titulo @endif">
                                                    Nuker</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_nuker >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_nuker >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_nuker >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_disabler == 3) shadow_titulo  @endif">
                                                    Disabler</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_disabler >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_disabler >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_disabler >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_jungler == 3) shadow_titulo  @endif">
                                                    Jungler</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_jungler >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_jungler >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_jungler >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_durable == 3) shadow_titulo  @endif">
                                                    Durable</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_durable >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_durable >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_durable >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_escape == 3) shadow_titulo  @endif">
                                                    Escape</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_escape >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_escape >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_escape >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_pusher == 3) shadow_titulo  @endif">
                                                    Pusher</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_pusher >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_pusher >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_pusher >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->roles_initiator == 3) shadow_titulo  @endif">
                                                    Initiator</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_initiator >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_initiator >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->roles_initiator >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- STRENGTHS -->
                                    <div class="w-full xl:w-2/5 flex items-center justify-center">
                                        <div class="grid grid-cols-3 gap-x-3 gap-y-2 w-full mb-1">
                                            <div>
                                                <p class="text-xs @if($post->hero->strengths_team_fight == 3) shadow_titulo  @endif">
                                                    Team-fight</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_team_fight >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_team_fight >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_team_fight >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->strengths_farm == 3) shadow_titulo  @endif">
                                                    Farm</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_farm >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_farm >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_farm >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->strengths_split_push == 3) shadow_titulo  @endif">
                                                    Split-push</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_split_push >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_split_push >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_split_push >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->strengths_siege == 3) shadow_titulo  @endif">
                                                    Siege</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_siege >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_siege >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_siege >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->strengths_base_defense == 3) shadow_titulo @endif">
                                                    Base-Def.</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_base_defense >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_base_defense >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_base_defense >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->strengths_roshan == 3) shadow_titulo  @endif">
                                                    Roshan</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_roshan >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_roshan >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->strengths_roshan >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->damage_pure == 3) shadow_titulo  @endif">
                                                    Pure</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_pure >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_pure >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_pure >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->damage_physical == 3) shadow_titulo  @endif">
                                                    Physical</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_physical >= 1) bg-strength @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_physical >= 2) bg-strength @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_physical >= 3) bg-strength @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->hero->damage_magical == 3) shadow_titulo @endif">
                                                    Magical</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_magical >= 1) bg-intelligence @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_magical >= 2) bg-intelligence @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->hero->damage_magical >= 3) bg-intelligence @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- POST CREDITS & VIEWS & COMMENTS -->
                                <div class="px-2 flex items-center space-x-4 text-xs bg-gradient-to-r from-primary-background-sub to-prim_d  h-8 w-full post_footer">
                                    <x-post-footer :medal="$post->user->has_supporters_medal()">
                                        <x-slot name="href">{{route('user.show',['user'=>$post->user->id])}}</x-slot>
                                        <x-slot name="name">{{$post->user->name}}</x-slot>
                                        <x-slot name="points">{{$post->user->get_total_points()}}</x-slot>
                                        <x-slot name="views">{{$post->views}}</x-slot>
                                        <x-slot name="comments">{{$post->comments_total()}}</x-slot>
                                        <x-slot name="avatar">{{$post->user->di_avatar}}</x-slot>
                                    </x-post-footer>
                                </div>
                            </div>
                        @break
                        @case(2)
                        <!-- POST IMAGE -->
                            <div class="flex flex-col items-center justify-center relative  rounded">
                                <!-- POST IMAGE -->
                                <div class="h-44 md:h-full w-full md:w-40 shrink-0 gradient_placeholder shadow-inner rounded-l overflow-hidden ">
                                    @if($post->item->img_is_uploaded)
                                        <img src="{{asset($post->item->img_path)}}" alt="hero" class=" shadow-inner  object-cover object-center h-full w-full rounded md:rounded-l md:rounded-r-none">
                                    @endif
                                </div>
                            </div>
                            <!-- ITEM BODY -->
                            <div class="flex-grow flex items-center justify-center flex-col">
                                <!-- NAME -->
                                <div class="px-2  w-full flex items-end justify-start">
                                    <x-a-button-home href="{{route('item.show',$post->item->id)}}" :icon="'post_item'">{{$post->item->name}} <span class="text-primary-accent">ITEM</span>
                                    </x-a-button-home>
                                </div>
                                <div class="flex items-center justify-between w-full px-2 my-4 lg:my-2 space-y-5 xl:space-x-5 xl:space-y-0 flex-wrap xl:flex-nowrap">
                                    <!-- BASICS -->
                                    <div class="w-full xl:w-1/5 grid grid-cols-2 text-xs gap-1 ">
                                        <div class=" flex flex-col items-center justify-center bg-primary-card-sub box space-y-1 py-2 rounded">
                                            <img src="{{asset("/img/icons/gold2.png")}}" class="h-5 w-5 " alt="hero">
                                            <p>{{$post->item->gold}}</p>
                                        </div>
                                        <div class=" flex flex-col items-center justify-center bg-primary-card-sub box space-y-1 py-2 rounded">
                                            @switch($post->item->item_shop_id)
                                                @case(1)
                                                @include('svgs',['svg' => 'fountain','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                                @case(2)
                                                @include('svgs',['svg' => 'secret','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                                @case(3)
                                                @include('svgs',['svg' => 'loot','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                                @case(4)
                                                @include('svgs',['svg' => 'other','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                            @endswitch
                                            <p>{{$post->item->item_shop->name}}</p>
                                        </div>
                                        <div class="col-span-2  flex items-center space-x-2 justify-center bg-primary-card-sub box text-sm py-2 rounded ">

                                            @switch($post->item->item_type_id)
                                                @case(1)
                                                @include('svgs',['svg' => 'basic','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                                @case(2)
                                                @include('svgs',['svg' => 'upgrade','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                                @case(3)
                                                @include('svgs',['svg' => 'creep','classes' => 'h-5 w-5 text-primary-icon '])
                                                @break
                                            @endswitch
                                            <p class="text-xs">{{$post->item->item_type->name}}</p>
                                        </div>
                                    </div>
                                    <!-- ROLES -->
                                    <div class="w-full xl:w-2/5 flex items-center justify-center ">
                                        <div class="grid grid-cols-3 gap-x-3 gap-y-2 w-full mb-1">
                                            <div>
                                                <p class="text-xs @if($post->item->roles_armor == 3) shadow_titulo  @endif">
                                                    Armor</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_armor >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_armor >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_armor >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_damage == 3) shadow_titulo  @endif">
                                                    Damage</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_damage >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_damage >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_damage >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_utility == 3) shadow_titulo  @endif">
                                                    Utility</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="h-1  rounded @if($post->item->roles_utility >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="h-1  rounded @if($post->item->roles_utility >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="h-1  rounded @if($post->item->roles_utility >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_support == 3) shadow_titulo  @endif">
                                                    Support</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_support >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_support >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_support >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_siege == 3) shadow_titulo  @endif">
                                                    Siege</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_siege >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_siege >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_siege >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_heal == 3) shadow_titulo  @endif">
                                                    Heal</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_heal >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_heal >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_heal >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_mana == 3) shadow_titulo  @endif">
                                                    Mana</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_mana >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_mana >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_mana >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_disable == 3) shadow_titulo  @endif">
                                                    Disable</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_disable >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_disable >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_disable >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs @if($post->item->roles_resistance  == 3) shadow_titulo  @endif">
                                                    Resistance</p>
                                                <div class="h-1 w-full grid grid-cols-3 gap-1">
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_resistance >= 1) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_resistance >= 2) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                    <div class="-skew-x-[25deg] @if($post->item->roles_resistance >= 3) bg-primary-icon @else h-1 bg-primary-card-sub @endif"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- STRENGTHS -->
                                    <div class="w-full xl:w-2/5 flex items-center justify-center">

                                    </div>
                                </div>
                                <!-- POST CREDITS & VIEWS & COMMENTS -->
                                <div class="px-2 flex items-center space-x-4 text-xs bg-gradient-to-r from-primary-background-sub to-prim_d h-8 w-full post_footer">
                                    <x-post-footer :medal="$post->user->has_supporters_medal()">
                                        <x-slot name="href">{{route('user.show',['user'=>$post->user->id])}}</x-slot>
                                        <x-slot name="name">{{$post->user->name}}</x-slot>
                                        <x-slot name="points">{{$post->user->get_total_points()}}</x-slot>
                                        <x-slot name="views">{{$post->views}}</x-slot>
                                        <x-slot name="comments">{{$post->comments_total()}}</x-slot>
                                        <x-slot name="avatar">{{$post->user->di_avatar}}</x-slot>
                                    </x-post-footer>
                                </div>
                            </div>
                        @break
                        @case(3)
                        <!-- POST IMAGE -->
                            <div class="flex flex-col items-center justify-center relative  rounded">
                                <!-- POST IMAGE -->
                                <div class="h-44 md:h-full w-full md:w-40 shrink-0 gradient_placeholder shadow-inner rounded-l overflow-hidden ">
                                    @if($post->other->img_is_uploaded)
                                        <img src="{{asset($post->other->img_path)}}" alt="hero" class=" shadow-inner  object-cover object-center h-full w-full rounded md:rounded-l md:rounded-r-none">
                                    @endif
                                </div>
                            </div>
                            <!-- OTHER BODY -->
                            <div class="flex-grow flex items-center justify-center flex-col">
                                <!-- NAME -->
                                <div class="px-2 w-full  flex items-end justify-start">
                                    <x-a-button-home href="{{route('other.show',$post->other->id)}}" :icon="'post_other'">{{$post->other->name}} <span class="text-primary-accent">OTHER</span>
                                    </x-a-button-home>
                                </div>
                                <div class="flex items-center justify-between w-full px-2 my-4 lg:my-2 space-y-5 xl:space-x-5 xl:space-y-0 flex-wrap xl:flex-nowrap">
                                    <!-- BASICS -->
                                    <div class="w-full xl:w-1/5 text-xs  ">
                                        <div class="py-2 h-20 rounded flex flex-col items-center justify-center bg-primary-card-sub box space-y-1 py-1">
                                            @include('svgs',['svg' => 'flag','classes' => 'h-5 w-5 text-primary-icon '])
                                            <p>{{$post->other->other_flags->name}}</p>
                                        </div>
                                    </div>
                                    <!-- ROLES -->
                                    <div class="w-full xl:w-4/5 flex items-center justify-center ">
                                        <div class="grid  w-full text-sm">
                                            {!! Str::limit($post->other->description, 250)!!}
                                        </div>
                                    </div>

                                </div>
                                <!-- POST CREDITS & VIEWS & COMMENTS -->
                                <div class="px-2 flex items-center space-x-4 text-xs bg-gradient-to-r from-primary-background-sub to-prim_d h-8 w-full post_footer">
                                    <x-post-footer :medal="$post->user->has_supporters_medal()">
                                        <x-slot name="href">{{route('user.show',['user'=>$post->user->id])}}</x-slot>
                                        <x-slot name="name">{{$post->user->name}}</x-slot>
                                        <x-slot name="points">{{$post->user->get_total_points()}}</x-slot>
                                        <x-slot name="views">{{$post->views}}</x-slot>
                                        <x-slot name="comments">{{$post->comments_total()}}</x-slot>
                                        <x-slot name="avatar">{{$post->user->di_avatar}}</x-slot>
                                    </x-post-footer>
                                </div>
                            </div>
                        @break

                        @default
                    @endswitch
                    <!-- POST SCORE -->
                        <div class="flex md:flex-col items-start justify-start md:w-24 bg-primary-background-sub rounded-r">
                            <div class="w-1/2 md:w-24 lg:h-3/5 relative">
                                <div class="absolute top-0 left-0 right-0 text-center">
                                    <div class="bg-primary-accent  px-2 h-6 flex items-center justify-center w-full md:rounded-tr">
                                        <p class="text-xs w-full md:rounded-tr text-primary-text-accent font-semibold font-title">SCORE</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center space-Y-1 flex-col h-full pt-6">
                                    <p class="text-primary-text text-2xl font-semibold shadow_titulo font-numeric">{{$post->votes_total()}}</p>
                                    @include('svgs',['svg' => 'points','classes' => 'h-5 w-5 text-primary-icon drop-shadow'])
                                </div>
                            </div>
                            <div class="w-1/2 md:w-24 lg:h-2/5 relative">
                                <div class="absolute top-0 left-0 right-0 text-center">
                                    <div class="bg-primary-accent px-2 h-6 flex items-center justify-center w-full">
                                        <p class="text-xs w-full text-primary-text-accent font-semibold font-title">AWARDS</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center space-x-1  h-full pt-6">
                                    @include('svgs',['svg' => 'award','classes' => 'h-4 w-4 text-primary-icon drop-shadow'])
                                    <p class="text-primary-text drop-shadow font-numeric">{{$post->awards->count()}}</p>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <!-- PAGINATION -->
            <div class="bg-primary-card text-primary-text px-4 py-3 flex items-center justify-between sm:px-6 rounded shadow_caja mb-4 mt-4">
                {{ $posts->appends(request()->query())->onEachSide(1)->links() }}
            </div>
        </section>
        <!-- SIDEBAR -->
        <x-sidebar></x-sidebar>
    </div>
@endsection
<script>
    import Sort_and_filter from "../../js/components/sort-and-filter";

    export default {
        components: {Sort_and_filter}
    }
</script>