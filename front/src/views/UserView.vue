<script setup>
import encabezado from "../components/layout/Header.vue"
import pie from '../components/layout/Footer.vue';
import filtersUser from '../components/user/filters/filtersUser.vue'
import userActivity from '../components/user/activities/userActivity.vue'

</script>

<template>

  <body class="container text-center d-flex justify-content-center flex-column">

  <div class="row">
    <header class="col-12"> <encabezado/> </header>
  </div>
  <div class="row mt-3">
    <div class="col-12"><filtersUser/></div>
  </div>
  <div class="row mt-3">
    <div class="col-12"><userActivity/></div>
  </div>
  <div class="row mt-3">
    <footer class="col-12"> <pie/> </footer>
  </div>

  </body>

</template>

<style scoped>


</style>