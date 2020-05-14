<template>
    <form  @submit.prevent="login" method="post">
        <input type="text" name="email" v-model="form.email">
        <input type="password" name="password" v-model="form.password">
        <input type="submit" value="login">
    </form>
</template>
<script>
    import {Form} from 'vform'
    import {mapGetters} from 'vuex'
    export default {
        data() {
            return {
                form: new Form({
                    email: '' ,
                    password: '',
                    remember: false
                })
            }
        },
        methods: {
            login() {
                this.$store.dispatch("auth/login")
                this.form.post("/api/v1/auth/login").then(({data}) => {
                    this.$store.commit("auth/LOGIN_SUCCESS", {
                        token: data.access_token,
                        remember: this.remember
                    });
                    this.$store.dispatch('auth/fetchUser');
                    this.$router.push({name: 'dashboard'});
                })
                    .catch((error) => {
                        console.log(error)
                        this.$store.commit("auth/LOGIN_FAILED", error.response.data)
                    })
            }
        },
        computed: {
            /*...mapGetters({
                authError: 'auth/authError',
                isLoading: 'auth/isLoading'
            })*/
        }
    }
</script>
