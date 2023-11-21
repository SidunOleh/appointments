<template>

    <Hours 
        label="Set default working hours"
        v-model:hours="hours"
        @change="setHours"/>

</template>

<script>
import axios from 'axios'
import Hours from '../Elements/Hours.vue'
import {errorHandler} from '../../utils.js'

export default {
    components: {
        Hours,
    },
    data() {
        return {
            hours: [],
        }
    },
    methods: {
        getHours() {
            axios.get('/wp-json/appointments/v1/working-hours')
                .then(res => {
                    if (res.data.success) {
                        this.hours = res.data.data
                    }
                }).catch(errorHandler) 
        },
        setHours() {
            axios.post('/wp-json/appointments/v1/working-hours', {
                'default_working_hours': this.hours,
            }).catch(errorHandler) 
        },
    },
    mounted() {
        this.getHours()
    },
}
</script>