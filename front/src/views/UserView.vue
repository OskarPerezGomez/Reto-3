<script>
import encabezado from "../components/layout/Header.vue"
import pie from '../components/layout/Footer.vue';
import filtersUser from '../components/user/filters/filtersUser.vue'
import userActivity from '../components/user/activities/userActivity.vue'

</script>

<template>

  <body class="container text-center">

  <div class="row">
    <header class="col-12"> <encabezado/> </header>
  </div>
  <div class="row">
    <div class="col-12"><filtersUser/></div>
  </div>
  <div class="row">
    <footer class="col-12"> <pie/> </footer>
  </div>

  </body>

</template>

<style scoped>


</style>