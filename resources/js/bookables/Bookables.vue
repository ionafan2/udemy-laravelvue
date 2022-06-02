<template>
    <div>
        <bookable-list-item
            :item-title="bookable1.title"
            :item-content="bookable1.content"
            :price="1500">

        </bookable-list-item>

        <bookable-list-item
            :item-title="bookable2.title"
            :item-content="bookable2.content"
            :price="1500">

        </bookable-list-item>
        <bookable-list-item></bookable-list-item>
        <bookable-list-item></bookable-list-item>
        <bookable-list-item></bookable-list-item>
    </div>
</template>

<script>
import BookableListItem from "./BookableListItem";

export default {
    name: "Bookables",
    components: {
        BookableListItem
    },
    data() {
        return {
            bookable1 : {
                title: 'Cheap villa',
                content: 'Very Cheap villa'
            },
            bookable2 : {
                title: 'Cheap villa 2',
                content: 'Very Cheap villa'
            },
        }
    },
    beforeCreate() {
    },
    created() {
        console.log(this.bookable1);
        console.log(this.bookable2);
        setTimeout(() => {
            this.bookable1.title = "Expensive villa";
            this.bookable2.title = "Very Expensive villa";
        }, 5000);

    },
    beforeMount() {
    },
    mounted() {
    },
    beforeDestroy() {
    },
    destroyed() {
    }
}
</script>

<style scoped>

</style>
