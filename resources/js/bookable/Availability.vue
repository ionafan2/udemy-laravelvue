<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder">
            Check Availability
            <transition name="fade">
                <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
                <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
            </transition>
        </h5>

        <div class="form row">
            <div class="form-group col-md-6">
                <label for="startDate">From:</label>
                <input type="text" name="startDate" id="startDate" :class="[{'is-invalid': errorFor('startDate')}]"
                       class="form-control form-control-sm" placeholder="Start date"
                       v-model="startDate">
                <validation-errors :errors="errorFor('startDate')"></validation-errors>
            </div>
            <div class="form-group col-md-6">
                <label for="endDate">To:</label>
                <input type="text" name="endDate" id="endDate" :class="[{'is-invalid': errorFor('endDate')}]"
                       class="form-control form-control-sm" placeholder="End date"
                       v-model="endDate">
                <validation-errors :errors="errorFor('endDate')"></validation-errors>
            </div>
        </div>
        <div class="form row mt-2">
            <div class="form-group col-md-12">
                <DatePicker @period-selected="periodSelected" format="DD/MM/YYYY"></DatePicker>
            </div>
        </div>
        <span v-if="!loading">Select dates above</span>
        <span v-if="loading">
            <i class="fas fa-circle-notch fa-spin"></i> Checking...
        </span>
    </div>
</template>

<script>
// DatePicker @see https://github.com/krystalcampioni/vue-hotel-datepicker
import DatePicker from 'vue-hotel-datepicker'
import 'vue-hotel-datepicker/dist/vueHotelDatepicker.css';

import moment from 'moment';
import {is422} from "../shared/utils/response";
import ValidationErrors from "../shared/mixins/validationErrors";

export default {
    name: "Availability",
    mixins: [ValidationErrors],
    components: {DatePicker},
    props: {
        bookableId: [String, Number]
    },
    data() {
        return {
            loading: false,
            status: null,
            startDate: this.$store.state.lastSearch.startDate,
            endDate: this.$store.state.lastSearch.endDate
        }
    },
    methods: {
        async periodSelected(event, startDate, endDate) {
            this.loading = true;
            this.errors = null;

            this.startDate = moment(startDate).format('YYYY-MM-DD');
            this.endDate = moment(endDate).format('YYYY-MM-DD');

            this.$store.dispatch('setLastSearch', {
                startDate: this.startDate,
                endDate: this.endDate
            })

            try {
                this.status = (await axios.get(
                    `/api/bookables/${this.bookableId}/availability?startDate=${this.startDate}&endDate=${this.endDate}`
                )).status;

                this.$emit("availability", this.hasAvailability);

            } catch (err) {

                if (is422(err)) {
                    this.errors = err.response.data.errors;
                }

                this.status = err.response.status;
                this.$emit("availability", this.hasAvailability);
            }

            this.loading = false;
        }
    },
    created() {
    },
    computed: {
        hasErrors() {
            return 422 === this.status && this.errors !== null;
        },
        hasAvailability() {
            return 200 === this.status;
        },
        noAvailability() {
            return 404 === this.status;
        }
    }
}
</script>

<style scoped>
label {
    font-size: 0.7rem;
    text-transform: uppercase;
    color: gray;
    font-weight: bolder;
}
</style>
