<template>
  <home-template>
    <span slot="principal">
      <div id="wrap-btn-adicinar">
        <h5 id="titulo-adicionar-candidato">Adicionar novo candidato</h5>
        <b-button
          size="sm"
          @click="$router.push('cadastro')"
          class="btn-adicionar mr-1"
        >
          Adicionar
        </b-button>
      </div>
      <div id="wrap-tabela">
        <b-container fluid>
          <!-- User Interface controls -->
          <b-row>
            <b-col lg="6" class="my-1">
              <b-form-group
                label="Ordenar"
                label-for="sort-by-select"
                label-cols-sm="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-0"
                v-slot="{ ariaDescribedby }"
              >
                <b-input-group size="sm">
                  <b-form-select
                    id="sort-by-select"
                    v-model="sortBy"
                    :options="sortOptions"
                    :aria-describedby="ariaDescribedby"
                    class="w-75"
                  >
                    <template #first>
                      <option value="">-- Nenhum --</option>
                    </template>
                  </b-form-select>

                  <b-form-select
                    v-model="sortDesc"
                    :disabled="!sortBy"
                    :aria-describedby="ariaDescribedby"
                    size="sm"
                    class="w-25"
                  >
                    <option :value="false">Asc</option>
                    <option :value="true">Desc</option>
                  </b-form-select>
                </b-input-group>
              </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
              <b-form-group
                label="Ordenar"
                label-for="initial-sort-select"
                label-cols-sm="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-0"
              >
                <b-form-select
                  id="initial-sort-select"
                  v-model="sortDirection"
                  :options="['crescente', 'decrescente', 'último']"
                  size="sm"
                ></b-form-select>
              </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
              <b-form-group
                label="Filtro"
                label-for="filter-input"
                label-cols-sm="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-0"
              >
                <b-input-group size="sm">
                  <b-form-input
                    id="filter-input"
                    v-model="filter"
                    type="search"
                    placeholder="Digite para buscar"
                  ></b-form-input>

                  <b-input-group-append>
                    <b-button :disabled="!filter" @click="filter = ''"
                      >Buscar</b-button
                    >
                  </b-input-group-append>
                </b-input-group>
              </b-form-group>
            </b-col>

            <b-col lg="6" class="my-1">
              <b-form-group
                v-model="sortDirection"
                label="Filtro"
                description="Deixe desmarcado para filtrar todos os dados"
                label-cols-sm="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-0"
                v-slot="{ ariaDescribedby }"
              >
                <b-form-checkbox-group
                  v-model="filterOn"
                  :aria-describedby="ariaDescribedby"
                  class="mt-1"
                >
                  <b-form-checkbox value="nome">Nome</b-form-checkbox>
                  <b-form-checkbox value="email">E-mail</b-form-checkbox>
                  <b-form-checkbox value="idade">Idade</b-form-checkbox>
                  <b-form-checkbox value="linkedin">Linkedin</b-form-checkbox>
                  <b-form-checkbox value="tecnologias"
                    >Tecnologias</b-form-checkbox
                  >
                </b-form-checkbox-group>
              </b-form-group>
            </b-col>

            <b-col sm="5" md="6" class="my-1">
              <b-form-group
                label="Por página"
                label-for="per-page-select"
                label-cols-sm="6"
                label-cols-md="4"
                label-cols-lg="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-0"
              >
                <b-form-select
                  id="per-page-select"
                  v-model="perPage"
                  :options="pageOptions"
                  size="sm"
                ></b-form-select>
              </b-form-group>
            </b-col>

            <b-col sm="7" md="6" class="my-1">
              <b-pagination
                v-model="currentPage"
                :total-rows="totalRows"
                :per-page="perPage"
                align="fill"
                size="sm"
                class="my-0"
              ></b-pagination>
            </b-col>
          </b-row>

          <!-- Main table element -->
          <b-table
            :items="items"
            :fields="fields"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filter-included-fields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            stacked="md"
            show-empty
            small
            @filtered="onFiltered"
          >
            <template #cell(name)="row">
              {{ row.value.first }} {{ row.value.last }}
            </template>

            <template #cell(actions)="row">
              <b-button
                size="sm"
                @click="$router.push('alterar/' + row.item.id)"
                class="mr-1"
              >
                Alterar
              </b-button>
              <b-button
                size="sm"
                @click="$router.push('deletar/' + row.item.id)"
                class="mr-1"
              >
                Deletar
              </b-button>
              <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
          Deletar
        </b-button> -->
              <b-button size="sm" @click="row.toggleDetails">
                {{ row.detailsShowing ? "Esconder" : "Mostrar" }} Detalhes
              </b-button>
            </template>

            <template #row-details="row">
              <b-card>
                <ul>
                  <li v-for="(value, key) in row.item" :key="key">
                    {{ key }}: {{ value }}
                  </li>
                </ul>
              </b-card>
            </template>
          </b-table>

          <!-- Info modal -->
          <b-modal
            :id="infoModal.id"
            :title="infoModal.title"
            ok-only
            @hide="resetInfoModal"
          >
            <pre>{{ infoModal.content }}</pre>
          </b-modal>
        </b-container>
      </div>
    </span>
  </home-template>
</template>

<script>
import Vue from "vue";
import HomeTemplate from "@/templates/HomeTemplate";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
// Import Bootstrap an BootstrapVue CSS files (order is important)
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
export default {
  data() {
    return {
      items: [],
      fields: [
        { key: "nome", label: "Nome", sortable: true, sortDirection: "desc" },
        { key: "email", label: "E-mail", sortable: true, class: "text-center" },
        { key: "idade", label: "Idade", sortable: true, class: "text-center" },
        {
          key: "linkedin",
          label: "Linkedin",
          sortable: true,
          class: "text-center",
        },
        {
          key: "tecnologias",
          label: "Tecnologias",
          sortable: true,
          class: "text-center",
        },
        {
          sortable: false,
          sortByFormatted: true,
          filterByFormatted: true,
        },
        { key: "actions", label: "Actions" },
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, { value: 100, text: "'100'" }],
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
      infoModal: {
        id: "info-modal",
        title: "",
        content: "",
      },
    };
  },
  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter((f) => f.sortable)
        .map((f) => {
          return { text: f.label, value: f.key };
        });
    },
  },
  mounted() {
    // Set the initial number of items
    this.$http.get(this.$urlAPI + 'lista')
      .then((response) => {
        if (sessionStorage.getItem("usuario")) {
          console.log(response.data[0].nome);
          this.items = response.data;
          console.log(this.items);
          this.totalRows = this.items.length;
        } else {
          this.$router.push("/login").catch(() => {});
        }
      })
      .catch((error) => {
        console.log(error);
        this.errored = true;
      })
      .finally(() => (this.loading = false));
  },
  methods: {
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = JSON.stringify(item, null, 2);
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
  components: {
    HomeTemplate,
  },
};
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#titulo-adicionar-candidato {
  float: left;
  margin: 10px 0 0 10px;
}
#wrap-btn-adicinar {
  float: left;
  clear: both;
}
.btn-adicionar {
  float: left;
  margin: 10px 0 0 10px;
}
#wrap-tabela {
  float: left;
  margin-top: 10px;
}
</style>
