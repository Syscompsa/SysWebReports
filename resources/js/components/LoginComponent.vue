<template>
    <div>
        <b-container>
        <b-img center src="https://www.syscompsa.com/images/logo.png"></b-img>
        <!--<b-form class="offset-3 col-6" @submit="onSubmit">
            <b-form-group id="input-group-1" label="Username: " label-for="input-user">
                <b-form-input
                    id="input-user"
                    v-model="usuario.user"
                    type="text"
                    required
                    placeholder="Enter username"
                ></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-2" label="Password:" label-for="input-password">
                <b-form-input
                id="input-password"
                v-model="usuario.password"
                required
                placeholder="Enter password"
                type="password"
                ></b-form-input>     
            </b-form-group>
            <b-row align-h="center">
                <b-button @click="onSubmit" variant="outline-primary">Login</b-button>
                <b-button :to="{name: 'reporte'}" variant="outline-primary">reporte</b-button>
            </b-row>
        </b-form>-->
        </b-container>
    </div>
</template>
<script>
import router from 'vue-router'
export default {
    data(){
        return{
            usuario:{user:'', password:''},
        };
    },
    methods:{
        onSubmit(){
            console.log(this.usuario);
            console.log("Im here");
            axios.post('/login',this.usuario)
                .then(res=>{

                })
                .catch(res=>{

                });
        }
    }
}
</script>
<style lang="">
    
</style>