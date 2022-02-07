@extends('layout')

@section('content')
    <other-edit inline-template v-cloak>
        <div>
            <div class="min-h-screen flex items-center justify-center" v-if="loading">
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
                        <x-section-header>EDITING IDEA</x-section-header>
                        <div class="px-6 ">
                            <div class="lg:col-span-3 alert alert-error space-x-10 flex items-start justify-start flex-col" v-if="errors.description.length ">
                                <p>We encountered some errors</p>
                                <ul class="w-full list-disc block">
                                    <li v-for="error in errors.description">@{{ error }}</li>
                                </ul>
                            </div>

                        </div>
                        <div class="p-6 grid  lg:grid-cols-3 gap-8 ">

                            <!-- PREVIEW -->
                            <div class="">
                                <!-- BASIC INFO -->
                                <p class="label_title mb-4">Other's title</p>
                                <div class="grid grid-cols-7 gap-4 mb-4">
                                    <div class="flex items-center justify-center">
                                        @include('svgs',['svg' => 'post_other','classes' => 'w-8 h-8 text-primary-icon'])
                                    </div>
                                    <div class="col-span-6">
                                        <input type="text" class="w-full input-sm" maxlength="40" placeholder="Enter the idea's name or title..." v-model="dother.name">
                                        <p class="text-error text-xs">Invalid field</p>
                                    </div>
                                </div>
                                <p class="label_title mb-4">Post flag</p>
                                <select name="" class="w-full mb-4" v-model="dother.other_flags_id">
                                    @foreach($flags as $flag)
                                        <option value="{{$flag->id}}">{{$flag->name}}</option>
                                    @endforeach
                                </select>
                                <label class="label_title mb-4" for="name">Image</label>

                                <div class="rounded overflow-hidden shadow-lg shadow-primary-accent-sub">
                                    <div class="h-64 rounded-t gradient_placeholder">
                                        <img v-if="dother.img_is_uploaded != 0" :src="dother.img_path" alt="Her's portrait" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div class="my-6">
                                    <input id="image_file_input_hero" type="file" class="w-full file" accept=".jpg, .png" @change="onFileChangeItem">
                                    <p class="text-error text-xs">Invalid field</p>
                                </div>

                            </div>
                            <div class="col-span-2 flex flex-col">

                                <p class="label_title mb-4">Describe your idea</p>
                                @if(Auth::check() && Auth::user()->has_unlocked_text_editor())
                                    <x-tiny-mce :vmodel="'dother.description'" :height="500"></x-tiny-mce>
                                @else
                                    <textarea name="idea" id="" class="resize-none w-full flex-grow h-[500px] " v-model="dother.description"></textarea>
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
    </other-edit>
@endsection
