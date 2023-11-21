<template>

    <label :for="`hour-input-${uuid}`" class="title">
        {{ label }}
    </label>

    <TimePicker 
        :id="`hour-input-${uuid}`"
        class="hour-input" 
        format="HH:mm" 
        :minuteStep="10" 
        :value="null"
        @change="(time, timeStr) => addHour(timeStr)">
    </TimePicker>

    <transition-group name="list-complete" tag="div" class="hours">
        <div 
            v-for="hour in hours.sort()" 
            class="hour list-complete-item"
            :key="hour" 
            :title="`Delete ${hour}`"
            @click="deleteHour(hour)">
            {{ hour }}
        </div>
    </transition-group>

</template>

<script>
import {TimePicker} from 'ant-design-vue'

export default {
    props: ['hours', 'label',],
    components: {
        TimePicker,
    },
    data() {
        return {
            uuid: Math.random(),
        }
    },
    methods: {
        addHour(hour) {
            if (this.hours.indexOf(hour) != -1) return

            const newHours = this.hours.concat([hour])
            this.$emit('update:hours', newHours)
            this.$emit('change', newHours)
        },
        deleteHour(hour) {
            const newHours = this.hours.filter(val => val != hour)
            this.$emit('update:hours', newHours)
            this.$emit('change', newHours)
        },
    },
}
</script>

<style scoped>
.hour-input {
    width: 100%;
    margin-bottom: 10px;
}
.hours {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}
.hour {
    padding: 10px;
    border-radius: 5px;
    background-color: #a49561b0;
    font-size: 17px;
    line-height: 1;
    color: white;
    cursor: pointer;
}
.hour:hover {
    background-color: #9d1f1f;
}
.list-complete-item {
    transition: opacity,transform 0.7s ease;
}
.list-complete-enter-from,
.list-complete-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
.list-complete-leave-active {
    position: absolute;
}
</style>