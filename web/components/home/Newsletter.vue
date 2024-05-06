<template>
<div class="header-container-parent">
 <div class="w-100 mt-5" style="position:relative;">
    <div class="header_image" style="width: 100%; height: auto;" alt>
      <img class="d-none d-sm-none d-md-none d-lg-block" style="width: 100%; height: auto;" src="@/assets/images/home/newsletter.jpg" />
      <img class="d-none d-sm-none d-md-block d-lg-none" style="width: 100%; height: auto;" src="https://via.placeholder.com/623x312">
      <img class="d-none d-sm-block d-md-none d-lg-none" style="width: 100%; height: auto;" src="https://via.placeholder.com/376">
      <img class="d-block d-sm-none d-md-none d-lg-none" style="width: 100%; height: auto;" src="https://via.placeholder.com/425">
    </div>
    <div class="content w-100" style="background-color: #0000006b;">
      <div class style="height:100%">
        <div class="content_container h-100">
          <div class="title_container">
            <div class="centered-div">
                <div class="cardt">
                    <div class="cardt-title">
                        Suscribete a nuestro Newsletter
                    </div>
                    <div class="cardt-subtitle">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed di
                    </div>
                    <div class="cardt-content">
                        <input class="form-control mx-md-2" placeholder="Escribe tu correo">
                        <button class="btn btn-primary mx-md-2">Suscribirse</button>
                    </div>
                    <div class="cardt-footer">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing
                    </div>
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
        name: "Newsletter"
    }
</script>

<style lang="scss" scoped>

.cardt{
    background-color: rgba($color: $white, $alpha: .9);
    padding: 2% 10%;
}

.header-container-parent{
  padding:0px 10%;
}


.cardt-title{
    font-size: 2rem;
    display: flex;
    width: 100%;
    justify-content: center;
    color:$primary
}

.cardt-subtitle{
    font-size: 1.2rem;
    text-align: center;
    color:$headers;
    margin-bottom: 30px;
}

.form-control{
    background-color: transparent;
    color: $primary;
    border-color: $primary;
}

.cardt-content{
    display: flex;
    justify-content: space-between;
}

.btn-primary{
    background-color: $primary;
    border-color: $primary;
    &:hover{
        background: $white;
        color: $primary;

    }
}

.cardt-footer{
    margin-top: 35px;
    font-size: 1.2rem;
    text-align: center;
    color:$gray-strong;
}

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


.content {
  float: left;
  position: absolute;
  left: 0px;
  top: 0px;
  z-index: 2;
  height: 100%;
  padding: 5px;
  color: #FFFFFF;
  font-weight: 500;
}

.pre_crumb {
  color: white;
}
.breadcrumb {
  display: flex;
  flex-wrap: wrap;
  padding: .75rem 0rem;
  margin-bottom: 1rem;
  list-style: none;
  background-color: transparent;
  border-radius: .25rem;
}

.title_container {
  display: flex;
  text-align: center;
  height: 100%;
  justify-content: space-around;
  flex-direction: column;
}

.centered-div{
  display: grid;
  place-items: center;;
}
.primary_tile {
  color: white;
  font-size: 3.8rem;
  line-height: 80px;
  font-weight: 500;
  padding-left:  25%;
  padding-right: 25%;
}

.secondary_title {
  font-size: 1.4rem;
  color: white;
}

.btn-custom {
  margin-top: 15px;
  background-color: $white;
  color: $primary ;
  padding: .3rem 1.5rem !important;
  font-size: 1.5rem;
  font-weight: 500;
  &:hover{
      color: $white;
      background-color: $primary;
  }
}


@media (max-width: 1024px) {
  .primary_tile {
      font-size: 1.9rem;
      line-height: 1.5;
      padding-right: 25%;
      padding-left: 25%;
      margin-bottom: 15px;
  }
  .header-container-parent{
    padding: 0px;
  }

  .secondary_title {
      font-size: 1.3rem;
      margin: 1rem 0px !important;
  }

  .btn-custom{
    padding: .3rem 1.6rem !important;
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
      margin: .5rem 0px !important;
  }
  .breadcrumb_container {
      display: none;
  }
  .btn-custom {
      font-size: 0.9rem ;
      padding: 1rem 2rem;
  }
  .header-container-parent{
    padding: 0px;
  }
  .cardt{
    width: 100%;
    height: 100%;
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  .centered-div{
    height: 100%;
    width: 100%;
  }

}

@media (max-width: 425px) {
  .header_image {
      display: block;
      width: 100%;
  }

  .secondary_title{
      font-size: .7rem;
      margin: .6rem 0px !important;
  }

  .primary_title {
    font-size: 1rem;
    line-height: 1.2;
  }
  .btn-custom{
    padding: .1rem .8rem !important;
    font-size: 1rem;
  }


  .cardt-title{
    font-size: 1rem;
    text-align: center;
}
.header-container-parent{
    padding: 0px;
  }

.cardt-subtitle{
    font-size: .9rem;
    text-align: center;
    margin-bottom: 30px;
}

.form-control{
    background-color: transparent;
    color: $primary;
    border-color: $primary;
}

.cardt-content{
    display: flex;
    justify-content: center;
    flex-direction: column;
}

.btn-primary{
  margin-top: 15px;
  width: 100%;
    background-color: $primary;
    border-color: $primary;
    &:hover{
        background: $white;
        color: $primary;

    }
  }
  .cardt{
    padding: 12px;
  }
}

@media (max-width: 375px) {
  .secondary_title{
      font-size: .6rem;
      margin: .4rem 0px !important;
  }
  .header-container-parent{
    padding: 0px;
  }

  .primary_tile {
    font-size: .9rem;
    padding-left: 25%;
    padding-right: 25%;
    line-height: 1;
  }
  .btn-custom{
    padding: 0rem .5rem !important;
    font-size: .8rem !important;
  }
}

@media (max-width: 320px) {
  .secondary_title{
      font-size: .6rem;
      margin: .4rem 0px !important;
  }

  .primary_tile {
    font-size: .9rem;
    padding-left: 15%;
    padding-right: 15%;
    line-height: 1;
  }
  .header-container-parent{
    padding: 0px;
  }
}
</style>
