<template>
    <div class="container mt-4 pt-4">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="offer-container">
                    <div class="offer-image">
                        <img class="img-fluid" src="@/assets/images/home/offers/oferta1.jpg">
                    </div>
                    <div class="offer-content">
                        <span class="offer-name">Lorem ipsum dolor</span><br/>
                        <span class="offer-price">Desde S/ 60.00</span>
                    </div>
                </div>
            </div>
             <div class="col-md-4 mb-4 mb-md-0">
                <div class="offer-container">
                    <div class="offer-image">
                        <img class="img-fluid" src="@/assets/images/home/offers/oferta2.jpg">
                    </div>
                    <div class="offer-content">
                        <span class="offer-name">Lorem ipsum dolor</span><br/>
                        <span class="offer-price">Desde S/ 60.00</span>
                    </div>
                </div>
            </div>
             <div class="col-md-4 mb-4 mb-md-0">
                <div class="offer-container">
                    <div class="offer-image">
                        <img class="img-fluid" src="@/assets/images/home/offers/oferta3.jpg">
                    </div>
                    <div class="offer-content">
                        <span class="offer-name">Lorem ipsum dolor</span><br/>
                        <span class="offer-price">Desde S/ 60.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Offers"
    }
</script>

<style lang="scss" scoped>

.offer-content{
    float: left;
  position: absolute;
  left: 30px;
  top: 45px;
  z-index: 2;
  padding: 5px;
}

.offer-image{
    display: block;
  width: 100%;
}
.offer-name{
    font-size: 1.4rem;
    color:$primary;
    font-weight: 500;
}
.offer-price{
    font-size: 1.2rem;
    font-weight: 500;
    color:$gray-strong;
    text-decoration: underline;
}

@media (max-width: 990px) and (min-width: 768px) {
    .offer-name{
        font-size: .9rem;
        color:$primary;
        font-weight: 500;
    }
    .offer-price{
        font-size: .7rem;
        font-weight: 500;
        color:$gray-strong;
        text-decoration: underline;
    }
}
</style>
