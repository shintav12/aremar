<template>
  <div >
    <div class="header-news">
      <div class="header-news-container">
        <div class="header-news-section first">
          <span class="info">
            <i class="fas fa-phone"></i> (+511) 946 651 539
          </span>
          <span class="info">|</span>
          <span class="info">
            <i class="far fa-envelope"></i> info@joyasaremar.com
          </span>
        </div>
        <div class="header-news-section middle">
          <strong>Delivery Gratis a partir de S/. 120.00</strong>
          <span class="ml-2 offer-link">Comprar ahora</span>
        </div>
        <div class="header-news-section last">
          <span>
            <a class="social-links" href="https://www.facebook.com/joyas.aremar" target="_blank"><i class="fab fa-facebook-square"></i></a>
          </span>
          <span>
            <a class="social-links" href="https://www.instagram.com/joyasaremar" target="_blank"><i class="fab fa-instagram-square"></i></a>
          </span>
        </div>
      </div>
    </div>
    <nav class="navbar sticky-top navbar-light d-none d-lg-block">
        <div class="nav-section-container">
            <div class="nav-section first">

            </div>
            <div class="nav-section middle">
                <div class="row">
                    <div class="col-12 text-center mb-2">
                      <nuxt-link class="home-link" to="/"><img width="35%" class="img-fluid" src="@/assets/images/logos/logo-color.svg"></nuxt-link>
                      <div class="image-container sidebar-toggle justify-content-around">
                        <img width="35%" @click="toggle()" class="img-fluid " src="@/assets/images/logos/logo-color.svg">
                      </div>
                    </div>
                    <div class="col-12">
                        <div class="categories-container">
                            <nuxt-link v-for="item in categories" :key="item.id" :to="'/tienda/' + item.slug" class="category">
                                {{item.text}}
                            </nuxt-link>
                             <nuxt-link to="/about" class="category">
                                Us
                            </nuxt-link>
                             <nuxt-link to="/contact" class="category">
                                Contact
                            </nuxt-link>
                        </div>
                    </div>
                </div>

            </div>
            <div class="nav-section last">

            </div>
        </div>
    </nav>
    <nav class="navbar sticky-top navbar-light d-block d-lg-none">
        <div class="nav-section-container">
            <div class="nav-section first">

            </div>
            <div class="nav-section middle">
                <div class="row">
                    <div class="col-12 text-center mb-2">
                        <img @click="toggle()" width="35%" class="img-fluid" src="@/assets/images/logos/logo-login-color.svg">
                    </div>
                    <div class="col-12">
                        <div class="categories-container">
                            <nuxt-link v-for="item in categories" :key="item.id" :to="'/' + item.slug" class="category">
                                {{item.text}}
                            </nuxt-link>
                        </div>
                    </div>
                </div>

            </div>
            <div class="nav-section last">

            </div>
        </div>
    </nav>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
export default {
  name: "Navbar",
   computed: mapGetters({
    categories: 'categories/categories'
  }),
  methods: {
    toggle () {
        this.$store.commit('overlay/toggle', true)
        this.$store.commit('sidebar/toggle', true)
    }
  }
};
</script>

<style lang="scss" scoped>
.offer-link{
    border-radius: 5px;
    color: white;
    font-weight: 500;
    font-size: 12px;
    padding: 5px 10px;
    background-color: $gold;
}
.info{
    color: $primary;
    font-weight: 300;
    font-size: 15px;
}
.header-news{
    background-color: $background-gray;
}
.header-news-container {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  padding: 0px 3rem;
}
.header-news-section.middle {
  text-align: center;
  font-size: 14px;
  color: $gray-strong;
}
.header-news-section {
  margin: 10px 0px;
  flex: 1;
}
.social-links{
    color: $primary;
    font-size: 20px;
    margin: 0px 0px 0px 10px;
}
.header-news-section.last {
  text-align: right;
  font-size: 14px;
  color: $gray-strong;
}
.nav-section-container{
    display: flex;
    flex: 1;
}

.nav-section{
    justify-content: space-evenly;
    align-items: center;
    padding: 0px 3rem;
}

.nav-section.middle{
    flex:1;
}

.nav-section.first{
    flex:0.2;
}

.nav-section.last{
    flex:0.2;
}

.categories-container{
    display: flex;
    flex: 1;
    justify-content: center;
    align-items: center;
}
.category{
    color: $selection-fill;
    font-size: 14px;
    margin: 10px 15px;
    text-transform: uppercase;
    &:hover{
      color: $primary;
      font-weight: 500;
      text-decoration: none;
    }
}

.sidebar-toggle{
    display: none;
  }

@media (max-width: 1024px) {
  .header-news-container {
    display: none;
  }
  .home-link{
    display: none;
  }
  .sidebar-toggle{
    display: flex;
  }
  .nav-section.first{
    display: none;
    flex: 0;
  }
  .nav-section.last{
    display: none;
    flex: 0;
  }
  .nav-section{
    padding: 0px;
  }
  .categories-container{
    display: none;
  }

}


@media (max-width: 768px) {

}

@media (max-width: 425px) {

}

@media (max-width: 375px) {

}




</style>
