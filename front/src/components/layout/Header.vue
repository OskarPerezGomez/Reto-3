<script setup>
import {useRouter} from "vue-router";

const router = useRouter();
  function iniciarSesion(){
    router.push({path: "/login"});
  }
</script>

<template>
    <div class="row justify-content-center mt-3">

      <div class="col-10">
        <h1>Actividades disponibles</h1>
        <p>Explora y regístrate en nuestras actividades deportivas y culturales</p>
      </div>

      <div class="col-2">
        <button class="btn btn-success" @click="iniciarSesion()">Iniciar sesión</button>
      </div>

    </div>

</template>

<style scoped>

</style>