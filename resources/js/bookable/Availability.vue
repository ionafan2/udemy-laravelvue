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
                <input type="text" name="startDate" id="startDate" :class="[{'is-invalid': this.errorFor('startDate')}]"
                       class="form-control form-control-sm" placeholder="Start date"
                       v-model="startDate">
                <div v-for="(error,i) in this.errorFor('startDate')" class="invalid-feedback" :key="'startDate'+ i">
                    {{ error }}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="endDate">To:</label>
                <input type="text" name="endDate" id="endDate" :class="[{'is-invalid': this.errorFor('endDate')}]"
                       class="form-control form-control-sm" placeholder="End date"
                       v-model="endDate">

                <div v-for="(error,i) in this.errorFor('endDate')" class="invalid-feedback" :key="'endDate'+ i">
                    {{ error }}
                </div>
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
import DatePicker from 'vue-hotel-datepicker'
import 'vue-hotel-datepicker/dist/vueHotelDatepicker.css';
//@see https://github.com/krystalcampioni/vue-hotel-datepicker

import moment from 'moment';

export default {
    name: "Availability",
    components: {DatePicker},
    data() {
        return {
            loading: false,
            status: null,
            errors: null,
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
                `/api/bookables/${this.$route.params.id}/availability`, {
                    params: {
                        startDate: this.startDate,
                        endDate: this.endDate
                    }
                }).then(result => {
                this.status = result.status;

                console.log(result);
                this.loading = false;

            }).catch(error => {
                if (422 === error.response.status) {
                    this.errors = error.response.data.errors;
                }

                this.status = error.response.status;
            }).then(() => this.loading = false);

        },
        errorFor(field) {
            return this.hasErrors && this.errors[field] ? this.errors[field] : null;
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
