<template>

    <!-- create appointment -->
    <Modal
        :visible="createModal.show"
        title="Create appointment"
        okText="Create"
        @ok="createAppointment"
        @cancel="createModal.show = false"
        :okButtonProps="{loading: createModal.loading,}">

        <div class="title">
            Services
        </div>  
        <Select
            style="width: 100%;"
            :options="servicesOptions"
            placeholder="Select service"
            v-model:value="selectedService"/>

        <template v-if="selectedService">
            <div class="title">
                Service providers
            </div>  
            <Select
                style="width: 100%;"
                :options="providersOptions"
                placeholder="Select provider"
                v-model:value="selectedProvider"/>
        </template>

        <template v-if="selectedProvider">
            <div class="title">
                Select date
            </div>  
            <Calendar
                ref="calendar"
                :renderDay="renderDay"
                @changeMonth="changeMonth"
                @select="selectDate"/>
        </template>
        
        <template v-if="selectedDate">
            <div class="title">
                Select hour
            </div>  
            <Select
                style="width: 100%;"
                :options="workingHoursOptions"
                placeholder="Select hour"
                v-model:value="createModal.data.hour"/>
        </template> 

        <template v-if="createModal.data.hour">
            <div class="title">
                Customer details
            </div>

            <Input
                addonBefore="Name" 
                placeholder="Enter name"
                v-model:value="createModal.data.name"/>
            <Input
                addonBefore="Phone" 
                placeholder="Enter phone"
                v-model:value="createModal.data.phone"/>
            <Input
                addonBefore="E-mail"  
                placeholder="Enter e-mail"
                type="email"
                v-model:value="createModal.data.email"/>

            <label for="comment" class="title">
                Comment for appointment
            </label>
            <Textarea 
                id="comment"
                placeholder="Write comment"
                style="width: 100%;"
                v-model:value="createModal.data.comment"/>
        </template>

    </Modal>

    <AddButton title="Add appointment" @click="createModal.show = true"/> 
    
    <!-- appointments table -->
    <Table 
        ref="table"
        :dataSource="table.appointments.data" 
        :columns="table.columns"
        :pagination="{pageSize: table.appointments.per_page, total: table.appointments.total,}"
        :loading="table.loading"
        @change="changeTable">
        
        <template #bodyCell="{column, record}">

            <template v-if="column.key === 'date'">
                {{ new Date(record.start).toLocaleString(undefined, { 
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: 'numeric',
                    minute: 'numeric',
                 }) }}
            </template>

            <template v-if="column.key === 'pay_status'">
                <Switch
                    v-model:checked="record.pay_status"
                    @click="changePayStatus(record)"/>
            </template>

            <template v-if="column.key === 'created_at'">
                {{ new Date(record.created_at).toLocaleString(undefined, { 
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                 }) }}
            </template>

            <template v-if="column.key === 'delete'">
                <span
                    class="icon"
                    title="Delete appointment"
                    @click="deleteAppointment(record)">
                    ❌    
                </span>
            </template>
        
        </template>

    </Table>
        
</template>

<script>
import axios from 'axios'
import {Modal, Table, Input, Textarea, Select, Switch,} from 'ant-design-vue'
import AddButton from '../Elements/AddButton.vue'
import Calendar from '../Elements/Calendar.vue'
import {errorHandler, dateStr,} from '../../utils.js'

