<aside class="space-y-4">
    <!-- INTRO DOTAIDEAS -->

    <div class="p-[1px] bg-gradient-to-br from-prim_a to-prim_b rounded">
        <div class="bg-primary-card rounded  p-4  ">
            <div class="flex items-center justify-center space-y-1 flex-col">
                <div class="flex items-center justify-center space-x-2">
                    <p class="text-4xl  text-center  gradient_full_di">Welcome</p>
                </div>
                <p class="text text-center">Welcome to <span class="font-title uppercase">dota ideas</span>. An interactive forum to share ideas about <span class="font-semibold">Dota 2</span>.
                </p>
                <div class="text-sm text-center flex items-center justify-center flex-col">
                    <x-a-link href="{{route('post.create')}}">Create your hero</x-a-link>
                    <x-a-link href="{{route('post.create')}}">Create your item</x-a-link>
                    <x-a-link href="{{route('post.create')}}">Create any other idea</x-a-link>
                </div>
            </div>
        </div>
    </div>
@if($mrc)
    <!-- MRC -->
        <div class="p-0.5 bg-gradient-to-br from-prim_a to-prim_b rounded shadow_titulo mb-4">
            <div class="bg-primary-card rounded shadow_caja  p-4  relative">
                <div class="flex flex-col items-center justify-center space-y-2 z-50 relative">

                    <div class="flex items-center justify-center space-x-1">
                        <p class="text-xl  text-center  gradient_full_di">Monthly Rework Challenge</p>
                    </div>
                    <p class="text-sm text-center">Every month we challenge <span class="gradient_full_di">YOU</span> to create a better version of an ability of <span class="font-semibold"> Dota 2</span>
                    </p>

                    <div class="flex items-center justify-center flex-col w-full">
                        <p class="text-sm text-center text-primary-accent">This month's pick</p>
                        <p class="text-lg text-center gradient_full_di">{{$mrc->name}} - {{$mrc->spell_name}}</p>
                        <div class="px-6 w-full my-2">
                            <div class="w-full h-32 rounded relative">
                                <img src="{{asset($mrc->img_path)}}" alt="monthly pick dota 2 hero" class="object-cover w-full h-full rounded shadow_titulo">
                                <img src="{{asset($mrc->spell_img_path)}}" alt="monthly pick dota 2 spell" class="object-cover w-16 h-16 rounded absolute shadow_titulo -bottom-2 -left-2">
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="font-black text-xl text-center gradient_full_di  animate-pulse">{{$mrc->days_left()}}</p>
                    </div>
                    <div class="text-center space-x-4">
                        <x-a-button :icon="''" href="{{route('mrc.index')}}" type="button">join challenge</x-a-button>
                        <x-a-link href="{{route('mrc.dir')}}">view all</x-a-link>
                    </div>

                </div>

            </div>
        </div>
@endif
<!-- SHARE DOTAIDEAS -->
    <div class="bg-primary-card rounded shadow_caja p-4  text-center space-y-2">
        <p class="text-sm">Share <span class="font-title uppercase">dota ideas</span> to your friends and win <span class="text-primary-icon">points & shards</span></p>

        <x-di-button :icon="'share'" type="button">share dota ideas</x-di-button>
    </div>
    <!-- OPINION DOTAIDEAS -->
    <opinion inline-template v-cloak>
        <div class="bg-primary-card rounded shadow_caja  p-4 ">
            <form action="" method="post" class="flex flex-col items-center justify-center space-y-4 mb-0">
                <div class="flex items-center justify-center space-x-1">
                    @include('svgs',['svg' => 'comments','classes' => 'w-5 h-5 text-primary-icon '])
                    <p class="text-center text-sm">What do you think about Dota Ideas?</p>
                </div>
                <div v-if="!sent" class="flex flex-col items-center justify-center space-y-4 w-full">

                    <textarea class="text-xs resize-none rounded  p-2 w-full" id="" rows="3" v-model="message" maxlength="3000"></textarea>
                    <transition-group name="slide-fade" mode="out-in">
                        <div :key="1" v-if="loading">
                            <x-loading></x-loading>
                        </div>
                        <div :key="2" v-if="!loading">
                            <x-di-button type="button" icon="''" @click="send">SEND</x-di-button>
                        </div>
                    </transition-group>
                </div>
                <div v-if="sent">
                    <p class="gradient_full_di text-2xl text-center">Thank you for your feedback!</p>
                </div>
            </form>
            <hr class="mt-4 mb-3 border-primary-accent">
            <div class="flex items-center space-x-4 justify-center">
                <x-a-link href="{{route('contact.index')}}" class="text-xs">Contact</x-a-link>
                <x-a-link href="{{route('contact.index')}}" class="text-xs">Submit a bug</x-a-link>
                <x-a-link href="{{route('contact.index')}}" class="text-xs">Request a change</x-a-link>
            </div>
        </div>
    </opinion>
    <!-- TWITTER DOTAIDEAS -->
    <div class="bg-primary-card rounded shadow_caja  p-4 flex flex-col items-center justify-center space-y-3 ">
        <div class="flex items-center justify-center space-x-10">
            <a href="https://twitter.com/dotaideas" target="_blank">
                <img src="{{asset("/img/twitter.png")}}" alt="twitter logo" class="object-contain h-8 w-8">
            </a>
            <a href="https://www.reddit.com/user/dotaideas" target="_blank">
                <img src="{{asset("/img/reddit.png")}}" alt="twitter logo" class="object-contain h-8 w-8">
            </a>
        </div>

    </div>
    <!-- SUPPORT DOTAIDEAS -->
    <div class="bg-primary-card rounded shadow_caja  p-4 flex flex-col items-center justify-center space-y-3 ">
        <p class="text-center text-sm">If you like our project you can support us!</p>
        @include('svgs',['svg' => 'heart','classes' => 'w-6 h-6 text-primary-icon animate-pulse '])
        <x-a-button href="''" icon="''">DONATE</x-a-button>
        {{--        <div class="text-center h-10">--}}
        {{--            <form action="https://www.paypal.com/donate" method="post" target="_top">--}}
        {{--                <input type="hidden" name="business" value="WMSJXRC7QYDNU" />--}}
        {{--                <input type="hidden" name="no_recurring" value="0" />--}}
        {{--                <input type="hidden" name="item_name" value="Thank you so much for support Dota Ideas. Means the world to Us!" />--}}
        {{--                <input type="hidden" name="currency_code" value="USD" />--}}
        {{--                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />--}}
        {{--                <img alt="" border="0" src="https://www.paypal.com/en_AR/i/scr/pixel.gif" width="1" height="1" />--}}
        {{--            </form>--}}
        {{--        </div>--}}
    </div>
</aside>
