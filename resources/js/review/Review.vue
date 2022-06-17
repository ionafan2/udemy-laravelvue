<template>
    <div class="row">
        <div :class="[{'col-md-4': loading || !alreadyReviewed}, {'d-none': !loading && alreadyReviewed}]">

            <div class="card">
                <div class="card-body">
                    <div v-if="loading">Loading</div>
                    <div v-else>
                        <p>Stayed at
                            <router-link
                                :to="{name: 'bookable', params: {id: booking.bookable.bookable_id}}">
                                {{ booking.bookable.title }}
                            </router-link>
                        </p>
                        <p>
                            From {{ booking.start_date }} to {{ booking.end_date }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div :class="[{'col-md-8': loading || !alreadyReviewed}, {'col-md-12': !loading && alreadyReviewed}]">
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
            existingReview: null,
            booking: null
        }
    },
    created() {
        this.loading = true;
        axios(`/api/reviews/${this.$route.params.id}`)
            .then(response => {
                this.existingReview = response.data.data // do not return
            })
            .catch(error => {
                if (error.response && error.response.status && 404 === error.response.status) {
                    return axios(`/api/booking-by-review/${this.$route.params.id}`)
                        .then((response) => {
                            this.booking = response.data.data;
                        });
                }
            })
            .then(() => this.loading = false)
        ;
    },
    computed: {
        alreadyReviewed() {
            return this.hasReview || !this.booking;
        },
        hasReview() {
            return this.existingReview !== null;
        },
        hasBooking() {
            return this.booking !== null;
        }
    }
}
</script>

<style scoped>

</style>
