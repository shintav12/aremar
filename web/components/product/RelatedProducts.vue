<template>
        <div class="row my-5">
            <div class="col-lg-3 col-md-4 col-6">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <Product />
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <Product />
            </div>
        </div>
</template>

<script>
import Product from "@/components/shared/Product"
    export default {
        name: "RelatedProducts",
        components:{
            Product
        }
    }
</script>

<style lang="scss" scoped>

</style>