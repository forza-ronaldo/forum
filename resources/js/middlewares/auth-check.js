export default function checkAuth({ next, store }) {
    console.log("check-auth middleware run ...");
    if (!store.getters["auth/check"] && store.getters["auth/token"]) {
        console.log('not check but token found')
        store.dispatch("auth/fetchUser");
        return next();
    } else if (store.getters["auth/check"] && store.getters["auth/token"]) {
        console.log(' check & auth')
        return next();
    } else {
        console.log('go login')
        return next({ name: "login" });
    }
}
