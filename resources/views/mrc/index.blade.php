@extends('layout')

@section('content')
    <mrc inline-template v-cloak>
        <div>
            <h2 class="gradient_full_di text-4xl text-center mb-6 font-black">MONTHLY   REWORK CHALLENGE</h2>
            <div v-if="loading" class="flex items-center justify-center min-h-screen ">
                <x-loading></x-loading>
            </div>
            <section v-if="!loading">
                <div class="rounded p-6 shadow_caja bg-waves relative">
                    {{--                    <div class="bg-confeti bg-cover inset-0 absolute blur opacity-50"></div>--}}
                    <div class="grid lg:grid-cols-2 gap-4">
                        <div class="flex items-center justify-center flex-col space-y-4">
                            <p class="gradient_full_di leading-none text-xl font-bold">This month's ability is</p>
                            <p class="gradient_full_di leading-none text-3xl font-black" v-html="mrc.name"></p>
                            <p class="gradient_full_di leading-none text-5xl font-black" v-html="mrc.spell_name"></p>
                            <div class="flex flex-col items-center justify-center">
                                <div class="">
                                    <p class="font-black text-2xl text-center gradient_full_di  animate-pulse">{{$mrc->days_left()}}</p>
                                </div>
                                <div class="flex items-center justify-center mt-4 space-x-4">
                                    <x-a-button href="#start" :icon="''">PARTICIPATE NOW</x-a-button>
                                    <a :href="'/mrcs-entries/' + mrc.id" class=
                                    "shadow h-[35px] pb-0.5 pr-0.5
                                    bg-gradient-to-br from-prim_a to-prim_b
                                    cursor-pointer rounded transition-all
                                    hover:shadow-md hover:brightness-110
                                    hover:shadow-primary-accent font-title">
                                        <div class="space-x-2 px-3 flex items-center  h-[33px] bg-gradient-to-r from-prim_c to-prim_d transition-all shadow-inner">
                                            <p class="drop-shadow font-semibold uppercase ">VIEW ENTRIES</p>
                                        </div>
                                    </a>

{{--                                    <x-a-button :href="'/mrcs-entries/' + mrc" :icon="''">VIEW ENTRIES</x-a-button>--}}
                                </div>
                            </div>
                        </div>
                        <div class="h-86 rounded relative mb-6 pl-10">
                            <img :src="mrc.img_path" alt="monthly rework challenge pick" class="h-72 object-cover w-full h-full rounded shadow_titulo">
                            <div class="absolute -bottom-4 -left-2 w-36 h-36 rounded shadow_titulo">
                                <img :src="mrc.spell_img_path" alt="ability portrait" class="object-cover w-full h-full">
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" my-6 " id="start">
                    <div class="text-center">

                        <div class="grid lg:grid-cols-3 gap-6  ">
                            <div class="p-4 rounded bg-primary-card-sub shadow_caja flex flex-col items-center justify-center">
                                <p class="gradient_full_di text-center text-2xl">POINTS CONSIDERATION</p>
                                <div class="flex flex-col items-center justify-center flex-grow">
                                    <p class="text-sm">The users will point your entry according to this conditions:</p>
                                    <ul class="list-inside list-disc mt-2">
                                        <li class="text-sm">If remains true to the hero or item.</li>
                                        <li class="text-sm">If it feels balanced with the hero or item.</li>
                                        <li class="text-sm">If it's an original or a fun idea.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-4 rounded bg-primary-card-sub shadow_caja   flex flex-col items-center justify-center">
                                <p class="gradient_full_di text-center text-2xl">RULES</p>
                                <div class="flex flex-col items-center justify-center flex-grow">
                                    <ul class="list-inside list-disc mt-2">
                                        <li class="text-sm">Only one entry per user per MRC is admited.</li>
                                        <li class="text-sm">Once submited, users can't change the entry or deleted and create another one.</li>
                                        <li class="text-sm">Entry must respect our <x-a-link href="''">code of conduct</x-a-link></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-4 rounded bg-primary-card-sub shadow_caja flex flex-col items-center justify-center">
                                <p class="gradient_full_di text-center text-2xl">REWARDS</p>
                                <div class="flex flex-col items-center justify-center flex-grow">
                                    <div class="flex items-center justify-center space-x-4 mt-2">
                                        <p>For participating</p>
                                        <img src="{{"/img/icons/gems.png"}}" alt="" class="w-8 h-8">
                                        <p>50</p>
                                        @include('svgs',['svg' => 'points','classes' => 'w-8 h-8 text-primary-icon'])
                                        <p>150</p>
                                    </div>
                                    <div class="flex items-center justify-center space-x-4 mt-2 ">
                                        <p>Most voted entry</p>
                                        <img src="{{"/img/icons/gems.png"}}" alt="" class="w-8 h-8">
                                        <p>1000</p>
                                        @include('svgs',['svg' => 'points','classes' => 'w-8 h-8 text-primary-icon'])
                                        <p>2000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-primary-card rounded px-6 py-6 shadow_caja mt-4 " id="start">
                    <p class="gradient_full_di text-center text-2xl">Create a NEW ability or IMPROVE the existing one</p>

                    <div class="mb-10 max-w-[1000px] mx-auto">
                        <div class="xl:col-span-2 grid lg:grid-cols-2 gap-4 spell_box rounded p-4">
                            <div class="">
                                <div class="mb-4 grid grid-cols-3 gap-4">
                                    <div class="flex items-center justify-center flex-col border-2 border-solid rounded border-primary-accent">
                                        <p class="text-4xl font-semibold text-primary-accent">MRC</p>
                                        <p class="text-primary-accent text-sm font-semibold">ABILITY</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="label_title mb-4">Ability Name</p>
                                        <input type="text" class="w-full input-sm" maxlength="22" v-model="current_spell.name" :placeholder="[[current_spell.placeholder ]]">
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
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
                                    <label class="label_title mb-4">Aghanims Scepter Upgrade</label>
                                    <textarea rows="3" class="resize-none w-full text-sm" v-model="current_spell.mod_by_aghanims_scepter_desc"
                                              placeholder="Enter the upgrade description here..."></textarea>
                                    <p class="text-error text-xs">Invalid field</p>
                                </div>
                                <div v-if="current_spell.mod_by_aghanims_shard == 1" class="mb-4">
                                    <label class="label_title mb-4">Aghanims Shard Upgrade</label>
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
                    <div class="mt-4 flex items-center justify-center space-x-4">
                        <div v-if="publishing">
                            <x-loading></x-loading>
                        </div>
                        @if(Auth::check())
                            <x-di-button :icon="''" type="button" @click="submitRework">SUBMIT REWORK</x-di-button>
                        @else
                            <x-login-required-button :icon="''" href="{{route('login')}}">LOGIN TO PARTICIPATE</x-login-required-button>
                        @endif
                    </div>

                </div>

            </section>
        </div>
    </mrc>
@endsection
