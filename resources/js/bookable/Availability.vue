<template>
    <div>
        <h5 class="text-uppercase text-secondary font-weight-bolder">Availability</h5>

        <div class="form row">
            <div class="form-group col-md-6">
                <label for="from">From:</label>
                <input type="text" name="from" id="from" class="form-control form-control-sm" placeholder="Start date" v-model="startDate">
            </div>
            <div class="form-group col-md-6">
                <label for="to">To:</label>
                <input type="text" name="to" id="to" class="form-control form-control-sm" placeholder="End date" v-model="endDate">
            </div>
        </div>
        <div class="form row mt-2">
            <div class="form-group col-md-12">
                <DatePicker @period-selected="periodSelected" format="DD/MM/YYYY"></DatePicker>
            </div>
        </div>

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
            startDate: null,
            endDate: null
        }
    },
    methods: {
        periodSelected(event, startDate, endDate) {
            this.startDate = moment(startDate).format('DD/MM/YYYY');
            this.endDate = moment(endDate).format('DD/MM/YYYY');
        }
    },
    computed: {
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
