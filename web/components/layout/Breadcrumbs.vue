<template>
    <div class="bg d-none d-lg-block">
        <div class="breadcrumb-container">
            <span class="crumb">Home</span>
            <span class="crumb">></span>
            <span class="crumb">Categoria</span>
            <span class="crumb">></span>
            <span class="crumb">Producto</span>
            <span class="crumb">></span>
            <span class="crumb">Coleccion</span>
            <span class="crumb">></span>
            <span class="crumb">Nombre del Producto</span>
        </div>
    </div>
</template>

<script>
    export default {
        name:"Breandcrumbs"
    }
</script>

<style lang="scss" scoped>
.breadcrumb-container{
    display: flex;
    justify-content: flex-start;
    padding: 10px 0px;
}
.crumb{
    margin: 0px 15px 0px 0px;
    color: $gray-icons;
    font-size: .9rem;
}
.bg{
    background-color: $secondary;
    padding: 0px 3rem;
}
</style>