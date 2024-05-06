<template>
  <div>
    <div class="filter-section-container">
      <div class="filter-section">
        <div class="filter-title">Categorias</div>
        <div class="filter-content">
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Todos</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Anillos</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Dijes</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Collares</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Aretes</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Cadenas</label>
          </div>
        </div>
      </div>
      <hr />
      <div class="filter-section">
        <div class="filter-title">Metal</div>
        <div class="filter-content">
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Oro Blanco</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Oro Rosa</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Oro Amarillo</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Tres Oros</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Plata</label>
          </div>
        </div>
      </div>
      <hr />
      <div class="filter-section">
        <div class="filter-title">Colecci&oacute;n</div>
        <div class="filter-content">
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Blue</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Adore</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Classics</label>
          </div>
          <div class="input-container">
            <input class="radio-filter" type="radio" />
            <label>Religiosos</label>
          </div>
        </div>
      </div>
      <div class="filter-action">
        <button class="btn btn-custom">Buscar</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Filters",
};
</script>

<style lang="scss" scoped>
.filter-title {
  color: $secondary;
  font-size: 1.5rem;
  margin-bottom: 15px;
}
.filter-content {
  .input-container {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 10px;
  }
  label {
    margin: 0;
  }
}
.radio-options-container {
  display: flex;
  justify-content: center;
  align-items: center;
  .radio-option {
    cursor: pointer;
    margin-right: 10px;
    border-radius: 20px;
    display: grid;
    place-items: center;
    width: 35px;
    height: 35px;
    border: 1px solid $secondary !important;
    color: $secondary;
    transition: 0.3s;
    &:hover {
      background-color: $primary;
      color: $white;
      border: 1px solid $primary !important;
    }
  }
}
.filter-section {
  margin-bottom: 30px;
}
.radio-filter {
  margin-right: 15px;
  margin-bottom: 3px;
}

.btn-custom {
  margin-top: 15px;
  background-color: $white;
  border-color: $primary;
  width: 100%;
  color: $primary;
  padding: 0.3rem 1.5rem !important;
  font-size: 1.2rem;
  font-weight: 500;
  &:hover {
    color: $white;
    background-color: $primary;
  }
}
</style>
