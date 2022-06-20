<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder">
            Check Availability
            <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
            <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
        </h5>

        <div class="form row">
            <div class="form-group col-md-6">
                <label for="startDate">From:</label>
                <input type="text" name="startDate" id="startDate" :class="[{'is-invalid': errorFor('startDate')}]"
                       class="form-control form-control-sm" placeholder="Start date"
                       v-model="startDate">
                <v-errors :errors="errorFor('startDate')"></v-errors>
            </div>
            <div class="form-group col-md-6">
                <label for="endDate">To:</label>
                <input type="text" name="endDate" id="endDate" :class="[{'is-invalid': errorFor('endDate')}]"
                       class="form-control form-control-sm" placeholder="End date"
                       v-model="endDate">
                <v-errors :errors="errorFor('endDate')"></v-errors>
            </div>
        </div>
        <div class="form row mt-2">
            <div class="form-group col-md-12">
                <DatePicker @period-selected="periodSelected" format="DD/MM/YYYY"></DatePicker>
            </div>
        </div>
        <div v-if="loading">LOADING........</div>
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
        bookableId: String
    },
    data() {
        return {
            loading: false,
            status: null,
            startDate: null,
            endDate: null
        }
    },
    methods: {
        periodSelected(event, startDate, endDate) {
            this.loading = true;
            this.errors = null;

            this.startDate = moment(startDate).format('YYYY-MM-DD');
            this.endDate = moment(endDate).format('YYYY-MM-DD');

            axios.get(
                `/api/bookables/${this.bookableId}/availability`, {
                    params: {
                        startDate: this.startDate,
                        endDate: this.endDate
                    }
                }).then(result => {
                this.status = result.status;

                console.log(result);
                this.loading = false;

            }).catch(error => {
                if (is422(error)) {
                    this.errors = error.response.data.errors;
                }

                this.status = error.response.status;
            }).then(() => this.loading = false);

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
