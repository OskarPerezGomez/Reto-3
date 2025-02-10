<script setup>
import { RouterLink, RouterView } from 'vue-router'
import encabezado from './components/admin/AdminPanel.vue'
import pie from './components/layout/Footer.vue'
</script>

<template>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <body class="container text-center">

    <div class="row">
      <header class="col-12"> <encabezado/> </header>
    </div>




  <div class="col-12">
    <footer> <pie/> </footer>
  </div>

  </body>

</template>

<style scoped>


</style>
