import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './../components/HcodeSectionBanner'
import News from './../components/HcodeSectionNews'
import Notice from './../components/HcodeSectionNewsNotice'
import Hcode404 from './../components/Hcode404'

Vue.use(VueRouter)

export default new VueRouter({
    linkExactActiveClass: 'link-active',
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/news',
            alias: '/notices',
            component: News
        },
        {
            path: '/news/:idnotice',
            name: 'notice',
            component: Notice,
            beforeEnter: (to, from, next) => {
                
                next();
            }
        },
        {
            path: '/admin',
            redirect: '/'
        },
        {
            path: '*',
            component: Hcode404
        }
    ]
})