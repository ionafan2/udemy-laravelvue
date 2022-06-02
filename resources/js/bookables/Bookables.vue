<template>
    <div>
        <bookable-list-item
            item-title="Cheap villa"
            item-content="A very chip villa"
            :price="1500">

        </bookable-list-item>
        <bookable-list-item item-title="Cheap villa" item-content="A very chip villa"></bookable-list-item>
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
    beforeCreate() {
    },
    created() {
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
