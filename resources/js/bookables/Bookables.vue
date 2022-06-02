<template>
    <div>
        <bookable-list-item
            :item-title="bookable1.title"
            :item-content="bookable1.content"
            :price="1500">

        </bookable-list-item>

        <bookable-list-item
            :item-title="bookable2.title"
            :item-content="bookable2.content"
            :price="1500">

        </bookable-list-item>

        <bookable-list-item
            :item-title="bookable3.title"
            :item-content="bookable3.content"
            :price="1500">

        </bookable-list-item>
    </div>
</template>

<script>
import BookableListItem from "./BookableListItem";

export default {
    name: "Bookables",
    components: {
        BookableListItem
    },
    data() {
        return {
            bookable1: null,
            bookable2: null,
        }
    },
    beforeCreate() {
    },
    created() {
        console.log(this.bookable1);
        console.log(this.bookable2);
        setTimeout(() => {
            this.bookable1 = {
                title: 'Cheap villa',
                content: 'Very Cheap villa'
            };
            this.bookable2 = {
                title: 'Cheap villa 2',
                content: 'Very Cheap villa'
            };
            this.bookable3 = {
                title: 'Expensive villa 3',
                content: 'Very Expensive villa'
            };
        }, 5000);

        setTimeout(() => {
            console.log('First Change');
            this.bookable1.title = 'You will see this'
        }, 8000);

        setTimeout(() => {
            console.log('Second Change');
            this.bookable3.title = 'You wont see this'
        }, 12000);

    },
    beforeMount() {
    },
    mounted() {
    },
    beforeDestroy() {
    },
    destroyed() {
    }
}
</script>

<style scoped>

</style>
