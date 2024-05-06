<template>
    <div id="overlay" v-bind:class="{'open': sideBarOpen}"></div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
    export default {
        name:"Overlay",
         computed: mapGetters({
    sideBarOpen: 'overlay/getNavState'
  })
    }
</script>

<style lang="scss" scoped>
    #overlay {
    position: fixed; /* Sit on top of the page content */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    display: none;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
    z-index: 9998; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
    }
    .open {
        display: block !important;
    }
</style>