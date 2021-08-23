<template>
  <div class="medicina">
    <div class="container">
      <div class="row mt-3">
        <div
          class="
            col-12
            border-bottom
            mb-3
            d-flex
            justify-content-between
            align-items-center
          "
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

            <div class="form-group mr-1">
              <div class="sectionEspecialidades">
                <div class="selectEspecialidades">
                  <select v-model="especialidade">
                    <option disabled value="">Escolha uma especialidade</option>
                    <option
                      v-for="item in especialidades"
                      :key="item.id"
                      v-bind:value="{ id: item.id, nome: item.nome }"
                    >
                      {{ item.nome }}
                    </option>
                  </select>
                  <button
                    class="btn btn-primary"
                    @click.prevent="adicionaEspecialidade"
                  >
                    Add
                  </button>
                </div>
                <div class="sectionEspecialidadesMedico">
                  <div
                    class="chip"
                    v-for="item in medico.especialidades"
                    :key="item.id"
                  >
                    {{ item.nome }}
                    <span
                      class="closebtn"
                      @click.prevent="removeEspecialidade(item.id)"
                      >&times;</span
                    >
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group ml-1 botoes">
              <button
                v-if="!isEdit"
                class="btn btn-lg btn-rounded btn-success"
                @click.prevent="cadastrar()"
              >
                Cadastrar medico
              </button>
              <button
                v-if="isEdit"
                class="btn btn-lg btn-rounded btn-primary"
                @click.prevent="atualizar()"
              >
                Atualizar medico
              </button>
              <button
                v-if="isEdit"
                class="btn btn-lg btn-rounded btn-danger"
                @click.prevent="cancelar"
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
                <button
                  type="button"
                  class="btn btn-primary"
                  @click.prevent="busca"
                >
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
            <div class="col-12 mb-2" v-for="item in medicos" :key="item.id">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ item.nome }}</h5>

                  <p class="card-text">
                    <b>CRM: </b>{{ item.CRM }} <br />
                    <b>Telefone: </b>{{ item.telefone }}<br />
                    <b>E-mail: </b>{{ item.email }}<br />
                    <b>Data de Cadastro: </b>{{ item.dt_cadastro }}<br />
                    <b>Especialidades: </b>
                    {{ getEspecialidades(item.especialidades) }}<br />
                  </p>

                  <a
                    href="#"
                    class="btn btn-sm btn-primary"
                    @click.prevent="editmedico(item)"
                    >EDITAR</a
                  >
                  <a
                    href="#"
                    class="btn btn-sm btn-danger"
                    @click.prevent="deletemedico(item.id)"
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
  </div>
</template>

<script>
import api from '../api';

export default {
  name: 'Medicina',
  data() {
    return {
      queryBusca: '',
      isEdit: false,
      ex: 'CRUD',
      resposta: {
        show: false,
        mensagem: '',
      },
      name: 'Médicos',
      especialidade: {},
      especialidades: [],
      medicos: [],
      medico: {
        id: 1,
        nome: '',
        CRM: '',
        telefone: '',
        email: '',
        dt_cadastro: '',
        especialidades: [],
      },
    };
  },
  mounted() {
    api.get('especialidades').then((response) => {
      this.especialidades = response.data;
      console.log(response.data);
    });
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
        nome: '',
        descricao: '',
      });
    },
    refresh() {
      api.get('medicos').then((response) => {
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
        .post('medico', {
          nome: this.medico.nome,
          CRM: this.medico.CRM,
          telefone: this.medico.telefone,
          email: this.medico.email,
          especialidades: this.medico.especialidades.map((es) => es.id),
        })
        .then((response) => {
          console.log(response);
          this.resposta = {
            show: true,
            mensagem: `${this.medico.nome} cadastrado com sucesso!`,
          };
          this.estadoInicial();
          this.refresh();
        })
        .catch((e) => {
          console.log(`Erro: ${e.message}`);
        });
    },
    atualizar() {
      api
        .put('medico', {
          id: this.medico.id,
          nome: this.medico.nome,
          CRM: this.medico.CRM,
		  dt_cadastro: this.medico.dt_cadastro,
          telefone: this.medico.telefone,
          email: this.medico.email,
          especialidades: this.medico.especialidades.map((es) => es.id),
        })
        .then(() => {
          this.estadoInicial();
          this.refresh();
        });
    },
    busca() {
      api.get(`medicos?nome=${this.queryBusca}`).then((response) => {
        this.medicos = response.data;
      });
    },
    adicionaEspecialidade() {
      console.log(this.especialidade.id);
      if (this.medico.especialidades.indexOf(this.especialidade) === -1) {
        this.medico.especialidades.push(this.especialidade);
      }
      this.especialidade = {};
    },
    removeEspecialidade(id) {
      console.log(`Remover especialidade ${id}`);
      const narr = [];
      this.medico.especialidades.forEach((value) => {
        if (value.id !== id) narr.push(value);
      });
      this.medico.especialidades = narr;
    },
    getEspecialidades(espec) {
      return espec.map((es) => es.nome).toString();
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
.sectionEspecialidades {
  display: flex;
  flex-direction: column;
  margin-top: 1em;
}
.selectEspecialidades {
  display: flex;
  flex-direction: row;
}
.chip {
  display: inline-block;
  padding: 0 25px;
  height: 50px;
  font-size: 16px;
  line-height: 50px;
  border-radius: 25px;
  background-color: #f1f1f1;
}

.chip img {
  float: left;
  margin: 0 10px 0 -25px;
  height: 50px;
  width: 50px;
  border-radius: 50%;
}
.sectionEspecialidadesMedico {
  display: flex;
  flex-direction: row;
}
</style>
