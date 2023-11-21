class Calendar {
    months

    week

    current

    selected

    container

    renderDay

    constructor(settings = {}) {
        this.months = settings.months ?? [
            'January', 'February', 'March',
            'April', 'May', 'June',
            'July', 'August', 'September',
            'October', 'November', 'December'
        ]
        this.week = settings.week ?? [
            'SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'
        ]

        this.current = {}
        this.current.year =
            settings.year ?? new Date().getFullYear()
        this.current.month =
            settings.month ?? new Date().getMonth()

        this.selected = {
            year: null,
            month: null,
            day: null,
        }

        this.container = $(settings.container)

        this.renderDay = settings.renderDay

        this.renderMonth()

        $(document).on(
            'click',
            `${settings.container} .arrow.prev`,
            () => this.changeMonth('prev', settings.changeMonth)
        )
        $(document).on(
            'click',
            `${settings.container} .arrow.next`,
            () => this.changeMonth('next', settings.changeMonth)
        )
        $(document).on(
            'click',
            `${settings.container} .curr-day`,
            (e) => this.select(e, settings.select)
        )
    }

    renderMonth() {
        const calendar = `
            <div class="calendar">
                <div class="calendar__top">
                    <div class="arrow prev">
                        ❮  
                    </div>
                    <div class="date">
                        ${this.months[this.current.month]} ${this.current.year}
                    </div>
                    <div class="arrow next">
                        ❯
                    </div>
                </div>
                <div class="calendar__week">
                    ${this.renderWeek()}
                </div>
                <div class="calendar__days">
                    ${this.renderDays()}
                </div>
            </div>`

        this.container.html(calendar)
    }

    renderWeek() {
        let week = ''
        this.week.forEach(day => week += `<span>${day}</span>`)

        return week
    }

    renderDays() {
        let days = ''

        const lastDayPrevMonth = new Date(
            this.current.year,
            this.current.month,
            0
        ).getDay()
        if (lastDayPrevMonth < 6) {
            for (let i = lastDayPrevMonth; i >= 0; i--) {
                days += `<span class="prev-day">
                        </span>`
            }
        }
        const daysCountCurrMonth = new Date(
            this.current.year,
            this.current.month + 1,
            0
        ).getDate()
        let currDay = null
        for (let i = 1; i <= daysCountCurrMonth; i++) {
            currDay = {
                value: i,
                class: `curr-day ${this.isSelected(i) ? 'selected' : ''}`,
            }
            if (this.renderDay) {
                currDay = this.renderDay(currDay)
            }
            days += `<span class="${currDay.class}">
                        ${currDay.value}
                    </span>`
        }
        const lastDayCurrMonth = new Date(
            this.current.year,
            this.current.month,
            daysCountCurrMonth
        ).getDay()
        for (let i = 1; i <= 6 - lastDayCurrMonth; i++) {
            days += `<span class="next-day">
                    </span>`
        }

        return days
    }

    isSelected(day) {
        return this.selected.year == this.current.year &&
            this.selected.month == this.current.month &&
            this.selected.day == day
    }

    changeMonth(prevNext, callback) {
        const date = new Date(this.current.year, this.current.month)
        if (prevNext == 'prev') {
            date.setMonth(date.getMonth() - 1)
        } else {
            date.setMonth(date.getMonth() + 1)
        }

        this.current.year = date.getFullYear()
        this.current.month = date.getMonth()

        if (callback) callback({
            year: this.current.year,
            month: this.current.month,
        })

        this.renderMonth()
    }

    select(e, callback) {
        this.selected = {
            year: this.current.year,
            month: this.current.month,
            day: parseInt($(e.target).text()),
        }

        if (callback) callback(this.selected)

        this.renderMonth()
    }
}