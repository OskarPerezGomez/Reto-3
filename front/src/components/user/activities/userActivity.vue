<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const actions = ref([]);

const fetchActions = async () => {
  try {
    const response = await axios.get("http://localhost/api/action/all");
    actions.value = response.data.data;
  } catch (error) {
    console.error("Error al obtener las acciones:", error);
  }
};

onMounted(fetchActions);
</script>

<template>
    
    <div class="row">
    <div v-for="action in actions" :key="action.id" class="card p-3 shadow col-4">
      <div class="d-flex justify-content-between">
        <span class="badge bg-light text-dark">
          {{ action.capacity }} plazas disponibles
        </span>
        <span class="badge bg-light text-dark">{{ action.price }}€/mes</span>
      </div>
      <h4 class="mt-3">{{ action.name }}</h4>
      <p class="text-secondary mb-1">{{ action.center.name }}</p>
      <p class="text-muted">
        Horario: {{ action.start_time }}
      </p>
      <button class="btn btn-success w-100">Inscribirse</button>
    </div>
  </div>
</template>

<style scoped>

    

</style>
