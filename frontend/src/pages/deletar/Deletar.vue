<template>
<login-template>
    <span slot="menuesquerdo">
        <img src="https://cakeerp.com/wp-content/uploads/2019/10/capa-2-1080x675.png" class="responsive-img" />
    </span>
    <span slot="principal">
       
        <h2>Deletar</h2>
        <input type="text" placeholder="Nome" value="" v-model="nome">
                <input type="text" placeholder="E-mail" value="" v-model="email">
                <input type="text" placeholder="Idade" value="" v-model="idade">
                <input type="text" placeholder="linkedin" value="" v-model="linkedin">    
                <input type="text" placeholder="tecnologias" value="" v-model="tecnologias">    
                <h5>Tem certeza?</h5>    
        <button type="button" class="btn" v-on:click="cadastro()">Sim</button>
        <router-link class="btn orange" to="/">Não</router-link>
    </span>
   
</login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';
import Multiselect from 'vue-multiselect'
import Router from 'vue-router'

export default {
  name: 'Deletar',
  data () {
    return {
      id: this.$route.params.id,
      nome:'',
       email:'',
       idade:'',
       linkedin:'',
       tecnologias:'',
       value: [
        
      ],
      options: [
        { name: 'C#', code: 'd' },
        { name: 'Javascript', code: 'js' },
        { name: 'Nodejs', code: 'nj' },
        { name: 'Angular', code: 'an' },
        { name: 'React', code: 'rc' },
        { name: 'Ionic', code: 'ic' },
        { name: 'Mensageria', code: 'ms' },
        { name: 'PHP', code: 'ph' },
        { name: 'Laravel', code: 'lr' }
      ]
    }
  },
  components:{
      Multiselect,
    LoginTemplate,
    Router
  },
  methods:{
    cadastro(){
            axios.delete( 'http://localhost:8000/api/deletar/'+this.id, {        
        })
        .then(response => {
              console.log('Cadastro realizado com sucesso');
              this.$router.push('/');
        })
      .catch(e => {
        alert("Erro! Tente novamente mais tarde!");
      })
      }
    },
    mounted(){   
        axios.get('http://localhost:8000/api/candidato/'+this.id, {                
        })
        .then(response => {
           this.nome = response.data.nome;
           this.email = response.data.email;
           this.idade = response.data.idade;
           this.linkedin = response.data.linkedin;
           this.tecnologias = response.data.tecnologias;
            console.log(response.data)            
        })
      .catch(e => {
        alert("Erro! Tente novamente mais tarde!");
      })
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
