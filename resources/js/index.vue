<template>
    <div>
        <router-link :to="{name: 'home'}">Home</router-link>
        <router-link :to="{name: 'con'}">Con</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "index"
}
</script>

