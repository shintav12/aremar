<template>
  <div>
    <Breadcrumbs />
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div
            class
            style="display: block; flex-basis: 0; flex-grow: 1; flex-shrink: 1; padding: 0.75rem;"
          >
            <carousel :starting-image="2" :images="images"></carousel>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <div class="product-container-info">
            <div class="product-title-container">
              <i class="far fa-heart"></i>
              <h1 class="product-title">Lorem ipsum dolor</h1>
            </div>
            <div class="product-content-info">
              <p
                class="product-shordescription"
              >Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod �ncidunt ut laoreet dolore magna</p>
              <div class="product-section-title">Metales</div>
              <div class="product-sizes">
                <div class="input-container">
                  <input type="radio" class="custom-radio" />
                  <span for class="custom-radio-label">Oro Blanco</span>
                </div>
                <div class="input-container">
                  <input type="radio" class="custom-radio" />
                  <span for class="custom-radio-label">Oro Rosa</span>
                </div>
                <div class="input-container">
                  <input type="radio" class="custom-radio" />
                  <span for class="custom-radio-label">Oro Amarillo</span>
                </div>
                <div class="input-container">
                  <input type="radio" class="custom-radio" />
                  <span for class="custom-radio-label">Tres Oros</span>
                </div>
              </div>
              <div class="product-prize">S/.30</div>
              <div class="product-action-container">
                <button class="btn btn-primary">
                  <i class="fas fa-shopping-bag mr-2"></i>Agregar al Carrito
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 mt-5">
          <hr style="" />
          <p class="pt-4">
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod �ncidunt ut laoreet dolore magna aliquam erat
            volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci ta�on ullamcorper suscipit lobor�s nisl ut aliquip ex ea commodo consequat.
            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse moles�e consequat, vel illum dolore eu feugiat nulla facilisis at vero eros
            et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
            Lorem ipsum dolor sit amet, cons ectetuer adipiscing elit, sed diam nonummy nibh euismod �ncidunt ut laoreet dolore magna aliquam erat
          </p>
          <p>
            volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci ta�on
            volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci ta�on ullamcorper suscipit lobor�s nisl ut aliquip ex ea commodo consequat.
            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse moles�e consequat, vel illum dolore eu feugiat nulla facilisis at vero eros
            et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
            Lorem ipsum dolor sit amet, cons ectetuer adipiscing elit, sed diam nonummy nibh euismod �ncidunt ut laoreet dolore magna aliquam
          </p>
        </div>
      </div>
      <hr style="" />
      <div class="col-12">
        <div class="title-section">
          <div class="primary-title">
            Relacionados
          </div>
          <div class="secondary-title">
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonu
          </div>
        </div>
      </div>
      <div class="my-5 pb-5">
        <RelatedProducts />
      </div>
    </div>
  </div>
</template>

<script>
import RelatedProducts from "@/components/product/RelatedProducts";
import Breadcrumbs from "@/components/layout/Breadcrumbs";
import Carousel from "@/components/shared/Carousel";
export default {
  name: "ProductDetail",
  components: {
    RelatedProducts,
    Carousel,
  },
  transition (to, from) {
      return 'bounce';
  },
  head() {
    return {
      title: "Joyas Aremar | Tienda | Categoria | Producto",
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Descripcion corta acerca de aremar",
        },
      ],
    };
  },
  data() {
    return {
      images: [
        {
          id: "1",
          big:
            "https://res.cloudinary.com/glamira/image/upload/c_limit,c_fill,dpr_1.0,f_auto,fl_lossy,q_auto/media/product/set26/gwd12000/yellow_pra_polished_w3_3.jpg",
          thumb:
            "https://res.cloudinary.com/glamira/image/upload/c_limit,c_fill,dpr_1.0,f_auto,fl_lossy,q_auto/media/product/set26/gwd12000/yellow_pra_polished_w3_3.jpg",
        },
        {
          id: "2",
          big:
            "https://res.cloudinary.com/glamira/image/upload/c_limit,c_fill,dpr_1.0,f_auto,fl_lossy,q_auto/media/product/set26/gwd12000/red_pra_polished_w3_2.jpg",
          thumb:
            "https://res.cloudinary.com/glamira/image/upload/c_limit,c_fill,dpr_1.0,f_auto,fl_lossy,q_auto/media/product/set26/gwd12000/red_pra_polished_w3_2.jpg",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
p{
  text-align: justify;
  color: $headers;
}
.title-section{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.primary-title{
  margin: 15px 0px;
  color: $primary;
  font-size: 2.5rem;
  font-weight: 500;
}
.secondary-title{
  color:$gray-strong;
  font-size: 1.2rem;
}
hr{
  border-top: 2px solid $primary;
}
.product-title-container {
  color: $primary;
  font-size: 2rem;
  display: flex;
  align-items: center;
  h1 {
    margin: 0;
    margin-left: 15px;
  }
  margin-bottom: 15px;
}
.product-shordescription {
  line-height: 1.5;
  color: $headers;
  font-size: 1.3rem;
}
.input-container {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin-right: 15px;
  font-size: 1.2rem;
  label {
    color: $headers;
    font-weight: 500;
  }
}
label {
  margin: 0;
}
.product-sizes {
  display: flex;
  justify-content: flex-start;
}
.custom-radio {
  margin-right: 8px;
}
.product-section-title {
  font-size: 1.5rem;
  font-weight: 500;
  margin: 15px 0px;
  color: $primary;
}
.product-prize {
  font-size: 2rem;
  font-weight: 500;
  margin: 35px 0px;
  color: $headers;
}
.btn-primary {
  color: $white;
  background-color: $primary;
  border-color: $primary;
  text-transform: uppercase;
  padding: 8px 12px;
  font-weight: 500;
}
@media (max-width: 425px){
  .product-sizes {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
  }
}
</style>
