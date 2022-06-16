<template>
    <div>
        <div v-if="loading">Loading</div>
        <div v-else>
            <div v-if="alreadyReviewed">
                You have already left review for this booking!
                </div>
            <div v-else>
                <div class="mb-3">
                    <label for="rating" class="form-label text-muted">Select Star Rating</label>
                    <star-rating v-model="review.rating" class="fa-3x"></star-rating>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label text-muted">Your review content</label>
                    <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <button class="btn btn-lg btn-primary w-100 form-control">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Review",
    data() {
        return {
            loading: false,
            review: {
                rating: 5,
                content: null
            },
            existingReview: null
        }
    },
    created() {
        this.loading = true;
        axios(`/api/reviews/${this.$route.params.id}`)
            .then(response => this.existingReview = response.data.data)
            .catch(errors => console.log(errors))
            .then(_ => this.loading = false)
        ;
    },
    computed: {
        alreadyReviewed() {
            return this.existingReview !== null;
        }
    }
}
</script>

<style scoped>

</style>
