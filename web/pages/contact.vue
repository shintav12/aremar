<template>
  <div>
    <div>
      <CategoriesHeader />
    </div>
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="section-container">
                    <h1 class="page-title">
                        Informacion de Contacto
                    </h1>
                    <p class="page-description">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.
                    </p>
                    <div class="info-container">
                        <div class="info">
                            <div class="mb-2"><i class="fas fa-phone mr-2"></i><strong> Teléfono:</strong><span class="info-item"> 946 651 539</span>    </div>
                            <div class="mb-2"><i class="fas fa-phone mr-2"></i><strong> Correo:</strong><span class="info-item"> info@joyasaremar.com</span>    </div>
                            <div class="mb-2"><i class="fas fa-phone mr-2"></i><strong> Atencion:</strong><span class="info-item"> 09:00 - 17:00 </span>    </div>
                        </div>
                    </div>
                    <div class="social-container">
                        <span class="mr-3">Siguenos Aqui: </span> <span data-v-4c8f870a=""><a href="https://www.facebook.com/joyas.aremar" target="_blank" class="social-links"><i data-v-4c8f870a="" class="fab fa-facebook-square" aria-hidden="true"></i></a></span><span data-v-4c8f870a=""><a data-v-4c8f870a="" href="https://www.facebook.com/joyas.aremar" target="_blank" class="social-links"><i data-v-4c8f870a="" class="fab fa-facebook-square" aria-hidden="true"></i></a></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="section-container">
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Correo" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="Mensaje" placeholder="Mensaje" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button class="btn btn-primary w-100">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapMutations, mapGetters, Store } from "vuex";
import CategoriesHeader from "@/components/shared/CategoriesHeader";
export default {
  name: "Contacto",
  transition (to, from) {
      return 'bounce';
  },
  head() {
    return {
      title: "Joyas Aremar | Contacto",
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Descripcion corta acerca de aremar",
        },
      ],
    };
  },
  components: {
    CategoriesHeader,
  },
};
</script>

<style lang="scss" scoped>
.fa-phone{
  color: $primary;
}
.page-title{
    color: $primary;
    font-size: 2rem;
    margin-bottom: 15px;
}
.page-description{
    color: $headers;
    font-size: 1.2rem;
}
strong{
    color: $primary;
}
.info{
    font-size: 1rem;
}
.info-item{
    color: $headers;
}
.social-container{
    margin-top: 25px;
    color: $primary;
    font-size: 1.1rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}
.social-links{
    color:$primary;
    margin-right: 10px;
    font-size: 2rem;
}

.btn-primary{
    color: $white;
    font-size: 1.1rem;
    font-weight: 500;
    border-color: $primary;
    text-transform: uppercase;
    background-color: $primary;
    transition: .3s;
    &:hover{
        background-color: $white;
        color:$primary;
    }
}
</style>
