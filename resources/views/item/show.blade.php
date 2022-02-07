@extends('layout')

@section('content')
    <!-- GENERAL DESCRIPTION --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow_caja pb-6">
        <x-section-header>GENERAL</x-section-header>
        <div class="flex items-center justify-around px-6   my-2 flex-wrap space-x-4">
            <!-- TITULO -->

            <div class="flex-grow items-center justify-start flex space-x-2">
                @include('svgs',['svg' => 'post_item','classes' => 'h-6 w-6 text-primary-accent shrink-0'])
                <p class="text-3xl font-semibold py-2 shadow_titulo">{{$item->name}}</p>
            </div>
            <div>
                <div class="flex items-center justify-center space-x-4 ">
                    @if(Auth::check() && Auth::id() == $item->post->user->id)
                        <x-a-button href="{{route('item.edit',$item->id)}}" :icon="'edit'">EDIT POST</x-a-button>
                    @endif
                    <x-a-button href="#vote" :icon="'vote'">VOTE</x-a-button>
                    <x-a-button href="#" :icon="'share'">Share this post</x-a-button>
                </div>
            </div>
            <x-score-post-header>
                <x-slot name="score">{{$item->post->votes_total()}}</x-slot>
                <x-slot name="awards">{{$item->post->awards->count()}}</x-slot>
            </x-score-post-header>
        </div>
            <div class="px-6 grid lg:grid-cols-3 gap-4">
                <div class="flex items-start justify-center">
                    <div class="w-full">
                        <!-- HERO PORTRAIT -->
                        <div class="rounded shadow-lg shadow-primary-accent-sub">
                            <div class="w-full h-80 gradient_placeholder rounded">
                                @if($item->img_is_uploaded)
                                    <img src="{{$item->img_path}}" alt="Dota 2 item" class="object-cover w-full h-full object-top rounded">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-1 space-y-4">
                    <!-- BASICS -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                            <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">Item cost</p>

                            <img src="{{asset("/img/icons/gold2.png")}}" class="h-6 w-6 " alt="gold">
                            <p>{{$item->gold}}</p>
                        </div>
                        <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                            <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">Obtainable at</p>
                            <div class="flex items-center justify-center space-x-0.5">
                                @switch($item->item_shop_id)
                                    @case(1)
                                    @include('svgs',['svg' => 'fountain','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                    @case(2)
                                    @include('svgs',['svg' => 'secret','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                    @case(3)
                                    @include('svgs',['svg' => 'loot','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                    @case(4)
                                    @include('svgs',['svg' => 'other','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                @endswitch
                            </div>
                            <p>{{$item->item_shop->name}}</p>
                        </div>
                        <div class="rounded flex flex-col items-center justify-start bg-primary-card-sub space-y-1 pb-2">
                            <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">Item type</p>
                            <div class="flex items-center justify-center space-x-0.5">
                                @switch($item->item_type_id)
                                    @case(1)
                                    @include('svgs',['svg' => 'basic','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                    @case(2)
                                    @include('svgs',['svg' => 'upgrade','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                    @case(3)
                                    @include('svgs',['svg' => 'creep','classes' => 'h-6 w-6 text-primary-icon'])
                                    @break
                                @endswitch
                            </div>
                            <p>{{$item->item_type->name}}</p>
                        </div>
                    </div>
                    <!-- ATTRIBUTES -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="rounded bg-primary-card-sub flex items-center justify-start flex-col space-y-1 py-2">
                            @include('svgs',['svg' => 'strength','classes' => 'h-6 w-6 text-strength'])
                            <p class="font-semibold text-strength text-xl">+ {{$item->bonus_strength}}</p>
                        </div>
                        <div class="rounded bg-primary-card-sub flex items-center justify-start flex-col space-y-1 py-2">
                            @include('svgs',['svg' => 'agility','classes' => 'h-6 w-6 text-agility'])
                            <p class="font-semibold text-agility text-xl">+ {{$item->bonus_agility}}</p>
                        </div>
                        <div class="rounded bg-primary-card-sub flex items-center justify-start flex-col space-y-1 py-2">
                            @include('svgs',['svg' => 'intelligence','classes' => 'h-6 w-6 text-intelligence'])
                            <p class="font-semibold text-intelligence text-xl">+ {{$item->bonus_intelligence}}</p>
                        </div>
                        <div class="col-span-3">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="rounded bg-primary-card-sub flex items-start justify-start flex-col space-y-1 pb-2 ">
                                    <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">Bonus Attributes</p>
                                    @if($item->item_attributes->count() >0)
                                        <ul class="list-disc list-inside pl-4">

                                            @foreach($item->item_attributes as $attribute)
                                                <li class="text-sm px-2 mb-1 text-primary-icon"><span class="text-primary-text">{{$attribute->value}}</span></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="pl-4 text-sm">No bonus attributes</p>
                                    @endif

                                </div>
                                <div class="rounded bg-primary-card-sub flex items-start justify-start flex-col space-y-1 pb-2 ">
                                    <p class="text-xs text-primary-accent font-semibold p-1 bg-primary-accent text-primary-text-accent w-full rounded-t text-center mb-2">Recipe</p>
                                    @if($item->item_recipes->count() >0)
                                        <ul class="list-disc list-inside pl-4">

                                            @foreach($item->item_recipes as $recipe)
                                                <li class="text-sm px-2 mb-1 text-primary-icon"><span class="text-primary-text">{{$recipe->item}}</span></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="pl-4 text-sm">Recipe not included</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="flex flex-col items-center justify-between h-full">
                    <!-- ROLES -->
                    <div class="w-full">
                        <p class="label_title mb-4 lg:mb-1">Roles</p>
                    </div>
                    <div class="flex items-center justify-center w-full mb-4">
                        <div class="grid grid-cols-3 gap-5 w-full mb-1 px-2">
                            <div>
                                <p class="text-sm @if($item->roles_armor == 3 ) shadow_titulo @elseif($item->roles_armor == 0) text-primary-text-muted @endif" >Armor</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_armor >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_armor >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_armor >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_damage == 3 ) shadow_titulo @elseif($item->roles_damage == 0) text-primary-text-muted @endif">Damage</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_damage >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_damage >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_damage >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_utility == 3 ) shadow_titulo @elseif($item->roles_utility == 0) text-primary-text-muted @endif">Utility</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_utility >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_utility >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_utility >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_support == 3 ) shadow_titulo @elseif($item->roles_support == 0) text-primary-text-muted @endif">Support</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_support >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_support >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_support >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_siege == 3 ) shadow_titulo @elseif($item->roles_siege == 0) text-primary-text-muted @endif">Siege</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_siege >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_siege >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_siege >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_heal == 3 ) shadow_titulo @elseif($item->roles_heal == 0) text-primary-text-muted @endif">Heal</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_heal >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_heal >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_heal >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_mana == 3 ) shadow_titulo @elseif($item->roles_mana == 0) text-primary-text-muted @endif">Mana</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_mana >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_mana >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_mana >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_disable == 3 ) shadow_titulo @elseif($item->roles_disable == 0) text-primary-text-muted @endif">Disable</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_disable >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_disable >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_disable >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->roles_resistance == 3 ) shadow_titulo @elseif($item->roles_resistance == 0) text-primary-text-muted @endif">Resistance</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_resistance >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_resistance >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->roles_resistance >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DAMAGE output -->
                    <div class="w-full">
                        <p class="label_title mb-4 lg:mb-1">Damage output</p>
                    </div>
                    <div class="flex items-center justify-center w-full ">
                        <div class="grid grid-cols-3 gap-5 w-full mb-1 px-2">
                            <div>
                                <p class="text-sm @if($item->damage_pure == 3 ) shadow_titulo @elseif($item->damage_pure == 0) text-primary-text-muted @endif">Pure</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_pure >= 1 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_pure >= 2 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_pure >= 3 ) bg-primary-icon @else bg-primary-card-sub @endif "></div>

                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->damage_physical == 3 ) shadow_titulo @elseif($item->damage_physical == 0) text-primary-text-muted @endif">Physical</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_physical >= 1 ) bg-strength @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_physical >= 2 ) bg-strength @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_physical >= 3 ) bg-strength @else bg-primary-card-sub @endif "></div>

                                </div>
                            </div>
                            <div>
                                <p class="text-sm @if($item->damage_magical == 3 ) shadow_titulo @elseif($item->damage_magical == 0) text-primary-text-muted @endif">Magical</p>
                                <div class="h-3 w-full grid grid-cols-3 gap-1.5">
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_magical >= 1 ) bg-intelligence @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_magical >= 2 ) bg-intelligence @else bg-primary-card-sub @endif "></div>
                                    <div class="h-3 -skew-x-[25deg] @if($item->damage_magical >= 3 ) bg-intelligence @else bg-primary-card-sub @endif "></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <item-spells inline-template v-cloak>
        <div class="rounded bg-primary-card shadow_caja mt-4">
            <x-section-header>ABILITIES</x-section-header>
            <div class="grid lg:grid-cols-5 gap-10  p-6  ">
                <div class="lg:col-span-5" v-if="loading">
                    <loading></loading>
                </div>
                <!-- SPELL LIST -->
                <div v-if="!loading" class=" lg:col-span-2 flex items-start justify-start flex-col rounded space-y-2">
                    <div v-if="spell_1.name != ''" class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == '1','button_spell_inactive':selected_spell != '1'}"
                         @click="changeCurrentSpell('1')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder  rounded "
                             :class="{
                                         'active_spell':spell_1.spell_type == 1,
                                         'passive_spell':spell_1.spell_type == 3,
                                         'autocast_spell':spell_1.spell_type == 2,
                                         }"
                        >
                            <img v-if="spell_1.img_is_uploaded != 0" :src="spell_1.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center">
                            <p class="text-4xl font-bold">1</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">
                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_1.name == ''}">@{{spell_1.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_1.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_1.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_1.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div v-if="spell_2.name != ''" class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == '2','button_spell_inactive':selected_spell != '2'}"
                         @click="changeCurrentSpell('2')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_2.spell_type == 1,
                                         'passive_spell':spell_2.spell_type == 3,
                                         'autocast_spell':spell_2.spell_type == 2,
                                         }">
                            <img v-if="spell_2.img_is_uploaded != 0" :src="spell_2.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center">
                            <p class="text-4xl font-bold">2</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">

                            <p class="font-semibold text-xl w-full capitalize  mb-2" :class="{'italic':spell_2.name == ''}">@{{spell_2.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_2.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_2.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_2.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div v-if="spell_3.name != ''" class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell== '3','button_spell_inactive':selected_spell!= '3'}"
                         @click="changeCurrentSpell('3')">
                        <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_3.spell_type == 1,
                                         'passive_spell':spell_3.spell_type == 3,
                                         'autocast_spell':spell_3.spell_type == 2,
                                         }">
                            <img v-if="spell_3.img_is_uploaded != 0" :src="spell_3.img_path" alt="spell image" class="object-cover w-full h-full">
                        </div>
                        <div class="w-24 shrink-0 flex items-center justify-center">
                            <p class="text-4xl font-bold">3</p>
                        </div>
                        <div class="flex items-start justify-start flex-grow flex-col">

                            <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_3.name == ''}">@{{spell_3.name || 'unnamed'}}</p>
                            <div class="flex items-center justify-start space-x-2">
                                <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_3.spell_type == 1">
                                    <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_3.spell_type == 3">
                                    <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                </div>
                                <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_3.spell_type == 2">
                                    <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- CURRENT SPELL -->
                <div class="lg:col-span-3" v-if="spell_1.name == ''">
                    <p>This items does not have any abilities.</p>
                </div>
                <div v-if="!loading && spell_1.name != ''" class="rounded lg:col-span-3  spell_box ">
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

                    </div>
                </div>
            </div>
        </div>
    </item-spells>
    <!-- DESCRIPTION & LORE --------------------------------------------------------------------------------------------------------------->
    <div class="rounded bg-primary-card shadow pb-6 mt-4">
        <x-section-header>DESCRIPTION & LORE</x-section-header>
        <div class="grid lg:grid-cols-2 gap-8  p-6">
            <div>
                <div class="flex items-center justify-start space-x-2 mb-2">
                    @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                    <p class="font-semibold text-lg">Description</p>
                </div>
                @if($item->description != '')
                    <div class="long_text text_html">{!! $item->description!!}</div>
                @else
                    <p>This item has no description added.</p>
                @endif
            </div>
            <div>
                <div class="flex items-center justify-start space-x-2  mb-2">
                    @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                    <p class="font-semibold text-lg">Lore</p>
                </div>
                @if($item->lore != '')
                    <div class="long_text text_html">{!! $item->lore!!}</div>
                @else
                    <p>This item has no lore added.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- CREDITS & VOTING --------------------------------------------------------------------------------------------------------------->
    <x-credits :post="$item->post"></x-credits>
    <!-- COMMENTS --------------------------------------------------------------------------------------------------------------->
    <x-comments :post="$item->post"></x-comments>


@endsection
