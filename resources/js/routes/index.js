import Vue from 'vue';
import VueRouter from 'vue-router'
import store from '../store/index'
import Login from '../pages/auth/login';
import register from  '../pages/auth/register';
import home from '../pages/home';
import dashboard from '../pages/dashboard';
import Index from '../pages/discussion/Index';
import SignleDiscussion from '../pages/discussion/SignleDiscussion';
import discussionsinChannelspecific from '../pages/discussion/discussionsinChannelspecific';

import guest from "../middlewares/guest";
import checkAuth from "../middlewares/auth-check";
import middlewarePipeline from "./middlewarePipeline";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/login",
            component: Login,
            name: "login",
            meta:{
                middleware:[guest]
            }

        }
        ,{
            path: "/register",
            component: register,
            name: "register",
            meta: {
                middleware: [guest]
            }
        }
        ,{
            path: "/home",
            component: home,
            name: "home"
        },
        {
            path: "/dashboard",
            component: dashboard,

            children: [
                {
                    path: "",
                    component: Index,
                    name: "dashboard",
                    meta: {
                        middleware: [checkAuth]
                    },
                },
                {
                    path: 'channel/:channel',
                    component:discussionsinChannelspecific  ,
                    name: 'showCategory'
                },
                {
                    path: "discussion/:channel/:discussion",
                    component: SignleDiscussion,
                    name: "showDiscussion"
                }
            ]
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) return next();
    const middleware = to.meta.middleware;
    const context = {
        to,
        from,
        next,
        store
    };
    return middlewarePipeline(context,middleware,0);
});
export default router;
