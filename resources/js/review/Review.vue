<template>
    <div>

        <form>
            <div class="mb-3">
                <label for="rating" class="form-label text-muted">Select Star Rating</label>
                <star-rating :rating="review.rating" class="fa-3x" @rating:changed="review.rating = $event"></star-rating>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label text-muted">Your review content</label>
                <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <button class="btn btn-lg btn-primary w-100 form-control">Submit</button>
        </form>

    </div>
</template>

<script>
export default {
    name: "Review",
    data() {
        return {
            review: {
                rating: 5,
                content: null
            }
        }
    }
}
</script>

<style scoped>

</style>
