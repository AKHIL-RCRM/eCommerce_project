import { createRouter, createWebHistory } from "vue-router";
import Start from "./views/Start.vue";
import NotFound from "./views/NotFound.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "home", component: Start },
        { path: "/:notFound(.*)", component: NotFound },
    ],
});

export default router;
