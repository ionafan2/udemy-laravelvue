<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder">Availability</h5>

        <div class="form row">
            <div class="form-group col-md-6">
                <label for="from">From:</label>
                <input type="text" name="from" id="from" class="form-control form-control-sm" placeholder="Start date"
                       v-model="startDate">
            </div>
            <div class="form-group col-md-6">
                <label for="to">To:</label>
                <input type="text" name="to" id="to" class="form-control form-control-sm" placeholder="End date"
                       v-model="endDate">
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

        }
    },
    created() {
    },
    computed: {}
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
