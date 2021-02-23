<template>
<login-template>
    <span slot="menuesquerdo">
        <img src="https://cakeerp.com/wp-content/uploads/2019/10/capa-2-1080x675.png" class="responsive-img" />
    </span>
    <span slot="principal">
       
        <h2>Login</h2>
                <input type="text" placeholder="E-mail" v-model="email">
        <input type="password" placeholder="Senha" v-model="password">
        <button type="button" class="btn" v-on:click="login()">Entrar</button>
    </span>
   
</login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';

export default {
  name: 'Login',
  data () {
    return {
       email:'',
       password:''
    }
  },
  components:{
    LoginTemplate
  },
  methods:{
      login(){
            axios.post( 'http://localhost:8000/api/login', {
            email: this.email,
            password: this.password
        })
        .then(response => {
            //console.log(response)
            if(response.data.token){
              // login com sucesso
              console.log('login com sucesso');
              sessionStorage.setItem('usuario',JSON.stringify(response.data));
              this.$router.push('/');
            }else if(response.data.status == false){
              // login não existe
              console.log('login não existe');
              alert('Login inválido');
            }else{
              // erros da validação
              console.log('erros de validação');
              let erros = '';
              for(let erro of Object.values(response.data)){
                erros += erro + " ";
              }
              alert(erros);
            }
        })
      .catch(e => {
        alert("Erro! Tente novamente mais tarde!");
      })
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
