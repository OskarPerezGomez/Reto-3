<script setup>
import { ref } from "vue";
const mail = ref("");
const pass = ref("");


function validarUsuario(){

}
</script>

<template>
  <div class="container text-center d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4 w-50">
      <div class="card-body">
        <h3 class="card-title mb-3">Iniciar sesión</h3>

        <div class="mb-3">
          <div class="form-floating w-75 mx-auto">
            <input
                type="email"
                id="email"
                v-model="mail"
                class="form-control"
                placeholder=" "
            />
            <label for="email">Correo electrónico</label>
          </div>
        </div>

        <div class="mb-3">
          <div class="form-floating w-75 mx-auto">
            <input
                type="password"
                id="email"
                v-model="pass"
                class="form-control"
                placeholder=" "
            />
            <label for="email">Contraseña</label>
          </div>
        </div>

        <button class="btn btn-success w-75 mx-auto my-2" @click="validarUsuario()">Iniciar sesión</button>

        <p class="mt-3 text-muted">
          Explora y regístrate en nuestras actividades deportivas y culturales
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.form-floating {
  position: relative;
}

.form-floating input {
  height: 3rem;
  padding: 1rem 0.75rem;
  font-size: 1rem;
}

.form-floating label {
  position: absolute;
  top: 50%; /* Centrado verticalmente */
  left: 0.75rem;
  transform: translateY(-30%);
  font-size: 1rem;
  color: #6c757d;
  transition: all 0.2s ease-in-out;
  background-color: transparent; /* Fondo transparente antes de hacer clic */
  padding: 0 5px;
  z-index: 2;
  pointer-events: none;
}

.form-floating input:focus ~ label,
.form-floating input:not(:placeholder-shown) ~ label {
  top: 0.1rem;
  font-size: 1rem;
  color: #495057;
  padding: 1px;
}

</style>
