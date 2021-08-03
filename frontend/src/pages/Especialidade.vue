<template>
  <main-layout>
    <p>Especialidades</p>
    <button v-on:click="insere">{{ message }}</button>
    <p>{{ especialidades }} {{flag}}</p>
  </main-layout>
</template>

<script>
import MainLayout from "../layouts/Main.vue";
import api from "../api";
export default {
  components: {
    MainLayout,
  },
  data() {
    return {
      message: "olá",
      especialidades: [],
      flag: false
    };
  },
  mounted() {
    api
      .get("especialidades")
      .then((response) => (this.especialidades = response.data))
      .catch((err) => {
        console.log("Erro " + err);
      });
  },
  methods: {
    refresh() {
      api
        .get("especialidades")
        .then((response) => (this.especialidades = response.data))
        .catch((err) => {
          console.log("Erro " + err);
        });
    },
    insere() {
      api
        .post("especialidade/", {
          nome: "Ribeiro5",
          descricao: "Rib",
        })
        .then((response) => {
          if (response.status != 200) {
            console.log(response.data);
          }
        })
        .catch((err) => {
          console.log("Erro " + err);
        });
      this.refresh();
      this.flag=true;
    },
  },
};
</script>