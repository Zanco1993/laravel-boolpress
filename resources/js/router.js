import Vue from "vue";
import VueRouter from 'vue-router';
import Home from "./pages/Home.vue"
import Contacts from "./pages/Contacts.vue"
import Show from "./pages/posts/Show.vue"

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: "//",
            component: Home,
            name: "home.index",
            meta: {title: "Homepage", linktext:'home'},
        },
        {
            path: "/contacts",
            component: Contacts,
            name: "contacts.index",
            meta: {title: "Contacts", linktext:'contacts'},
        },
        {
            path: "/posts/:post",
            component: Show,
            name: "posts.show",
            meta: {title: "Dettaglio"},
        },
    ],
});

export default router;