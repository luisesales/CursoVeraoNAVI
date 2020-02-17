<template>
    <div>
            <CardCarrosel/>
            <CardCarros/>
    </div>
</template>

<script>
    import CardCarrosel from "../Cards/CardCarrosel"
    import CardCarros from "../Cards/CardCarros"

    export default {
        name: "Home",
        components: {CardCarrosel,CardCarros}
    }
</script>

<style scoped>

</style>
