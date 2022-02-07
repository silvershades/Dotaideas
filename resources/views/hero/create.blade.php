@extends('layout')

@section('content')
    <hero-create inline-template v-cloak>
        <div>
            <div class="h-64 bg-blue-50" v-if="loading">
                <x-loading></x-loading>
            </div>
            <div v-if="!loading">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="transition-all" :class="{'blur':publish_modal}">
                    <div class="rounded bg-primary-card shadow_caja pb-6 ">
                        <x-section-header>CREATING A HERO</x-section-header>
                        <div class="">
                            <div class="px-6 pt-6 lg:col-span-3 alert alert-error space-x-10 flex items-start justify-start flex-col" v-if="errors.hero.length ">
                                <p>We encountered some errors</p>
                                <ul class="w-full list-disc block">
                                    <li v-for="error in errors.hero">@{{ error }}</li>
                                </ul>
                            </div>

                        </div>
                        <div class="p-6 grid  lg:grid-cols-3 gap-8 ">

                            <!-- PREVIEW -->
                            <div class="">
                                <p class="label_title mb-4">Hero's portrait</p>
                                <div class="rounded overflow-hidden shadow-lg shadow-primary-accent-sub">
                                    <div class="h-64 rounded-t gradient_placeholder">
                                        <img v-if="dhero.image_show != ''" :src="dhero.image_show" alt="Her's portrait" class="w-full h-full object-cover">
                                    </div>
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
                                <div class="flex items-center justify-center w-full space-x-4 rounded bg-primary-card-sub p-2 my-6">
                                    <div class="bg-gray-800 rounded-full w-14 h-14 flex items-center justify-center border-4 border-yellow-400">
                                        <p class="text-2xl text-yellow-400 font-semibold w-14 text-center align-middle" id="hero_level_indicator" v-html="current_level"></p>
                                    </div>
                                    <div class="w-full flex-grow flex flex-col items-center justify-center overflow-hidden rounded-3xl">
                                        <input type="range" min="1" max="30" value="1" step="1" class="range range-primary range-lg" v-model="current_level" v-on:input="calculateData">
                                    </div>

                                </div>
                                <p class="label_title mb-2">PREVIEW OF VARIABLE VALUES</p>
                                <div class="grid grid-cols-1 my-6 gap-6">
                                    <div class="flex items-center justify-center rounded bg-primary-card-sub p-1 space-x-4 relative pt-8">
                                        <p class="text-center absolute top-0 right-0 left-0 p-1 bg-primary-accent text-primary-text-accent font-semibold text-sm rounded-t">Attack Damage</p>
                                        <div class="flex items-center justify-center">
                                            @include('svgs',['svg' => 'attack_damage','classes' => 'w-12 h-12 text-primary-icon'])
                                        </div>
                                        <div class="flex items-start justify-center flex-col flex-grow py-2">
                                            <p class="text-2xl font-semibold">@{{ damage }}</p>
                                            <p>Base damage <span class="font-semibold">@{{ dhero.attack_damage_min }} - @{{ dhero.attack_damage_max }}</span></p>
                                            <p v-if="dhero.primary_attribute == 1">Added by <span class="text-strength font-semibold">STR</span> <span class="text-on font-semibold">+@{{ current_strength }}</span>
                                            </p>
                                            <p v-if="dhero.primary_attribute == 2">Added by <span class="text-agility font-semibold">AGI</span> <span
                                                    class="text-on font-semibold">+@{{ current_agility }}</span>
                                            </p>
                                            <p v-if="dhero.primary_attribute == 3">Added by <span class="text-intelligence font-semibold">INT</span> <span
                                                    class="text-on font-semibold">+@{{ current_intelligence }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center rounded bg-primary-card-sub p-1 space-x-4 relative pt-8">
                                        <p class="text-center  absolute top-0 right-0 left-0 p-1 bg-primary-accent text-primary-text-accent font-semibold text-sm rounded-t">Attack Speed</p>
                                        <div class="flex items-center justify-center">
                                            @include('svgs',['svg' => 'attack_time','classes' => 'w-12 h-12 text-primary-icon'])
                                        </div>
                                        <div class="flex items-start justify-center flex-col flex-grow py-2">
                                            <p class="text-2xl font-semibold">@{{ attack_per_second }}sec <span class="font-normal text-lg">between attacks</span></p>
                                            <p class="">BAT <span class="font-semibold">1.7</span></p>
                                            <p class="">IAS <span class="font-semibold">@{{ +dhero.attack_ias }}</span> <span
                                                    class="text-on font-semibold">+@{{ +current_agility }}</span> from <span
                                                    class="text-agility font-semibold"> AGI</span></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center rounded bg-primary-card-sub p-1 space-x-4 relative pt-8">
                                        <p class="text-center absolute top-0 right-0 left-0 p-1 bg-primary-accent text-primary-text-accent font-semibold text-sm rounded-t">Armor</p>
                                        <div class="flex items-center justify-center">
                                            @include('svgs',['svg' => 'defense_armor','classes' => 'w-12 h-12 text-primary-icon'])
                                        </div>
                                        <div class="flex items-start justify-center flex-col flex-grow py-2">
                                            <p class="text-2xl font-semibold">@{{ def_armor }}</p>
                                            <p>Added by <span class="text-agility font-semibold">AGI</span> <span class="text-on font-semibold">+@{{ armor_added }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <p class="label_title mb-4">Hero's name</p>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'post_hero','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <input type="text" class="w-full input-sm" maxlength="40" placeholder="Enter the hero's name here..." v-model="dhero.name">
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
                                </div>
                                <div class="w-full mt-4 lg:mt-0 ">
                                    <p class="label_title">Basics</p>
                                </div>
                                <!-- COMPLEXITY -->
                                <div class="">
                                    <p class="block font-semibold mb-2">Complexity
                                        <span class="text-primary-icon" v-if="dhero.complexity == 1">Easy</span>
                                        <span class="text-primary-icon" v-if="dhero.complexity == 2">Normal</span>
                                        <span class="text-primary-icon" v-if="dhero.complexity == 3">Hard</span>
                                    </p>
                                    <div class="w-full grid grid-cols-3 gap-4 ">
                                        <div>
                                            <input name="complexity" type="radio" id="easy" class="hidden" v-model="dhero.complexity" value="1">
                                            <label for="easy" class="radio_label">
                                                @include('svgs',['svg' => 'rombo_full','classes' => 'w-8 h-8  text-primary-icon'])
                                                @include('svgs',['svg' => 'rombo_empty','classes' => 'w-8 h-8 text-primary-icon'])
                                                @include('svgs',['svg' => 'rombo_empty','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="complexity" type="radio" id="normal" class="hidden" v-model="dhero.complexity" value="2">
                                            <label for="normal" class="radio_label">
                                                @include('svgs',['svg' => 'rombo_full','classes' => 'w-8 h-8  text-primary-icon'])
                                                @include('svgs',['svg' => 'rombo_full','classes' => 'w-8 h-8  text-primary-icon'])
                                                @include('svgs',['svg' => 'rombo_empty','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="complexity" type="radio" id="hard" class="hidden" v-model="dhero.complexity" value="3">
                                            <label for="hard" class="radio_label">
                                                @include('svgs',['svg' => 'rombo_full','classes' => 'w-8 h-8 text-primary-icon'])
                                                @include('svgs',['svg' => 'rombo_full','classes' => 'w-8 h-8 text-primary-icon'])
                                                @include('svgs',['svg' => 'rombo_full','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- PRIMARY ATTRIBUTE -->
                                <div class="">
                                    <p class="block font-semibold mb-2">Primary Attribute
                                        <span class="text-strength" v-if="dhero.primary_attribute == 1">Strength</span>
                                        <span class="text-agility" v-if="dhero.primary_attribute == 2">Agility</span>
                                        <span class="text-intelligence" v-if="dhero.primary_attribute == 3">Intelligence</span>
                                    </p>
                                    <div class="w-full grid grid-cols-3 gap-4 ">
                                        <div>
                                            <input name="primary_attribute" type="radio" id="primary_attribute_strength" class="hidden" v-model="dhero.primary_attribute" value="1">
                                            <label for="primary_attribute_strength" class="radio_label">
                                                @include('svgs',['svg' => 'strength','classes' => 'w-8 h-8 text-strength'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="primary_attribute" type="radio" id="primary_attribute_agility" class="hidden" v-model="dhero.primary_attribute" value="2">
                                            <label for="primary_attribute_agility" class="radio_label">
                                                @include('svgs',['svg' => 'agility','classes' => 'w-8 h-8 text-agility'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="primary_attribute" type="radio" id="primary_attribute_intelligence" class="hidden" v-model="dhero.primary_attribute" value="3">
                                            <label for="primary_attribute_intelligence" class="radio_label">
                                                @include('svgs',['svg' => 'intelligence','classes' => 'w-8 h-8 text-intelligence'])
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <!-- ATTACK RANGE TYPE -->
                                <div class="">
                                    <p class="block font-semibold mb-2">Attack range
                                        <span class="text-primary-icon" v-if="dhero.attack_type == 1">Melee</span>
                                        <span class="text-primary-icon" v-if="dhero.attack_type == 2">Range</span>
                                    </p>
                                    <div class="w-full grid grid-cols-3 gap-4 ">
                                        <div>
                                            <input name="attack_type" type="radio" id="melee" class="hidden" v-model="dhero.attack_type" value="1">
                                            <label for="melee" class="radio_label">
                                                @include('svgs',['svg' => 'melee','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="attack_type" type="radio" id="range" class="hidden" v-model="dhero.attack_type" value="2">
                                            <label for="range" class="radio_label">
                                                @include('svgs',['svg' => 'ranged','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="label_title mb-4" for="name">Hero's Portrait</label>
                                    <input id="image_file_input_hero" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChangeHero">
                                    <p class="text-error text-xs">Invalid field</p>
                                </div>
                                <!-- ROLES -->
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">Roles</p>
                                </div>
                                <div class="flex items-center justify-center w-full mb-10">
                                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">
                                        <div>
                                            <p class="text-sm mb-1">Carry
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_carry == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_carry == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_carry == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_carry == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_carry">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Support
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_support == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_support == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_support == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_support == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_support">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Nuker
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_nuker == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_nuker == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_nuker == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_nuker == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_nuker">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Disabler
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_disabler == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_disabler == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_disabler == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_disabler == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_disabler">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Jungler
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_jungler == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_jungler == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_jungler == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_jungler == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_jungler">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Durable
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_durable == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_durable == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_durable == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_durable == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_durable">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Escape
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_escape == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_escape == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_escape == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_escape == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_escape">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Pusher
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_pusher == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_pusher == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_pusher == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_pusher == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_pusher">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Initiator
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.roles_initiator == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_initiator == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_initiator == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.roles_initiator == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.roles_initiator">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- STRENGTHS -->
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">Strengths & Weaknesses</p>
                                </div>
                                <div class="flex items-center justify-center w-full mb-10">
                                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">
                                        <div>
                                            <p class="text-sm mb-1">Team-fight
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.strengths_team_fight == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_team_fight == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_team_fight == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_team_fight == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.strengths_team_fight">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Farm
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.strengths_farm == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_farm == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_farm == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_farm == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.strengths_farm">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Split-push
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.strengths_split_push == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_split_push == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_split_push == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_split_push == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.strengths_split_push">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Siege
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.strengths_siege == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_siege == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_siege == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_siege == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.strengths_siege">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Base-Def.
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.strengths_base_defense == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_base_defense == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_base_defense == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_base_defense == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.strengths_base_defense">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Roshan
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.strengths_roshan == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_roshan == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_roshan == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="dhero.strengths_roshan == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.strengths_roshan">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- DAMAGE output -->
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">Damage output</p>
                                </div>
                                <div class="flex items-center justify-center w-full">
                                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">
                                        <div>
                                            <p class="text-sm mb-1">Pure
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.damage_pure == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-accent" v-if="dhero.damage_pure == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-accent" v-if="dhero.damage_pure == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-accent" v-if="dhero.damage_pure == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden pure_slider">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.damage_pure">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Physical
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.damage_physical == 0">NONE</span>
                                                <span class="font-semibold text-xs text-strength" v-if="dhero.damage_physical == 1">LOW</span>
                                                <span class="font-semibold text-xs text-strength" v-if="dhero.damage_physical == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-strength" v-if="dhero.damage_physical == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden physical_slider">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.damage_physical">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Magical
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="dhero.damage_magical == 0">NONE</span>
                                                <span class="font-semibold text-xs text-intelligence" v-if="dhero.damage_magical == 1">LOW</span>
                                                <span class="font-semibold text-xs text-intelligence" v-if="dhero.damage_magical == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-intelligence" v-if="dhero.damage_magical == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden magical_slider">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="dhero.damage_magical">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- BASIC INFO -->

                                <div class="w-full mb-2">
                                    <p class="label_title">Attributes</p>
                                </div>
                                <div class="flex items-center justify-end space-x-4 my-4">
                                    <div class="">
                                        <select class="select-sm py-1" v-model="selectedHero">
                                            <option value="" selected disabled>Load values from</option>
                                            @foreach($dota2heroes as $d2hero)
                                                <option value="{{$d2hero->json_name}}">{{$d2hero->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div v-if="loading_hero">
                                        <x-loading></x-loading>
                                    </div>
                                    <x-di-button :icon="''" type="button" @click="loadHero">OVERRIDE VALUES</x-di-button>
                                </div>
                                <!-- STRENGTH -->
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'strength','classes' => 'w-8 h-8 text-strength'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm ">Strength <span class="font-semibold text-primary-icon text-lg" v-html="dhero.strength"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden physical_slider">
                                            <input type="range" min="1" max="100" step="1" class="range range-primary w-full" v-model="dhero.strength" v-on:input="calculateData">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm ">Gain per level <span class="font-semibold text-primary-icon text-lg" v-html="dhero.lvlup_strength"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden physical_slider">
                                            <input type="range" min="0" max="10" step="0.1" class="range range-primary w-full" v-model="dhero.lvlup_strength" v-on:input="calculateData">
                                        </div>

                                    </div>
                                </div>
                                <!-- AGILITY -->
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'agility','classes' => 'w-8 h-8 text-agility'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm ">Agility <span class="font-semibold text-primary-icon text-lg" v-html="dhero.agility"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden agility_slider">
                                            <input type="range" min="1" max="100" step="1" class="range range-primary w-full" v-model="dhero.agility" v-on:input="calculateData">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm ">Gain per level <span class="font-semibold text-primary-icon text-lg" v-html="dhero.lvlup_agility"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden agility_slider">
                                            <input type="range" min="0" max="10" step="0.1" class="range range-primary w-full" v-model="dhero.lvlup_agility" v-on:input="calculateData">
                                        </div>

                                    </div>
                                </div>
                                <!-- INTELLIGENCE -->
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'intelligence','classes' => 'w-8 h-8 text-intelligence'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm ">Intelligence <span class="font-semibold text-primary-icon text-lg" v-html="dhero.intelligence"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden magical_slider">
                                            <input type="range" min="1" max="100" step="1" class="range range-primary w-full" v-model="dhero.intelligence" v-on:input="calculateData">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm ">Gain per level <span class="font-semibold text-primary-icon text-lg" v-html="dhero.lvlup_intelligence"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden magical_slider">
                                            <input type="range" min="0" max="10" step="0.1" class="range range-primary w-full" v-model="dhero.lvlup_intelligence" v-on:input="calculateData">
                                        </div>

                                    </div>
                                </div>
                                <div class="w-full mt-4 mb-2 relative">
                                    <p class="label_title">Bonus Health & Mana Regeneration</p>

                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'regen','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm"><span class="te"> HP</span> <span class="font-semibold text-primary-icon text-lg"
                                                                                                                 v-html="dhero.basic_regen_hp"></span>
                                        </p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden ">
                                            <input type="range" min="0" max="10" step="0.05" class="range range-primary w-full " v-model="dhero.basic_regen_hp" v-on:input="calculateDamageFromMin">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm"><span class="text0"> MANA</span> <span class="font-semibold text-primary-icon text-lg"
                                                                                                                      v-html="dhero.basic_regen_mana"></span>
                                        </p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden ">
                                            <input type="range" min="0" max="10" step="0.05" class="range range-primary w-full " v-model="dhero.basic_regen_mana" v-on:input="calculateDamageFromMax">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">Base Attack</p>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'attack_damage','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm"><span class="text-primary-accent"> MIN</span> Damage <span class="font-semibold text-primary-icon text-lg"
                                                                                                                                          v-html="dhero.attack_damage_min"></span>
                                        </p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="1" max="99" step="1" class="range range-primary w-full" v-model="dhero.attack_damage_min" v-on:input="calculateDamageFromMin">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm"><span class="text-primary-accent"> MAX</span> Damage <span class="font-semibold text-primary-icon text-lg"
                                                                                                                                          v-html="dhero.attack_damage_max"></span>
                                        </p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="2" max="100" step="1" class="range range-primary w-full" v-model="dhero.attack_damage_max" v-on:input="calculateDamageFromMax">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'attack_time','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm">Attack BAT <span class="font-semibold text-primary-icon text-lg" v-html="dhero.attack_bat"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="0.1" max="3" step="0.1" class="range range-primary w-full" v-model="dhero.attack_bat" v-on:input="calculateData">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm">Attack IAS <span class="font-semibold text-primary-icon text-lg" v-html="dhero.attack_ias"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="20" max="700" step="5" class="range range-primary w-full" v-model="dhero.attack_ias" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'attack_range','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm">Attack Range <span class="font-semibold text-primary-icon text-lg" v-html="dhero.attack_range"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="150" max="1000" step="1" class="range range-primary w-full" v-model="dhero.attack_range" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">Base Defense</p>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'defense_armor','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm">Armor <span class="font-semibold text-primary-icon text-lg" v-html="dhero.defense_armor"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="-10" max="30" step="1" class="range range-primary w-full" v-model="dhero.defense_armor" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'defense_magic_resistance','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm">Magic Resistance <span class="font-semibold text-primary-icon text-lg"
                                                                                                      v-html="dhero.defense_magic_resistance"></span><span
                                                class="font-semibold text-primary-icon text-lg">%</span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="0" max="100" step="1" class="range range-primary w-full" v-model="dhero.defense_magic_resistance" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">Mobility</p>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'speed','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm">Speed <span class="font-semibold text-primary-icon text-lg" v-html="dhero.mobility_speed"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="250" max="450" step="1" class="range range-primary w-full" v-model="dhero.mobility_speed" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'turn_rate','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm">Turn Rate <span class="font-semibold text-primary-icon text-lg" v-html="dhero.mobility_turn_rate"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="0.1" max="5" step="0.1" class="range range-primary w-full" v-model="dhero.mobility_turn_rate" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'vision','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm"><span class="text-primary-accent font-semibold">DAY</span> Vision <span
                                                class="font-semibold text-primary-icon text-lg"
                                                v-html="dhero.mobility_vision_day"></span>
                                        </p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="150" max="3000" step="50" class="range range-primary w-full" v-model="dhero.mobility_vision_day" v-on:input="calculateData">
                                        </div>
                                    </div>
                                    <div class="col-span-3">
                                        <p class="font-semibold mb-1  text-sm"><span class="text-blue-500 font-semibold">NIGHT</span> Vision <span class="font-semibold text-primary-icon text-lg"
                                                                                                                                                   v-html="dhero.mobility_vision_night"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="150" max="3000" step="50" class="range range-primary w-full" v-model="dhero.mobility_vision_night" v-on:input="calculateData">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="rounded bg-primary-card shadow_caja pb-6 mt-8">
                        <x-section-header>ABILITIES & SPELLS</x-section-header>
                        <div class="p-6 grid  xl:grid-cols-3 gap-8 ">
                            <div class="lg:col-span-3 alert alert-error space-x-10 flex items-start justify-start flex-col" v-if="errors.spells.length ">
                                <p>We encountered some errors</p>
                                <ul class="w-full list-disc block">
                                    <li v-for="error in errors.spells">@{{ error }}</li>
                                </ul>
                            </div>
                            <div class="xl:col-span-1 space-y-4">
                                <p class="text-primary-text-muted flex items-center">
                                    @include('svgs',['svg' => 'down_vote','classes' => 'w-6 h-6 text-primary-icon mr-2 animate-bounce shrink-0'])
                                    Select an ability to start editing. Heroes can only have 6 abilities, the last 2 are optional.</p>
                                <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == 'Q','button_spell_inactive':selected_spell != 'Q'}"
                                     @click="changeCurrentSpell('Q')">
                                    <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder  rounded "
                                         :class="{
                                         'active_spell':spell_Q.spell_type == 1,
                                         'passive_spell':spell_Q.spell_type == 2,
                                         'autocast_spell':spell_Q.spell_type == 3,
                                         }"
                                    >
                                        <img v-if="spell_Q.image_show != ''" :src="spell_Q.image_show" alt="spell image" class="object-cover w-full h-full">
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
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_Q.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_Q.spell_type == 3">
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
                                         'passive_spell':spell_W.spell_type == 2,
                                         'autocast_spell':spell_W.spell_type == 3,
                                         }">
                                        <img v-if="spell_W.image_show != ''" :src="spell_W.image_show" alt="spell image" class="object-cover w-full h-full">
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
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_W.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_W.spell_type == 3">
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
                                         'passive_spell':spell_E.spell_type == 2,
                                         'autocast_spell':spell_E.spell_type == 3,
                                         }">
                                        <img v-if="spell_E.image_show != ''" :src="spell_E.image_show" alt="spell image" class="object-cover w-full h-full">
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
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_E.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_E.spell_type == 3">
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
                                         'passive_spell':spell_R.spell_type == 2,
                                         'autocast_spell':spell_R.spell_type == 3,
                                         }">
                                        <img v-if="spell_R.image_show != ''" :src="spell_R.image_show" alt="spell image" class="object-cover w-full h-full">
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
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_R.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_R.spell_type == 3">
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

                                <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell== 'D','button_spell_inactive':selected_spell!= 'D'}"
                                     @click="changeCurrentSpell('D')">
                                    <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded" :class="{
                                         'active_spell':spell_D.spell_type == 1,
                                         'passive_spell':spell_D.spell_type == 2,
                                         'autocast_spell':spell_D.spell_type == 3,
                                         }">
                                        <img v-if="spell_D.image_show != ''" :src="spell_D.image_show" alt="spell image" class="object-cover w-full h-full">
                                    </div>
                                    <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                                        <p class="text-4xl font-bold leading-none">D</p>
                                        <p class="text-xs   leading-none">OPTIONAL</p>
                                    </div>
                                    <div class="flex items-start justify-start flex-grow flex-col">

                                        <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_D.name == ''}">@{{spell_D.name || 'unnamed'}}</p>
                                        <div class="flex items-center justify-start space-x-2">
                                            <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_D.spell_type == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_D.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_D.spell_type == 3">
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
                                <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell== 'F','button_spell_inactive':selected_spell!= 'F'}"
                                     @click="changeCurrentSpell('F')">
                                    <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded" :class="{
                                         'active_spell':spell_F.spell_type == 1,
                                         'passive_spell':spell_F.spell_type == 2,
                                         'autocast_spell':spell_F.spell_type == 3,
                                         }">
                                        <img v-if="spell_F.image_show != ''" :src="spell_F.image_show" alt="spell image" class="object-cover w-full h-full">
                                    </div>
                                    <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                                        <p class="text-4xl font-bold leading-none">F</p>
                                        <p class="text-xs   leading-none">OPTIONAL</p>
                                    </div>
                                    <div class="flex items-start justify-start flex-grow flex-col">
                                        <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_F.name == ''}">@{{spell_F.name || 'unnamed'}}</p>
                                        <div class="flex items-center justify-start space-x-2">
                                            <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_F.spell_type == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_F.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_F.spell_type == 3">
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
                            <div class="xl:col-span-2 mt-10 grid lg:grid-cols-2 gap-4 spell_box rounded p-4">
                                <div class="">
                                    <div class="mb-4 grid grid-cols-3 gap-4">
                                        <div class="flex items-center justify-center flex-col border-2 border-solid rounded border-primary-accent">
                                            <p v-html="current_spell.hotkey" class="text-4xl font-semibold text-primary-accent"></p>
                                            <p class="text-primary-accent text-sm font-semibold">ABILITY</p>
                                        </div>
                                        <div class="col-span-2">
                                            <p class="label_title mb-4">Ability Name</p>
                                            <input type="text" class="w-full input-sm" maxlength="22" v-model="current_spell.name" :placeholder="[[current_spell.placeholder ]]">
                                            <p class="text-error text-xs">Invalid field</p>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <p class="label_title mb-4 text-primary-text">Image</p>
                                        <input v-show="current_spell.hotkey ==  'Q'" id="image_file_input_Q" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  'W'" id="image_file_input_W" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  'E'" id="image_file_input_E" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  'R'" id="image_file_input_R" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  'D'" id="image_file_input_D" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  'F'" id="image_file_input_F" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
                                    <div class="mb-0">
                                        <p class="label_title mb-4">Description</p>
                                        <textarea rows="5" class="resize-none w-full text-sm" v-model="current_spell.description" placeholder="Enter the spell description here..."></textarea>
                                        <p class="text-error text-sm">Invalid field</p>
                                    </div>
                                    <div class="w-full space-y-2 rounded-b py-2 mb-4">
                                        <p class="text-sm">Add ability's specifics</p>
                                        <div class="flex items-center justify-around space-x-2 ">
                                            <div>
                                                <input type="text" maxlength="22" class="input-sm py-0 w-full uppercase" placeholder="DAMAGE" v-model="spell_mod_name">
                                            </div>
                                            <div>
                                                <input type="text" maxlength="22" class="input-sm py-0 w-full uppercase" placeholder="100/200/300/400" v-model="spell_mod_value">
                                            </div>
                                            <div>
                                                <x-di-button type="button" :icon="'plus'" @click="addSpellModifier">ADD</x-di-button>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="list-disc ml-6 mt-2">
                                                <li v-for="(mod, index) in current_spell.spell_attributes" class="uppercase text-sm">
                                                    <span class="flex items-center space-x-2">
                                                        <span class="text-primary-text-muted">@{{ mod.name }}</span>
                                                        <span class="font-semibold">@{{ mod.value }}</span>
                                                        <span>
                                                            <button class="cursor-pointer text-primary-text-muted hover:text-primary-icon flex items-center" type="button"
                                                                    @click="deleteSpellModifier(index)">
                                                                @include('svgs',['svg' => 'trash','classes' => 'w-4 h-4'])
                                                            </button>
                                                        </span>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <p class="label_title mb-4">Cooldown & Manacost</p>
                                        <div class="grid grid-cols-8 gap-4 mb-2">
                                            <div class="flex items-center justify-center">
                                                @include('svgs',['svg' => 'cooldown','classes' => 'w-8 h-8 rounded'])
                                            </div>
                                            <div class="col-span-3">
                                                <input type="text" class="w-full input-sm" maxlength="22" placeholder="Cooldown" v-model="current_spell.cooldown">
                                                <p class="text-error text-xs">Invalid field</p>
                                            </div>
                                            <div class="flex items-center justify-center">
                                                <div class="w-8 h-8 rounded gradient_mana_cost"></div>
                                            </div>
                                            <div class="col-span-3">
                                                <input type="text" class="w-full input-sm" maxlength="22" placeholder="Manacost" v-model="current_spell.manacost">
                                                <p class="text-error text-xs">Invalid field</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-if="current_spell.mod_by_aghanims_scepter == 1" class="mb-4">
                                        <label class="label_title mb-4" for="name">Aghanims Scepter Upgrade</label>
                                        <textarea rows="3" class="resize-none w-full text-sm" v-model="current_spell.mod_by_aghanims_scepter_desc"
                                                  placeholder="Enter the upgrade description here..."></textarea>
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
                                    <div v-if="current_spell.mod_by_aghanims_shard == 1" class="mb-4">
                                        <label class="label_title mb-4" for="name">Aghanims Shard Upgrade</label>
                                        <textarea rows="3" class="resize-none w-full text-sm" v-model="current_spell.mod_by_aghanims_shard_desc"
                                                  placeholder="Enter the upgrade description here..."></textarea>
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
                                </div>
                                <div class="space-y-4">

                                    <div class="grid grid-cols-3 gap-4">
                                        <p class="col-span-3 label_title">Type</p>

                                        <div>
                                            <input name="ability_type" type="radio" id="active_spell" class="hidden" v-model="current_spell.spell_type" value="1">
                                            <label for="active_spell" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'active','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">ACTIVE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_type" type="radio" id="passive_spell" class="hidden" v-model="current_spell.spell_type" value="2">
                                            <label for="passive_spell" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'passive','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">PASSIVE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_type" type="radio" id="autocast_spell" class="hidden" v-model="current_spell.spell_type" value="3">
                                            <label for="autocast_spell" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'autocast','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">AUTOCAST</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <p class="col-span-3 label_title">Target</p>
                                        <div>
                                            <input name="ability_target" type="radio" id="target_none" class="hidden" v-model="current_spell.spell_target" value="1">
                                            <label for="target_none" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'target_none','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">NO TARGET</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_target" type="radio" id="target_unit" class="hidden" v-model="current_spell.spell_target" value="3">
                                            <label for="target_unit" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'target_unit','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">UNIT</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_target" type="radio" id="target_unit_or_point" class="hidden" v-model="current_spell.spell_target" value="4">
                                            <label for="target_unit_or_point" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'target_unit_or_point','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">UNIT OR POINT</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_target" type="radio" id="radio_label" class="hidden" v-model="current_spell.spell_target" value="6">
                                            <label for="radio_label" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'target_unit_with_area','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">UNIT WITH AREA</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_target" type="radio" id="target_area" class="hidden" v-model="current_spell.spell_target" value="2">
                                            <label for="target_area" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'target_area','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">AREA</span>
                                            </label>
                                        </div>

                                        <div>
                                            <input name="ability_target" type="radio" id="target_vector" class="hidden" v-model="current_spell.spell_target" value="5">
                                            <label for="target_vector" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'target_vector','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">VECTOR</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-4">
                                        <p class="col-span-4 label_title">Damage Output</p>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_none" class="hidden" v-model="current_spell.spell_damage_type" value="1">
                                            <label for="damage_none" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs">NONE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_pure" class="hidden" v-model="current_spell.spell_damage_type" value="2">
                                            <label for="damage_pure" class="radio_label_pure flex-col h-11 space-y-1">
                                                <span class="text-xs">PURE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_physical" class="hidden" v-model="current_spell.spell_damage_type" value="3">
                                            <label for="damage_physical" class="radio_label_physical flex-col h-11 space-y-1">
                                                <span class="text-xs">PHYSICAL</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_magical" class="hidden" v-model="current_spell.spell_damage_type" value="4">
                                            <label for="damage_magical" class="radio_label_magical flex-col h-11 space-y-1">
                                                <span class="text-xs">MAGICAL</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_mix" class="hidden" v-model="current_spell.spell_damage_type" value="5">
                                            <label for="damage_mix" class="radio_label_mix flex-col h-11 space-y-1">
                                                <span class="text-xs">MIX</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_hp_removal" class="hidden" v-model="current_spell.spell_damage_type" value="6">
                                            <label for="damage_hp_removal" class="radio_label_hp_removal flex-col h-11 space-y-1">
                                                <span class="text-xs">HP REMOVAL</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <p class="col-span-3 label_title">Interactions</p>
                                        <div>
                                            <input name="pierces_bkb" type="checkbox" id="pierces_bkb" class="hidden" v-model="current_spell.pierces_bkb">
                                            <label for="pierces_bkb" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs leading-none">PIERCES BKB</span>
                                                <span v-if="current_spell.pierces_bkb == 0" class="leading-none font-semibold text-off">NO</span>
                                                <span v-if="current_spell.pierces_bkb == 1" class="leading-none font-semibold text-on">YES</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="dispellable" type="checkbox" id="dispellable" class="hidden" v-model="current_spell.dispellable">
                                            <label for="dispellable" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs leading-none">DISPELLABLE</span>
                                                <span v-if="current_spell.dispellable == 0" class="leading-none font-semibold text-off">NO</span>
                                                <span v-if="current_spell.dispellable == 1" class="leading-none font-semibold text-on">YES</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="breakable" type="checkbox" id="breakable" class="hidden" v-model="current_spell.breakable">
                                            <label for="breakable" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs leading-none">BREAKABLE</span>
                                                <span v-if="current_spell.breakable == 0" class="leading-none font-semibold text-off">NO</span>
                                                <span v-if="current_spell.breakable == 1" class="leading-none font-semibold text-on">YES</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="blocked_by_linkens" type="checkbox" id="blocked_by_linkens" class="hidden" v-model="current_spell.blocked_by_linkens">
                                            <label for="blocked_by_linkens" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs leading-none">PROCS LINKENS</span>
                                                <span v-if="current_spell.blocked_by_linkens == 0" class="leading-none font-semibold text-off">NO</span>
                                                <span v-if="current_spell.blocked_by_linkens == 1" class="leading-none font-semibold text-on">YES</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="cast_while_rooted" type="checkbox" id="cast_while_rooted" class="hidden" v-model="current_spell.cast_while_rooted">
                                            <label for="cast_while_rooted" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs leading-none">CAST WHILE ROOTED</span>
                                                <span v-if="current_spell.cast_while_rooted == 0" class="leading-none font-semibold text-off">NO</span>
                                                <span v-if="current_spell.cast_while_rooted == 1" class="leading-none font-semibold text-on">YES</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <p class="col-span-2 label_title">Aghanim's Scepter & Shard</p>
                                        <div v-if="current_spell.hotkey == 'D' || current_spell.hotkey == 'F'">
                                            <input name="created_by_aghanims_scepter" type="checkbox" id="created_by_aghanims_scepter" class="hidden"
                                                   v-model="current_spell.created_by_aghanims_scepter">
                                            <label for="created_by_aghanims_scepter" class="radio_label_aghanims flex-col h-11 space-y-1" @click="checkAghanimCreation(1)">
                                                <span class="text-xs leading-none">SCEPTER NEW SPELL</span>
                                                <span v-if="current_spell.created_by_aghanims_scepter == 0" class="leading-none font-semibold text-strength">NO</span>
                                                <span v-if="current_spell.created_by_aghanims_scepter == 1" class="leading-none font-semibold text-blue-400">YES</span>
                                            </label>
                                        </div>
                                        <div v-if="current_spell.hotkey == 'D' || current_spell.hotkey == 'F'">
                                            <input name="created_by_aghanims_shard" type="checkbox" id="created_by_aghanims_shard" class="hidden" v-model="current_spell.created_by_aghanims_shard">
                                            <label for="created_by_aghanims_shard" class="radio_label_aghanims flex-col h-11 space-y-1" @click="checkAghanimCreation(2)">
                                                <span class="text-xs leading-none">SHARD NEW SPELL</span>
                                                <span v-if="current_spell.created_by_aghanims_shard == 0" class="leading-none font-semibold text-strength">NO</span>
                                                <span v-if="current_spell.created_by_aghanims_shard == 1" class="leading-none font-semibold text-blue-400">YES</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="mod_by_aghanims_scepter" type="checkbox" id="mod_by_aghanims_scepter" class="hidden" v-model="current_spell.mod_by_aghanims_scepter">
                                            <label for="mod_by_aghanims_scepter" class="radio_label_aghanims flex-col h-11 space-y-1" @click="checkAghanimCreation(3)">
                                                <span class="text-xs leading-none text-primary-text">UPGRADABLE BY SCEPTER</span>
                                                <span v-if="current_spell.mod_by_aghanims_scepter == 0" class="leading-none font-semibold text-strength">NO</span>
                                                <span v-if="current_spell.mod_by_aghanims_scepter == 1" class="leading-none font-semibold text-blue-400">YES</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="mod_by_aghanims_shard" type="checkbox" id="mod_by_aghanims_shard" class="hidden" v-model="current_spell.mod_by_aghanims_shard">
                                            <label for="mod_by_aghanims_shard" class="radio_label_aghanims flex-col h-11 space-y-1" @click="checkAghanimCreation(4)">
                                                <span class="text-xs leading-none text-primary-text">UPGRADABLE BY SHARD</span>
                                                <span v-if="current_spell.mod_by_aghanims_shard == 0" class="leading-none font-semibold text-strength">NO</span>
                                                <span v-if="current_spell.mod_by_aghanims_shard == 1" class="leading-none font-semibold text-blue-400">YES</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="rounded bg-primary-card shadow_caja pb-6 mt-8">
                        <x-section-header>TALENT TREE</x-section-header>
                        <div class="p-6 grid  lg:grid-cols-3 gap-8 ">
                            <div class="lg:col-span-3 alert alert-error space-x-10 flex items-start justify-start flex-col" v-if="errors.talents.length ">
                                <p>We encountered some errors</p>
                                <ul class="w-full list-disc block">
                                    <li v-for="error in errors.talents">@{{ error }}</li>
                                </ul>
                            </div>
                            <div class="lg:col-span-3 grid grid-cols-5 gap-10  px-4 lg:px-8 text-center">
                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_25_left">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                                        <p class="text-2xl text-yellow-400 font-bold shrink-0  w-14">25</p>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_25_right">
                                </div>

                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_20_left">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                                        <p class="text-2xl text-yellow-400 font-bold shrink-0  w-14 ">20</p>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_20_right">
                                </div>

                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_15_left">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                                        <p class="text-2xl text-yellow-400 font-bold shrink-0  w-14 ">15</p>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_15_right">
                                </div>

                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_10_left">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div class="bg-gray-800 rounded-full  inline-flex items-center justify-center border-4 border-yellow-400 w-14 h-14">
                                        <p class="text-2xl text-yellow-400 font-bold shrink-0  w-14">10</p>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <input type="text" maxlength="70" class="w-full text-center" v-model="dhero.talent_10_right">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="rounded bg-primary-card shadow_caja pb-6 mt-8 ">
                        <x-section-header>DESCRIPTION & LORE</x-section-header>
                        <div class="p-6 grid  lg:grid-cols-4 gap-8 ">
                            <div class="lg:col-span-3 alert alert-error space-x-10 flex items-start justify-start flex-col" v-if="errors.description.length ">
                                <p>We encountered some errors</p>
                                <ul class="w-full list-disc block">
                                    <li v-for="error in errors.description">@{{ error }}</li>
                                </ul>
                            </div>
                            <div class="lg:col-span-2">
                                <p class="col-span-3 label_title mb-4">Hero's Description</p>
                                @if(Auth::check() && Auth::user()->has_unlocked_text_editor())
                                    <x-tiny-mce :vmodel="'dhero.description'" :height="400"></x-tiny-mce>
                                @else
                                    <textarea name="idea" id="" class="resize-none w-full flex-grow h-[400px]" v-model="dhero.description"></textarea>
                                @endif
                            </div>
                            <div class="lg:col-span-2">
                                <p class="col-span-3 label_title mb-4">Hero's Lore</p>
                                @if(Auth::check() && Auth::user()->has_unlocked_text_editor())
                                    <x-tiny-mce :vmodel="'dhero.lore'" :height="400"></x-tiny-mce>
                                @else
                                    <textarea name="idea" id="" class="resize-none w-full flex-grow h-[400px]" v-model="dhero.lore"></textarea>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="flex items-center justify-center  p-2 my-4 space-x-4 ">
                        <x-di-button :icon="'arrow_right'" type="button" @click="startPublish">CONTINUE</x-di-button>
                    </div>
                </div>

            </div>
            <x-modal-publish></x-modal-publish>
        </div>
    </hero-create>
@endsection
