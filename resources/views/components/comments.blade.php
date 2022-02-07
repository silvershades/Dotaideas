<post-comments inline-template v-cloak>
    <div class="rounded bg-primary-card shadow pb-6 mt-4 max-w-[1000px] mx-auto">
        <x-section-header>COMMENTS</x-section-header>
        <div class="space-y-4 px-4 lg:px-8 py-4 max-w-[800px] mx-auto">
            <div class="flex items-center space-x-2">
                @include('svgs',['svg' => 'text','classes' => 'h-5 w-5 text-primary-icon '])
                <p class="font-semibold">Leave your comment</p>
            </div>
            <input type="hidden" v-model="post" v-init:post="'<?=($post->id) ?>'">
            <div>
                <textarea name="message" class="resize-none w-full border-2 border-primary-accent-sub-dark focus:border-2 focus:primary-accent-sub-dark h-32" v-model="new_comment.message"></textarea>
            </div>

            <div class="text-center flex items-center justify-center">
                <transition name="fade">
                    <div v-if="loading_send" class="mr-4">
                        <x-loading></x-loading>
                    </div>
                </transition>
                @if(Auth::check())
                    <x-di-button type="button" :icon="'text'" @click="addNewComment">Send message</x-di-button>
                @else
                    <x-login-required-button :icon="'login'" href="{{route('login')}}">LOGIN TO COMMENT</x-login-required-button>
                @endif
            </div>
        </div>

        <div class=" px-4 lg:px-8 py-4  mx-auto">
            <p class="mb-2 text-sm">This post has <span class="font-semibold text-primary-accent">@{{ comments_total }}</span> comments.</p>
            <transition name="fade">
                <div v-if="loading" class="mb-2">
                    <x-loading></x-loading>
                </div>
            </transition>
            <div v-for="comment in comments">
                <div class="rounded bg-primary-card-sub py-4 flex items-start justify-start mb-4 ">
                    <div class=" flex-shrink-0 w-36 flex items-center justify-start h-full flex-col space-y-2">
                        <div class="mt-3 space-y-2">
                            <div class="w-16 h-16 rounded-full overflow-hidden">
                                <img :src="comment.user_di_avatar" class="object-cover w-full h-full">
                            </div>
                            <div class="flex items-center justify-center space-x-1">
                                @include('svgs',['svg' => 'points','classes' => 'h-5 w-5 text-primary-icon '])
                                <p class="text-sm">@{{ comment.user_points }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <a href="#" class="text-primary-accent font-semibold p-0 ">@{{ comment.user_name }}</a>
                        <p class="text-xs text-primary-text-muted ">@{{ comment.created_at }}</p>
                        <p class="mt-2 mb-4 pr-10 text-sm ">@{{ comment.message }}</p>
                        <div class="flex items-center justify-start space-x-4">
                            @if(Auth::check())
                                <x-di-button type="button" :icon="'replied'" @click="toggleBox(comment)">
                                    <span v-if="comment.show_reply_box == 0">reply</span>
                                    <span v-if="comment.show_reply_box == 1">dismiss</span>
                                </x-di-button>
                            @endif
                        </div>
                        <transition name="slide-fade">
                            <div class="mr-6 mt-4 flex items-center justify-center flex-col" v-if="comment.show_reply_box == 1">
                                <textarea name="message" id="" class="resize-none w-full border-2 border-primary-accent-sub-dark focus:border-2 focus:primary-accent-sub-dark h-32" v-model="comment.reply"></textarea>
                                <div class="flex items-center justify-center space-x-4">
                                    <transition name="fade">
                                        <div v-if="comment.loading == 1" class="mt-4 flex">
                                            <x-loading></x-loading>
                                        </div>
                                    </transition>
                                    <x-di-button type="button" :icon="'text'" class="mt-4" @click="addNewReply(comment)">SEND message</x-di-button>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>

                <div class="rounded bg-primary-card-sub py-4 flex items-start justify-center mb-4 ml-10 " v-for="reply in comment.replies">
                    <div class=" flex-shrink-0 w-36 flex items-center justify-start h-full flex-col space-y-2">
                        <div class="mt-2">
                            <div class="w-16 h-16 rounded-full overflow-hidden">
                                <img :src="comment.user_di_avatar" class="object-cover w-full h-full">
                            </div>
                        </div>
                        <div class="flex items-center justify-center space-x-1">
                            @include('svgs',['svg' => 'points','classes' => 'h-5 w-5 text-primary-icon '])
                            <p class="text-sm">@{{ comment.user_points }}</p>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex items-center space-x-2">
                            @include('svgs',['svg' => 'replied','classes' => 'h-5 w-5 '])
                            <a href="#" class="text-primary-accent font-semibold p-0 ">@{{ reply.user_name }}</a>
                            <p class="text-primary-accent ">replied</p>
                        </div>
                        <p class="text-xs text-primary-text-muted ">@{{ reply.created_at }}</p>
                        <p class="mt-2 mb-4 pr-10 text-sm ">@{{ reply.message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</post-comments>
