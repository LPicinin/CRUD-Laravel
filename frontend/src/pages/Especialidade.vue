<template>
  <main-layout>
    <div class="container">
      <div class="row mt-5">
        <div
          class="col-12 border-bottom mb-5 d-flex justify-content-between align-items-center"
        >
          <h2 :title="ex">{{ name }}</h2>
          <p>{{ especialidadesCount }}</p>
        </div>

        <div class="col-4">
          <form action="">
            <div class="form-group mr-1 campo">
              <label>Nome:</label>
              <input
                type="text"
                class="form-control"
                placeholder="Nome aqui..."
                v-model="especialidade.nome"
              />
            </div>

            <div class="form-group mr-1 campo">
              <label>Descrição</label>
              <textarea
                rows="5"
                class="form-control"
                placeholder="Descrição aqui..."
                v-model="especialidade.descricao"
              />
            </div>

            <div class="form-group ml-1 botoes">
              <button
                v-if="!isEdit"
                class="btn btn-lg btn-rounded btn-success"
                @click="cadastrar()"
              >
                Criar Especialidade
              </button>
              <button
                v-if="isEdit"
                class="btn btn-lg btn-rounded btn-primary"
                @click="atualizar(especialidade)"
              >
                Atualizar Especialidade
              </button>
              <button
                v-if="isEdit"
                class="btn btn-lg btn-rounded btn-danger"
                @click="cancelar"
              >
                Cancelar
              </button>
            </div>
          </form>
        </div>

        <div class="col-8 border-left">
          <div class="contact" v-if="especialidades.length">
            <!--Campo de busca-->
            <div class="campoBusca">
              <div class="input-group">
                <div class="form-outline">
                  <input
                    type="search"
                    id="form1"
                    class="form-control"
                    placeholder="Busca"
                    v-model="queryBusca"
                  />
                </div>
                <button type="button" class="btn btn-primary" @click="busca">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
            <div
              class="col-12 mb-2"
              v-for="item in especialidades"
              :key="item.id"
            >
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ item.nome }}</h5>

                  <p class="card-text">
                    {{ item.descricao }}
                  </p>

                  <a
                    href="#"
                    class="btn btn-sm btn-primary"
                    @click="editEspecialidade(item)"
                    >EDITAR</a
                  >
                  <a
                    href="#"
                    class="btn btn-sm btn-danger"
                    @click="deleteEspecialidade(item.id)"
                    >DELETAR</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div v-else>Nenhum contato encontrado!</div>
        </div>
      </div>
    </div>
  </main-layout>
</template>
<script>
import MainLayout from "../layouts/Main.vue";
import api from "../api";

export default {
  components: {
    "main-layout": MainLayout,
  },
  data() {
    return {
      queryBusca: "",
      isEdit: false,
      ex: "CRUD",
      resposta: {
        show: false,
        mensagem: "",
      },
      name: "Especialidades",
      especialidades: [],
      especialidade: {
        id: 0,
        nome: "",
        descricao: "",
      },
    };
  },
  mounted() {
    this.refresh();
  },
  computed: {
    especialidadesCount() {
      return `Total de especialidades é ${this.especialidades.length}`;
    },
  },
  methods: {
    estadoInicial() {
      (this.isEdit = false),
        (this.especialidade = {
          id: 0,
          nome: "",
          descricao: "",
        });
    },
    refresh() {
      api.get("especialidades").then((response) => {
        this.especialidades = response.data;
      });
    },
    cancelar() {
      this.estadoInicial();
      this.refresh();
    },
    deleteEspecialidade(id) {
      api.delete(`especialidade/${id}`).then((response) => {
        console.log(response.data);
        this.refresh();
      });
    },
    editEspecialidade(especialidade) {
      this.especialidade = especialidade;
      this.isEdit = true;
    },
    cadastrar() {
      api
        .post("especialidade", {
          nome: this.especialidade.nome,
          descricao: this.especialidade.descricao,
        })
        .then((response) => {
          console.log(response.status);
          this.resposta = {
            show: true,
            mensagem: `${this.especialidade.nome} cadastrado com sucesso!`,
          };
          this.estadoInicial();
          this.refresh();
        })
        .catch((e) => {
          console.log("Erro: " + e.message);
        });
    },
    atualizar(especialidade) {
      this.especialidade.nome = especialidade.nome;
      this.especialidade.descricao = especialidade.descricao;
      api.put("especialidade", this.especialidade).then(() => {
        this.estadoInicial();
        this.refresh();
      });
    },
    busca() {
      api.get(`especialidades?nome=${this.queryBusca}`).then((response) => {
        this.especialidades = response.data;
      });
    },
  },
};
</script>

<style scoped>
.campo {
  margin-top: 1em;
  display: flex;
  flex-direction: column;
}
.botoes {
  margin-top: 1em;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-content: space-between;
}
.campoBusca {
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  justify-content: flex-end;
}

</style>
