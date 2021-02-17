<template>
<login-template>
    <span slot="menuesquerdo">
        <img src="https://cakeerp.com/wp-content/uploads/2019/10/capa-2-1080x675.png" class="responsive-img" />
    </span>
    <span slot="principal">
       
        <h2>Cadastro</h2>
                <input type="text" placeholder="Nome" value="" v-model="name">
                <input type="text" placeholder="E-mail" value="" v-model="email">
                <input type="text" placeholder="Idade" value="" v-model="idade">
                <input type="text" placeholder="linkedin" value="" v-model="linkedin">
        <div>
        <label class="typo__label">Tecnologias</label>
        <multiselect v-model="value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
        </div>
        <button type="button" class="btn" v-on:click="cadastro()">Enviar</button>
        <router-link class="btn orange" to="/login">Já tenho conta</router-link>
    </span>
   
</login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';
import Multiselect from 'vue-multiselect'

export default {
  name: 'Cadastro',
  data () {
    return {
       name:'',
       email:'',
       password:'',
       password_confirmation:'',
       value: [
        { name: 'Javascript', code: 'js' }
      ],
      options: [
        { name: 'Vue.js', code: 'vu' },
        { name: 'Javascript', code: 'js' },
        { name: 'Open Source', code: 'os' }
      ]
    }
  },
  components:{
      Multiselect,
    LoginTemplate
  },
  methods:{
      addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },
      cadastro(){
            axios.post( 'http://localhost:8000/api/cadastro', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
        })
        .then(response => {
            //console.log(response)
            if(response.data.token){
              // login com sucesso
              console.log('Cadastro realizado com sucesso');
              sessionStorage.setItem('usuario',JSON.stringify(response.data));
              this.$router.push('/');
            }else if(response.data.status == false){
              // login não existe
              alert('Erro no cadastro! tente novamente mais tarde.');
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
