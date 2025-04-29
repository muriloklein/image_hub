import {createRouter, createWebHistory} from 'vue-router'
import DefaultLayout from './components/DefaultLayout.vue'
import Home from './views/Home.vue'
import MyImages from './views/MyImages.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import NotFound from './views/NotFound.vue'
import useUserStore from './store/user'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: DefaultLayout,
            children: [
                {path: '/', name: 'Home', component: Home},
                {path: '/images', name: 'MyImages', component: MyImages},
            ],
            beforeEnter: async (to, from, next) => {
                try {
                    const userStore = useUserStore();
                    await userStore.fetchUser();
                    next();
                } catch (error) {
                    next(false);
                }
            }
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
        },
        {
            path: '/register',
            name: 'Register',
            component: Register,
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: NotFound,
        }
    ]
})

export default router;