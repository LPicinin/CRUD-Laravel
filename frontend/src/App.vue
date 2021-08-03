<template>
  <div id="app">
    
    <nav>
      <li>
        <a><router-link to="/home">Go to Foo</router-link></a>
      </li>
      <li>
        <router-link to="/especialidade">Go to Bar</router-link>
      </li>
    </nav>
    <router-view></router-view>
    <img alt="Vue logo" src="./assets/logo.png" />
  </div>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
