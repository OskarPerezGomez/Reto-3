<script setup>
import { ref } from "vue";
import axios from "axios";

const mail = ref("");
const pass = ref("");
const users = ref([]);
const API_SERVER = import.meta.env.VITE_API_SERVER; // Asegúrate de que la variable esté en .env
async function validarUsuario() {
  this.error = null;
  this.isLoading = true;
  try {
    const response = await axios.post(
        `${API_SERVER}/api/auth/login`,
        {
          email: mail.value,
          password: pass.value,
        }
    );
    sessionStorage.setItem('token', response.data.access_token);
    sessionStorage.setItem('user', JSON.stringify(response.data.user));
    const expiresIn = 3600;
    const expirationTime =  Date.now() + expiresIn * 1000;
    sessionStorage.setItem('token_expiration', expirationTime);
    setTimeout(() => {
      sessionStorage.removeItem('token');
      sessionStorage.removeItem('token_expiration');
      sessionStorage.removeItem('user');
      alert('Tu sesión ha caducado. Por favor, inicia sesión de nuevo.');
      this.$router.push({ name: 'login' });
    }, expiresIn * 1000);
    const userId = response.data.user.id;
    const userRole = response.data.user.role;
    if (userRole === 'tecnico') {
      this.$router.push(`/tecnico/${userId}`);
    } else if (userRole === 'admin') {
      this.$router.push(`/admin/${userId}`);
    } else {
      this.$router.push(`/user/${userId}`);
    }
  } catch (err) {
    this.error = err.response?.data?.error || 'Ha ocurrido un error.';
  } finally {
    this.isLoading = false;
  }
};




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
                id="pass"
                v-model="pass"
                class="form-control"
                placeholder=" "
            />
            <label for="email">Contraseña</label>
          </div>
        </div>

        <button class="btn btn-success w-75 mx-auto my-2" @click="validarUsuario()">Iniciar sesión</button>

        <p class="mt-3 text-muted">
          Registrate y explora nuestras actividades deportivas y culturales
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
  top: 30%; /* Centrado verticalmente */
  left: 0.75rem;
  transform: translateY(-30%);
  font-size: 1rem;
  color: #6c757d;
  transition: all 0.2s ease-in-out;
  background-color: white; /* Fondo transparente antes de hacer clic */
  padding: 0;
  z-index: 2;
  height: auto;
  pointer-events: none;
}

.form-floating input:focus ~ label,
.form-floating input:not(:placeholder-shown) ~ label {
  top: -0.3rem;
  font-size: 1rem;
  color: black;
  background-color: white;
  z-index: 1000;
}

</style>
