<template>
  <div class="bg" :style="{ backgroundImage: `url(${returnBg})` }">
    <div class="row fullH">
      <div class="centered-content w-100">
        <div class="centered-div">
          <div class="page-headd mb-5 pb-2">
            <div class="logo-login">
              <img src="@/assets/images/logos/logo-login.svg" alt class="img-fluid img-logo" />
            </div>
            <div
              class="logo-text"
            >Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh</div>
          </div>
          <div class="px-4 d-flex justify-content-center">
            <div class="card">
              <div class="card-head">
                <div class="main-text">Ingresa</div>
                <div class="secondary-text">con tus redes sociales</div>
              </div>
              <div class="ssmm-access">
                <div class="option google"></div>
                <div class="option facebook"></div>
              </div>
              <div class="content-card">
                <form action>
                  <div class="form-group">
                    <input type="text" placeholder="Correo" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="text" placeholder="Password" class="form-control" />
                  </div>
                  <div class="form-group">
                    <input type="checkbox" />
                    <span>Mantener la sesion abierta</span>
                  </div>
                  <button class="btn btn-primary w-100">Ingresar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: "no-navs",
  computed: {
    returnBg() {
      return require("~/assets/images/bg.jpg");
    },
  },
};
</script>

<style lang="scss" scoped>
.form-group > span{
    color: $primary;
    font-size: 1rem;
}
.logo-text {
  color: $white;
  font-size: 1.1rem;
  text-align: center;
}
.logo-login {
  text-align: center;
  margin-bottom: 15px;
}
.img-logo {
  width: 70%;
}
.centered-div {
  width: 40%;
}
.card {
  padding: 25px;
  border-radius: 10px;
  width: 90%;
}
.centered-content {
  display: flex;
  justify-content: center;
  margin-top: 55px;
}
.fullH {
  min-height: 100vh;
}
.row {
  margin: 0;
  padding: 0;
}
.bg {
  background: center;
  min-height: 100vh;
  background-size: cover;
}
.main-text {
  color: $primary;
  text-align: center;
  font-weight: 500;
  font-size: 2rem;
}
.secondary-text {
  color: $gray-icons;
  text-align: center;
  font-size: 1.1rem;
  margin-bottom: 25px;
}

.btn-primary {
  color: $white;
  font-size: 1.1rem;
  font-weight: 500;
  border-color: $primary;
  text-transform: uppercase;
  background-color: $primary;
  transition: 0.3s;
  &:hover {
    background-color: $white;
    color: $primary;
  }
}
@media (max-width: 768px) {
.centered-div {
    width: 100%;
}
}
</style>
