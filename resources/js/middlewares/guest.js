export default function guest({next,store}) {
console.log("guest middleware run")
    if( store.getters['auth/token'])
    {
        console.log('token found')
        return next({name:'home'});
    }
    else
    {
        console.log('token not found')
        return next();
    }
}
