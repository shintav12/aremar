<template>
  <div>
    <div>
      <CategoriesHeader />
    </div>
    <div class="container">
      <div class="row my-5 py-5">
        <div class="col-xl-4">
          <div class="value-container">
            <div class="value-image">
              <img src="https://via.placeholder.com/350x250" alt class="image-fluid w-100" />
            </div>
            <div class="value-content">
              <div class="value-title">LOREM IPSUM DOLOR</div>
              <div class="value-description">
                Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod �ncidunt ut laoreet dolore magna
                aliquam erat volutpat
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="value-container">
            <div class="value-image">
              <img src="https://via.placeholder.com/350x250" alt class="image-fluid w-100" />
            </div>
            <div class="value-content">
              <div class="value-title">LOREM IPSUM DOLOR</div>
              <div class="value-description">
                Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod �ncidunt ut laoreet dolore magna
                aliquam erat volutpat
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="value-container">
            <div class="value-image">
              <img src="https://via.placeholder.com/350x250" alt class="image-fluid w-100" />
            </div>
            <div class="value-content">
              <div class="value-title">LOREM IPSUM DOLOR</div>
              <div class="value-description">
                Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod �ncidunt ut laoreet dolore magna
                aliquam erat volutpat
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="padding: 0px 10%">
       <div class="paralax-section my-5">
      <div class="image d-none d-md-block">
        <img src="@/assets/images/about-section.jpg" alt class="image-fluid w-100" />
      </div>
      <div class="content-paralax-section">
        <div class="content">
          <div class="row">
            <div class="col-12">
              <div class="section-title">Lorem ipsum Dolor</div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container">
                <div class="image">
                  <img src="@/assets/icons/heart.svg" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container">
                <div class="image">
                  <img src="@/assets/icons/heart.svg" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container">
                <div class="image">
                  <img src="@/assets/icons/heart.svg" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
            <div class="col-lg-6 col-md-3 col-12">
              <div class="benefit-container">
                <div class="image">
                  <img src="@/assets/icons/heart.svg" alt class="img-fluid image-benefit" />
                </div>
                <div class="title">Lorem ipsum dolortu</div>
                <div class="description">Lorem ipsum dolor</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

    <div class="container mb-5 pb-5">
      <div class="our-team-title">Nuestro Equipo</div>
          <div
            class="our-team-subtitle"
          >Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh</div>
      <div class="our-team-members">
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
          </div>
        </div>
        <div class="our-team-container">
          <div class="our-team-group">
            <div class="team-member-container">
              <div class="team-member-image">
                <img class="image-fluid w-100" src="https://via.placeholder.com/250x200" alt />
              </div>
              <div class="team-member-info">
                <div class="team-member-name">Nombre Apellido</div>
                <div class="team-member-position">Cargo Empresa</div>
              </div>
            </div>
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
  components: {
    CategoriesHeader,
  },
  transition: 'bounce',
  computed: mapGetters({
    homeHeader: "headers/headerById",
  }),
  methods: {
    ...mapGetters(["headerById"]),
  },
  head() {
    return {
      title: "Joyas Aremar | Acerca de Nosotros",
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Descripcion corta acerca de aremar",
        },
      ],
    };
  },
};
</script>

<style lang="scss" scoped>
.our-team-members {
  display: grid;

  width: 100%;
  grid-template-columns: 25% 25% 25% 25%;
}
.team-member-name {
  color: $primary;
  font-weight: 500;
  font-size: 1.3rem;
  text-align: center;
}

.team-member-position {
  color: $selection-fill;
  font-weight: 500;
}

.team-member-info {
  padding: 20px 0px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.team-member-container {
  border: 1px solid $primary !important;
  margin: 15px;
}
.our-team-container {
  width: 100%;
  margin-bottom: 15px;
}
.our-team-title {
  color: $primary;
  font-size: 2.5rem;
  font-weight: 500;
  text-align: center;
  width: 100%;
}

.our-team-subtitle {
  text-align: center;
  font-size: 1.2rem;
  margin-bottom: 40px;
  color: $gray-icons;
}

.value-container {
  display: flex;
  flex-direction: column;
  .value-content {
    display: flex;
    flex-direction: column;
    width: 100%;
    .value-title {
      margin: 15px 0px;
      font-size: 1.3rem;
      color: $primary;
      font-weight: 500;
      text-transform: uppercase;
    }
    .value-description {
      text-align: justify;
      font-size: 1rem;
      color: $headers;
      font-weight: 500;
    }
  }
}

.paralax-section {
  display: flex;
  justify-content: center;
  .image {
    width: 50%;
  }
  .content-paralax-section {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: $secondary;
    .content {
      padding: 3% 7%;
    }
  }
}
.section-title {
  font-size: 2rem;
  font-weight: 500;
  color: $primary;
  margin-bottom: 40px;
}

.benefit-container {
  margin-bottom: 45px;
  .image {
    margin-bottom: 10px;
    .image-benefit {
      width: 25%;
    }
  }

  .title {
    color: $primary;
    font-size: 1.5rem;
    font-weight: 500;
  }

  .description {
    color: $gray-strong;
    font-size: 1rem;
  }
}

@media (max-width: 768px){
  .our-team-members {
    grid-template-columns: 50% 50% ;
    grid-template-rows: 50% 50% ;
  }
}

@media (max-width: 1440px) {
  .paralax-section > .image {
    width: 0%;
  }
  .paralax-section {
    display: flex;
    justify-content: center;
    .content-paralax-section {
      width: 100%;
      background-color: $secondary;
      .content {
        padding: 7% 7%;
      }
    }
  }
}

@media (max-width: 1024px) and (min-width: 426px) {
  .value-container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 20px;
    .value-content {
      display: flex;
      flex-direction: column;
      padding: 15px;
      width: 100%;
      .value-title {
        margin: 15px 0px;
        font-size: 1.3rem;
        color: $headers;
        font-weight: 500;
        text-transform: uppercase;
      }
      .value-description {
        text-align: justify;
        font-size: 1rem;
        color: $gray-strong;
        font-weight: 500;
      }
    }
  }
}
@media (max-width: 425px) {
  .value-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    .value-content {
      display: flex;
      flex-direction: column;
      width: 100%;
      .value-title {
        margin: 15px 0px;
        font-size: 1.3rem;
        color: $headers;
        font-weight: 500;
        text-transform: uppercase;
      }
      .value-description {
        text-align: justify;
        font-size: 1rem;
        color: $gray-strong;
        font-weight: 500;
      }
    }
  }
   .our-team-members {
    grid-template-columns: auto ;
    grid-template-rows: auto ;
  }
}
</style>
