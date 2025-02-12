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

    <div v-if="showModal" class="modal-overlay col-10 offset-1 " @click="closeModal">
      <div class="modal-content" @click.stop>
        <h4>Editar Acción</h4>
        <form @submit.prevent="saveAction">
          <div class="form-group col-8 offset-2">
            <label for="name"><b>Nombre</b></label>
            <input v-model="selectedAction.name" id="name" type="text" class="form-control" required />
          </div>
          <div class="form-group col-8 offset-2">
            <label for="date_init"><b>Fecha</b></label>
            <input v-model="selectedAction.date_init" id="date_init" type="date" class="form-control" required />
          </div>
          <div class="form-group col-8 offset-2">
            <label for="price"><b>Precio</b></label>
            <input v-model="selectedAction.price" id="price" type="number" class="form-control" required />
          </div>
          <div class="form-group col-8 offset-2">
            <label for="capacity"><b>Plazas</b></label>
            <input v-model="selectedAction.capacity" id="capacity" type="number" class="form-control" required />
          </div>
          <div class="form-group d-flex justify-content-center mb-2 gap-3 col-8 offset-2">
            <button type="submit" class="btn btn-success mt-3">Guardar Cambios</button>
            <button class="btn btn-danger mt-3" @click="closeModal">Cerrar</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

// Definir las variables
const actions = ref([]);
const API_SERVER = import.meta.env.VITE_API_SERVER;
const showModal = ref(false);
const selectedAction = ref({});

const fetchActions = async () => {
  try {
    const response = await axios.get(`${API_SERVER}/api/action/center`);
    actions.value = response.data.data;
  } catch (error) {
    console.error("Error al obtener las acciones:", error);
  }
};

const editAction = (action) => {
  selectedAction.value = { ...action };
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const saveAction = async () => {
  try {
    const dataToSend = { ...selectedAction.value };

    Object.keys(dataToSend).forEach(key => {
      if (dataToSend[key] === "" || dataToSend[key] === null || dataToSend[key] === undefined) {
        delete dataToSend[key];
      }
    });

    const response = await axios.put(`${API_SERVER}/api/action/${selectedAction.value.id}/update`, dataToSend, {
      headers: {
        'Content-Type': 'application/json',
      }
    });

    alert("Acción actualizada con éxito");
    fetchActions();
    closeModal();
  } catch (error) {
    console.error("Error al actualizar la acción:", error.response ? error.response.data : error);
    alert("Hubo un error al actualizar la acción. Verifica la consola para más detalles.");
  }
};

const deleteAction = async (id) => {
  if (confirm("¿Estás seguro de que deseas eliminar esta acción?")) {
    try {
      await axios.delete(`${API_SERVER}/api/action/${id}/destroy`);
      await fetchActions();
      alert("Acción eliminada con éxito");
    } catch (error) {
      console.error("Error al eliminar la acción:", error);
      alert("Hubo un error al eliminar la acción");
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

h4{
  display: flex;
  justify-content: center;
  margin-top: 1em;
}
</style>
