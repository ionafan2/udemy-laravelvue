<template>
    <div>
        <bookable-list-item
            v-if="bookable1"
            :item-title="bookable1.title"
            :item-content="bookable1.content"
            :price="1500">

        </bookable-list-item>

        <bookable-list-item
            v-if="bookable2"
            :item-title="bookable2.title"
            :item-content="bookable2.content"
            :price="1500">
        </bookable-list-item>
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
            bookable1: null,
            bookable2: null,
        }
    },
    created() {
        setTimeout(() => {
            this.bookable1 = {
                title: 'Cheap villa',
                content: 'Very Cheap villa'
            };
            this.bookable2 = {
                title: 'Cheap villa 2',
                content: 'Very Cheap villa'
            };
        }, 2000);
    }
}
</script>

<style scoped>

</style>
