<template>
    <form  @submit.prevent="register" method="post">
        <input type="text" name="name" v-model="form.name" placeholder="enter name">
        <input type="email" name="email" v-model="form.email" placeholder="enter email" autocomplete="off">
        <input type="password" name="password" v-model="form.password" placeholder="enter password"  autocomplete="new-password">
        <input type="password" name="password_confirmation" v-model="form.password_confirmation" placeholder="enter password_confirmation">
        <input type="submit" value="register">
    </form>
</template>
<script>
    import {Form} from 'vform'

    export default {
        data(){
            return{
                form: new Form({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }),
            }
        },
        methods:{
            register() {
                this.form.post("/api/v1/auth/register").then(({data}) => {
                    console.log(data)
                    this.$router.push({name: 'login'})
                }).catch((err) => {
                    console.log(err.response.data)
                })
            }
        }
    }
</script>
