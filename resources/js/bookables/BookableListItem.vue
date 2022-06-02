<template>
    <div>
        <h1>{{ itemTitle }}</h1>
        <p>{{ itemContent }}</p>
    </div>
</template>

<script>
export default {
    props: {
        'itemTitle': String,
        'itemContent': String,
        'price': Number
    },
    mounted() {
        // setTimeout(_=>{
        //     this.itemTitle = 'New Title';
        // }, 1500);
    }
}
</script>

<style scoped>

</style>
