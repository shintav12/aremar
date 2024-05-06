<template>

  <div>
    <Sidebar />
    <Overlay />
    <SideFilter />
    <div id="main">
      <Navbar />
      <Nuxt />
      <Footer />
    </div>
  </div>
</template>
<script>

import Navbar from "../components/layout/Navbar";
import Footer from "../components/layout/Footer";
import Sidebar from "../components/layout/Sidebar";
import Overlay from "../components/layout/Overlay";
import SideFilter from "../components/layout/SideFilter";
export default {
  components: {
    Navbar,
    Footer,
    Overlay,
    Sidebar,
    SideFilter
  },
  data() {
    return {
      sideBarOpen: false,
    };
  },
  methods: {},
};
</script>
<style lang="scss">
html {
  font-family: Roboto, sans-serif;
  height: 100%;
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: inherit;
}

body {
  position: relative;
  margin: 0;
  padding: 0;
  min-height: 100%;
}
</style>
