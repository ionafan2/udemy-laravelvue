<template>
    <div class="p-4">
        <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">Reviews list</h6>
        <div class="border-bottom d-none d-md-block" v-for="number in 3" :key="number">
            <div class="row pt-4 ">
                <div class="col-md-6">Victor Pupkin</div>
                <div class="col-md-6 d-flex justify-content-end">⭐️⭐️⭐️⭐️⭐️</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    Added 5 minutes ago
                </div>
            </div>
            <div class="row pt-4 pb-4">
                <div class="col-md-12">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto autem corporis
                        error, iste iusto maxime modi neque nihil obcaecati pariatur quibusdam rerum suscipit tempora ut
                        voluptas voluptatem voluptates, voluptatum?</p>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReviewList"
}
</script>

<style scoped>

</style>
