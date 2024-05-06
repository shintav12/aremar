<template>
  <div class="footer">
    <div class="container my-5">
      <div class="row">
        <div class="col-lg-4">
          <div class="logo-footer">
            <img width="80%" src="@/assets/images/logos/logo-white.svg" class="img-fluid" />
          </div>
          <div class="social-links">
            <a class="social-link">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a class="social-link">
              <i class="fab fa-twitter"></i>
            </a>
            <a class="social-link">
              <i class="fab fa-instagram"></i>
            </a>
            <a class="social-link">
              <i class="fab fa-pinterest"></i>
            </a>
            <a class="social-link">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="footer-column-container">
            <div class="footer-column">
              <div class="footer-section">
                <div class="f-title">Informacion de Interes</div>
                <div class="f-content">
                  <nuxt-link class="footer-link" to="/">Contactanos</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Preguntas Frecuentes</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Politicas de Privacidad</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Libro de Reclamaciones</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Sigue tu pedido</nuxt-link>
                </div>
              </div>
            </div>
            <div class="footer-column">
              <div class="footer-section">
                <div class="f-title">Seguir Viendo</div>
                <div class="f-content">
                  <nuxt-link class="footer-link" to="/">Ofertas</nuxt-link>
                  <nuxt-link class="footer-link" to="/">For Her</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Colecciones</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Registrate</nuxt-link>
                  <nuxt-link class="footer-link" to="/">Delivery</nuxt-link>
                </div>
              </div>
            </div>
            <div class="footer-column">
              <div class="footer-section">
                <div class="f-title">Estamos en Contacto</div>
                <div class="f-content mr-2">
                  <span class="footer-link">
                    <i class="fas fa-phone mr-2"></i>(+511) 946 651 539
                  </span>
                  <span class="footer-link">
                    <i class="far fa-envelope mr-2"></i>info@joyasaremar.com
                  </span>
                </div>
              </div>
              <div class="footer-section mt-2">
                <div class="f-title">Encuentranos</div>
                <div class="f-content">
                  <span class="footer-link text-left">
                    <i class="far fa-envelope mr-2"></i>Av. Aviación 2956 Of. 201
                    <br />San Borja, Lima
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr style="border-top: 1px solid white" />
    <div class="container">
      <div class="footer-foot">
        <div class="copyright"><i class="far fa-copyright mr-2"></i>Joyas Aremar 2020, Powered By Kanavant</div>
        <div class="paymethods">
          <i class="fab fa-cc-visa"></i>
          <i class="fab fa-cc-amex"></i>
          <i class="fab fa-cc-paypal"></i>
          <i class="fab fa-ebay"></i>
          <i class="fab fa-cc-mastercard"></i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style lang="scss" scoped>
.footer-foot {
  display: flex;
  justify-content: space-between;
  align-items: center;
  .paymethods {
    i {
      margin: 10px 0px 10px 10px;
      color: $white;
      font-size: 1.8rem;
    }
  }
  .copyright{
    color: $white;
      font-size: 1rem;
  }
}
.footer-column-container {
  display: flex;
  justify-content: space-between;
}
.footer-section {
  .f-title {
    margin-bottom: 15px;
    color: $white;
    font-weight: 500;
    font-size: 1.3rem;
    display: flex;
    justify-content: flex-start;
  }
  .f-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    .footer-link {
      color: #f5f5f5;
      text-decoration: none;
      margin: 12px 0px;
    }
  }
}
.footer {
  position: relative;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem 0px;
  background-color: $headers;
  text-align: center;
  .logo-footer {
    display: flex;
    justify-content: flex-start;
  }
}
.social-link {
  color: $white;
  cursor: pointer;
  margin: 15px 40px 15px 0px;
  font-size: 18px;
}
.social-links {
  display: flex;
  justify-content: flex-start;
}
@media (max-width: 425px) {
  .footer-column-container{
    flex-direction: column;
  }
  .footer-column{
    margin-bottom: 25px;
  }
  .footer-foot {
  display: flex;
  justify-content: center;
  flex-direction: column;
  .paymethods {
    i {
      margin: 10px 0px 10px 10px;
      color: $white;
      font-size: 1.8rem;
    }
  }
  .copyright{
    color: $white;
      font-size: 1rem;
  }
}
}
</style>
