@extends('layout')

@section('content')
    <div>
        <mrc-show inline-template v-cloak>
            <div>
                <div v-if="loading" class="flex items-center justify-center min-h-screen ">
                    <x-loading></x-loading>
                </div>
                <div v-if="!loading">
                    <div class="rounded  p-6" v-if="spells && !no_entries">
                        <p class="gradient_full_di text-5xl text-center ">MRC entry voting</p>
                        <div class="flex items-center justify-center rounded bg-primary-card-sub shadow_caja max-w-[800px] mx-auto mt-4">

                            <div class="grid grid-cols-3 gap-4 w-full">
                                <div class="flex items-start justify-start col-span-2">
                                    <img :src="current_spell.user_avatar" alt="user avatar" class="h-16 w-16 rounded object-contain">
                                    <div class="ml-6 flex items-start flex-col justify-center h-full">
                                        <p class="text-primary-accent text-xs font-semibold">CREATED BY</p>
                                        <div class="flex items-center justify-center space-x-1 mt-2">
                                            <p v-html="current_spell.user_name"></p>
                                            @include('svgs',['svg' => 'points','classes' => 'w-4 h-4 text-primary-icon'])
                                            <p v-html="current_spell.user_points"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-end space-x-2">
                                    <div class="flex flex-col items-center justify-center h-full">
                                        <p class="text-primary-accent text-xs font-semibold">ENTRY Nº</p>
                                        <p class="text-3xl font-semibold">@{{ current_spell.id }}/@{{ spells.length }}</p>
                                    </div>
                                    <div class="pr-6">
                                        <div v-if="current_spell.voted">
                                            <p class="flex items-center justify-center space-x-2" v-if="current_spell.voted.vote == '-1'">
                                                @include('svgs',['svg' => 'thumbs_down','classes' => 'w-8 h-8 ml-2 text-off'])</p>
                                            <p class="flex items-center justify-center space-x-2" v-if="current_spell.voted.vote == '1'">
                                                @include('svgs',['svg' => 'thumbs_up','classes' =>   'w-8 h-8 ml-2 text-on'])</p>
                                        </div>
                                        <div v-else>
                                            <p>-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <transition-group name="slide-fade" mode="in-out">
                            <div :key="1" v-if="par == true" class="spell_box max-w-[800px] mx-auto mt-4 rounded bg-primary-card" :key="item.id">
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
                                        <div class=" flex flex-col space-y-1"
                                             :class="{'radio_label_show_on':current_spell.blocked_by_linkens === 1,'radio_label_show_off':current_spell.blocked_by_linkens === 0}">
                                            <span class="text-xs leading-none">PROCS LINKENS</span>
                                            <span v-if="current_spell.blocked_by_linkens == 0" class="leading-none font-semibold text-off">NO</span>
                                            <span v-if="current_spell.blocked_by_linkens == 1" class="leading-none font-semibold text-on">YES</span>
                                        </div>
                                        <div class=" flex flex-col space-y-1"
                                             :class="{'radio_label_show_on':current_spell.cast_while_rooted === 1,'radio_label_show_off':current_spell.cast_while_rooted === 0}">
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
                                        <div class="flex items-center justify-start space-x-2 my-4" v-if="current_spell.cooldown">
                                            @include('svgs',['svg' => 'cooldown','classes' => 'w-6 h-6 rounded'])
                                            <p class="font-semibold" v-html=" current_spell.cooldown"></p>
                                        </div>
                                        <div class="flex items-center justify-start space-x-2 my-4" v-if="current_spell.manacost">
                                            <div class="gradient_mana_cost w-6 h-6 rounded"></div>
                                            <p class="font-semibold" v-html=" current_spell.manacost"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div :key="2" v-if="par == false" class="spell_box max-w-[800px] mx-auto mt-4 rounded bg-primary-card">
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
                                        <div class=" flex flex-col space-y-1"
                                             :class="{'radio_label_show_on':current_spell.blocked_by_linkens === 1,'radio_label_show_off':current_spell.blocked_by_linkens === 0}">
                                            <span class="text-xs leading-none">PROCS LINKENS</span>
                                            <span v-if="current_spell.blocked_by_linkens == 0" class="leading-none font-semibold text-off">NO</span>
                                            <span v-if="current_spell.blocked_by_linkens == 1" class="leading-none font-semibold text-on">YES</span>
                                        </div>
                                        <div class=" flex flex-col space-y-1"
                                             :class="{'radio_label_show_on':current_spell.cast_while_rooted === 1,'radio_label_show_off':current_spell.cast_while_rooted === 0}">
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
                                        <div class="flex items-center justify-start space-x-2 my-4" v-if="current_spell.cooldown">
                                            @include('svgs',['svg' => 'cooldown','classes' => 'w-6 h-6 rounded'])
                                            <p class="font-semibold" v-html=" current_spell.cooldown"></p>
                                        </div>
                                        <div class="flex items-center justify-start space-x-2 my-4" v-if="current_spell.manacost">
                                            <div class="gradient_mana_cost w-6 h-6 rounded"></div>
                                            <p class="font-semibold" v-html=" current_spell.manacost"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </transition-group>
                        @if(Auth::check())

                            <div class="flex items-center justify-center space-x-10 mt-6">
                                <button @click="VoteNeg(current_spell.id)" class="shadow h-[50px] w-44 p-0.5 bg-gradient-to-br from-prim_a to-prim_b cursor-pointer rounded transition-all
                                hover:shadow-md hover:brightness-110 hover:shadow-primary-accent font-title uppercase" type="button">
                                    <div class="space-x-2 px-3 flex items-center justify-center h-[46px] bg-gradient-to-r from-prim_c to-prim_d transition-all shadow-inner">
                                        <transition name="slide-fade" mode="out-in">
                                            <div v-if="loading_vote">
                                                <x-loading></x-loading>
                                            </div>
                                            <div v-if="!loading_vote">
                                                @include('svgs',['svg' => 'thumbs_down','classes' => 'w-8 h-8 text-off'])
                                            </div>
                                        </transition>
                                    </div>

                                </button>
                                <button @click="Next" class="shadow h-[50px] w-32 p-0.5 bg-gradient-to-br from-prim_a to-prim_b cursor-pointer rounded transition-all
                                hover:shadow-md hover:brightness-110 hover:shadow-primary-accent font-title uppercase" type="button">
                                    <div class="space-x-2 px-3 flex items-center justify-center h-[46px] bg-gradient-to-r from-prim_c to-prim_d transition-all shadow-inner">
                                        <p class="font-semibold">NEXT</p>
                                        @include('svgs',['svg' => 'shuffle','classes' => 'ml-2 w-6 h-6'])
                                    </div>
                                </button>

                                <button @click="VotePos(current_spell.id)" class="shadow h-[50px] w-44 p-0.5 bg-gradient-to-br from-prim_a to-prim_b cursor-pointer rounded transition-all
                                hover:shadow-md hover:brightness-110 hover:shadow-primary-accent font-title uppercase" type="button">
                                    <div class="space-x-2 px-3 flex items-center justify-center h-[46px] bg-gradient-to-r from-prim_c to-prim_d transition-all shadow-inner">
                                        <transition name="slide-fade" mode="out-in">
                                            <div v-if="loading_vote">
                                                <x-loading></x-loading>
                                            </div>
                                            <div v-if="!loading_vote">
                                                @include('svgs',['svg' => 'thumbs_up','classes' => 'w-8 h-8 text-on'])
                                            </div>
                                        </transition>
                                    </div>
                                </button>
                            </div>
                        @else
                            <div class="flex items-center justify-center mt-6">
                                <x-login-required-button :icon="''" href="{{route('login')}}">LOGIN TO VOTE</x-login-required-button>
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center justify-center min-h-[200px] max-w-[800px] mx-auto p-6 rounded bg-primary-card shadow_caja" v-if="no_entries">
                        <p class="text-2xl">There are no entries yet!</p>
                    </div>
                </div>
            </div>
        </mrc-show>
    </div>

@endsection
