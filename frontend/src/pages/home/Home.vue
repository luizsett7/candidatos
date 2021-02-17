<template>
<site-template>
  <span slot="menuesquerdo">
    <div class="row valign-wrapper">
            <grid-vue tamanho="4">
            </grid-vue>
            <grid-vue tamanho="8">
              <span class="black-text">
                <h5>{{usuario.name}}</h5>
              </span>
            </grid-vue>
          </div>
  </span>
  <span slot="principal">
    
  </span>
</site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import GridVue from '@/components/layouts/GridVue'

export default {
  name: 'Home',
  data () {
    return {
      usuario:false
    }
  },
  created(){
    let usuarioAux = sessionStorage.getItem('usuario');
    if(usuarioAux){
      this.usuario = JSON.parse(usuarioAux);
    }
  },
  components:{
    SiteTemplate,
    GridVue,
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
