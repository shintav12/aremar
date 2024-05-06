<template>
<div style="padding:0px 10% !important">
 <div class="py-5">
    <div class="container my-5">
      <div class="benefit-container">
          <div class="benefit">
            <div class="benefit-icon">
              <img width="25%" class="img-fluid" src="@/assets/icons/heart.svg" />
            </div>
            <div class="benefit-title my-2">Lorem ipsum dolortu</div>
            <div class="benefit-description">Lorem ipsum dolor</div>
          </div>
          <div class="benefit middle">
            <div class="benefit-icon">
              <img width="25%" class="img-fluid" src="@/assets/icons/heart.svg" />
            </div>
            <div class="benefit-title my-2">Lorem ipsum dolortu</div>
            <div class="benefit-description">Lorem ipsum dolor</div>
          </div>
          <div class="benefit">
            <div class="benefit-icon">
              <img width="25%" class="img-fluid" src="@/assets/icons/heart.svg" />
            </div>
            <div class="benefit-title my-2">Lorem ipsum dolortu</div>
            <div class="benefit-description">Lorem ipsum dolor</div>
          </div>
      </div>
    </div>
  </div>
</div>

</template>

<script>
export default {
  name: "Benefits",
};
</script>

<style lang="scss" scoped>
.bg-gray{
    background-color: $background-gray;
}
.benefit-container{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.middle{
    border-right: 2px solid $selection-fill !important;
    border-left: 2px solid $selection-fill !important;
    padding: 20px 8%;
}
.benefit{
    margin: 15px 15px;
    .benefit-icon{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .benefit-title{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 500;
        font-size: 1.5rem;
        color:$headers;
    }
    .benefit-description{
        text-align: center;
        font-size: 1rem;
        color: $gray-strong;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

@media (max-width: 425px){
    .middle{
        border-top: 2px solid $selection-fill !important;
        border-bottom: 2px solid $selection-fill !important;
        border-left: 0px solid $selection-fill !important;
        border-right: 0px solid $selection-fill !important;
        padding: 10% 0%;
    }
    .benefit-container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .benefit{
        margin: 15px 15px;
    .benefit-icon{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .benefit-title{
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: 500;
        font-size: 1.5rem;
        color:$headers;
    }
    .benefit-description{
        text-align: center;
        font-size: 1rem;
        color: $gray-strong;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
}
</style>
