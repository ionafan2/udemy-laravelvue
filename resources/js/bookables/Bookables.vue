<template>
    <div>
        <div v-if="loading">Data is loading</div>
        <div v-else>
            <bookable-list-item
                :item-title="bookable.title"
                :item-content="bookable.content"
                :price="1500"
                v-for="(bookable,index) in bookables"
                :key="index"
            >
            </bookable-list-item>
        </div>
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
            bookables: null,
            loading: false,
        }
    },
    created() {
        this.loading = true;
        setTimeout(() => {
            this.bookables = [
                {
                    title: 'Cheap villa',
                    content: 'Very Cheap villa'
                },
                {
                    title: 'Cheap villa 2',
                    content: 'Very Cheap villa'
                }
            ];
            this.loading = false;
        }, 2000);
    }
}
</script>

<style scoped>

</style>
