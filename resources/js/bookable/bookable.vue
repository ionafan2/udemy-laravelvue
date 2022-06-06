<template>
    <div>
        <div v-if="loading">Data is loading</div>
        <div v-else>
            <bookable-list-item v-bind="bookable"></bookable-list-item>
        </div>
    </div>
</template>

<script>
import BookableListItem from "../bookables/BookableListItem";

export default {
    name: "Bookable",
    components: {
        BookableListItem
    },
    data() {
        return {
            loading: false,
            bookable: null
        }
    },
    created() {
        this.loading = true;
        axios.get(`/api/bookables/${this.$route.params.id}`).then(result => {
            this.bookable = result.data;
            this.loading = false;
        });
    }
}

</script>

<style scoped>

</style>
