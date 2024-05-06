<template>
  <div>
    <Breadcrumbs />
    <div class="container my-5">
      <div class="row mb-4">
        <div class="col-12">
          <div class="page-title">Tu Cuenta</div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-md-6 col-12">
          <div class="card w-100">
            <div class="card-title">Detalles del Perfil</div>
            <div class="card-content">
              <div class="name">Nombre Apellido</div>
              <div class="mail">nombreapellido@gmail.com</div>
            </div>
            <div class="card-options">
              <div class="option">Restablecer Contrase&ntilde;a</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="card w-100">
            <div class="card-title">Direccion de Envios</div>
            <div class="card-content">
              <div class="name">Calle Tiziano 302, Piso 301 - San Borja</div>
              <div class="mail">Lima, 15033 - Perú</div>
            </div>
            <div class="card-options">
              <div class="option">Cambiar Direccion</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mb-4">
        <div class="col-12">
          <div class="card w-100">
            <div class="card-title">Historial de Pedidos</div>
            <div class="card-content">
              <div class="mail">No has hecho pedidos aun</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumbs from "@/components/layout/Breadcrumbs";
export default {
  components: {
    Breadcrumbs,
  },
};
</script>

<style lang="scss" scoped>
.card {
  padding: 20px;
  border-radius: 10px;
}
.page-title{
    color:$primary;
    font-size: 2.3rem;
    font-weight: 500;

}
.card-title{
    font-size: 1.3rem;
    color:$primary;
    font-weight: 500;
    margin-bottom: 15px;
}
.card-content > .name{
    font-size: 1rem;
    color:$gray-strong;
    font-weight: 500;
}
.card-content > .mail{
    font-size: 1rem;
    color:$gray-icons;
}
.card-content{
    margin-bottom: 25px;
}
.card-options > .option{
    color:$primary;
    font-weight: 400;
    cursor: pointer;
}
</style>
