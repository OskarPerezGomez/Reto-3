<script setup>
import {useRouter} from "vue-router";
const user = sessionStorage.getItem('user');
const router = useRouter();
  function iniciarSesion(){
    router.push({path: "/login"});
  }
  function cerrarSesion(){
    sessionStorage.clear();
    location.reload();
  }
</script>

<template>
  <div class="row justify-content-center mt-3">
    <div class="col-12 d-flex justify-content-between align-items-center mt-2 mb-5">
      <div class="text-center flex-grow-1">
        <h1>Actividades disponibles</h1>
        <p>Explora y regístrate en nuestras actividades deportivas y culturales</p>
      </div>
      <div v-if="!user">
      <button class="btn btn-success" @click="iniciarSesion()">Iniciar sesión</button>
      </div>
      <div v-if="user">
        <button class="btn btn-success" @click="cerrarSesion()">Cerrar sesión</button>
        <a href="">Perfil user</a>
      </div>
    </div>
  </div>


</template>

<style scoped>

</style>