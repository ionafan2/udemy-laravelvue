<template>
    <div>
        <div v-if="loading">Data is loading</div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-items-stretch" v-for="(bookable, column) in bookablesInRow(row)"
                     :key="'row' + row + column">
                    <bookable-list-item v-bind="bookable"></bookable-list-item>
                </div>
                <div class="col" v-for="p in placeHoldersInRow(row)" :key="'p' + row + p"></div>
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

        axios.get('/api/bookables').then(response => {
            this.bookables = response.data.data;
            this.loading = false;
        });
    }
}
</script>

<style scoped>

</style>
