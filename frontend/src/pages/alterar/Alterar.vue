<template>
<login-template>
    <span slot="menuesquerdo">
        <img src="https://cakeerp.com/wp-content/uploads/2019/10/capa-2-1080x675.png" class="responsive-img" />
    </span>
    <span slot="principal">
       
        <h2>Alteração</h2>
        <input type="text" placeholder="Nome" value="" v-model="nome">
                <input type="text" placeholder="E-mail" value="" v-model="email">
                <input type="text" placeholder="Idade" value="" v-model="idade">
                <input type="text" placeholder="linkedin" value="" v-model="linkedin">        
                <input type="text" placeholder="tecnologias" value="" v-model="tecnologias">        
                 <div>
        <label class="typo__label">Tecnologias</label>
        <multiselect @remove="remover" @select="toggleSelected" v-model="value" tag-placeholder="Adicionar uma nova tecnologia" placeholder="Buscar uma tecnologia" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
        </div>
        <button type="button" class="btn" v-on:click="cadastro()">Atualizar</button>
        <router-link class="btn orange" to="/login">Já tenho conta</router-link>
    </span>
   
</login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';
import Multiselect from 'vue-multiselect'
import Router from 'vue-router'

export default {
  name: 'Alterar',
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
            axios.post( 'http://localhost:8000/api/atualizar/'+this.id, {
            nome: this.nome,
            email: this.email,
            idade: this.idade,
            linkedin: this.linkedin,
            tecnologias: this.tecnologias            
        })
        .then(response => {
              console.log('Cadastro realizado com sucesso');
              this.$router.push('/');
        })
      .catch(e => {
        alert("Erro! Tente novamente mais tarde!");
      })
    },
    remover(value, id){
      this.tecnologias = this.tecnologias.replace(value.name + ",", " ");
      this.value = this.tecnologias;
    },
      toggleSelected(value, id) {
        if(this.tecnologias == ""){
          this.tecnologias = value.name;
        }else{
          this.tecnologias = this.tecnologias + ", " + value.name;
        }
      },
      addTag (newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },
  },
    mounted(){   
        axios.get('http://localhost:8000/api/candidato/'+this.id, {                
        })
        .then(response => {
          if(sessionStorage.getItem('usuario')){
           this.nome = response.data.nome;
           this.email = response.data.email;
           this.idade = response.data.idade;
           this.linkedin = response.data.linkedin;
           this.tecnologias = response.data.tecnologias;
           let tec = this.tecnologias.split(",");
           for(let i = 0; i < tec.length; i++){
            this.value.push({ name: tec[i].slice(tec.indexOf(",") + 1) });
           }           
            console.log(this.value)            
            }else{
          this.$router.push('/login');
        }
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
