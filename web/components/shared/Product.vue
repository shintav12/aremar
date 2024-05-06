<template>
  <div @click="productDetail()" class="product-container mb-3">
    <div class="product-image-container">
      <div class="product-image">
        <div class="product-image-overlay">
          <div class="options-overlay">

            <div class="option">
              <a>
                <i class="fas fa-cart-plus"></i>
              </a>
            </div>
            <div class="option">
              <a href="http://google.com">
                <i class="fas fa-search"></i>
              </a>
            </div>
          </div>
        </div>
        <img class="img-fluid alt-image" src="@/assets/images/home/products/productalt.jpg" />
        <img class="img-fluid main-image" src="@/assets/images/home/products/product1.jpg" />
      </div>
    </div>
    <div class="product-info">
      <span class="product-name">Lorem ipsum dolor, consec adi</span>
      <div class="product-secondary-info">
        <span class="product-prize">S/.30.00</span>
        <span class="product-colors"></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Product",
  props: ["product"],
  methods:{
    productDetail(){
      this.$router.push("/tienda/categoria/producto");
    }
  }
};
</script>

<style lang="scss" scoped>
.product-info{
    margin-top: 15px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.product-secondary-info{
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
}

.product-name{
    font-size: 1rem;
    font-weight: 500;
    color: $primary;
}

.product-prize{
    margin-top: 5px;
    font-size: 1.1rem;
    font-weight: 500;
    color: $gray-icons;
}
.options-overlay {
  .option {
    cursor: pointer;
    background: $background-gray;
    color: $gray-icons;
    font-size: 1.2rem;
    padding: 10px;
    margin: 15px;
    a {
      color: $gray-icons;
      text-decoration: none;
    }
  }
}

.alt-image {
  display: block;
  opacity: 0;
  width: 0;
  transition: visibility 0s, opacity 0.5s linear;
}
.main-image {
  display: block;
  opacity: 1;
  width: 100%;
  transition: visibility 0s, opacity 0.5s linear;
}
.product-image-overlay {
  visibility: hidden;
  position: absolute;
  opacity: 0;
  //transition: visibility 0s, opacity 0.5s linear;
  z-index: 10;
}
.product-image:hover {
  .product-image-overlay {
    visibility: visible;
    opacity: 1;
  }
  .main-image {
    width: 0;
    display: block;
    opacity: 0;
  }
  .alt-image {
    width: 100%;
    display: block;
    opacity: 1;
  }
}
</style>
