import VueRouter from 'vue-router';

import test from "./components/test";

export default new VueRouter({
    routes: [
        {
            path: '/home',
            component: test
        }
    ],
    mode: 'history'
})
