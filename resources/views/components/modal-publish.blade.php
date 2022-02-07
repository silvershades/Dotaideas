<div id="my-modal" class="fixed inset-0 bg-transparent  flex items-center justify-center" v-if="publish_modal">
    <div class="rounded spell_box w-[600px] max-w-screen bg-primary-card p-10  text-center flex items-center justify-center flex-col space-y-8">
        <div>

            <p class="mb-6 text-5xl gradient_full_di">HOW TO CONTINUE</p>
            <p class="mb-2 leading-none text-center">You can save this draft and finish it later on!</p>
            <p class="mb-2 leading-none gradient_full_di">OR</p>
            <p class=" leading-none text-center ">You can publish it now and make it visible to the world!</p>
        </div>

        <div class=" flex items-center justify-center flex-col " v-if="ajax_success">
            <div class="bg-green-200 text-green-700 rounded p-2">
                <p>@{{ ajax_success }}</p>

            </div>
            <div class="flex items-center justify-center  p-2 my-4 space-x-4 ">
                <a :href="post_created_id" class="shadow h-[35px] pb-0.5 pr-0.5 bg-gradient-to-br from-prim_a to-prim_b cursor-pointer rounded transition-all hover:shadow-md hover:brightness-110 hover:shadow-primary-accent font-title">
                    <div class="space-x-2 px-3 flex items-center  h-[33px] bg-gradient-to-r from-prim_c to-prim_d transition-all shadow-inner">
                        @include('svgs',['svg' => 'arrow_right','classes' => 'w-5 h-5'])
                        <p class="drop-shadow font-semibold uppercase ">GO TO POST</p>
                    </div>
                </a>

                <x-a-button :icon="'arrow_right'" href="/user/{{Auth::id()}}">GO TO PROFILE</x-a-button>
            </div>

        </div>
        <div class="bg-red-100 p-2 rounded flex items-center justify-center flex-col  max-h-[300px] " v-if="Object.keys(ajax_errors).length > 0">
            <p class="block text-sm font-semibold text-off">We encountered some errors</p>
            <ul class="block text-sm list-disc text-left ml-6 long_text" v-if="!exception">
                <li v-for="ajax_error in ajax_errors" class="text-primary-text-accent">@{{ ajax_error[0] }}</li>
            </ul>
            <p v-if="exception" class="text-primary-text-accent">@{{ ajax_errors }}</p>
        </div>
        <div v-if="publishing" class="">
            <x-loading></x-loading>
        </div>
        <div class="modal-action flex items-center justify-center space-x-4 " v-if="!ajax_success">
            <div v-if="Object.keys(ajax_errors).length == 0" class="flex items-center justify-center space-x-4 ">
                <x-di-button type="button" :icon="'draft'" @click="presetPostNotActive">SAVE DRAFT</x-di-button>
                <x-di-button type="button" :icon="'upload'" @click="presetPostActive">PUBLISH POST</x-di-button>
            </div>
            <x-di-button type="button" :icon="'cancel'" @click="publish_modal = false">Dismiss</x-di-button>
        </div>
    </div>
</div>
