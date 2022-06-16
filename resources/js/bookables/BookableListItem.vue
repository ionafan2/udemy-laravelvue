<template>
    <div class="card w-100">
        <div class="card-body">
            <router-link :to="{name : 'bookable', params: {id}}">
                <h5 class="card-title">
                    {{ title }}
                </h5>
            </router-link>
            <p class="card-text">{{ description }}</p>
            <p class="card-footer">{{ price | currency }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        'title': String,
        'description': String,
        'price': Number,
        'id': Number
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
