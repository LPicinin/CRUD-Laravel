<template>
  <main-layout>
    <div class="container">
      <div class="row mt-5">
        <div
          class="col-12 border-bottom mb-5 d-flex justify-content-between align-items-center"
        >
          <h2 :title="ex">{{ name }}</h2>
          <p>{{ medicosCount }}</p>
        </div>

        <div class="col-4">
          <form action="">
            <div class="form-group mr-1 campo">
              <label>Nome:</label>
              <input
                type="text"
                class="form-control"
                placeholder="Nome aqui..."
                v-model="medico.nome"
              />
            </div>

            <div class="form-group mr-1 campo">
              <label>CRM</label>
              <input
                rows="5"
                class="form-control"
                placeholder="CRM aqui..."
                v-model="medico.CRM"
              />
            </div>
            <div class="form-group mr-1 campo">
              <label>Telefone</label>
              <input
                rows="5"
                class="form-control"
                placeholder="Telefone aqui..."
                v-model="medico.telefone"
              />
            </div>
            <div class="form-group mr-1 campo">
              <label>email</label>
              <input
                type="email"
                class="form-control"
                placeholder="Email aqui..."
                v-model="medico.email"
              />
            </div>
            <div class="form-group mr-1 campo">
              <label>Data de cadastro</label>
              <input
                type="date"
                class="form-control"
                placeholder="Data de cadastro aqui..."
                v-model="medico.dt_cadastro"
              />
            </div>

            <div class="form-group ml-1 botoes">
              <button
                v-if="!isEdit"
                class="btn btn-lg btn-rounded btn-success"
                @click="cadastrar()"
              >
                Criar medico
              </button>
              <button
                v-if="isEdit"
                class="btn btn-lg btn-rounded btn-primary"
                @click="atualizar(medico)"
              >
                Atualizar medico
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
          <div class="contact" v-if="medicos.length">
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
              v-for="item in medicos"
              :key="item.id"
            >
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ item.nome }}</h5>

                  <p class="card-text">
                    <b>CRM: </b>{{ item.CRM }} <br>
                    <b>Telefone: </b>{{item.telefone}}<br>
                    <b>E-mail: </b>{{item.email}}<br>
                    <b>Data de Cadastro: </b>{{item.dt_cadastro}}<br>
                  </p>

                  <a
                    href="#"
                    class="btn btn-sm btn-primary"
                    @click="editmedico(item)"
                    >EDITAR</a
                  >
                  <a
                    href="#"
                    class="btn btn-sm btn-danger"
                    @click="deletemedico(item.id)"
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
      name: "Médicos",
      medicos: [],
      medico: {
        id: 1,
        nome: "",
        CRM: "",
        telefone: "",
        email: "",
        dt_cadastro: ""
      },
    };
  },
  mounted() {
    this.refresh();
  },
  computed: {
    medicosCount() {
      return `Total de médicos é ${this.medicos.length}`;
    },
  },
  methods: {
    estadoInicial() {
      (this.isEdit = false),
        (this.medico = {
          id: 0,
          nome: "",
          descricao: "",
        });
    },
    refresh() {
      api.get("medicos").then((response) => {
        this.medicos = response.data;
      });
    },
    cancelar() {
      this.estadoInicial();
      this.refresh();
    },
    deletemedico(id) {
      api.delete(`medico/${id}`).then((response) => {
        console.log(response.data);
        this.refresh();
      });
    },
    editmedico(medico) {
      this.medico = medico;
      this.isEdit = true;
    },
    cadastrar() {
      api
        .post("medico", {
          nome: this.medico.nome,
          descricao: this.medico.descricao,
        })
        .then((response) => {
          console.log(response.status);
          this.resposta = {
            show: true,
            mensagem: `${this.medico.nome} cadastrado com sucesso!`,
          };
          this.estadoInicial();
          this.refresh();
        })
        .catch((e) => {
          console.log("Erro: " + e.message);
        });
    },
    atualizar(medico) {
      this.medico.nome = medico.nome;
      this.medico.descricao = medico.descricao;
      api.put("medico", this.medico).then(() => {
        this.estadoInicial();
        this.refresh();
      });
    },
    busca() {
      api.get(`medicos?nome=${this.queryBusca}`).then((response) => {
        this.medicos = response.data;
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
