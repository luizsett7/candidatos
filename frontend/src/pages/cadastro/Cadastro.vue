<template>
  <login-template>
    <span slot="menuesquerdo">
      <img
        src="https://cakeerp.com/wp-content/uploads/2019/10/capa-2-1080x675.png"
        class="responsive-img"
      />
    </span>
    <span slot="principal">
      <h2>Cadastro</h2>
      <input type="text" placeholder="Nome" value="" v-model="nome" />
      <input type="text" placeholder="E-mail" value="" v-model="email" />
      <input type="text" placeholder="Idade" value="" v-model="idade" />
      <input type="text" placeholder="linkedin" value="" v-model="linkedin" />
      <div>
        <label class="typo__label">Tecnologias</label>
        <multiselect
          @select="toggleSelected"
          v-model="value"
          tag-placeholder="Adicionar uma nova tecnologia"
          placeholder="Buscar uma tecnologia"
          label="name"
          track-by="code"
          :options="options"
          :multiple="true"
          :taggable="true"
          @tag="addTag"
        ></multiselect>
      </div>
      <button type="button" class="btn" v-on:click="cadastro()">
        Cadastrar
      </button>
    </span>
  </login-template>
</template>

<script>
import LoginTemplate from "@/templates/LoginTemplate";
import Multiselect from "vue-multiselect";

export default {
  name: "Cadastro",
  data() {
    return {
      usuario: false,
      nome: "",
      email: "",
      idade: "",
      linkedin: "",
      tecnologias: "",
      value: [],
      options: [
        { name: "C#", code: "d" },
        { name: "Javascript", code: "js" },
        { name: "Nodejs", code: "nj" },
        { name: "Angular", code: "an" },
        { name: "React", code: "rc" },
        { name: "Ionic", code: "ic" },
        { name: "Mensageria", code: "ms" },
        { name: "PHP", code: "ph" },
        { name: "Laravel", code: "lr" },
      ],
    };
  },
  components: {
    Multiselect,
    LoginTemplate,
  },
  created() {
    let usuarioAux = sessionStorage.getItem("usuario");
    if (usuarioAux) {
      this.usuario = JSON.parse(usuarioAux);
    } else {
      this.$router.push("/login");
    }
  },
  methods: {
    toggleSelected(value, id) {
      if (this.tecnologias == "") {
        this.tecnologias = value.name;
      } else {
        this.tecnologias = this.tecnologias + ", " + value.name;
      }
    },
    addTag(newTag) {
      const tag = {
        name: newTag,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
      };
      this.options.push(tag);
      this.value.push(tag);
    },
    cadastro() {
      if (sessionStorage.getItem("usuario")) {
        this.$http.post(this.$urlAPI + 'cadastro', {
            nome: this.nome,
            email: this.email,
            idade: this.idade,
            linkedin: this.linkedin,
            tecnologias: this.tecnologias,
          })
          .then((response) => {
            //console.log(response)
            if (response.data.email) {
              // login com sucesso
              console.log("Cadastro realizado com sucesso");
              this.$router.push("/");
            } else if (response.data.status == false) {
              // login não existe
              alert("Erro no cadastro! tente novamente mais tarde.");
            } else {
              // erros da validação
              console.log("erros de validação");
              let erros = "";
              for (let erro of Object.values(response.data)) {
                erros += erro + " ";
              }
              alert(erros);
            }
          })
          .catch((e) => {
            alert("Erro! Tente novamente mais tarde!");
          });
      } else {
        this.$router.push("/login");
      }
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
