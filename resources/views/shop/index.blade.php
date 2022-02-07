@extends('layout')
@section('content')
    <shop-index inline-template v-cloak>
        <div>

            <div class="container mx-auto rounded bg-primary-card">
                <div class="min-h-screen flex items-center justify-center" v-if="loading">
                    <x-loading></x-loading>
                </div>
                <div class="p-6 mb-4" v-if="!loading">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2 flex items-start justify-center flex-col">
                            <p class="text-4xl gradient_full_di flex items-center">
                                SIDESHOP</p>
                            <p class="text-lg text-primary-accent">Earn shards engaging with Dota Ideas and make your posts more noticeable.</p>
                        </div>
                        <div class="flex items-end flex-col justify-end  space-x-3 ">
                            <div class="flex items-center justify-end space-x-3 text-2xl font-semibold gradient_full_di text-primary-text ">
                                <p class="font-title">Your balance</p>
                                <img src="{{asset("/img/icons/gems.png")}}" class="w-9 h-9" alt="di shards ">
                                <p>@{{balance}}</p>
                            </div>
                            <div class="text-right mt-1">
                                <x-a-link href="''" class="text-sm">How to obtain DI shards</x-a-link>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container mx-auto rounded bg-primary-card mb-4" v-for="cat in shop_items">
                <x-section-header>@{{cat.name}}</x-section-header>
                <div class="min-h-screen flex items-center justify-center" v-if="loading">
                    <x-loading></x-loading>
                </div>
                <div class="px-6 pb-6 pt-4">
                    {{--                    <p class="text-primary-accent mb-4">@{{cat.description}}</p>--}}
                    <div class="grid lg:grid-cols-4 gap-10" :class="{'lg:grid-cols-3':cat.id == 1}">
                        <div v-for="item in cat.data"
                             class="bg-primary-card-sub border-primary-accent-sub shadow_caja rounded transition-all hover:shadow-primary-accent-sub w-full p-4"
                             :class="{'lg:col-span-2':cat.id == 2}">
                            <div class="min-h-[65px]">
                                <p class="gradient_full_di text-xl">@{{item.name}}</p>
                                <p class="text-sm text-primary-accent" v-if="item.charges != 0">USE: @{{item.charges}} use/s</p>
                                <p class="text-sm text-primary-accent" v-if="item.charges == 0">Unlocks permanently</p>
                            </div>
                            <div class="w-full h-32 rounded mb-4 mt-2 ">
                                <div class="rounded h-32  mx-auto shadow_titulo overflow-hidden">
                                    <img :src="item.img_path" alt="Dota idea shop Item" class="object-contain h-full mx-auto rounded">
                                </div>
                            </div>
                            <div class="flex items-center justify-center">
                                <div class="inline-flex items-center justify-center mr-4">
                                    <img src="{{asset("/img/icons/gems.png")}}" class="w-5 h-5 mr-1 gradient_full_di" alt="">
                                    <p class="font-numeric font-semibold text-primary-icon text-lg">@{{item.value}}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center space-x-4 mt-2">
                                @if(Auth::check())
                                    <div v-if="!loading_buy || item != selected_item">
                                        <transition name="slide-fade" mode="out-in">
                                            <x-di-button type="button" :icon="''" @click="openOptions(item)" v-if="item.menu_opened == 0 && cat.id == 2">BUY</x-di-button>
                                            <x-di-button type="button" :icon="''" @click="openOptions(item)" v-if="item.menu_opened == 0 && cat.id != 2">UNLOCK</x-di-button>
                                            <div v-if="item.menu_opened == 1">
                                                <x-di-button type="button" :icon="''" @click="buyItem(item)">CONFIRM</x-di-button>
                                                <x-di-button type="button" :icon="''" @click="closeOptions(item)">CANCEL</x-di-button>
                                            </div>

                                        </transition>
                                    </div>
                                    <div v-if="loading_buy && item == selected_item">
                                        <x-loading></x-loading>
                                    </div>
                                @else
                                    <x-login-required-button :icon="'login'" href="{{route('login')}}">LOGIN TO UNLOCK</x-login-required-button>
                                @endif
                            </div>
                            <div class="pt-4">
                                <p class="text-sm text-center rounded bg-primary-card p-2">@{{item.description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mx-auto rounded bg-primary-card mb-4">
                <x-section-header>SHARDS</x-section-header>
                <div class="min-h-screen flex items-center justify-center" v-if="loading">
                    <x-loading></x-loading>
                </div>
                <div class="px-6 pb-6 pt-4">
                    <div class="grid lg:grid-cols-4 gap-10">
                        <div class="lg:col-span-2 flex items-center justify-center flex-col">
                            <p class="text-3xl gradient_full_di text-center">DOTA IDEAS IS FREE</p>
                            <p class="max-w-[400px] mx-auto text-center">All of our content is <b>100% free</b> and for you to enjoy, and we hope you do! Why we sell shards?
                                We thought is was a nice idea for those of you that want to <b>support us</b> in a <span class="gradient_full_di">cool</span> way!</p>
                        </div>
                        <div class="bg-primary-card-sub border-primary-accent-sub shadow_caja rounded transition-all hover:shadow-primary-accent-sub w-full p-4 relative">
                            <div class="min-h-[65px]">
                                <p class="gradient_full_di text-2xl">500 SHARDS</p>
                            </div>
                            <div class="w-full h-32 rounded mb-4 mt-2 ">
                                <div class="rounded h-32  mx-auto shadow_titulo">
                                    <img src="{{asset("/img/icons/gems.png")}}" alt="Dota idea shop Item" class="object-contain w-full h-full rounded">
                                </div>
                            </div>
                            <img src="{{asset("/img/icons/paypal.png")}}" alt="paypal checkout" class="absolute top-2 right-2 w-10 h-10">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex items-center justify-center">
                                    <p class="font-numeric font-semibold text-primary-icon text-lg">0.99 U$D</p>
                                </div>
                            </div>
                            <div id="paypal-button-container2" class="mt-4 rounded bg-stone-100 p-4"></div>
                        </div>
                        <div class="bg-primary-card-sub border-primary-accent-sub shadow_caja rounded transition-all hover:shadow-primary-accent-sub w-full p-4 relative">
                            <div class="min-h-[65px]">
                                <p class="gradient_full_di text-2xl">15000 SHARDS</p>
                            </div>
                            <div class="w-full h-32 rounded mb-4 mt-2 ">
                                <div class="rounded h-32  mx-auto shadow_titulo">
                                    <img src="{{asset("/img/icons/gems.png")}}" alt="Dota idea shop Item" class="object-contain w-full h-full rounded">
                                </div>
                            </div>
                            <img src="{{asset("/img/icons/paypal.png")}}" alt="paypal checkout" class="absolute top-2 right-2 w-10 h-10">
                            <div class="flex items-center justify-center">
                                <div class="inline-flex items-center justify-center">
                                    <p class="font-numeric font-semibold text-primary-icon text-lg">24.99 U$D</p>
                                </div>
                            </div>
                            <div id="paypal-button-container" class="mt-4 rounded bg-stone-100 p-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </shop-index>
@endsection
