<template>
    <div>
        <success v-if="success">Congratulations on your purchase!</success>
        <div class="row" v-else>
            <div class="col-md-8" v-if="itemsInBasket">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_names">First names</label>
                        <input type="text" class="form-control" name="first_names" v-model="customer.first_names"
                               :class="[{'is-invalid': errorFor('customer.first_names')}]"
                        />
                        <validation-errors :errors="errorFor('customer.first_names')"></validation-errors>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Last name</label>
                        <input type="text" class="form-control" name="last_name" v-model="customer.last_name"
                               :class="[{'is-invalid': errorFor('customer.last_name')}]"/>
                        <validation-errors :errors="errorFor('customer.last_name')"></validation-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" v-model="customer.email"
                               :class="[{'is-invalid': errorFor('customer.email')}]"/>
                        <validation-errors :errors="errorFor('customer.email')"></validation-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" name="street" v-model="customer.street"
                               :class="[{'is-invalid': errorFor('customer.street')}]"/>
                        <validation-errors :errors="errorFor('customer.street')"></validation-errors>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city">City</label>
                        <input type="text" class="form-control" name="city" v-model="customer.city"
                               :class="[{'is-invalid': errorFor('customer.city')}]"/>
                        <validation-errors :errors="errorFor('customer.city')"></validation-errors>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" name="country" v-model="customer.country"
                               :class="[{'is-invalid': errorFor('customer.country')}]"/>
                        <validation-errors :errors="errorFor('customer.country')"></validation-errors>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <input type="text" class="form-control" name="state" v-model="customer.state"
                               :class="[{'is-invalid': errorFor('customer.state')}]"/>
                        <validation-errors :errors="errorFor('customer.state')"></validation-errors>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" name="zip" v-model="customer.zip"
                               :class="[{'is-invalid': errorFor('customer.zip')}]"/>
                        <validation-errors :errors="errorFor('customer.zip')"></validation-errors>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-12 mb-3 d-grid gap-2">
                        <button type="submit" @click.prevent="book" class="btn btn-lg btn-primary btn-block"
                                :disabled="loading">Book now!
                        </button>
                    </div>
                </div>

            </div>
            <div class="col-md-8 bg-light rounded-3" v-else>
                <div class="container-fluid py-5 text-center">
                    <h1 class="display-5 fw-bold">Empty</h1>
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
    mixins: [ValidationErrors],
    data() {
        return {
            loading: false,
            bookingAttempted: false,
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
        }),
        success() {
            return !this.loading && 0 === this.itemsInBasket && this.bookingAttempted;
        }
    },
    methods: {
        async book() {
            this.loading = true;
            this.errors = false;
            this.bookingAttempted = false;

            try {
                await axios.post(`/api/checkout`, {
                    customer: this.customer,
                    bookings: this.basket.map(basketItem => ({
                        bookable_id: basketItem.bookable.id,
                        startDate: basketItem.dates.startDate,
                        endDate: basketItem.dates.endDate
                    }))
                });
                this.$store.dispatch("clearBasket");

            } catch (err) {
                this.errors = err.response && err.response.data.errors;
            }

            this.loading = false;
            this.bookingAttempted = true;
        }
    }
};
</script>

<style scoped>
h6.badge {
    font-size: 100%;
}
</style>
