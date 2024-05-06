<template>
  <div class="header-container-parent">
    <div class="p-0 m-0 item w-100" style="position:relative">
      <div class="header_image" style="width: 100%; height: auto;" alt>
        <img
          class="d-none d-sm-none d-md-none d-lg-block"
          style="width: 100%; height: auto;"
          src="@/assets/images/about.jpg"
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
      <div class="content w-100">
        <div class="container h-100">
          <div class style="height:100%">
            <div class="content_container h-100">
              <div class="title_container">
                <div class="centered-div">
                  <h1 class="primary_tile">Quienes Somos</h1>
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
  name: "CategoriesHeader",
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
  color: $white;
  font-size: 3.8rem;
  line-height: 80px;
  font-weight: 500;
}

.secondary_title {
  font-size: 1.4rem;
  color: $secondary;
}

.btn-custom {
  margin-top: 15px;
  background-color: $white;
  color: $primary;
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
    font-size: 2.3rem;
    line-height: 1;
  }
  .header-container-parent{
    padding: 0px;
  }

  .secondary_title {
    font-size: 1.5rem;
  }
}

@media (max-width: 768px) {
  .content_container {
    height: 100%;
  }
  .header-container-parent{
    padding: 0px;
  }
  .primary_tile {
    font-size: 3rem;
    line-height: 1;
  }
  .secondary_title {
    font-size: 2rem;
  }
  .breadcrumb_container {
    display: none;
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
    font-size: 2rem;
  }

  .primary_tile {
    font-size: 3rem;
  }
  .btn-custom {
    padding: 0.1rem 0.8rem !important;
    font-size: 1rem;
  }
}
</style>
