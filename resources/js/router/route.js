let routes = [
    { path: '/blog', component: require('../components/BlogComponent.vue').default },
    { path: '/comment', component: require('../components/CommentComponent.vue').default },
]

let router = new VueRouter({
    mode: 'history',
    routes
})


const app = new Vue({
    el: '#app',
    router
});
