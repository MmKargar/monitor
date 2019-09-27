import Vue from 'vue';
import Vuex from 'vuex';
import day from './components/day';
import Axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        message: 'message from vuex'
    },
    mutations: {
        increment(state) {
            state.count++
        }
    }
})

const app = new Vue({
    el: '#app',
    data: {
        date: '0',
        message: '0',
        average_power: '0',
        average_voltage: '0',
        total_power: '0',
        total_yield: '0',
        global_irradiation: '0',
        ambient_temp: '0',
        pv_temp: '0',
        wind_speed: '0',
    },
    store: store,
    components: {
        day
    },
    methods: {
        async get_data() {
            var dt = {
                'day': document.getElementById('day-date').value
            }
            await Axios.post(get_data_route, dt)
                .then(response => {
                    this.date = response.data.date;
                    this.message = response.data.message;
                    this.global_irradiation = response.data.global_irradiation;
                    this.wind_speed = response.data.wind_speed;
                    this.pv_temp = response.data.pv_temp;
                    this.ambient_temp = response.data.ambient_temp;
                    this.total_power = response.data.total_power;
                    this.average_power = response.data.average_power;
                    this.average_voltage = response.data.average_voltage;
                    this.total_yield = response.data.total_yield;
                    average_power = response.data.average_power_chart;
                    total_power = response.data.total_power_chart;
                    total_yield = response.data.total_yield_chart;
                    day_data = response.data.day_chart_data;

                    // use configuration item and data specified to show chart
                    averagepower_option.series[0].data[0].value = average_power;
                    totalpower_option.series[0].data[0].value = total_power;
                    totalyield_option.series[0].data[0].value = total_yield;

                    averagepower.setOption(averagepower_option, true);
                    totalpower.setOption(totalpower_option, true);
                    totalyield.setOption(totalyield_option, true);

                    // day chart rebuild
                    addData(day_chart, day_data);

                })
                .catch(error => console.log(error));

            setTimeout(() => {
                this.get_data();
            }, refresh_rate * 1000);

        }
    },
    mounted() {
        // run this function every second
        this.get_data();
    }
});