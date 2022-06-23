<template>
    <div class="p-4">
        <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">Reviews list</h6>
        <div v-if="!loading">
            <div class="border-bottom d-none d-md-block" v-for="(review,i) in reviews" :key="i">
                <div class="row pt-4 ">
                    <div class="col-md-6">Victor Pupkin</div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <star-rating :value="review.rating" class="fa-lg"></star-rating>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ review.created_at | moment("from") }}
                    </div>
                </div>
                <div class="row pt-4 pb-4">
                    <div class="col-md-12">
                        <p>{{ review.content }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>Loading...</div>
    </div>
</template>
<script>
export default {
    name: "ReviewList",
    components: {},
    props: {
        bookableId: [String, Number]
    },
    data() {
        return {
            loading: false,
            reviews: null
        }
    },
    created() {
        this.loading = true
        axios.get(`/api/bookables/${this.bookableId}/reviews`).then(result => {
            this.reviews = result.data.data;
            this.loading = false;
        });
    }
}
</script>
