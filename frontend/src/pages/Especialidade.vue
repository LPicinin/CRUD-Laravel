<template>
  <main-layout>
    <div class="container">
      <h1>Páginda Especialidade</h1>
      <div class="container">
        <div class="barraBotoes">
          <div class="busca">
            <input type="search" id="form1" class="form-control" />
            <button type="button" class="btn btn-primary">
              <i class="bi bi-search"></i>
            </button>
            <button
              type="button"
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#insertModal"
            >
              <i class="bi bi-plus-circle"></i>Add
            </button>
          </div>
          <div class="container">
            <!-- Modal para inserir cadastro -->
            <div
              class="modal fade"
              id="insertModal"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                      Cadastro de especialidade
                    </h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div
                        v-if="resposta.show"
                        class="alert alert-success"
                        role="alert"
                      >
                        {{ resposta.mensagem }}
                      </div>
                      <div class="mb-3">
                        <label for="formnome" class="form-label">Nome:</label>
                        <input
                          type="text"
                          class="form-control"
                          id="formnome"
                          placeholder=""
                          v-model="especialidade.nome"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="formDescricao" class="form-label"
                          >Descrição:
                        </label>
                        <textarea
                          type="text"
                          class="form-control"
                          id="formDescricao"
                          placeholder=""
                          v-model="especialidade.descricao"
                          required
                        />
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      Cancelar
                    </button>
                    <button
                      type="button"
                      class="btn btn-primary"
                      v-on:click="cadastrar"
                    >
                      Cadastrar
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th style="width: 5%">#</th>
            <th style="width: 25%">Nome</th>
            <th style="width: 55%">Descrição</th>
            <th style="width: 15%">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in especialidades" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.nome }}</td>
            <td>{{ item.descricao }}</td>
            <td>
              <div class="tabelaOpcoes">
                <button class="btn btn-primary">
                  <i class="bi bi-plus-circle">Editar</i>
                </button>
                <button class="btn btn-danger" v-on:click="excluir(item.id)">
                  <i class="bi bi-dash-circle">Excluir</i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main-layout>
</template>
<style scoped src="../css/especialidade.css"></style>
<script>
import MainLayout from "../layouts/Main.vue";
import api from "../api";

export default {
  name: "Especialidade",
  components: {
    "main-layout": MainLayout,
  },
  data() {
    return {
      resposta: {
        show: false,
        mensagem: "",
      },
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
  methods: {
    estadoInicial() {
      this.especialidade = {
        id: 0,
        nome: "",
        descricao: "",
      };
    },
    refresh() {
      api.get("especialidades").then((response) => {
        this.especialidades = response.data;
      });
    },
    excluir(id) {
      api.delete(`especialidade/${id}`).then(() => {
        this.refresh();
      });
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
  },
};
</script>
