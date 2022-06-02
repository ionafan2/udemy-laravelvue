<template>
    <div>
        <bookable-list-item></bookable-list-item>
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
    }
}
</script>

<style scoped>

</style>
