@extends("layout")

@section("content")
    <div class="">
        <contact inline-template>
            <div class="grid lg:grid-cols-2 gap-10 max-w-[1100px] mx-auto">
                <div class="p-1 bg-gradient-to-br from-prim_a to-prim_b rounded shadow_titulo lg:col-span-2">
                    <div class="flex items-center justify-center flex-col p-6 rounded bg-primary-card ">
                        <div class="flex items-center justify-center flex-col h-20 bg-gradient-to-r from-prim_d to-prim_b w-full rounded">
                            <h2 class="text-3xl uppercase font-bold text-center shadow_titulo">Contact us</h2>
                        </div>
                        <p class="mt-4 text-sm flex-grow w-full">Tell us what on your mind and we will get back to you ASAP.</p>

                        <div class="grid grid-cols-2 gap-4 w-full">
                            <div class="w-full mt-6 space-y-4">
                                <p class="label_title">Your name</p>
                                <input type="text" class="w-full" v-model="contact.name" maxlength="30">
                                <p class="label_title">Your email</p>
                                <input type="email" class="w-full" v-model="contact.email">
                            </div>
                            <div class="w-full mt-6">
                                <p class="label_title mb-4">Your message</p>
                                <textarea  rows="5" class="resize-none w-full" v-model="contact.message" maxlength="3000"></textarea>
                            </div>
                        </div>
                        <div class="mt-6">
                            <transition-group name="slide-fade" mode="out-in">
                                <div :key="1" v-if="loading_contact">
                                    <x-loading></x-loading>
                                </div>
                                <div :key="2" v-if="!loading_contact">
                                    <x-di-button type="button" icon="''" @click="sendContact">SEND</x-di-button>
                                </div>
                            </transition-group>
                        </div>
                    </div>
                </div>
                <div class="p-0.5 bg-gradient-to-br from-prim_a to-prim_b rounded shadow_titulo">
                    <div class="flex items-center justify-center flex-col p-6 rounded bg-primary-card   h-full">
                        <div class="flex items-center justify-center flex-col h-16 bg-gradient-to-r from-prim_d to-prim_b w-full rounded">
                            <h2 class="text-2xl uppercase font-bold text-center shadow_titulo">Report a bug</h2>
                        </div>
                        <p class="text-sm mt-4">Have found a bug in our system? Let us know and we will get rid of it.
                            Try to be precise and describe us what you where doing for example at the moment the bug occurred.</p>
                        <div class="w-full mt-6 space-y-4">
                            <p class="label_title">Your name</p>
                            <input type="text" class="w-full" v-model="bug.name" maxlength="30">
                            <p class="label_title">Your email</p>
                            <input type="email"  class="w-full" v-model="bug.email">
                        </div>
                        <p class="label_title mt-4">Describe the bug</p>
                        <div class="w-full mt-4">
                            <textarea rows="5" class="resize-none w-full" v-model="bug.message" maxlength="3000"></textarea>
                        </div>
                        <div class="mt-6">
                            <transition-group name="slide-fade" mode="out-in">
                                <div :key="1" v-if="loading_bug">
                                    <x-loading></x-loading>
                                </div>
                                <div :key="2" v-if="!loading_bug">
                                    <x-di-button type="button" icon="''" @click="sendBug">SEND</x-di-button>
                                </div>
                            </transition-group>
                        </div>
                    </div>
                </div>
                <div class="p-0.5 bg-gradient-to-br from-prim_a to-prim_b rounded shadow_titulo">
                    <div class="flex items-center justify-center flex-col p-6 rounded bg-primary-card  h-full">
                        <div class="flex items-center justify-center flex-col h-16 bg-gradient-to-r from-prim_d to-prim_b w-full rounded">
                            <h2 class="text-2xl uppercase font-bold text-center shadow_titulo">Request a change</h2>
                        </div>
                        <p class="mt-4 text-sm  flex-grow">Would you like something that is missing in Dota Ideas, let Us know! We will look into it.</p>
                        <div class="w-full mt-6 space-y-4">
                            <p class="label_title">Your name</p>
                            <input type="text"  class="w-full" v-model="request.name" maxlength="30">
                            <p class="label_title">Your email</p>
                            <input type="email"  class="w-full" v-model="request.email">
                        </div>
                        <p class="label_title mt-4">Describe the request</p>
                        <div class="w-full mt-4">
                            <textarea  rows="5" class="resize-none w-full" v-model="request.message" maxlength="3000"></textarea>
                        </div>
                        <div class="mt-6">
                            <transition-group name="slide-fade" mode="out-in">
                                <div :key="1" v-if="loading_request">
                                    <x-loading></x-loading>
                                </div>
                                <div :key="2" v-if="!loading_request">
                                    <x-di-button type="button" icon="''" @click="sendRequest">SEND</x-di-button>
                                </div>
                            </transition-group>
                        </div>
                    </div>
                </div>
            </div>
        </contact>
    </div>

@endsection
