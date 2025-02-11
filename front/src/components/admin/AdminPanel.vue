<template>
  <div class="container mt-4">
    <table class="table table-bordered text-center">
      <thead class="table-light">
      <tr>
        <th>Actividad</th>
        <th>Centro</th>
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
        <td>{{ action.center_name }}</td>
        <td>{{ action.center_address }}</td>
        <td>{{ action.date_init }}</td>
        <td>{{ action.price }}€</td>
        <td>{{ action.capacity }}</td>
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

// Definir las variables
const actions = ref([]);
const API_SERVER = import.meta.env.VITE_API_SERVER;

// Función para obtener las acciones
const fetchActions = async () => {
  try {
    const response = await axios.get(`${API_SERVER}/api/action/center`);
    actions.value = response.data.data;
  } catch (error) {
    console.error("Error al obtener las acciones:", error);
  }
};

// Función para eliminar una acción
const deleteAction = async (id) => {
  if (confirm("¿Estás seguro de que deseas eliminar esta acción?")) {
    try {
      await axios.delete(`${API_SERVER}/api/action/${id}/destroy`);
      actions.value = actions.value.filter(action => action.id !== id);
      alert("Acción eliminada con éxito");
    } catch (error) {
      console.error("Error al eliminar la acción:", error);
      alert("Hubo un error al eliminar la acción");
    }
  }
};

// Cargar las acciones cuando se monta el componente
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
