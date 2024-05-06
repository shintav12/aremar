<template>
  <div class="header-container-parent">
    <div class="p-0 px m-0 item w-100" style="position:relative;">
    <div class="header_image" style="width: 100%; height: auto;" alt>
      <img
        class="d-none d-sm-none d-md-none d-lg-block"
        style="width: 100%; height: auto;"
        src="@/assets/images/home/main_banner.jpg"
      />
      <img
        class="d-none d-sm-none d-md-block d-lg-none"
        style="width: 100%; height: auto;"
        src="https://via.placeholder.com/623x312"
      />
      <img
        class="d-none d-sm-block d-md-none d-lg-none"
        style="width: 100%; height: auto;"
        src="https://via.placeholder.com/376"
      />
      <img
        class="d-block d-sm-none d-md-none d-lg-none"
        style="width: 100%; height: auto;"
        src="https://via.placeholder.com/425"
      />
    </div>
    <div class="content w-100" style="background-color: #0000006b;">
      <div class="container h-100">
        <div class style="height:100%">
          <div class="content_container h-100">
            <div class="title_container">
              <div class="centered-div">
                <h4
                  class="secondary_title my-2"
                  style="font-weight: 500 !important;"
                >{{header.secondary_text}}</h4>
                <h1 class="primary_tile">{{header.main_text}}</h1>

                <a
                  class="btn btn-custom"
                  :target="header.btn_target"
                  :href="header.btn_link"
                >{{header.btn_text}}</a>
              </div>
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
  name: "Header",
  props: ["header"],
};
</script>

<style lang="scss" scoped>
.container {
  position: relative;
}

.header_image {
  display: block;
  width: 100%;
}

.content_container {
  height: 90%;
}

.header-container-parent{
  padding: 0px 10%;
}

.content {
  float: left;
  position: absolute;
  left: 0px;
  top: 0px;
  z-index: 2;
  height: 100%;
  padding: 5px;
  color: #ffffff;
  font-weight: 500;
}

.pre_crumb {
  color: white;
}
.breadcrumb {
  display: flex;
  flex-wrap: wrap;
  padding: 0.75rem 0rem;
  margin-bottom: 1rem;
  list-style: none;
  background-color: transparent;
  border-radius: 0.25rem;
}

.title_container {
  display: flex;
  text-align: left;
  height: 100%;
  justify-content: space-around;
  flex-direction: column;
}

.centered-div {
  display: flex;
  justify-content: flex-start;
  flex-direction: column;
}
.primary_tile {
  color: white;
  font-size: 3.8rem;
  line-height: 80px;
  font-weight: 500;
  padding-right: 30%;
}

.secondary_title {
  font-size: 1.4rem;
  color: white;
}

.btn-custom {
  margin-top: 15px;
  background-color: $white;
  color: $primary;
  width: 150px;
  padding: 0.3rem 1.5rem !important;
  font-size: 1.5rem;
  font-weight: 500;
  &:hover {
    color: $white;
    background-color: $primary;
  }
}

@media (max-width: 1024px) {
  .primary_tile {
    font-size: 1.9rem;
    line-height: 1.5;
    padding-right: 25%;
    margin-bottom: 15px;
  }

  .header-container-parent{
    padding: 0px;
  }


  .secondary_title {
    font-size: 1.3rem;
    margin: 1rem 0px !important;
  }

  .btn-custom {
    padding: 0.3rem 1.6rem !important;
    font-size: 1.2rem;
  }
}

@media (max-width: 768px) {
  .content_container {
    height: 100%;
  }
  .primary_tile {
    font-size: 1.7rem;
    line-height: 1.5;
  }
  .secondary_title {
    font-size: 1rem;
    margin: 0.5rem 0px !important;
  }
  .breadcrumb_container {
    display: none;
  }
  .btn-custom {
    font-size: 0.9rem;
    padding: 1rem 2rem;
  }
    .header-container-parent{
    padding: 0px;
  }
}

@media (max-width: 425px) {
  .header_image {
    display: block;
    width: 100%;
  }
    .header-container-parent{
    padding: 0px;
  }

  .secondary_title {
    font-size: 0.7rem;
    margin: 0.6rem 0px !important;
  }

  .primary_tile {
    font-size: 1rem;
    line-height: 1.2;
  }
  .btn-custom {
    padding: 0.1rem 0.8rem !important;
    font-size: 1rem;
  }
}

@media (max-width: 375px) {
  .secondary_title {
    font-size: 0.6rem;
    margin: 0.4rem 0px !important;
  }
    .header-container-parent{
    padding: 0px;
  }

  .primary_tile {
    font-size: 0.9rem;

    padding-right: 25%;
    line-height: 1;
  }
  .btn-custom {
    padding: 0rem 0.5rem !important;
    font-size: 0.8rem !important;
  }
}

@media (max-width: 320px) {
  .secondary_title {
    font-size: 0.6rem;
    margin: 0.4rem 0px !important;
  }
    .header-container-parent{
    padding: 0px;
  }

  .primary_tile {
    font-size: 0.9rem;
    padding-right: 15%;
    line-height: 1;
  }
}
</style>
