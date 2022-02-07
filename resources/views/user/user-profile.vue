<template>

</template>

<script>
export default {
    name: "user-profile",
    data: function () {
        return {
            loading: false,
            id: '',
            loading_rename: false,
            user_name: '',
            user_avatar: '',
            posts: [],
            achievements: [],
            stash_avatars: [],
            stash_unlocks: [],
            stash_post_bg_emerald: [],
            stash_post_bg_golden: [],
            stash_shards_purchase: [],
            loading_make_pro: false,
        }
    },
    mounted() {
        // this.loadAchievements();
        this.id = window.location.href.split('/').pop();
        this.loadUser();
        this.loadAvatar();
        this.loadStashes();
        this.loadPosts();
    },
    methods: {
        loadUser() {
            const formData = new FormData();
            formData.append('user', this.id);
            axios.post('/api/user-name', formData)
                .then((response) => {
                    this.user_name = response.data.user_name;
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        rename() {
            this.loading_rename = true;
            const formData = new FormData();
            formData.append('user', this.id);
            formData.append('name', this.user_name);
            axios.post('/api/user-rename', formData)
                .then((response) => {
                    if (response.data.status == 'success') {
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Name changed', {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
                    } else {
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> An error ocurred', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
                    }
                    this.loading_rename = false;
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        loadAvatar() {
            const formData = new FormData();
            formData.append('user', this.id);
            axios.post('/api/user-avatar', formData)
                .then((response) => {
                    this.user_avatar = response.data.avatar;
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        loadStashes() {
            const formData = new FormData();
            formData.append('user', this.id);
            axios.post('/api/user-stash', formData)
                .then((response) => {
                    this.stash_avatars = response.data.stash_avatars;
                    this.stash_unlocks = response.data.stash_unlocks;
                    this.stash_post_bg_emerald = response.data.stash_post_bg_emerald;
                    this.stash_post_bg_golden = response.data.stash_post_bg_golden;
                    this.stash_shards_purchase = response.data.stash_shards_purchase;
                    // console.log(response.data.msg)
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        loadPosts() {
            const formData = new FormData();
            formData.append('user', this.id);
            axios.post('/api/user-posts', formData)
                .then((response) => {
                    this.posts = response.data.data;
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        loadAchievements() {
            const formData = new FormData();
            formData.append('user', this.id);
            axios.post('/api/user-achievements', formData)
                .then((response) => {
                    if (response.data.status == 'success') {
                        this.achievements = response.data.achievements;
                    }
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        changeVisibility(visibility, post) {
            const formData = new FormData();
            formData.append('post', post.id);
            formData.append('visibility', visibility);
            axios.post('/api/user-post-visibility', formData)
                .then((response) => {
                    if (response.data.status == 'success') {
                        post.is_active = response.data.visibility;
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Visibility changed', {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
                    } else {
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> An error ocurred', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
                    }
                })
                .catch(function (error) {
                    // console.log(error)
                });
        },
        equipAvatar(item) {
            const formData = new FormData();
            formData.append('avatar', item.id);
            axios.post('/api/user-equip-avatar', formData)
                .then((response) => {
                    if (response.data.status == 'success') {
                        this.user_avatar = response.data.avatar;
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Avatar changed', {type: 'success', className: 'font-title', position: "top-right", duration: 10000});
                    } else {
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> An error ocurred', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
                    }
                })
                .catch(function (error) {
                    // console.log(error)
                });
        }, makePro(bg, post) {
            const formData = new FormData();
            formData.append('bg', bg);
            formData.append('post', post.id);
            post.loading = true;
            axios.post('/api/user-make-post-pro', formData)
                .then((response) => {
                    if (response.data.status == 'success') {
                        this.loadStashes();
                        this.loadPosts();
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> Idea made PRO successfully!', {
                            type: 'success',
                            className: 'font-title',
                            position: "top-right",
                            duration: 10000
                        });
                    } else {
                        Vue.toasted.show('<span class="font-semibold mr-3">DI.BOT says</span> An error ocurred', {type: 'error', className: 'font-title', position: "top-right", duration: 10000});
                    }
                    post.loading = false;
                })
                .catch(function (error) {
                    post.loading = false;
                    // console.log(error)
                });
        },

    }
}
</script>


<style scoped>
.slide-fade-enter-active {
    transition: all .3s ease-in;
}

.slide-fade-leave-active {
    transition: none;
}

.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */
{
    transform: translateX(10px);
    opacity: 0;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 1s
}

.fade-leave-to {
    opacity: 0
}
</style>