export default {
    components: {
        Modal, Table,
        AddButton, Input,
        Textarea, Select, 
        Switch, Calendar,
    },
    data() {
        return {
            table: {
                loading: true,
                current: 1,
                columns: [
                    {
                        title: 'Date',
                        dataIndex: 'start',
                        key: 'date',
                        sorter: {
                            compare: (a, b) => a.start.localeCompare(b.start),
                        },
                    },
                    {
                        title: 'Pay status',
                        dataIndex: 'pay_status',
                        key: 'pay_status',
                        filters: [
                            { 
                                text: 'Payed', 
                                value: true, 
                            },
                            { 
                                text: 'Not payed', 
                                value: false, 
                            },
                        ],
                    },
                    {
                        title: 'Service',
                        dataIndex: ['service', 'name'],
                        key: 'service',
                    },
                    {
                        title: 'Provider',
                        dataIndex: ['provider', 'name'],
                        key: 'provider',
                    },
                    {
                        title: 'Name',
                        dataIndex: ['customer', 'name'],
                        key: 'customer.name',
                    },
                    {
                        title: 'E-mail',
                        dataIndex: ['customer', 'email'],
                        key: 'customer.email',
                    },
                    {
                        title: 'Phone',
                        dataIndex: ['customer', 'phone'],
                        key: 'phone',
                    },
                    {
                        title: 'Comment',
                        dataIndex: 'comment',
                        width: '200px',
                    },
                    {
                        title: 'Created',
                        dataIndex: 'created_at',
                        key: 'created_at',
                        sorter: {
                            compare: (a, b) => a.created_at.localeCompare(b.created_at),
                        },
                    },
                    {
                        key: 'edit',
                        width: '10px',
                    },
                    {
                        key: 'delete',
                        width: '10px',
                    },
                ],
                appointments: [],
            },
            createModal: {
                show: false,
                loading: false,
                workingDays: [],
                data: {
                    name: '',
                    phone: '',
                    email: '',
                    service_id: null,
                    provider_id: null,
                    date: null,
                    hour: null,
                    comment: '',
                },
            },
            services: [],
        }
    },
    computed: {
        servicesOptions() {
            const servicesOptions = []
            this.services.data.forEach(service => {
                servicesOptions.push({
                    value: service.id,
                    label: service.name,
                })
            })

            return servicesOptions
        },
        selectedService: {
            get() {
                return this.createModal.data.service_id
            },
            set(val) {
                this.createModal.data.service_id = val
                this.selectedProvider = null
            },
        },
        providersOptions() {
            const providers = this.services.data
                .filter(service => service.id == this.selectedService)[0]
                .providers
            const providersOptions = []
            providers.forEach(provider => {
                providersOptions.push({
                    value: provider.id,
                    label: provider.name
                })
            })

            return providersOptions
        },
        selectedProvider: {
            get() {
                return this.createModal.data.provider_id
            },
            set(val) {
                this.createModal.data.provider_id = val
                this.selectedDate = ''
                if (val) {
                    this.createModal.workingDays = this.getWorkingDays(
                        this.$refs.calendar.current.year, 
                        this.$refs.calendar.current.month,
                        val
                    )
                    this.$refs.calendar.setDays()
                }
            },
        },
        selectedDate: {
            get() {
                return this.createModal.data.date
            },
            set(val) {
                this.createModal.data.date = val
                this.createModal.data.hour = ''
            },
        },
        workingHoursOptions() {
            const workingHoursOptions = []
            for (let i = 0; i < this.createModal.workingDays.length; i++) {
                if (
                    this.createModal.workingDays[i].date == this.selectedDate
                ) {
                    const workingHours = this.createModal.workingDays[i].working_hours.split(',')
                    workingHours.forEach(hour => {
                        workingHoursOptions.push({value: hour,})
                    })
                }
            }

            return workingHoursOptions
        },
    },
    methods: {
        getAppointments(params = {}) {
            this.table.loading = true
            axios.get('/wp-json/appointments/v1/appointments', {
                params,
            }).then(res => {
                if (res.data.success) {
                    this.table.appointments = res.data.data
                }
                this.table.loading = false
            }).catch(errorHandler)
        },
        changeTable(pagination, filters, sort) {
            this.table.current = pagination.current
            this.getAppointments({
                ...pagination,
                ...filters,
                orderby: sort.field,
                order: sort.order == 'ascend' ? 'ASC' : 'DESC',
            })
        },
        changePayStatus(appointment) {
            axios.post(`/wp-json/appointments/v1/appointments/${appointment.id}/pay-status`, {
                status: appointment.pay_status,
                _method: 'PATCH',
            }).then(res => {
                if (res.data.success) {
                    Modal.success({
                        title: 'Changed',
                        content: 'Pay status successfully changed.',
                    })
                }
            }).catch(err => {
                appointment.pay_status = ! appointment.pay_status
                errorHandler(err)
            })
        },
        deleteAppointment(appointment) {
            Modal.confirm({
                title: `Are you sure to delete appointment?`,
                okText: 'Yes',
                cancelText: 'No',
                onOk: () => {
                    axios.delete(`/wp-json/appointments/v1/appointments/${appointment.id}`)
                        .then(res => {
                            if (res.data.success) {
                                this.getAppointments({current: this.table.current})
                            }
                        }).catch(errorHandler)
                },
            })
        },
        createAppointment() {
            this.createModal.loading = true
            axios.post('/wp-json/appointments/v1/appointments', {
                name: this.createModal.data.name,
                phone: this.createModal.data.phone,
                email: this.createModal.data.email,
                service_id: this.createModal.data.service_id,
                provider_id: this.createModal.data.provider_id,
                date: this.createModal.data.date,
                hour: this.createModal.data.hour,
                comment: this.createModal.data.comment,
            }).then(res => {
                if (res.data.success) {
                    this.createModal.loading = false
                    this.createModal.show = false
                    this.selectedService = null
                    this.createModal.data.name = ''
                    this.createModal.data.phone = ''
                    this.createModal.data.email = ''
                    this.createModal.data.comment = ''
                    this.getAppointments({current: this.table.current})
                }
            }).catch(err => {
                this.createModal.loading = false
                errorHandler(err)
            }) 
        },
        getServices() {
            axios.get('/wp-json/appointments/v1/services', {
                params: {pageSize: 1000,},
            }).then(res => {
                if (res.data.success) {
                    this.services = res.data.data
                }
            }).catch(errorHandler)
        },
        changeMonth(date) {
            this.createModal.workingDays = this.getWorkingDays(date.year, date.month,  this.selectedProvider)
        },
        getWorkingDays(year, month, providerId) {
            const req = new XMLHttpRequest()
            req.open(
                'GET', 
                `/wp-json/appointments/v1/working-days/free?year=${year}&month=${month+1}&provider_id=${providerId}`, 
                false
            )
            req.setRequestHeader('X-WP-Nonce', wpApiSettings.nonce)
            req.send()
            if (req.status == 200) {
                const data = JSON.parse(req.responseText)

                return data.data
            } else {
                return []
            }
        },
        renderDay(day, date) {
            if (this.isWorkingDay(date.year, date.month, day.value)) {
                day.class = `${day.class} free`
            } else {
                day.class = `${day.class} not-free`
            }

            return day
        },
        isWorkingDay(year, month, day) {
            for (let i = 0; i < this.createModal.workingDays.length; i++) {
                if (
                    this.createModal.workingDays[i].date == dateStr(year, month, day)
                ) {
                    return true
                }
            }

            return false
        },
        selectDate(date) {
            this.selectedDate = dateStr(date.year, date.month, date.day)
        },
    },
    mounted() {
        this.getAppointments()
        this.getServices()
    },
}
</script>

<style>
.free {
    background-color: #a49561b0 !important;
    color: white !important;
}
.free:hover {
    background-color: #514315 !important;
}
.free.selected {
    background-color: #514315 !important;
}
.not-free {
    pointer-events: none;
}
.ant-modal.loading {
    padding: 0;
}
</style>