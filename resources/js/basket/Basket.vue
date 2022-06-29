<template>
    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_names">First names</label>
                        <input type="text" class="form-control" name="first_names" v-model="customer.first_names" />
                        <validation-errors :errors="errorFor('first_names')"></validation-errors>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" name="last_name" v-model="customer.last_name"  />
                        <validation-errors :errors="errorFor('last_name')"></validation-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" v-model="customer.email" />
                        <validation-errors :errors="errorFor('email')"></validation-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" name="street" v-model="customer.street" />
                        <validation-errors :errors="errorFor('street')"></validation-errors>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" v-model="customer.city" />
                        <validation-errors :errors="errorFor('city')"></validation-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country"  v-model="customer.country"/>
                        <validation-errors :errors="errorFor('country')"></validation-errors>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" name="state" v-model="customer.state"/>
                        <validation-errors :errors="errorFor('')"></validation-errors>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" name="zip" v-model="customer.zip" />
                        <validation-errors :errors="errorFor('')"></validation-errors>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12 mb-3 d-grid gap-2">
                        <button type="submit" @click.prevent="book" class="btn btn-lg btn-primary btn-block">Book now!</button>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase text-secondary font-weight-bolder">Your Cart</h6>
                    <h6 class="badge bg-success text-uppercase">
                        <span v-if="itemsInBasket">Items {{ itemsInBasket }}</span>
                        <span v-else>Empty</span>
                    </h6>
                </div>

                <transition-group name="fade" tag="div">
                    <div v-for="item in basket" :key="item.bookable.id">
                        <div class="pt-2 pb-2 border-top d-flex justify-content-between">
                            <span>
                                <router-link :to="{name: 'bookable', params: {id: item.bookable.id}}">{{
                                        item.bookable.title
                                    }}</router-link>
                            </span>
                            <span class="font-weight-bold">${{ item.price.total }}</span>
                        </div>
                        <div class="pt-2 pb-2 d-flex justify-content-between">
                            <span>From {{ item.dates.startDate }}</span>
                            <span>To {{ item.dates.endDate }}</span>
                        </div>
                        <div class="pt-2 pb-2 text-right">
                            <button
                                class="btn btn-sm btn-outline-secondary"
                                @click="$store.dispatch('removeFromBasket', item.bookable.id)"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </transition-group>
            </div>
        </div>
    </div>
</template>


<script>
import {mapGetters, mapState} from "vuex";
import ValidationErrors from "../shared/mixins/validationErrors";

export default {
    mixins: [
        ValidationErrors
    ],
    data() {
        return {
            loading: false,
            customer: {
                first_names: null,
                last_name: null,
                street: null,
                city: null,
                email: null,
                country: null,
                state: null,
                zip: null
            }
        }
    },
    computed: {
        ...mapGetters(["itemsInBasket"]),
        ...mapState({
            basket: state => state.basket.items
        })
    },
    methods: {
        async book() {
            this.loading = true;

            try {
                await axios.post(`/api/checkout`, {
                    customer: this.customer,
                    bookings: this.basket.map(basketItem => ({
                        bookable_id: basketItem.bookable.id,
                        startDate: basketItem.dates.startDate,
                        endDate: basketItem.dates.endDate
                    }))
                });

            } catch (err) {

            }

            this.loading = false;
        }
    }
};
</script>

<style scoped>
h6.badge {
    font-size: 100%;
}
</style>
