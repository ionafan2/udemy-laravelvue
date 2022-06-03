<template>
    <div>
        <div v-if="loading">Data is loading</div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col" v-for="(bookable, column) in bookablesInRow(row)" :key="'row' + row + column">
                    <bookable-list-item
                        :item-title="bookable.title"
                        :item-content="bookable.content"
                        :price="1500"
                    >
                    </bookable-list-item>
                </div>
                <div class="col" v-for="p in placeHoldersInRow(row)" :key="'p' + row"></div>
            </div>

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
            columns: 3
        }
    },
    computed: {
        rows() {
            return this.bookables ? Math.ceil(this.bookables.length / this.columns) : 0;
        }
    },
    methods: {
        bookablesInRow(row) {
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },
        placeHoldersInRow(row) {
            return this.columns - this.bookablesInRow(row).length;
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
                },
                {
                    title: 'Cheap villa 2',
                    content: 'Very Cheap villa'
                },
                {
                    title: 'Cheap villa 2',
                    content: 'Very Cheap villa'
                },
                {
                    title: 'Cheap villa 2',
                    content: 'Very Cheap villa'
                },
                {
                    title: 'Cheap villa 2',
                    content: 'Very Cheap villa'
                },
                {
                    title: 'Cheap villa 2',
                    content: 'Very Cheap villa'
                }
            ];
            this.loading = false;
        }, 1000);
    }
}
</script>

<style scoped>

</style>
