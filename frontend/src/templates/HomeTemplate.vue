<template>
  <span>
  <header>
  <nav-bar logo="Candidatos" url="/" cor="green darken-1">
    <li v-if="!usuario"><router-link to="/login">Entrar</router-link></li>
    <li v-if="usuario"><router-link to="/">Home</router-link></li>
    <li v-if="usuario">{{usuario.name}}</li>
    <li v-if="usuario"><a v-on:click="sair()">Sair</a></li>
  </nav-bar>
  </header>
      <main>
      <div class="container">
          <slot name="principal" />
        </div>
      </main>
      <footer-vue cor="green darken-1" logo="Candidatos" descricao="Sistema de cadastro de candidatos" ano="2021">
        <li><router-link class="grey-text text-lighten-3" to="/">Home</router-link></li>
      </footer-vue>

  </span>
</template>

<script>
import NavBar from '@/components/layouts/NavBar'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
  name: 'HomeTemplate',
  data(){
    return {
      usuario: false
    }
  },
  components:{
    NavBar,
    FooterVue,
    GridVue,
    CardMenuVue
  },
  methods:{
      sair(){
          sessionStorage.clear();
          this.usuario = false;
          this.$router.push('/login');
      }
  },
  created(){
      let usuarioAux = sessionStorage.getItem('usuario');
      if(usuarioAux){
        this.usuario = JSON.parse(usuarioAux);
      }
    }
}
</script>

<style>

</style>
