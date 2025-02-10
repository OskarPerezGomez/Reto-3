<script setup>

</script>

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
      <tr> <!-- v-for="(, index) in " :key="index"-->
        <td><strong>{{ "Yoga en el Parque" }}</strong></td>
        <td>{{ 'Ibaiondo' }}</td>
        <td>{{ '13/01/2024' }}</td>
        <td>{{ '15' }}€</td>
        <td>{{ '23' }}</td>
        <td class="botones">
          <button class="btn btn-sm btn-outline-warning " @click="">
            <img src="../../assets/img/editar.png" alt="editar">
          </button>
          <button class="btn btn-sm btn-outline-danger" @click="">
            <img src="../../assets/img/goma-de-borrar.png" alt="borrar">
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
  .botones{
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

  button img{
    width: 18px;
  }
</style>