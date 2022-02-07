require('./bootstrap');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
import Toasted from 'vue-toasted';


Vue.component('Editor', require('@tinymce/tinymce-vue').default);

Vue.component('hero-create', require('../views/hero/hero-create.vue').default);
Vue.component('hero-edit', require('../views/hero/hero-edit.vue').default);
Vue.component('hero-general', require('../views/hero/hero-general.vue').default);
Vue.component('hero-spells', require('../views/hero/hero-spells.vue').default);

Vue.component('item-create', require('../views/item/item-create.vue').default);
Vue.component('item-edit', require('../views/item/item-edit.vue').default);
// Vue.component('item-general', require('../views/item/item-general.vue').default);
Vue.component('item-spells', require('../views/item/item-spells.vue').default);

Vue.component('other-create', require('../views/other/other-create.vue').default);
Vue.component('other-edit', require('../views/other/other-edit.vue').default);

Vue.component('mrc', require('../views/mrc/mrc.vue').default);
Vue.component('mrc-show', require('../views/mrc/mrc-show.vue').default);


Vue.component('shop-index', require('../views/shop/shop-index').default);

Vue.component('user-profile', require('../views/user/user-profile').default);

Vue.component('contact', require('../views/contact/contact.vue').default);

Vue.component('sort-and-filter', require('./components/sort-and-filter.vue').default);
Vue.component('opinion', require('./components/opinion.vue').default);
Vue.component('loading', require('./components/loading.vue').default);
Vue.component('post-comments', require('./components/post-comments.vue').default);
Vue.component('post-credits', require('./components/post-credits.vue').default);

Vue.use(Toasted);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.directive('init', {
    bind: function(el, binding, vnode) {
        vnode.context[binding.arg] = binding.value;
    }
});

var app = new Vue({
    el: '#app'
})


