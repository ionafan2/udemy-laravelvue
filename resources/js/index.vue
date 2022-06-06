<template>
    <div>
        <nav class="navbar bg-white border-bottom navbar-light">
            <router-link class="nav-link navbar-brand" :to="{name: 'home'}">Home</router-link>
<!--            <router-link class="nav-link" :to="{name: 'bookable-show'}">Con</router-link>-->
        </nav>
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "index"
}
</script>

