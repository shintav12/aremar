<template>
  <div>
    <HeaderIntern />
    <div class="container my-5">
      <div class="row">
        <div class="col-lg-3 d-none d-lg-flex">
          <Filters />
        </div>
        <div class="col-lg-9">
          <div class="row">
            <div class="col-12">
              <div class="sorting-filters-container">
               <div @click="toggleFilters()" class="responsive-filter-container d-flex d-lg-none">
                  <i class="fas fa-sliders-h mr-3"></i> Filtros
                </div>
                <div class="sorting-filter-container">
                  <select name id class="form-control">
                    <option>Alfabetico</option>
                    <option>$ Mayor a Menor</option>
                    <option>$ Menor a Mayor</option>
                  </select>
                </div>
                 
              </div>
            </div>  
          </div>
          <div class="row mb-5">
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
            <div class="col-md-3 col-6 mb-2">
              <Product />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderIntern from "@/components/shared/HeaderIntern";
import Filters from "@/components/store/Filters";
import Product from "@/components/shared/Product";
import { mapState, mapMutations, mapGetters, Store } from "vuex";
export default {
  components: {
    HeaderIntern,
    Filters,
    Product,
  },
  transition (to, from) {
      return 'bounce';
  },
  props: ["header"],
  computed: mapGetters({
    homeHeader: "headers/headerById",
  }),
  head() {
    return {
      title: "Joyas Aremar | Tienda | Categoria",
      meta: [
        {
          hid: "description",
          name: "description",
          content: "Descripcion corta acerca de aremar",
        },
      ],
    };
  },
  methods: {
    toggleFilters () {
        this.$store.commit('overlay/toggle', true)
        this.$store.commit('sidefilter/toggle', true)
    }
  }
};
</script>

<style lang="scss" scoped>
.sorting-filters-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}
.responsive-filter-container{
  display: flex;
  align-items: center;
  color: $gold;
}
</style>