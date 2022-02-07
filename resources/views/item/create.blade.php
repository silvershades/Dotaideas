@extends('layout')

@section('content')
    <item-create inline-template v-cloak>
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
                    <div class="rounded bg-primary-card shadow_caja  ">
                        <x-section-header>CREATING AN ITEM</x-section-header>
                        <div class="px-6 ">
                            <div class="lg:col-span-3 alert alert-error space-x-10 flex items-start justify-start flex-col" v-if="errors.hero.length ">
                                <p>We encountered some errors</p>
                                <ul class="w-full list-disc block">
                                    <li v-for="error in errors.hero">@{{ error }}</li>
                                </ul>
                            </div>

                        </div>
                        <div class="p-6 grid  lg:grid-cols-3 gap-8 ">

                            <!-- PREVIEW -->
                            <div class="">
                                <label class="label_title mb-4" for="name">Item's Portrait</label>

                                <div class="rounded overflow-hidden shadow-lg shadow-primary-accent-sub">
                                    <div class="h-64 rounded-t gradient_placeholder">
                                        <img v-if="ditem.image_show != ''" :src="ditem.image_show" alt="Her's portrait" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="my-6">
                                    <input id="image_file_input_hero" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChangeItem">
                                    <p class="text-error text-xs">Invalid field</p>
                                </div>
                                <div class="w-full mb-2">
                                    <p class="label_title">GOLD COST</p>
                                </div>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'coin','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm">Total Gold value <span class="font-semibold text-primary-icon text-lg" v-html="ditem.gold"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                            <input type="range" min="0" max="15000" step="5" class="range range-primary w-full" v-model="ditem.gold" v-on:input="">
                                        </div>
                                        <p class="text-xs text-primary-text-muted mt-0.5">For a more precise selection you can use arrow keys.</p>

                                    </div>
                                </div>
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">RECIPE</p>
                                </div>
                                <div class="w-full space-y-2 rounded-b py-2 mb-4">
                                    <div class="flex items-center justify-between space-x-2 ">
                                        <div class="flex-grow">
                                            <input type="text" maxlength="22" class="input-sm py-0 w-full uppercase" placeholder="Mystic Staff" v-model="recipe_mod_value">
                                        </div>
                                        <div>
                                            <x-di-button type="button" :icon="'plus'" @click="addRecipeModifier">ADD</x-di-button>
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="list-disc ml-6 mt-2">
                                            <li v-for="(mod, index) in ditem.recipe" class="uppercase text-sm">
                                                    <span class="flex items-center space-x-2">
                                                        <span class="font-semibold">@{{ mod.value }}</span>
                                                        <span>
                                                            <button class="cursor-pointer text-primary-text-muted hover:text-primary-icon flex items-center" type="button"
                                                                    @click="deleteRecipeModifier(index)">
                                                                @include('svgs',['svg' => 'trash','classes' => 'w-4 h-4'])
                                                            </button>
                                                        </span>
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <!-- BASIC INFO -->
                                <p class="label_title mb-4">Items's name</p>
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'post_item','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <input type="text" class="w-full input-sm" maxlength="40" placeholder="Enter the item's name here..." v-model="ditem.name">
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
                                </div>
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">BONUS Attributes</p>
                                </div>
                                <!-- STRENGTH -->
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'strength','classes' => 'w-8 h-8 text-strength'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm ">Strength <span class="font-semibold text-primary-icon text-lg" v-html="'+' + ditem.bonus_strength"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden physical_slider">
                                            <input type="range" min="0" max="50" step="1" class="range range-primary w-full" v-model="ditem.bonus_strength">
                                        </div>
                                    </div>

                                </div>
                                <!-- AGILITY -->
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'agility','classes' => 'w-8 h-8 text-agility'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm ">Agility <span class="font-semibold text-primary-icon text-lg" v-html="'+' + ditem.bonus_agility"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden agility_slider">
                                            <input type="range" min="0" max="50" step="1" class="range range-primary w-full" v-model="ditem.bonus_agility">
                                        </div>
                                    </div>

                                </div>
                                <!-- INTELLIGENCE -->
                                <div class="grid grid-cols-7 gap-4 mb-2">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'intelligence','classes' => 'w-8 h-8 text-intelligence'])
                                    </div>
                                    <div class="col-span-6">
                                        <p class="font-semibold mb-1  text-sm ">Intelligence <span class="font-semibold text-primary-icon text-lg" v-html="'+' + ditem.bonus_intelligence"></span></p>
                                        <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden magical_slider">
                                            <input type="range" min="0" max="50" step="1" class="range range-primary w-full" v-model="ditem.bonus_intelligence">
                                        </div>
                                    </div>

                                </div>
                                <div class="w-full mt-4 mb-2">
                                    <p class="label_title">OTHER BONUSES</p>
                                </div>
                                <div class="w-full space-y-2 rounded-b py-2 mb-4">
                                    <div class="flex items-center justify-around space-x-2 ">

                                        <div class="flex-grow">
                                            <input type="text" maxlength="22" class="input-sm py-0 w-full uppercase" placeholder="+20 armor" v-model="item_mod_value">
                                        </div>
                                        <div>
                                            <x-di-button type="button" :icon="'plus'" @click="addItemModifier">ADD</x-di-button>
                                        </div>
                                    </div>
                                    <div>
                                        <ul class="list-disc ml-6 mt-2">
                                            <li v-for="(mod, index) in ditem.modifiers" class="uppercase text-sm">
                                                    <span class="flex items-center space-x-2">
                                                        <span class="font-semibold">@{{ mod.value }}</span>
                                                        <span>
                                                            <button class="cursor-pointer text-primary-text-muted hover:text-primary-icon flex items-center" type="button"
                                                                    @click="deleteItemModifier(index)">
                                                                @include('svgs',['svg' => 'trash','classes' => 'w-4 h-4'])
                                                            </button>
                                                        </span>
                                                    </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <!-- BASICS -->
                                <div class="w-full mb-2">
                                    <p class="label_title">BASICS</p>
                                </div>

                                <div class="">
                                    <p class="block font-semibold mb-2">Item type
                                        <span class="text-primary-accent" v-if="ditem.item_type_id == 1">Basic</span>
                                        <span class="text-primary-accent" v-if="ditem.item_type_id == 2">Upgrade</span>
                                        <span class="text-primary-accent" v-if="ditem.item_type_id == 3">Neutral</span>
                                    </p>
                                    <div class="w-full grid grid-cols-3 gap-4 ">
                                        <div>
                                            <input name="item_type" type="radio" id="primary_b1" class="hidden" v-model="ditem.titem_type_idype" value="1">
                                            <label for="primary_b1" class="radio_label">
                                                @include('svgs',['svg' => 'basic','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="item_type" type="radio" id="primary_b2" class="hidden" v-model="ditem.item_type_id" value="2">
                                            <label for="primary_b2" class="radio_label">
                                                @include('svgs',['svg' => 'upgrade','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="item_type" type="radio" id="primary_b3" class="hidden" v-model="ditem.item_type_id" value="3">
                                            <label for="primary_b3" class="radio_label">
                                                @include('svgs',['svg' => 'creep','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div class="">
                                    <p class="block font-semibold mb-2">Obtainable at
                                        <span class="text-primary-accent" v-if="ditem.item_shop_id == 1">Fountain Shop</span>
                                        <span class="text-primary-accent" v-if="ditem.item_shop_id == 2">Secret Shop</span>
                                        <span class="text-primary-accent" v-if="ditem.item_shop_id == 3">Loot</span>
                                        <span class="text-primary-accent" v-if="ditem.item_shop_id == 4">Other</span>
                                    </p>
                                    <div class="w-full grid grid-cols-4 gap-4 ">
                                        <div>
                                            <input name="shop" type="radio" id="primary_a1" class="hidden" v-model="ditem.item_shop_id" value="1">
                                            <label for="primary_a1" class="radio_label">
                                                @include('svgs',['svg' => 'fountain','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="shop" type="radio" id="primary_a2" class="hidden" v-model="ditem.item_shop_id" value="2">
                                            <label for="primary_a2" class="radio_label">
                                                @include('svgs',['svg' => 'secret','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="shop" type="radio" id="primary_a3" class="hidden" v-model="ditem.item_shop_id" value="3">
                                            <label for="primary_a3" class="radio_label">
                                                @include('svgs',['svg' => 'loot','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>
                                        <div>
                                            <input name="shop" type="radio" id="primary_a4" class="hidden" v-model="ditem.item_shop_id" value="4">
                                            <label for="primary_a4" class="radio_label">
                                                @include('svgs',['svg' => 'other','classes' => 'w-8 h-8 text-primary-icon'])
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <!-- ROLES -->
                                <div class="w-full mb-2">
                                    <p class="label_title">Roles</p>
                                </div>
                                <div class="flex items-center justify-center w-full mb-10">
                                    <div class="grid grid-cols-3 gap-x-5 gap-y-2 w-full mb-1">
                                        <div>
                                            <p class="text-sm mb-1">Armor
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_armor == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_armor == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_armor == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_armor == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_armor">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Damage
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_damage == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_damage == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_damage == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_damage == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_damage">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Utility
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_utility == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_utility == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_utility == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_utility == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_utility">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Support
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_support == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_support == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_support == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_support == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_support">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Siege
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_siege == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_siege == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_siege == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_siege == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_siege">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Heal
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_heal == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_heal == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_heal == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_heal == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_heal">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Mana
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_mana == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_mana == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_mana == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_mana == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_mana">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Disable
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_disable == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_disable == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_disable == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_disable == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_disable">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Resistance
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.roles_resistance == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_resistance == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_resistance == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-icon" v-if="ditem.roles_resistance == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.roles_resistance">
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
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.damage_pure == 0">NONE</span>
                                                <span class="font-semibold text-xs text-primary-accent" v-if="ditem.damage_pure == 1">LOW</span>
                                                <span class="font-semibold text-xs text-primary-accent" v-if="ditem.damage_pure == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-primary-accent" v-if="ditem.damage_pure == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden pure_slider">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.damage_pure">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Physical
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.damage_physical == 0">NONE</span>
                                                <span class="font-semibold text-xs text-strength" v-if="ditem.damage_physical == 1">LOW</span>
                                                <span class="font-semibold text-xs text-strength" v-if="ditem.damage_physical == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-strength" v-if="ditem.damage_physical == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden physical_slider">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.damage_physical">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm mb-1">Magical
                                                <span class="font-semibold text-xs text-primary-text-muted" v-if="ditem.damage_magical == 0">NONE</span>
                                                <span class="font-semibold text-xs text-intelligence" v-if="ditem.damage_magical == 1">LOW</span>
                                                <span class="font-semibold text-xs text-intelligence" v-if="ditem.damage_magical == 2">NORMAL</span>
                                                <span class="font-semibold text-xs text-intelligence" v-if="ditem.damage_magical == 3">HIGH</span>
                                            </p>
                                            <div class="w-full flex-grow flex flex-col items-center justify-center bg-primary-card-sub rounded-3xl  overflow-hidden magical_slider">
                                                <input type="range" min="0" max="3" step="1" class="range range-primary  w-full " v-model="ditem.damage_magical">
                                            </div>
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
                                    @include('svgs',['svg' => 'down_vote','classes' => 'w-6 h-6 text-primary-accent-sub mr-2 animate-bounce shrink-0'])
                                    Select an ability to start editing. Items can only have 3 abilities. (Consider not creating more than 1 ACTIVE spell, but you can)</p>
                                <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == '1','button_spell_inactive':selected_spell != '1'}"
                                     @click="changeCurrentSpell('1')">
                                    <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder  rounded "
                                         :class="{
                                         'active_spell':spell_1.spell_type == 1,
                                         'passive_spell':spell_1.spell_type == 2,
                                         'autocast_spell':spell_1.spell_type == 3,
                                         }"
                                    >
                                        <img v-if="spell_1.image_show != ''" :src="spell_1.image_show" alt="spell image" class="object-cover w-full h-full">
                                    </div>
                                    <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                                        <p class="text-4xl font-bold leading-none">1</p>
                                        <p class="text-xs   leading-none">OPTIONAL</p>
                                    </div>
                                    <div class="flex items-start justify-start flex-grow flex-col">
                                        <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_1.name == ''}">@{{spell_1.name || 'unnamed'}}</p>
                                        <div class="flex items-center justify-start space-x-2">
                                            <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_1.spell_type == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_1.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_1.spell_type == 3">
                                                <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                                 v-if="spell_1.mod_by_aghanims_scepter == 1 || spell_1.created_by_aghanims_scepter == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                                 v-if="spell_1.mod_by_aghanims_shard == 1  || spell_1.created_by_aghanims_shard == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell == '2','button_spell_inactive':selected_spell != '2'}"
                                     @click="changeCurrentSpell('2')">
                                    <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_2.spell_type == 1,
                                         'passive_spell':spell_2.spell_type == 2,
                                         'autocast_spell':spell_2.spell_type == 3,
                                         }">
                                        <img v-if="spell_2.image_show != ''" :src="spell_2.image_show" alt="spell image" class="object-cover w-full h-full">
                                    </div>
                                    <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                                        <p class="text-4xl font-bold leading-none">2</p>
                                        <p class="text-xs   leading-none">OPTIONAL</p>
                                    </div>
                                    <div class="flex items-start justify-start flex-grow flex-col">

                                        <p class="font-semibold text-xl w-full capitalize  mb-2" :class="{'italic':spell_2.name == ''}">@{{spell_2.name || 'unnamed'}}</p>
                                        <div class="flex items-center justify-start space-x-2">
                                            <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_2.spell_type == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_2.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_2.spell_type == 3">
                                                <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                                 v-if="spell_2.mod_by_aghanims_scepter == 1 || spell_2.created_by_aghanims_scepter == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                                 v-if="spell_2.mod_by_aghanims_shard == 1  || spell_2.created_by_aghanims_shard == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">SHARD</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden group button_spell" :class="{'button_spell_active':selected_spell== '3','button_spell_inactive':selected_spell!= '3'}"
                                     @click="changeCurrentSpell('3')">
                                    <div class="w-20 h-20 shrink-0 flex items-center justify-center gradient_placeholder rounded " :class="{
                                         'active_spell':spell_3.spell_type == 1,
                                         'passive_spell':spell_3.spell_type == 2,
                                         'autocast_spell':spell_3.spell_type == 3,
                                         }">
                                        <img v-if="spell_3.image_show != ''" :src="spell_3.image_show" alt="spell image" class="object-cover w-full h-full">
                                    </div>
                                    <div class="w-24 shrink-0 flex items-center justify-center flex-col">
                                        <p class="text-4xl font-bold leading-none">3</p>
                                        <p class="text-xs   leading-none">OPTIONAL</p>
                                    </div>
                                    <div class="flex items-start justify-start flex-grow flex-col">

                                        <p class="font-semibold text-xl w-full capitalize mb-2" :class="{'italic':spell_3.name == ''}">@{{spell_3.name || 'unnamed'}}</p>
                                        <div class="flex items-center justify-start space-x-2">
                                            <div class="flex items-center justify-start bg-sky-600 px-3 py-1 rounded" v-if="spell_3.spell_type == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">ACTIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-gray-600 w-auto px-3 py-1 rounded" v-if="spell_3.spell_type == 2">
                                                <p class="text-xs uppercase w-full text-white font-semibold">PASSIVE</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-cyan-600 w-auto px-3 py-1 rounded" v-if="spell_3.spell_type == 3">
                                                <p class="text-xs uppercase w-full text-white font-semibold">AUTOCAST</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                                 v-if="spell_3.mod_by_aghanims_scepter == 1 || spell_3.created_by_aghanims_scepter == 1">
                                                <p class="text-xs uppercase w-full text-white font-semibold">SCEPTER</p>
                                            </div>
                                            <div class="flex items-center justify-start bg-blue-600 w-auto px-3 py-1 rounded"
                                                 v-if="spell_3.mod_by_aghanims_shard == 1  || spell_3.created_by_aghanims_shard == 1">
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
                                        <input v-show="current_spell.hotkey ==  '1'" id="image_file_input_Q" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  '2'" id="image_file_input_W" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">
                                        <input v-show="current_spell.hotkey ==  '3'" id="image_file_input_E" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChange">

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
                                                <li v-for="(mod, index) in current_spell.modifiers" class="uppercase text-sm">
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
                                            <input name="ability_type" type="radio" id="passive_spell" class="hidden" v-model="current_spell.spell_type" value="3">
                                            <label for="passive_spell" class="radio_label flex-col h-14 space-y-1">
                                                @include('svgs',['svg' => 'passive','classes' => 'w-6 h-6 text-primary-icon'])
                                                <span class="text-xs">PASSIVE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="ability_type" type="radio" id="autocast_spell" class="hidden" v-model="current_spell.spell_type" value="2">
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
                                            <input name="spell_damage_type" type="radio" id="damage_none" class="hidden" v-model="current_spell.spell_damage_type" value="0">
                                            <label for="damage_none" class="radio_label flex-col h-11 space-y-1">
                                                <span class="text-xs">NONE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_pure" class="hidden" v-model="current_spell.spell_damage_type" value="1">
                                            <label for="damage_pure" class="radio_label_pure flex-col h-11 space-y-1">
                                                <span class="text-xs">PURE</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_physical" class="hidden" v-model="current_spell.spell_damage_type" value="2">
                                            <label for="damage_physical" class="radio_label_physical flex-col h-11 space-y-1">
                                                <span class="text-xs">PHYSICAL</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_magical" class="hidden" v-model="current_spell.spell_damage_type" value="3">
                                            <label for="damage_magical" class="radio_label_magical flex-col h-11 space-y-1">
                                                <span class="text-xs">MAGICAL</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_mix" class="hidden" v-model="current_spell.spell_damage_type" value="4">
                                            <label for="damage_mix" class="radio_label_mix flex-col h-11 space-y-1">
                                                <span class="text-xs">MIX</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input name="spell_damage_type" type="radio" id="damage_hp_removal" class="hidden" v-model="current_spell.spell_damage_type" value="5">
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
                                <p class="col-span-3 label_title mb-4">Item's Description</p>
                                @if(Auth::check() && Auth::user()->has_unlocked_text_editor())
                                    <x-tiny-mce :vmodel="'ditem.description'" :height="400"></x-tiny-mce>
                                @else
                                    <textarea name="idea" id="" class="resize-none w-full flex-grow h-[400px] " v-model="ditem.description"></textarea>
                                @endif
                            </div>
                            <div class="lg:col-span-2">
                                <p class="col-span-3 label_title mb-4">Item's Lore</p>
                                @if(Auth::check() && Auth::user()->has_unlocked_text_editor())
                                    <x-tiny-mce :vmodel="'ditem.lore'" :height="400"></x-tiny-mce>
                                @else
                                    <textarea name="idea" id="" class="resize-none w-full flex-grow h-[400px] " v-model="ditem.lore"></textarea>
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
    </item-create>
@endsection
