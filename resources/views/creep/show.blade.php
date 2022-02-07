@extends('layout')

@section('content')
    @include('post.includes.post_type_header',['post_type' => 'Creep'])

    <!-- GENERAL DESCRIPTION --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow pb-6">
        <div class="px-4 bg-primary-accent text-white text-center rounded-t flex items-center justify-start">
            <p class="text-lg font-semibold px-3 py-2">General</p>
        </div>
        <div class="flex items-center justify-around  px-4 lg:px-8  my-2 flex-wrap">
            <!-- TITULO -->
            <div class="flex-grow items-center justify-start flex">
                <p class="text-3xl font-semibold py-2">{{$creep->name}}</p>
            </div>
            <!-- SHARE BAR -->
            @include("post.includes.action_bar")
        </div>
        <div class="px-4 lg:px-8 grid lg:grid-cols-3 gap-4">
            <div class="flex items-start justify-center">
                <div class="w-full">
                    <!-- HERO PORTRAIT -->
                    <div class="rounded shadow">
                        <div class="w-full h-80 gradient_placeholder rounded">
                            <img src="{{asset("/img/heroes/batrider_hphover.png")}}" alt="hero dota 2" class="object-cover w-full h-full object-top rounded">
                        </div>
                    </div>

                </div>
            </div>
            <div class="px-1 space-y-2">
                <!-- BASICS -->
                <div class="grid grid-cols-3 gap-2">
                    <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-2 pb-2">
                        <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">total gold</p>
                        <img src="{{asset("/img/icons/gold2.png")}}" class="h-8 w-8" alt="hero">
                        <p>{{$creep->creep_units->sum("kill_gold")}}</p>
                    </div>
                    <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-2 pb-2">
                        <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">total exp</p>
                        <p class="font-black text-primary-accent text-2xl">XP</p>
                        <p>{{$creep->creep_units->sum("kill_exp")}}</p>
                    </div>
                    <div class="rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-2 pb-2">
                        <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">total units</p>
                        @include('svgs',['svg' => 'creep','classes' => 'w-8 h-8 text-primary-accent'])
                        <p>{{$creep->creep_units->sum("units_in_camp")}}</p>
                    </div>
                </div>
                <!-- CREEP CAMP TYPE -->
                <div class="">
                    <div class="flex items-center justify-center flex-col space-y-2 bg-primary-card-sub  p-2 lg:h-52 rounded">
                        @include('svgs',['svg' => 'camp','classes' => 'h-10 w-10 text-primary-accent'])
                        <p>{{$creep->creep_type->name}}</p>
                    </div>

                </div>

            </div>
            <div class="flex flex-col items-center justify-start ">
                <!-- ROLES -->
                <div class="w-full mb-4">
                    <p class="w-full rounded bg-primary-card-sub px-2 py-1">Roles</p>
                </div>
                <div class="flex items-center justify-center w-full mb-3">
                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">
                        <div>
                            <p class="text-sm">Gold</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_gold >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_gold >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_gold >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Experience</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_experience >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_experience >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_experience >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Dominate</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_dominate >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_dominate >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_dominate >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Early game</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_early >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_early >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_early >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Mid game</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_mid >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_mid >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_mid >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Late game</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_late >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_late >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_late >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- DAMAGE output -->
                <div class="w-full mb-4">
                    <p class="w-full rounded bg-primary-card-sub px-2 py-1">Resistances</p>
                </div>
                <div class="flex items-center justify-center w-full mb-3">
                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">

                        <div>
                            <p class="text-sm">Armor</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_armor >= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_armor >= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_armor >= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>

                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Magic</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_magic_res>= 1 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_magic_res>= 2 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_magic_res>= 3 ) bg-primary-accent @else bg-primary-card-sub @endif "></div>

                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Status</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->roles_status_res >= 1 ) bg-primary-accent  @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_status_res >= 2 ) bg-primary-accent  @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->roles_status_res >= 3 ) bg-primary-accent  @else bg-primary-card-sub @endif "></div>

                            </div>
                        </div>
                    </div>
                </div><!-- DAMAGE output -->
                <div class="w-full mb-4">
                    <p class="w-full rounded bg-primary-card-sub px-2 py-1">Damage output</p>

                </div>
                <div class="flex items-center justify-center w-full mb-3">
                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">

                        <div>
                            <p class="text-sm">Pure</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->damage_pure >= 1 ) bg-yellow-500 @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->damage_pure >= 2 ) bg-yellow-500 @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->damage_pure >= 3 ) bg-yellow-500 @else bg-primary-card-sub @endif "></div>

                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Physical</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->damage_physical >= 1 ) bg-red-500 @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->damage_physical >= 2 ) bg-red-500 @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->damage_physical >= 3 ) bg-red-500 @else bg-primary-card-sub @endif "></div>

                            </div>
                        </div>
                        <div>
                            <p class="text-sm">Magical</p>
                            <div class="h-2 rounded w-full grid grid-cols-3 gap-1">
                                <div class="h-2 rounded @if($creep->damage_magical >= 1 ) bg-blue-500 @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->damage_magical >= 2 ) bg-blue-500 @else bg-primary-card-sub @endif "></div>
                                <div class="h-2 rounded @if($creep->damage_magical >= 3 ) bg-blue-500 @else bg-primary-card-sub @endif "></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- UNTIS --------------------------------------------------------------------------------------------------------------->
    <div class="mt-4 bg-primary-card rounded">
        <div class="px-4 bg-primary-accent text-primary-text-accent text-center rounded-t flex items-center justify-start">
            <p class="text-lg font-semibold px-3 py-2">Camp Units</p>
        </div>
        <div class="space-y-4 px-4 lg:px-8 py-6">
            @foreach($creep->creep_units as $unit)
                <div class="flex items-start justify-start space-x-4 p-4 rounded ">
                    <div>
                        <div class="w-64 h-44 rounded-t shadow flex-shrink-0 gradient_placeholder">
                            <img src="{{asset("/img/heroes/batrider_hphover.png")}}" alt="hero dota 2" class="object-cover w-full h-full object-top rounded-t">
                        </div>
                        <div>
                            <div class="relative w-full shadow">
                                <div class="gradient_hp w-full h-10 flex items-center justify-center relative">
                                    <p class=" text-white font-semibold text-center px-1 filter drop-shadow ">{{ $unit->total_hp }}</p>
                                    <p class="absolute right-2 text-green-700 font-semibold text-sm text-center px-1 ">+ {{ $unit->total_hp_regen }}</p>
                                </div>
                                <div class="gradient_mana w-full rounded-b h-10 flex items-center justify-center relative">
                                    <p class="text-white font-semibold text-center px-1 filter drop-shadow">{{$unit->total_mana }}</p>
                                    <p class="absolute right-2 text-blue-700 font-semibold text-sm text-center px-1">+ {{ $unit->total_mana_regen }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-2 space-x-0.5">
                            <div class="h-16 w-1/3 rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1 ">
                                @if($unit->attack_type == 1)
                                    @include('svgs',['svg' => 'melee','classes' => 'h-6 w-6 text-primary-icon'])
                                    <p>Melee</p>
                                @else
                                    @include('svgs',['svg' => 'ranged','classes' => 'h-6 w-6 text-primary-icon'])
                                    <p>Ranged</p>
                                @endif
                            </div>
                            <div class="h-16 w-1/3 rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                @include('svgs',['svg' => 'attack_damage','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>{{$unit->attack_damage_min}} - {{$unit->attack_damage_max}} </p>
                            </div>
                            <div class="h-16  w-1/3  rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                @include('svgs',['svg' => 'attack_time','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>{{$unit->attack_time}} </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-0.5 space-x-0.5">
                            <div class="h-16 w-1/3 rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                @include('svgs',['svg' => 'defense_armor','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>{{$unit->defense_armor}} </p>
                            </div>
                            <div class="h-16 w-1/3 rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                @include('svgs',['svg' => 'defense_magic_resistance','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>{{$unit->defense_magic_resistance}} </p>
                            </div>
                            <div class="h-16  w-1/3  rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                @include('svgs',['svg' => 'defense_status_resistance','classes' => 'h-6 w-6 text-primary-icon'])
                                <p>{{$unit->defense_status_resistance}} </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-0.5 space-x-0.5">
                            <div class="h-16 w-1/2 rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                <img src="{{asset("/img/icons/gold2.png")}}" class="h-6 w-6 " alt="hero">
                                <p>{{$unit->kill_gold }}</p>
                            </div>
                            <div class="h-16  w-1/2  rounded flex flex-col items-center justify-center bg-primary-card-sub  space-y-1 pt-2 p-1  ">
                                <p class="font-black text-primary-accent text-lg leading-none">XP</p>
                                <p>{{$unit->kill_exp}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3 w-full">
                        <p class="font-bold text-2xl">{{$unit->name}}</p>
                        <p class="w-full">{{$unit->description}}</p>
                        <div class="div flex items-center space-x-2">
                            @include('svgs',['svg' => 'creep','classes' => 'h-5 w-5 text-primary-icon '])
                            <p class="text-sm">UNITS IN CAMP: <span class="font-semibold">{{$unit->units_in_camp}}</span></p>
                        </div>
                        <div class="w-full">
                            <p class="font-semibold text-primary-accent text-lg">Abilities</p>
                            @foreach($creep->post->spells as $spell)
                                @if($spell->creep_unit_id == $unit->id)
                                    @include("post.includes.spell",['spell' => $spell])
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <!-- DESCRIPTION & LORE --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow pb-6 mt-4">
        <div class="px-4 bg-primary-accent text-primary-text-accent text-center rounded-t mb-6 flex items-center justify-start">
            <p class="text-lg font-semibold px-3 py-2">Description & Lore</p>
        </div>
        <div class="grid lg:grid-cols-2 gap-8  px-4 lg:px-8">
            <div>
                <div class="flex items-center justify-start space-x-2 mb-2">
                    @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                    <p class="font-semibold text-lg">Description</p>
                </div>
                <p class="h-96 long_text">{{$creep->description}}</p>
            </div>
            <div>
                <div class="flex items-center justify-start space-x-2  mb-2">
                    @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                    <p class="font-semibold text-lg">Lore</p>
                </div>
                <p class="h-96 long_text">{{$creep->lore}}</p>
            </div>
        </div>
    </div>

    <!-- CREDITS & VOTING --------------------------------------------------------------------------------------------------------------->
    <post-credits></post-credits>
    <!-- CHANGELOG --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow pb-6 mt-4">
        @include("post.includes.changelog")
    </div>
    <!-- COMMENTS --------------------------------------------------------------------------------------------------------------->
    <post-comments></post-comments>
@endsection
