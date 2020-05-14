import Vue from "vue";
import store from "./store/index";
import router from "./routes/index";


const app = new Vue({
    el: "#app",
    router,
    store
});
