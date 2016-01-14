var Vue = require('vue');
var resource = require('vue-resource');
var VueRouter = require('vue-router');
var VueValidator = require('vue-validator');

Vue.use(resource);
Vue.use(VueRouter);
Vue.use(VueValidator);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector("[name='_token']").content;

var App = new Vue({});

var router = new VueRouter();

router.map({
    '/tasks': {
        component: require('./components/tasks.js')
    },
    '/members': {
        component: require('./components/members.js')
    },
    '/assign/:task': {
        component: require('./components/assign_members.js')
    }
});

router.start(App, '#app');

router.go('/tasks');