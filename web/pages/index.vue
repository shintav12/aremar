<template>
<div>
  <Header v-bind:header="homeHeader(1)"/>
  <Offers />
  <Products />
  <Newsletter />
  <Benefits />
</div>
</template>

<script>
import { mapState, mapMutations, mapGetters, Store } from 'vuex';
import Header from '@/components/home/Header';
import Offers from '@/components/home/Offers';
import Products from '@/components/home/Products';
import Newsletter from '@/components/home/Newsletter';
import Benefits from '@/components/home/Benefits';
export default {
  components:{
    Header,
    Offers,
    Products,
    Newsletter,
    Benefits
  },
   computed: mapGetters({
    homeHeader: 'headers/headerById'
  }),
  methods:{
    ...mapGetters(['headerById']),
  },
  transition (to, from) {
      return 'bounce';
  },
  head() {
      return {
        title: "Joyas Aremar | Home",
        meta: [
          {
            hid: 'description',
            name: 'description',
            content: 'Descripcion corta acerca de aremar'
          }
        ]
      }
  }
}
</script>

<style>

</style>
