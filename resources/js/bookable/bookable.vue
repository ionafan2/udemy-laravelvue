<template>
    <div>
<!--        <bookable-list-item-->
<!--            :item-title="bookable.title"-->
<!--            :item-description="bookable.description"-->
<!--            :price="bookable.price"-->
<!--        >-->
<!--        </bookable-list-item>-->
    </div>
</template>

<script>
export default {
    name: "bookable",
    data() {
        return {
            bookable: null
        }
    },
    created() {
        //console.log(this.$route.params.id);
        axios.get(`/api/bookables/${this.$route.params.id}`).then(result => {
            this.bookable = result.data;
            console.log('test');

        });
    }
}

</script>

<style scoped>

</style>
