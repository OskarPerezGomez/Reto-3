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
import { ref, onMounted } from 'vue';
import axios from 'axios';

// Crear una referencia reactiva para almacenar las acciones
const actions = ref([]);

// Al montar el componente, hacer la solicitud a la API de Laravel
onMounted(() => {
  axios
      .get('http://127.0.0.1:8000/api/action/actions')  // URL de la API en Laravel
      .then((response) => {
        actions.value = response.data;  // Almacenar las acciones en la referencia reactiva
        console.log(actions.value)
      })
      .catch((error) => {
        console.error('Error al obtener las actividades:', error);
        if (error.response) {
          // El servidor respondió con un código de error
          console.error('Respuesta del servidor:', error.response);
        } else if (error.request) {
          // La solicitud fue realizada, pero no se recibió respuesta
          console.error('No se recibió respuesta:', error.request);
        } else {
          // Otro tipo de error
          console.error('Error al configurar la solicitud:', error.message);
        }
      });
});

// Métodos para manejar las acciones (editar y eliminar)
const editAction = (action) => {
  console.log('Editar acción:', action);
};

const deleteAction = (id) => {
  console.log('Borrar acción con ID:', id);
};
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
