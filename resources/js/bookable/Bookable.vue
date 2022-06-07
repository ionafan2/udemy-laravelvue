<template>
    <div>
        <div class="row" v-if="loading"><div class="col-md-12">Data is loading...</div></div>
        <div class="row" v-else >
            <div class="col-md-7">
                <bookable-list-item v-bind="bookable"></bookable-list-item>
            </div>
            <div class="col-md-5">
                <availability></availability>
            </div>
        </div>
    </div>
</template>

<script>
import BookableListItem from "../bookables/BookableListItem";
import Availability from "./Availability";

export default {
    name: "Bookable",
    components: {
        BookableListItem,
        Availability
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
            this.bookable = result.data.data;
            this.loading = false;
        });
    }
}

</script>
