<template>
  <div class="container my-5 pt-5">
    <div class="row">
      <div class="section-title col-12">Lorem ipsum dolor sit</div>
      <div class="section-subtitle col-12">Lorem ipsum dolor adi</div>
    </div>
    <div class="row">
      <div class="filters-container col-12 my-5">
        <div class="filter active">Lo + Vendido</div>
        <div class="filter">En Oferta</div>
        <div class="filter">Destacados</div>
      </div>
      <div class="product-container-wrapper">
        <div class="product-item-wrapper">
            <Product />
        </div>
        <div class="product-item-wrapper">
            <Product />
        </div>
        <div class="product-item-wrapper">
            <Product />
        </div>
        <div class="product-item-wrapper">
            <Product />
        </div>
         <div class="product-item-wrapper">
            <Product />
        </div>
        <div class="product-item-wrapper">
            <Product />
        </div>
        <div class="product-item-wrapper">
            <Product />
        </div>
        <div class="product-item-wrapper">
            <Product />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Product from "../shared/Product";
export default {
  name: "Products",
  components: {
    Product,
  },
};
</script>

<style lang="scss" scoped>
.product-container-wrapper{
  display: grid;
   grid-template-columns: 25% 25% 25% 25%;
}

.product-item-wrapper{
  margin: 15px;
}
.section-title {
  font-size: 2.5rem;
  font-weight: 500;
  text-align: center;
  color: $primary;
}
.section-subtitle {
  font-size: 1.2rem;
  font-weight: 500;
  text-align: center;
  color: $headers;
}
.filters-container {
  display: flex;
  justify-content: center;
}
.filter {
  border-radius: 7px;
  padding: 10px 15px;
  margin: 0px 8px;
  font-weight: 500;
  color: $gray-icons;
  border: 2px solid $selection-fill !important;
  transition: 0.3s;
  &:hover {
    color: $white;
    border: 2px solid $primary !important;
    background-color: $primary;
  }
}
.active {
  border: 2px solid $primary !important;
  color: $primary;
  background-color: $white;
}
@media (max-width: 425px) {
  .filter {
    margin: 20px 4px;
  }
}

@media (max-width: 1024px) {
  .product-container-wrapper{
  display: grid;
   grid-template-columns: 33% 33% 33%;
}
}
</style>
