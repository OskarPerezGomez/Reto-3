<script>
  
</script>

<template>
      <h3>Búsqueda de actividades</h3>
      <div class="mb-3 d-flex">
        <input type="text" class="form-control me-2" placeholder="Buscar actividades...">
        <button class="btn btn-light border d-flex align-items-center gap-2">
          <img src="../../../assets/img/filtrar.png" alt="Reiniciar" width="20" height="20"> Reiniciar
        </button>
      </div>
      <h4>Filtros</h4>
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Ubicación</label>
          <input type="text" class="form-control" placeholder="Introduce una ubicación">
        </div>
        <div class="col-md-4">
          <label class="form-label">Rango de edad</label>
          <select class="form-select">
            <option selected>Selecciona rango de edad</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Idioma</label>
          <select class="form-select">
            <option selected>Selecciona idioma</option>
          </select>
        </div>
      </div>
      <div class="row g-3 mt-2">
        <div class="col-md-4">
          <label class="form-label">Horario</label>
          <select class="form-select">
            <option selected>Selecciona horario</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Fecha inicio</label>
          <div class="input-group">
            <span class="input-group-text"><img src="../../../assets/img/calendario.png" alt="Fecha inicio" width="16" height="16"></span>
            <input type="date" class="form-control">
          </div>
        </div>
        <div class="col-md-4">
          <label class="form-label">Fecha fin</label>
          <div class="input-group">
            <span class="input-group-text"><img src="../../../assets/img/calendario.png" alt="Fecha fin" width="16" height="16"></span>
            <input type="date" class="form-control">
          </div>
        </div>
      </div>
      <div class="mt-3">
        <button class="btn btn-dark w-100">Buscar</button>
      </div>
  </template>
  

  