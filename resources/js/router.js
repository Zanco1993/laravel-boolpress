import Vue from "vue";
import VueRouter from 'vue-router';
import Home from "./pages/Home.vue"
import Contacts from "./pages/Contacts.vue"

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
    ],
});

export default router;