<template>
  <div class="container mt-4">
    <table class="table table-bordered text-center">
      <thead class="table-light">
      <tr>
        <th>Actividad</th>
        <th>Ubicación</th>
        <th>Fecha</th>
        <th>Precio</th>
        <th>Plazas</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(action, index) in actions" :key="action.id">
        <td><strong>{{ action.name }}</strong></td>
        <td>{{ action.location }}</td>
        <td>{{ action.date }}</td>
        <td>{{ action.price }}€</td>
        <td>{{ action.plazas }}</td>
        <td class="botones">
          <button class="btn btn-sm btn-outline-warning" @click="editAction(action)">
            <img src="../../assets/img/editar.png" alt="editar">
          </button>
          <button class="btn btn-sm btn-outline-danger" @click="deleteAction(action.id)">
            <img src="../../assets/img/goma-de-borrar.png" alt="borrar">
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const actions = ref([]);
const API_SERVER = import.meta.env.VITE_API_SERVER

const fetchActions = async () => {
  try {
    const response = await axios.get(`${API_SERVER}/api/action/actions`);
    actions.value = response.data.data;
  } catch (error) {
    console.error("Error al obtener las acciones:", error);
    if (error.response) {
      console.error("Respuesta del servidor:", error.response);
    } else if (error.request) {
      console.error("No se recibió respuesta:", error.request);
    } else {
      console.error("Error de configuración:", error.message);
    }
  }
};


onMounted(fetchActions);
</script>

<style scoped>
.botones {
  display: flex;
  justify-content: center;
  gap: 8px;
}

button {
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

button img {
  width: 18px;
}
</style>
