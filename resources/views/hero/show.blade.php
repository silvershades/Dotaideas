@extends('layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-error mb-4">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif
    <!-- GENERAL DESCRIPTION --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow_caja min-h-[600px]">
        <x-section-header>GENERAL</x-section-header>
        <div class="flex items-center justify-around px-6   my-2 flex-wrap space-x-4">
            <!-- TITULO -->
            <div class="flex-grow items-center justify-start flex space-x-2">
                @include('svgs',['svg' => 'post_hero','classes' => 'h-6 w-6 text-primary-accent shrink-0'])
                <p class="text-3xl font-semibold py-2 shadow_titulo">{{$hero->name}}</p>
            </div>
            <div>
                <div class="flex items-center justify-center space-x-4 ">
                    @if(Auth::check() && Auth::id() == $hero->post->user->id)
                        @can('isMortal')
                            <x-a-button href="{{route('hero.edit',$hero->id)}}" :icon="'edit'">EDIT POST</x-a-button>
                        @endcan
                    @endif
                    <x-a-button href="#vote" :icon="'vote'">VOTE</x-a-button>
                    <x-a-button href="#" :icon="'share'">Share this post</x-a-button>
                </div>
            </div>
            <x-score-post-header>
                <x-slot name="score">{{$hero->post->votes_total()}}</x-slot>
                <x-slot name="awards">{{$hero->post->awards->count()}}</x-slot>
            </x-score-post-header>
        </div>
        <hero-general inline-template v-cloak>
            <div class="px-6 pb-6  grid lg:grid-cols-3 gap-4">
                <div class="lg:col-span-3" v-if="loading">
                    <loading></loading>
                </div>
                <div class="flex items-start justify-center" v-if="!loading">
                    <div class="w-full">
                        <!-- HERO PORTRAIT -->
                        <div class="rounded shadow-lg shadow-primary-accent-sub">

                            <div class="w-full h-72 gradient_placeholder rounded-t">
                                @if($hero->img_is_uploaded)
                                    <img src="{{$hero->img_path}}" alt="hero dota 2" class="object-cover w-full h-full object-top rounded">
                                @endif
                            </div>
                            <!-- LEVEL 1 HP & MANA -->
                            <div class="relative w-full">

                                <div class="gradient_hp w-full h-10 flex items-center justify-center relative">
                                    <p class="text-xl text-white font-semibold text-center px-1 filter drop-shadow ">@{{ hp }}</p>
                                    <p class="absolute right-2 text-green-700 font-semibold text-sm text-center px-1 ">+ @{{ hp_regen }}</p>
                                </div>
                                <div class="gradient_mana w-full rounded-b h-10 flex items-center justify-center relative">
                                    <p class="text-xl text-white font-semibold text-center px-1 filter drop-shadow">@{{ mana }}</p>
                                    <p class="absolute right-2 text-blue-700 font-semibold text-sm text-center px-1">+ @{{ mana_regen }}</p>

                                </div>
                            </div>
                        </div>
                        <!-- LEVEL SELECTOR -->
                        <div class="flex items-center justify-center w-full space-x-4 rounded bg-primary-card-sub p-6 mt-4 h-[96px]">
                            <div class="bg-gray-800 rounded-full w-14 h-14 flex items-center justify-center border-4 border-yellow-400">
                                <p class="text-2xl text-yellow-400 font-semibold w-14 text-center align-middle" id="hero_level_indicator" v-html="current_level"></p>
                            </div>
                            <div class="w-full flex-grow flex flex-col items-center justify-center overflow-hidden rounded-3xl">
                                <input type="range" min="1" max="30" value="1" step="1" class="range range-primary range-lg" v-model="current_level" v-on:input="calculateData">
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="!loading" class="px-1 space-y-4">
                    <div class="grid grid-cols-3 gap-4">
                        <div v-if="hero.primary_attribute === 1" class="rounded flex flex-col items-center justify-center bg-strength space-y-1 pt-2 pb-1 shadow">
                            @include('svgs',['svg' => 'strength','classes' => 'h-6 w-6 text-primary-text-accent'])
                            <p class="text-primary-text-accent">Strength</p>
                        </div>
                        <div v-if="hero.primary_attribute === 2" class="rounded flex flex-col items-center justify-center bg-agility space-y-1 pt-2 pb-1 shadow">
                            @include('svgs',['svg' => 'agility','classes' => 'h-6 w-6 text-primary-text-accent'])
                            <p class="text-primary-text-accent">Agility</p>
                        </div>
                        <div v-if="hero.primary_attribute === 3" class="rounded flex flex-col items-center justify-center bg-intelligence space-y-1 pt-2 pb-1 shadow">
                            @include('svgs',['svg' => 'intelligence','classes' => 'h-6 w-6 text-primary-text-accent'])
                            <p class="text-primary-text-accent">Intelligence</p>
                        </div>

                        <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 pb-1 shadow">
                            <div v-if="hero.attack_type === 1" class="flex flex-col items-center justify-center">
                                @include('svgs',['svg' => 'melee','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>Melee</p>
                            </div>
                            <div v-if="hero.attack_type === 2" class="flex flex-col items-center justify-center">
                                @include('svgs',['svg' => 'ranged','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>Ranged</p>
                            </div>
                        </div>
                        <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub space-y-1 pt-2 pb-1 shadow">
                            <div>
                                <div v-if="hero.complexity === 1" class="flex items-center justify-center space-x-0.5">
                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-6 w-6 text-primary-icon'])
                                    @include('svgs',['svg' => 'rombo_empty','classes' => 'h-6 w-6 text-primary-icon'])
                                    @include('svgs',['svg' => 'rombo_empty','classes' => 'h-6 w-6 text-primary-icon'])
                                </div>
                                <div v-if="hero.complexity === 2" class="flex items-center justify-center space-x-0.5">
                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-6 w-6 text-primary-icon'])
                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-6 w-6 text-primary-icon'])
                                    @include('svgs',['svg' => 'rombo_empty','classes' => 'h-6 w-6 text-primary-icon'])
                                </div>
                                <div v-if="hero.complexity === 3" class="flex items-center justify-center space-x-0.5">
                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-6 w-6 text-primary-icon'])
                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-6 w-6 text-primary-icon'])
                                    @include('svgs',['svg' => 'rombo_full','classes' => 'h-6 w-6 text-primary-icon'])
                                </div>
                            </div>
                            <p v-if="hero.complexity === 1">Easy</p>
                            <p v-if="hero.complexity === 2">Medium</p>
                            <p v-if="hero.complexity === 3">Hard</p>
                        </div>
                    </div>
                    <!-- ATTRIBUTES -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="rounded bg-primary-card-sub  flex items-center justify-center flex-col space-y-1 pt-2 ">
                            @include('svgs',['svg' => 'strength','classes' => 'h-6 w-6 text-strength'])
                            <p class="font-semibold text-strength text-xl" v-html="current_strength"></p>
                            <div class="flex items-center justify-center space-x-2 bg-primary-accent w-full py-1 rounded-b">
                                <p class="text-sm text-primary-text-accent font-semibold leading-none">+ @{{ hero.lvlup_strength }}</p>
                            </div>
                        </div>
                        <div class="rounded flex items-center justify-center flex-col space-y-1 pt-2 bg-primary-card-sub   ">
                            @include('svgs',['svg' => 'agility','classes' => 'h-6 w-6 text-agility'])
                            <p class="font-semibold text-agility text-xl" v-html="current_agility"></p>
                            <div class="flex items-center justify-center space-x-2 bg-primary-accent  w-full py-1 rounded-b">
                                <p class="text-sm text-primary-text-accent font-semibold leading-none">+ @{{ hero.lvlup_agility }}</p>
                            </div>
                        </div>
                        <div class="rounded bg-primary-card-sub   flex items-center justify-center flex-col space-y-1 pt-2 ">
                            @include('svgs',['svg' => 'intelligence','classes' => 'h-6 w-6 text-intelligence'])
                            <p class="font-semibold text-intelligence text-xl" v-html="current_intelligence"></p>
                            <div class="flex items-center justify-center space-x-2 bg-primary-accent  w-full py-1 rounded-b">
                                <p class="text-sm text-primary-text-accent font-semibold leading-none">+ @{{ hero.lvlup_intelligence }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- STATS -->
                    <div class="w-full mt-2  rounded flex items-center justify-around  space-x-4">
                        <div class="w-1/3 relative">
                            <x-di-button type="button" :icon="''" v-on:click="changeTab(1)" class="w-full">ATTACK</x-di-button>
                            <div v-if="tab_selected == 1" class="absolute -bottom-4 left-0 right-0 flex items-center justify-center w-full">
                                @include('svgs',['svg' => 'caret_down','classes' => 'text-primary-icon h-5 w-5'])
                            </div>
                        </div>
                        <div class="w-1/3 relative">
                            <x-di-button type="button" :icon="''" v-on:click="changeTab(2)" class="w-full">DEFENSE</x-di-button>
                            <div v-if="tab_selected == 2" class="absolute -bottom-4 left-0 right-0 flex items-center justify-center w-full">
                                @include('svgs',['svg' => 'caret_down','classes' => 'text-primary-icon h-5 w-5'])
                            </div>
                        </div>
                        <div class="w-1/3 relative">
                            <x-di-button type="button" :icon="''" v-on:click="changeTab(3)" class="w-full">MOBILITY</x-di-button>
                            <div v-if="tab_selected == 3" class="absolute -bottom-4 left-0 right-0 flex items-center justify-center w-full">
                                @include('svgs',['svg' => 'caret_down','classes' => 'text-primary-icon h-5 w-5'])
                            </div>
                        </div>

                    </div>

                    <div class="rounded transition-all duration-300" v-if="tab_selected === 1">
                        <div class="grid grid-cols-3 gap-4 h-full">
                            <div class=" col-span-2 bg-primary-card-sub  rounded col-start-1 flex items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Attack Damage</p>
                                <div class="flex items-center justify-around w-full p-2 h-20">
                                    <div class="">
                                        @include('svgs',['svg' => 'attack_damage','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center">
                                        <p class="font-semibold text-3xl text-primary-text-sub leading-none"><span>@{{ min_damage }}</span>-<span>@{{ max_damage }}</span></p>
                                        <p class="text-sm whitespace-nowrap text-primary-text-muted">BASE @{{ hero.attack_damage_min }} - @{{ hero.attack_damage_max }}</p>
                                        <p class="text-sm whitespace-nowrap text-strength font-semibold" v-if="hero.primary_attribute === 1">+ <span>@{{ current_strength }} STR</span></p>
                                        <p class="text-sm whitespace-nowrap text-agility font-semibold" v-if="hero.primary_attribute === 2">+ <span>@{{ current_agility }} AGI</span></p>
                                        <p class="text-sm whitespace-nowrap text-intelligence font-semibold" v-if="hero.primary_attribute === 3">+ <span>@{{ current_intelligence }} INT</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-span-2 bg-primary-card-sub  rounded col-start-1 row-start-2 flex items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Attack Speed</p>
                                <div class="flex items-center justify-around w-full p-2 h-20">
                                    <div class="">
                                        @include('svgs',['svg' => 'attack_time','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center">
                                        <p class="font-semibold text-3xl text-primary-text leading-none">@{{ attack_per_second || 0 }} sec</p>
                                        <p class="text-xs text-primary-text">between attacks</p>
                                        <p class="text-sm whitespace-nowrap text-primary-text">BAT @{{ hero.attack_time }} <span
                                                class="text-sm whitespace-nowrap text-agility font-semibold">+ @{{ current_agility }} IAS</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row-span-2 bg-primary-card-sub  rounded col-start-3 row-start-1 flex flex-col items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Attack Range</p>
                                <div class="flex items-center flex-col justify-around w-full h-full p-2">
                                    <div class="">
                                        @include('svgs',['svg' => 'attack_range','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center flex items-center justify-center">
                                        <p class="font-semibold text-3xl text-primary-text">@{{ hero.attack_range || 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded transition-all duration-300" v-if="tab_selected === 2">
                        <div class="grid grid-cols-3 gap-4 h-full">
                            <div class=" col-span-2 bg-primary-card-sub  rounded col-start-1 flex items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Armor</p>
                                <div class="flex items-center justify-around w-full p-2 h-20">
                                    <div class="">
                                        @include('svgs',['svg' => 'defense_armor','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center">
                                        <p class="font-semibold text-3xl text-primary-text  leading-none">@{{ armor }}</p>
                                        <p class="text-sm whitespace-nowrap text-primary-text-muted">BASE @{{ hero.defense_armor }} </p>
                                        <p class="text-sm whitespace-nowrap text-agility font-semibold">+ <span>@{{ armor_added }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 bg-primary-card-sub  rounded col-start-1 row-start-2 flex items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Magic Resistance</p>
                                <div class="flex items-center justify-around w-full p-2 h-20">
                                    <div class="">
                                        @include('svgs',['svg' => 'magic_resistance','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class=" text-center">
                                        <p class="font-semibold text-3xl text-primary-text leading-none">@{{ hero.defense_magic_resistance || 0 }}%</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row-span-2 bg-primary-card-sub  rounded col-start-3 row-start-1 flex flex-col items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Status Resistance</p>
                                <div class="flex items-center flex-col justify-around w-full h-full p-2">
                                    <div class="">
                                        @include('svgs',['svg' => 'status_resistance','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center flex items-center justify-center">
                                        <p class="font-semibold text-3xl text-primary-text leading-none">0%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" rounded transition-all duration-300" v-if="tab_selected === 3">
                        <div class="grid grid-cols-3 gap-4 h-full">
                            <div class="col-span-2 bg-primary-card-sub  rounded col-start-1 flex items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Movement Speed</p>
                                <div class="flex items-center justify-around w-full p-2 h-20">
                                    <div class="">
                                        @include('svgs',['svg' => 'speed','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center">
                                        <p class="font-semibold text-3xl text-primary-text  leading-none">@{{ hero.mobility_speed || 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 bg-primary-card-sub  rounded col-start-1 row-start-2 flex items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Turn Rate</p>
                                <div class="flex items-center justify-around w-full p-2 h-20">
                                    <div class="">
                                        @include('svgs',['svg' => 'turn_rate','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center">
                                        <p class="font-semibold text-3xl text-primary-text leading-none">@{{ hero.mobility_turn_rate || 0 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class=" row-span-2 bg-primary-card-sub  rounded col-start-3 row-start-1 flex flex-col items-center justify-start flex-col">
                                <p class="shadow-md text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t flex items-center justify-center mb-2">
                                    Vision</p>
                                <div class="flex items-center flex-col justify-around w-full h-full p-2">
                                    <div class="">
                                        @include('svgs',['svg' => 'vision','classes' => 'text-primary-icon h-10 w-10'])
                                    </div>
                                    <div class="text-center flex items-center flex-col justify-center">
                                        <p class="text-xs text-primary-text-muted">DAY</p>
                                        <p class="font-semibold text-3xl text-primary-text ">@{{ hero.mobility_vision_day || 0 }}</p>
                                        <p class="text-xs text-primary-text-muted">NIGHT</p>
                                        <p class="font-semibold text-3xl text-primary-text ">@{{ hero.mobility_vision_night || 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROLES, STRENGTHS & DAMAGE OUTPUT -------------------------------------------------------------------->
                <div v-if="!loading" class="flex flex-col items-center justify-between h-full">
                    <!-- ROLES -->
                    <div class=" w-full">
                        <div class="w-full">
                            <p class="label_title mb-4">Roles</p>
                        </div>
                        <div class="flex items-center justify-center w-full ">
                            <div class="grid grid-cols-3 gap-5 w-full mb-1 px-2">
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_carry == 3 ,'text-primary-text-muted': hero.roles_carry == 0 }">Carry</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_carry >= 1 ,'bg-primary-card-sub ': hero.roles_carry < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_carry >= 2 ,'bg-primary-card-sub ': hero.roles_carry < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_carry >= 3 ,'bg-primary-card-sub ': hero.roles_carry < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_support == 3 ,'text-primary-text-muted': hero.roles_support == 0 }">Support</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_support >= 1 ,'bg-primary-card-sub ': hero.roles_support < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_support >= 2 ,'bg-primary-card-sub ': hero.roles_support < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_support >= 3 ,'bg-primary-card-sub ': hero.roles_support < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_nuker == 3 ,'text-primary-text-muted': hero.roles_nuker == 0 }">Nuker</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_nuker >= 1 ,'bg-primary-card-sub ': hero.roles_nuker < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_nuker >= 2 ,'bg-primary-card-sub ': hero.roles_nuker < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_nuker >= 3 ,'bg-primary-card-sub ': hero.roles_nuker < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_disabler == 3 ,'text-primary-text-muted': hero.roles_disabler == 0 }">Disabler</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">

                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_disabler >= 1 ,'bg-primary-card-sub ': hero.roles_disabler < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_disabler >= 2 ,'bg-primary-card-sub ': hero.roles_disabler < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_disabler >= 3 ,'bg-primary-card-sub ': hero.roles_disabler < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_jungler == 3 ,'text-primary-text-muted': hero.roles_jungler == 0 }">Jungler</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_jungler >= 1 ,'bg-primary-card-sub ': hero.roles_jungler < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_jungler >= 2 ,'bg-primary-card-sub ': hero.roles_jungler < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_jungler >= 3 ,'bg-primary-card-sub ': hero.roles_jungler < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_durable == 3 ,'text-primary-text-muted': hero.roles_durable == 0 }">Durable</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_durable >= 1 ,'bg-primary-card-sub ': hero.roles_durable < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_durable >= 2 ,'bg-primary-card-sub ': hero.roles_durable < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_durable >= 3 ,'bg-primary-card-sub ': hero.roles_durable < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_escape == 3 ,'text-primary-text-muted': hero.roles_escape == 0 }">Escape</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_escape >= 1 ,'bg-primary-card-sub ': hero.roles_escape < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_escape >= 2 ,'bg-primary-card-sub ': hero.roles_escape < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_escape >= 3 ,'bg-primary-card-sub ': hero.roles_escape < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_pusher == 3 ,'text-primary-text-muted': hero.roles_pusher == 0 }">Pusher</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_pusher >= 1 ,'bg-primary-card-sub ': hero.roles_pusher < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_pusher >= 2 ,'bg-primary-card-sub ': hero.roles_pusher < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_pusher >= 3 ,'bg-primary-card-sub ': hero.roles_pusher < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.roles_initiator == 3 ,'text-primary-text-muted': hero.roles_initiator == 0 }">Initiator</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_initiator >= 1 ,'bg-primary-card-sub ': hero.roles_initiator < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_initiator >= 2 ,'bg-primary-card-sub ': hero.roles_initiator < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.roles_initiator >= 3 ,'bg-primary-card-sub ': hero.roles_initiator < 3 }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- STRENGTHS -->
                    <div class="w-full">
                        <div class="w-full ">
                            <p class="label_title mb-4">Strengths</p>
                        </div>
                        <div class="flex items-center justify-center w-full ">
                            <div class="grid grid-cols-3 gap-5 w-full mb-1  px-2">
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.strengths_team_fight == 3 ,'text-primary-text-muted': hero.strengths_team_fight == 0 }">Team-fight</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_team_fight >= 1 ,'bg-primary-card-sub ': hero.strengths_team_fight < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_team_fight >= 2 ,'bg-primary-card-sub ': hero.strengths_team_fight < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg]  transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_team_fight >= 3 ,'bg-primary-card-sub ': hero.strengths_team_fight < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.strengths_farm == 3 ,'text-primary-text-muted': hero.strengths_farm == 0 }">Farm</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_farm >= 1 ,'bg-primary-card-sub ': hero.strengths_farm < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_farm >= 2 ,'bg-primary-card-sub ': hero.strengths_farm < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_farm >= 3 ,'bg-primary-card-sub ': hero.strengths_farm < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.strengths_split_push == 3 ,'text-primary-text-muted': hero.strengths_split_push == 0 }">Split-push</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_split_push >= 1,'bg-primary-card-sub ': hero.strengths_split_push < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_split_push >= 2,'bg-primary-card-sub ': hero.strengths_split_push < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_split_push >= 3,'bg-primary-card-sub ': hero.strengths_split_push < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.strengths_siege == 3 ,'text-primary-text-muted': hero.strengths_siege == 0 }">Siege</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_siege >= 1 ,'bg-primary-card-sub ': hero.strengths_siege < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_siege >= 2 ,'bg-primary-card-sub ': hero.strengths_siege < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_siege >= 3 ,'bg-primary-card-sub ': hero.strengths_siege < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.strengths_base_defense == 3 ,'text-primary-text-muted': hero.strengths_base_defense == 0 }">Base-Def.</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_base_defense >= 1,'bg-primary-card-sub ': hero.strengths_base_defense < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_base_defense >= 2,'bg-primary-card-sub ': hero.strengths_base_defense < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_base_defense >= 3,'bg-primary-card-sub ': hero.strengths_base_defense < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.strengths_roshan == 3 ,'text-primary-text-muted': hero.strengths_roshan == 0 }">Roshan</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_roshan >= 1,'bg-primary-card-sub ': hero.strengths_roshan < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_roshan >= 2,'bg-primary-card-sub ': hero.strengths_roshan < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-primary-icon': hero.strengths_roshan >= 3,'bg-primary-card-sub ': hero.strengths_roshan < 3 }"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- DAMAGE output -->
                    <div class="w-full">
                        <div class="w-full">
                            <p class="label_title mb-4">Damage output</p>
                        </div>
                        <div class="flex items-center justify-center w-full">
                            <div class="grid grid-cols-3 gap-5 w-full mb-1  px-2">
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.damage_pure == 3 ,'text-primary-text-muted': hero.damage_pure == 0 }">Pure</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700" :class="{'bg-pure': hero.damage_pure >= 1,'bg-primary-card-sub ': hero.damage_pure < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700" :class="{'bg-pure': hero.damage_pure >= 2,'bg-primary-card-sub ': hero.damage_pure < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700" :class="{'bg-pure': hero.damage_pure >= 3,'bg-primary-card-sub ': hero.damage_pure < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.damage_physical == 3 ,'text-primary-text-muted': hero.damage_physical == 0 }">Physical</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-strength': hero.damage_physical >= 1,'bg-primary-card-sub ': hero.damage_physical < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-strength': hero.damage_physical >= 2,'bg-primary-card-sub ': hero.damage_physical < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-strength': hero.damage_physical >= 3,'bg-primary-card-sub ': hero.damage_physical < 3 }"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm" :class="{'shadow_titulo': hero.damage_magical == 3 ,'text-primary-text-muted': hero.damage_magical == 0 }">Magical</p>
                                    <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-intelligence': hero.damage_magical >= 1,'bg-primary-card-sub ': hero.damage_magical < 1 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-intelligence': hero.damage_magical >= 2,'bg-primary-card-sub ': hero.damage_magical < 2 }"></div>
                                        <div class="h-3 -skew-x-[25deg] transition-all duration-700"
                                             :class="{'bg-intelligence': hero.damage_magical >= 3,'bg-primary-card-sub ': hero.damage_magical < 3 }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </hero-general>
    </div>
    <!-- SPELLS --------------------------------------------------------------------------------------------------------------->
    <hero-spells inline-template v-cloak>
        <div class="rounded bg-primary-card shadow_caja mt-4">
            <x-section-header>ABILITIES</x-section-header>
            <div class="grid lg:grid-cols-5 gap-10  p-6  ">
                <div class="lg:col-span-5" v-if="loading">
                    <loading></loading>
                </div>
                <!-- SPELL LIST -->
                <div v-if="!loading" class=" lg:col-span-2 flex items-start justify-start flex-col rounded space-y-2">
                    <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == 'Q','button_spell_inactive':selected_spell != 'Q'}"
                         @click="changeCurrentSpell('Q')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder  rounded "
                             :class="{
                                         'active_spell':spell_Q.spell_type == 1,
                                         'passive_spell':spell_Q.spell_type == 3,
                                         'autocast_spell':spell_Q.spell_type == 2,
                                         }"
                        >
                            <img v-if="spell_Q.img_is_uploaded != 0" :src="spell_Q.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center">
                            <p class="text-4xl font-bold">Q</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">
                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_Q.name == ''}">@{{spell_Q.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_Q.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_Q.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_Q.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_Q.mod_by_aghanims_scepter == 1 || spell_Q.created_by_aghanims_scepter == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_Q.mod_by_aghanims_shard == 1  || spell_Q.created_by_aghanims_shard == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == 'W','button_spell_inactive':selected_spell != 'W'}"
                         @click="changeCurrentSpell('W')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_W.spell_type == 1,
                                         'passive_spell':spell_W.spell_type == 3,
                                         'autocast_spell':spell_W.spell_type == 2,
                                         }">
                            <img v-if="spell_W.img_is_uploaded != 0" :src="spell_W.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center">
                            <p class="text-4xl font-bold">W</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">

                            <p class="font-semibold text-xl w-full capitalize  mb-2" :class="{'italic':spell_W.name == ''}">@{{spell_W.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_W.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_W.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_W.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_W.mod_by_aghanims_scepter == 1 || spell_W.created_by_aghanims_scepter == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_W.mod_by_aghanims_shard == 1  || spell_W.created_by_aghanims_shard == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell== 'E','button_spell_inactive':selected_spell!= 'E'}"
                         @click="changeCurrentSpell('E')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_E.spell_type == 1,
                                         'passive_spell':spell_E.spell_type == 3,
                                         'autocast_spell':spell_E.spell_type == 2,
                                         }">
                            <img v-if="spell_E.img_is_uploaded != 0" :src="spell_E.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center">
                            <p class="text-4xl font-bold">E</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">

                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_E.name == ''}">@{{spell_E.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_E.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_E.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_E.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_E.mod_by_aghanims_scepter == 1 || spell_E.created_by_aghanims_scepter == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_E.mod_by_aghanims_shard == 1  || spell_E.created_by_aghanims_shard == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell== 'R','button_spell_inactive':selected_spell!= 'R'}"
                         @click="changeCurrentSpell('R')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_R.spell_type == 1,
                                         'passive_spell':spell_R.spell_type == 3,
                                         'autocast_spell':spell_R.spell_type == 2,
                                         }">
                            <img v-if="spell_R.img_is_uploaded != 0" :src="spell_R.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                            <p class="text-4xl font-bold leading-none">R</p>
                            <p class="text-xs font-semibold leading-none">ULTIMATE</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">

                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_R.name == ''}">@{{spell_R.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_R.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_R.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_R.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_R.mod_by_aghanims_scepter == 1 || spell_R.created_by_aghanims_scepter == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_R.mod_by_aghanims_shard == 1  || spell_R.created_by_aghanims_shard == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="spell_D.name  && spell_D.description " class="overflow-hidden group button_spell"
                         :class="{'button_spell_active':selected_spell== 'D','button_spell_inactive':selected_spell!= 'D'}"
                         @click="changeCurrentSpell('D')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded" :class="{
                                         'active_spell':spell_D.spell_type == 1,
                                         'passive_spell':spell_D.spell_type == 3,
                                         'autocast_spell':spell_D.spell_type == 2,
                                         }">
                            <img v-if="spell_D.img_is_uploaded != 0" :src="spell_D.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                            <p class="text-4xl font-bold leading-none">D</p>

                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">

                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_D.name == ''}">@{{spell_D.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_D.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_D.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_D.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_D.mod_by_aghanims_scepter == 1 || spell_D.created_by_aghanims_scepter == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_D.mod_by_aghanims_shard == 1  || spell_D.created_by_aghanims_shard == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="spell_F.name  && spell_F.description " class="overflow-hidden group button_spell"
                         :class="{'button_spell_active':selected_spell== 'F','button_spell_inactive':selected_spell!= 'F'}"
                         @click="changeCurrentSpell('F')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded" :class="{
                                         'active_spell':spell_F.spell_type == 1,
                                         'passive_spell':spell_F.spell_type == 3,
                                         'autocast_spell':spell_F.spell_type == 2,
                                         }">
                            <img v-if="spell_F.img_is_uploaded != 0" :src="spell_F.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                            <p class="text-4xl font-bold leading-none">F</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">
                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_F.name == ''}">@{{spell_F.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_F.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_F.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_F.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>
                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_F.mod_by_aghanims_scepter == 1 || spell_F.created_by_aghanims_scepter == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                </div>

                                <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                     v-if="spell_F.mod_by_aghanims_shard == 1  || spell_F.created_by_aghanims_shard == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- CURRENT SPELL -->
                <div v-if="!loading" class="rounded lg:col-span-3  spell_box ">
                    <div class="w-full rounded  flex flex-col space-y-2 p-4 ">
                        <p class="font-semibold text-3xl" v-html="current_spell.name"></p>
                        <div class="flex items-center justify-start space-x-4">

                            <div class="radio_label_show flex   flex-col h-16 space-y-1">
                                <div v-if="current_spell.spell_type == 1">
                                    @include('svgs',['svg' => 'active','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <div v-if="current_spell.spell_type == 2">
                                    @include('svgs',['svg' => 'autocast','classes' => 'w-6 h-6 text-primary-icon shrink-0 animate-spin-slow'])
                                </div>
                                <div v-if="current_spell.spell_type == 3">
                                    @include('svgs',['svg' => 'passive','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <p class="text-sm uppercase font-semibold">@{{ current_spell.spell_type_name }}</p>
                            </div>

                            <div class="radio_label_show flex  flex-col h-16 space-y-1">
                                <div v-if="current_spell.spell_target== 1">
                                    @include('svgs',['svg' => 'target_none','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <div v-if="current_spell.spell_target == 3">
                                    @include('svgs',['svg' => 'target_unit','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <div v-if="current_spell.spell_target == 4">
                                    @include('svgs',['svg' => 'target_unit_or_point','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <div v-if="current_spell.spell_target == 6">
                                    @include('svgs',['svg' => 'target_unit_with_area','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <div v-if="current_spell.spell_target == 2">
                                    @include('svgs',['svg' => 'target_area','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <div v-if="current_spell.spell_target == 5">
                                    @include('svgs',['svg' => 'target_vector','classes' => 'w-6 h-6 text-primary-icon shrink-0'])
                                </div>
                                <p class="text-sm uppercase font-semibold">@{{ current_spell.spell_target_name }}</p>
                            </div>
                            <div class="radio_label_show flex flex-col h-16 space-y-1" :class="{
                            'radio_label_show_none':current_spell.spell_damage_type === 1,
                            'radio_label_show_pure':current_spell.spell_damage_type === 2,
                            'radio_label_show_physical':current_spell.spell_damage_type === 3,
                            'radio_label_show_magical':current_spell.spell_damage_type === 4,
                            'radio_label_show_mix':current_spell.spell_damage_type === 5,
                            'radio_label_show_hp_removal':current_spell.spell_damage_type === 6,
                            }">
                                <p class="text-xs text-primary-text-muted">DAMAGE</p>
                                <p class="text-sm uppercase font-semibold">@{{ current_spell.spell_damage_type_name }}</p>
                            </div>
                        </div>
                        <p class="py-4 max-h-[300px] long_text" v-html=" current_spell.description"></p>
                        <div class="flex items-center justify-start text-sm text-center flex-wrap space-x-2 py-4">
                            <div class=" flex flex-col space-y-1" :class="{'radio_label_show_on':current_spell.pierces_bkb === 1,'radio_label_show_off':current_spell.pierces_bkb === 0}">
                                <span class="text-xs leading-none">PIERCES BKB</span>
                                <span v-if="current_spell.pierces_bkb == 0" class="leading-none font-semibold text-off">NO</span>
                                <span v-if="current_spell.pierces_bkb == 1" class="leading-none font-semibold text-on">YES</span>
                            </div>
                            <div class=" flex flex-col space-y-1" :class="{'radio_label_show_on':current_spell.dispellable === 1,'radio_label_show_off':current_spell.dispellable === 0}">
                                <span class="text-xs leading-none">DISPELLABLE</span>
                                <span v-if="current_spell.dispellable == 0" class="leading-none font-semibold text-off">NO</span>
                                <span v-if="current_spell.dispellable == 1" class="leading-none font-semibold text-on">YES</span>
                            </div>
                            <div class=" flex flex-col space-y-1" :class="{'radio_label_show_on':current_spell.breakable === 1,'radio_label_show_off':current_spell.breakable === 0}">
                                <span class="text-xs leading-none">BREAKEABLE</span>
                                <span v-if="current_spell.breakable == 0" class="leading-none font-semibold text-off">NO</span>
                                <span v-if="current_spell.breakable == 1" class="leading-none font-semibold text-on">YES</span>
                            </div>
                            <div class=" flex flex-col space-y-1" :class="{'radio_label_show_on':current_spell.blocked_by_linkens === 1,'radio_label_show_off':current_spell.blocked_by_linkens === 0}">
                                <span class="text-xs leading-none">PROCS LINKENS</span>
                                <span v-if="current_spell.blocked_by_linkens == 0" class="leading-none font-semibold text-off">NO</span>
                                <span v-if="current_spell.blocked_by_linkens == 1" class="leading-none font-semibold text-on">YES</span>
                            </div>
                            <div class=" flex flex-col space-y-1" :class="{'radio_label_show_on':current_spell.cast_while_rooted === 1,'radio_label_show_off':current_spell.cast_while_rooted === 0}">
                                <span class="text-xs leading-none">CAST WHILE ROOTED</span>
                                <span v-if="current_spell.cast_while_rooted == 0" class="leading-none font-semibold text-off">NO</span>
                                <span v-if="current_spell.cast_while_rooted == 1" class="leading-none font-semibold text-on">YES</span>
                            </div>


                        </div>
                        <div class="grid gap-2 text-sm">
                            <div class="inline-flex space-x-2" v-for="attribute in current_spell.spell_attributes">
                                <p class="text-primary-text-muted uppercase">@{{ attribute.name }}</p>
                                <p class="font-semibold uppercase">@{{ attribute.value }}</p>
                            </div>

                        </div>
                        <div class="text-sm flex items-center justify-start space-x-10 ">
                            <div class="flex items-center justify-start space-x-2 my-4">
                                @include('svgs',['svg' => 'cooldown','classes' => 'w-6 h-6 rounded'])
                                <p class="font-semibold" v-html=" current_spell.cooldown"></p>
                            </div>
                            <div class="flex items-center justify-start space-x-2 my-4">
                                <div class="gradient_mana_cost w-6 h-6 rounded"></div>
                                <p class="font-semibold" v-html=" current_spell.manacost"></p>
                            </div>
                        </div>
                        <div class="text-sm rounded grid lg:grid-cols-2 gap-4">
                            <div class="mb-2 flex items-center justify-start w-full space-x-2 my-2" v-if="current_spell.mod_by_aghanims_scepter == 1">
                                <div class="flex-grow  h-full">
                                    <p class="font-semibold radio_label_show_aghs">Aghanim's Scepter Upgrade</p>
                                    <p class="text-sm">@{{ current_spell.mod_by_aghanims_scepter_desc }}</p>
                                </div>
                            </div>
                            <div class="mb-2 flex items-center justify-start w-full space-x-2 my-2" v-if="current_spell.mod_by_aghanims_shard == 1">
                                <div class="flex-grow h-full">
                                    <p class="font-semibold radio_label_show_aghs">Aghanim's Shard Upgrade</p>
                                    <p class="text-sm">@{{ current_spell.mod_by_aghanims_shard_desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </hero-spells>
    <!-- TALENTS --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card  mt-4 shadow_caja ">
        <x-section-header>TALENT TREE</x-section-header>
        <div class="grid grid-cols-5 gap-10  p-6  text-center">
            <div class="col-span-2 rounded bg-primary-card-sub p-1   flex items-center justify-center shadow-lg shadow-primary-accent-sub">
                <p>{{$hero->talent_25_left}}</p>
            </div>
            <div class="flex items-center justify-center">
                <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                    <p class="text-2xl text-yellow-400 font-bold ">25</p>
                </div>
            </div>
            <div class="col-span-2 rounded bg-primary-card-sub p-1   flex items-center justify-center shadow-lg shadow-primary-accent-sub">
                <p>{{$hero->talent_25_right}}</p>
            </div>

            <div class="col-span-2 rounded bg-primary-card-sub p-1   flex items-center justify-center shadow-md shadow-primary-accent-sub">
                <p>{{$hero->talent_20_left}}</p>
            </div>
            <div class="flex items-center justify-center">
                <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                    <p class="text-2xl text-yellow-400 font-bold ">20</p>
                </div>
            </div>
            <div class="col-span-2 rounded bg-primary-card-sub p-1  flex items-center justify-center shadow-md shadow-primary-accent-sub">
                <p>{{$hero->talent_20_right}}</p>
            </div>

            <div class="col-span-2 rounded bg-primary-card-sub p-1 shadow  flex items-center justify-center shadow-primary-accent-sub">
                <p>{{$hero->talent_15_left}}</p>
            </div>
            <div class="flex items-center justify-center">
                <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                    <p class="text-2xl text-yellow-400 font-bold ">15</p>
                </div>
            </div>
            <div class="col-span-2 rounded bg-primary-card-sub p-1 shadow  flex items-center justify-center shadow-primary-accent-sub">
                <p>{{$hero->talent_15_right}}</p>
            </div>

            <div class="col-span-2 rounded bg-primary-card-sub p-1 shadow  flex items-center justify-center">
                <p>{{$hero->talent_10_left}}</p>
            </div>
            <div class="flex items-center justify-center">
                <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                    <p class="text-2xl text-yellow-400 font-bold ">10</p>
                </div>
            </div>
            <div class="col-span-2 rounded bg-primary-card-sub p-1 shadow  flex items-center justify-center">
                <p>{{$hero->talent_10_right}}</p>
            </div>
        </div>
    </div>
    <!-- DESCRIPTION & LORE --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card  mt-4 shadow_caja ">
        <x-section-header>DESCRIPTION & LORE</x-section-header>
        <div class="grid lg:grid-cols-2 gap-8  p-6 ">
            <div>
                <div class="flex items-center justify-start space-x-2 mb-2">
                    @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                    <p class="font-semibold text-lg">Description</p>
                </div>
                @if($hero->description != '')
                    <div class="long_text text_html">{!! $hero->description!!}</div>
                @else
                    <p>This hero has no lore added.</p>
                @endif
            </div>
            <div>
                <div class="flex items-center justify-start space-x-2  mb-2">
                    @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                    <p class="font-semibold text-lg">Lore</p>
                </div>
                @if($hero->lore != '')
                    <div class="long_text text_html">{!! $hero->lore!!}</div>

                @else
                    <p>This hero has no lore added.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- CREDITS & VOTING ------------------------------------------------------------------------------------------------------->
    <x-credits :post="$hero->post"></x-credits>
    <!-- COMMENTS --------------------------------------------------------------------------------------------------------------->
    <x-comments :post="$hero->post"></x-comments>




@endsection
