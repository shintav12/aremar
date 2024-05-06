<template>
  <div id="mySidenav" class="sidenav" v-bind:class="{'openNav': sideBarOpen}">
    <a @click="toggle()" class="closebtn">&times;</a>
    <a href="/"><img class="logo img-fluid" width="250px" src="@/assets/images/logos/logo-color.svg" /></a>
    <div class="mt-3 p-3">
        <Filters />
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import Filters from '@/components/store/Filters';
export default {
    name:"SideFilters",
    components:{
        Filters
    },
    methods:{
      toggle () {
        this.$store.commit('overlay/toggle', false)
        this.$store.commit('sidefilter/toggle', false)
      }
    },
    computed: mapGetters({
      sideBarOpen: 'sidefilter/getNavState',
  })
};
</script>

<style lang="scss">
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  background-color:$white;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 20px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.category-link{
  padding: 8px 8px 8px 20px;
  text-decoration: none;
  display: block;
  transition: 1s;
  color: $selection-fill;
  font-size: 1rem !important;
  text-transform: uppercase;
}

.sidenav a:hover {
  color: $primary;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 25px;
  margin-top: 10px;
  margin-left: 50px;
}

.logo{
  position: absolute;
  top: 0px;
  left: 10px;
  margin-top: 24px;
  margin-right: 50px;}


.openNav{
  width: 325px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>