<template>

    <div class="calendar">

        <div class="calendar__top">
            <div class="calendar__arrow" @click="swithMonth('prev')">
                ←
            </div>
            <div>
                {{ months[current.month] }} {{ current.year }}
            </div>
            <div class="calendar__arrow" @click="swithMonth('next')">
                →
            </div>
        </div>

        <div class="calendar__week">
            <span v-for="day in week">
                {{ day }}
            </span>
        </div>

        <div class="calendar__days">
            <div 
                v-for="day in days"
                :class="`calendar__day ${day.class}`"
                @click="selectDay(day)">
                {{ day.value }}
            </div>
        </div>

    </div>

</template>

<script>
export default {
    props: [
        'startDate', 
        'renderDay',
    ],
    data() {
        return {
            months: [
                'January', 'February', 'March', 
                'April', 'May', 'June', 
                'July', 'August', 'September', 
                'October', 'November', 'December'
            ],
            week: [
                'S', 'M', 'T', 'W', 'T', 'F', 'S'
            ],
            days: [],
            current: {
                year: null,
                month: null,
                day: null,
            },
        }
    },
    methods: {
        setDays() {
            this.days = [].concat(
                this.prevMonthDays(), 
                this.currMonthDays(), 
                this.nextMonthDays()
            )
        },
        prevMonthDays() {
            const prevMonthDays = []
            const prevMonthLastDay = 
                new Date(this.current.year, this.current.month, 0)
            if (prevMonthLastDay.getDay() == 6) {
                return prevMonthDays;
            }
            for (let i = prevMonthLastDay.getDay(); i >= 0; i--) {
                prevMonthDays.push({
                    value: prevMonthLastDay.getDate() - i,
                    month: 'prev',
                    class: 'prev',
                })
            }

            return prevMonthDays
        },
        currMonthDays() {
            const currMonthDays = []
            const currMonthDaysCount = 
                new Date(this.current.year, this.current.month + 1, 0).getDate()
            let currDay = null
            for (let i = 1; i <= currMonthDaysCount; i++) {
                currDay = {
                    value: i,
                    month: 'curr',
                    class: `curr ${i == this.current.day ? 'selected' : ''}`,
                }
                currMonthDays.push(this.renderDay ? this.renderDay(currDay, this.current) : currDay)
            }

            return currMonthDays
        },
        nextMonthDays() {
            const nextMonthDays = []
            const currMonthDaysCount = 
                new Date(this.current.year, this.current.month + 1, 0).getDate()
            const currMonthLastDay = 
                new Date(this.current.year, this.current.month, currMonthDaysCount)
            for (let i = 1; i <= 6 - currMonthLastDay.getDay(); i++) {
                nextMonthDays.push({
                    value: i,
                    month: 'next',
                    class: 'next',
                })
            }
            
            return nextMonthDays
        },
        selectDay(day) {
            if (day.month != 'curr') return

            this.current.day = day.value
            this.$emit('select', this.current)
            this.setDays()
        },
        swithMonth(prevNext) {
            let newDate = null
            if (prevNext == 'prev') {
                newDate = new Date(this.current.year, this.current.month, 0)
            } else if (prevNext == 'next') {
                newDate = new Date(this.current.year, this.current.month + 2, 0)
            } else {
                throw new Error('Invalid argument.')
            }

            this.current.year = newDate.getFullYear()
            this.current.month = newDate.getMonth()
            this.$emit('changeMonth', this.current)
            if (this.current.day) {
                this.current.day = this.current.day > newDate.getDate() ? 
                    newDate.getDate() : this.current.day
                this.$emit('select', this.current)
            }
            this.setDays()
        }, 
    },
    mounted() {
        this.current.year = this.startDate?.year ?? new Date().getFullYear()
        this.current.month = this.startDate?.month ?? new Date().getMonth()
        this.$emit('changeMonth', this.current)
        if (this.startDate?.day) {
            this.current.day = new Date().getDate()
            this.$emit('select', this.current)
        }
        this.setDays()
    },
}
</script>

<style scoped>
.calendar {
    color: #7E7E7E;
    font-size: 16px;
}
.calendar__top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    -ms-flex-align: center;
    padding: 15px;
    background-color: #F5F5F5;
    align-items: center;
}
.calendar__arrow {
    color: #000000;
    cursor: pointer;
}
.calendar__week {
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: (1fr)[7];
    grid-template-columns: repeat(7, 1fr);
    margin-top: 20px;
}
.calendar__week span {
    text-align: center;
}
.calendar__days {
    display: -ms-grid;
    display: grid;
    -ms-grid-columns: 1fr 10px 1fr 10px 1fr 10px 1fr 10px 1fr 10px 1fr 10px 1fr;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
    margin-top: 20px;
}
.calendar__day {
    padding: 15px 5px;
    text-align: center;
    background-color: #F5F5F5;
}
.calendar__day.prev, .calendar__day.next {
    background-color: white;
}
.calendar__day.curr {
    cursor: pointer;
}
.calendar__day.curr:hover {
    background-color: #514315;
    color: white;
}
.calendar__day.curr.selected {
    background-color: #514315;
    color: white;
}
</style>