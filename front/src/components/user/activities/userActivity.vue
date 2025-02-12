<script setup>
import { ref, computed, watch, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const props = defineProps(["filters"]);
const API_SERVER = import.meta.env.VITE_API_SERVER;

const actions = ref([]);

const router = useRouter();
const user = ref(null);

onMounted(() => {
  const storedUser = sessionStorage.getItem("user");
  if (storedUser) {
    try {
      user.value = JSON.parse(storedUser); // Convertimos el string a objeto
    } catch (error) {
      console.error("Error al parsear el usuario:", error);
    }
  }
});

// Función para obtener las actividades desde la API
const fetchActions = async () => {
  try {
    const response = await axios.get(`${API_SERVER}/api/action/all`);
    console.log("Respuesta de la API:", response.data);

    // Asegurar que los datos sean un array antes de asignarlos
    actions.value = Array.isArray(response.data.data) ? response.data.data : Object.values(response.data.data);
    console.log("Actividades actualizadas:", actions.value);  // Verifica si se actualiza correctamente

  } catch (error) {
    console.error("Error al cargar actividades:", error);
    actions.value = []; // Evitar problemas si la API falla
  }
};

const inscribirUsuario = async (activity) => {
  try {
    const userToken = sessionStorage.getItem("user");

    if (!userToken) {
      alert("Necesitas iniciar sesión para inscribirte.");
      return;
    }

    const userId = JSON.parse(userToken).id;  // Si usas el ID del usuario en el token

     // Realiza la primera petición para inscribir al usuario
     const responseInscripcion = await axios.post(`${API_SERVER}/api/inscribir`, {
      user_id: userId,
      action_id: activity.id
    });

    if (!responseInscripcion.data.success) {
      alert(responseInscripcion.data.message);
      return;
    }

    // Realiza la segunda petición para reducir las plazas
    const responsePlazas = await axios.post(`${API_SERVER}/api/action/reducirPlazas`, {
      action_id: activity.id
    });

    if (responsePlazas.data.success) {
      alert("Inscripción exitosa y plazas actualizadas!");
      fetchActions(); // Recargar las actividades para reflejar cambios
    } else {
      alert("La inscripción se registró, pero no se pudo reducir la plaza.");
    }
  } catch (error) {
    console.error("Error al inscribirse:", error);
    alert("Hubo un problema al procesar tu inscripción.");
  }
};


const formatTime = (time) => {
  // Si la hora está en formato 'HH:MM:SS', recortamos los últimos 3 caracteres ('SS')
  return time ? time.slice(0, 5) : ''; 
};

const calculateEndTime = (startTime, durationInMinutes) => {
  const [hours, minutes] = startTime.split(":").map(Number);
  const startDate = new Date();
  startDate.setHours(hours, minutes, 0); // Establecer la hora de inicio
  
  startDate.setMinutes(startDate.getMinutes() + durationInMinutes); // Sumar la duración

  const endHour = startDate.getHours();
  const endMinutes = startDate.getMinutes();

  // Formatear la hora de finalización
  const formattedEndTime = `${endHour.toString().padStart(2, "0")}:${endMinutes.toString().padStart(2, "0")}`;
  return formattedEndTime;
};

// Computed para filtrar las actividades
const filteredActions = computed(() => {
  console.log("Acciones filtradas:", actions.value);  // Verifica las acciones antes del filtro
  if (!Array.isArray(actions.value)) {
    console.warn("actions.value no es un array:", actions.value);
    return [];
  }

  return actions.value.filter(activity => {
    const { search, location, age, language, schedule, startDate, endDate } = props.filters;
    
    if (search && !activity.name.toLowerCase().includes(search.toLowerCase())) return false;
    if (location && !activity.center.name.toLowerCase().includes(location.toLowerCase())) return false;
    if (age && activity.age) {
    const [minAge, maxAge] = age.split("-");
    // Caso para "50+" (que no tiene un rango superior)
    if (age === "50+" && parseInt(activity.age) < 50) return false;
    // Rango normal
    if (parseInt(activity.age) < parseInt(minAge) || (maxAge && parseInt(activity.age) > parseInt(maxAge))) return false;
  }    
  if (language && activity.languaje.toLowerCase() !== language.toLowerCase()) return false;

    // Verificar si 'start_time' está definido antes de intentar dividirlo
    if (activity.start_time) {
      const hour = parseInt(activity.start_time.split(":")[0]);
      
      if (schedule === "morning" && (hour < 8 || hour >= 12)) return false;
      if (schedule === "afternoon" && (hour < 12 || hour >= 17)) return false;
      if (schedule === "night" && (hour < 17 || hour >= 22)) return false;
    }

    if (startDate && activity.date_init < startDate) return false;
    if (endDate && activity.date_end > endDate) return false;

    return true;
  });
});

const toggleInscription = async (activity) => {
  if (!user.value) {
    window.location.href = "/login"; // Redirige a login si no hay usuario
    return;
  }

  try {
    if (isUserEnrolled(activity.id)) {
      // Desapuntarse
      await axios.post(`${API_SERVER}/api/desapuntar`, {
        user_id: user.value.id,
        action_id: activity.id
      });
      alert("Te has desapuntado correctamente.");
    } else {
      // Inscribirse
      const response = await axios.post(`${API_SERVER}/api/inscribir`, {
        user_id: user.value.id,
        activity_id: activity.id
      });

      if (!response.data.success) {
        alert(response.data.message);
        return;
      }

      await axios.post(`${API_SERVER}/api/reducir-plazas`, {
        activity_id: activity.id
      });

      alert("Inscripción exitosa!");
    }

    fetchActions(); // Actualizar actividades
    fetchUserData(); // Actualizar usuario
  } catch (error) {
    console.error("Error al procesar inscripción:", error);
    alert("Hubo un problema con la inscripción.");
  }
};



// Ver cambios en los filtros y volver a cargar las actividades
watch(() => props.filters, fetchActions, { deep: true });

fetchActions();
</script>

<template>
  <div class="row">
    <div v-if="filteredActions.length === 0" class="col-12 text-center">
      <p class="alert alert-success">No hay actividades disponibles</p>
    </div>
    <div v-for="activity in filteredActions" :key="activity.id" class="col-md-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <span class="badge bg-light text-dark">
              {{ activity.capacity }} plazas disponibles
            </span>
            <span class="badge bg-light text-dark">{{ activity.price }}€/hora</span>
          </div>
          <h4 class="mt-3">{{ activity.name }}</h4>
          <p class="text-secondary mb-0">{{ activity.center ? activity.center.name : 'Centro no disponible' }}</p>
          <p class="text-muted mb-0">Edad: {{ activity.age }}</p>
          <p class="text-muted mb-0">Idioma: {{ activity.languaje }}</p>
          <p class="text-muted mb-0">Horario: {{ formatTime(activity.start_time) }} - {{ calculateEndTime(activity.start_time, activity.duration) }}</p>
          <p class="text-muted">Del dia {{ activity.date_init }} al dia {{ activity.date_end }}</p>

          <button
            v-if="user"
            class="btn w-100"
            :class="{
              'btn-secondary': activity.capacity === 0,
              'btn-danger': isUserEnrolled(activity.id),
              'btn-success': activity.capacity > 0 && !isUserEnrolled(activity.id)
            }"
            :disabled="activity.capacity === 0"
            @click="toggleInscription(activity)"
          >
            {{ activity.capacity === 0 ? "Plazas completas" : isUserEnrolled(activity.id) ? "Desapuntarse" : "Inscribirse" }}
          </button>
          <button v-else @click="router.push('/login')" class="btn btn-success w-100">Inscribirse</button>
        </div>
      </div>
    </div>
  </div>
</template>
