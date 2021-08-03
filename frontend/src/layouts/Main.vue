<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <v-link class="navbar-brand" href="/">Home</v-link>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <v-link class="nav-link" href="/medico">Medicos</v-link>
          </li>
          <li class="nav-item">
            <v-link class="nav-link" href="/especialidade"
              >Especialidades</v-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <slot></slot>
</template>

<script>
import VLink from "../components/VLink.vue";
export default {
  components: {
    VLink,
  },
};
</script>