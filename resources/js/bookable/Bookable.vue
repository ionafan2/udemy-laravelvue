<template>
    <div class="row">
        <div class="col-md-7 pb-4">
            <div class="card">
                <div class="card-body">
                    <div v-if="!loading">
                        <h2>{{ bookable.title }}</h2>
                        <hr>
                        <article>
                            {{ bookable.description }}
                        </article>
                    </div>
                    <div v-else>Loading...</div>
                </div>
            </div>

            <review-list :bookable-id="this.$route.params.id"></review-list>
        </div>
        <div class="col-md-5">
            <availability
                :bookable-id="this.$route.params.id"
                @availability="checkPrice($event)"
                class="mb-4"
            ></availability>

            <transition name="fade">
                <price-breakdown v-if="price" :price="price" class="mb-4"></price-breakdown>
            </transition>

            <transition name="fade">
                <button class="btn btn-outline-secondary btn-block" v-if="price" @click="addToBasket">Book now</button>
            </transition>
        </div>
    </div>
</template>

<script>
import Availability from "./Availability";
import ReviewList from "./ReviewList";
import PriceBreakdown from "./PriceBreakdown";

import {mapState} from "vuex";

export default {
    name: "Bookable",
    components: {
        Availability,
        ReviewList,
        PriceBreakdown
    },
    data() {
        return {
            loading: false,
            bookable: null,
            price: null
        }
    },
    created() {
        this.loading = true;
        axios.get(`/api/bookables/${this.$route.params.id}`).then(result => {
            this.bookable = result.data.data;
            this.loading = false;
        });
    },
    computed: {
        ...mapState({
            lastSearch: "lastSearch"
        })
    },
    methods: {
        async checkPrice(hasAvailability) {
            if (!hasAvailability) {
                this.price = null;
                return;
            }

            try {
                this.price = (await axios.get(
                    `/api/bookables/${this.bookable.id}/price?startDate=${this.lastSearch.startDate}&endDate=${this.lastSearch.endDate}`
                )).data.data;
            } catch (err) {
                this.price = null;
            }
        },
        addToBasket() {
            this.$store.commit("addToBasket", {
                bookable: this.bookable,
                price: this.price,
                dates: this.lastSearch
            });
        }
    }
}

</script>
