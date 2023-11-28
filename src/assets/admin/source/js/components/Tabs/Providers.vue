<template>

    <!-- create provider -->
    <Modal
        :visible="createModal.show"
        title="Create provider"
        okText="Create"
        @ok="createProvider"
        @cancel="createModal.show = false"
        :okButtonProps="{loading: createModal.loading,}">

        <label for="create-name" class="title">
            Provider name
        </label>
        <Input
            id="create-name"
            placeholder="Enter name" 
            v-model:value="createModal.data.name"/>

        <label for="create-email" class="title">
            Provider e-mail
        </label>
        <Input
            id="create-email"
            placeholder="Enter e-mail"  
            type="email"
            v-model:value="createModal.data.email"/>

        <label for="create-description" class="title">
            Provider description
        </label>
        <Textarea 
            id="create-description"
            placeholder="Write description"
            style="width: 100%;"
            v-model:value="createModal.data.description"/>

        <label for="create-sync-google-calendar" class="title">
            Sync with Google Calendar
        </label>
        <Switch
            id="create-sync-google-calendar"
            style="margin: 0 0 10px 0;"
            v-model:checked="createModal.data.sync_google_calendar"/>

        <template v-if="createModal.data.sync_google_calendar">
            <label for="create-google-calendar-id" class="title">
                Google Calendar ID
            </label>
            <Input
                id="create-google-calendar-id"
                placeholder="Enter google calendar id"  
                v-model:value="createModal.data.google_calendar_id"/>
        </template>

        <Collapse accordion>

            <CollapsePanel header="🇺🇦 UA">
                <label for="create-name-ua" class="title">
                    Provider name
                </label>
                <Input
                    id="create-name-ua"
                    placeholder="Enter name" 
                    v-model:value="createModal.data.name_ua"/>
                <label for="create-description-ua" class="title">
                    Provider description
                </label>
                <Textarea 
                    id="create-description-ua"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="createModal.data.description_ua"/>
            </CollapsePanel>

            <CollapsePanel header="🇷🇺 RU">
                <label for="create-name-ru" class="title">
                    Provider name
                </label>
                <Input
                    id="create-name-ru"
                    placeholder="Enter name" 
                    v-model:value="createModal.data.name_ru"/>
                <label for="create-description" class="title">
                    Provider description
                </label>
                <Textarea 
                    id="create-name-ru"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="createModal.data.description_ru"/>
            </CollapsePanel>

        </Collapse>

    </Modal>

    <AddButton title="Add provider" @click="createModal.show = true"/> 

    <!-- edit provider -->
    <Modal
        :visible="editModal.show"
        title="Edit provider"
        okText="Edit"
        @ok="editProvider"
        @cancel="editModal.show = false"
        :okButtonProps="{loading: editModal.loading,}">

        <label for="edit-name" class="title">
            Provider name
        </label>
        <Input
            id="edit-name"
            placeholder="Enter name" 
            v-model:value="editModal.provider.name"/>

        <label for="edit-email" class="title">
            Provider e-mail
        </label>
        <Input
            id="edit-email"
            placeholder="Enter e-mail"  
            type="email"
            v-model:value="editModal.provider.email"/>

        <label for="edit-description" class="title">
            Provider description
        </label>
        <Textarea 
            id="edit-description"
            placeholder="Write description"
            style="width: 100%;"
            v-model:value="editModal.provider.description"/>


        <label for="edit-sync-google-calendar" class="title">
            Sync with Google Calendar
        </label>
        <Switch
            id="edit-sync-google-calendar"
            style="margin: 0 0 10px 0;"
            v-model:checked="editModal.provider.sync_google_calendar"/>

        <template v-if="editModal.provider.sync_google_calendar">
            <label for="edit-google-calendar-id" class="title">
                Google Calendar ID
            </label>
            <Input
                id="edit-google-calendar-id"
                placeholder="Enter google calendar id"  
                v-model:value="editModal.provider.google_calendar_id"/>
        </template>

        <Collapse accordion>

            <CollapsePanel header="🇺🇦 UA">
                <label for="edit-name-ua" class="title">
                    Provider name
                </label>
                <Input
                    id="edit-name-ua"
                    placeholder="Enter name" 
                    v-model:value="editModal.provider.name_ua"/>
                <label for="edit-description-ua" class="title">
                    Provider description
                </label>
                <Textarea 
                    id="edit-description-ua"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="editModal.provider.description_ua"/>
            </CollapsePanel>

            <CollapsePanel header="🇷🇺 RU">
                <label for="edit-name-ru" class="title">
                    Provider name
                </label>
                <Input
                    id="edit-name-ru"
                    placeholder="Enter name" 
                    v-model:value="editModal.provider.name_ru"/>
                <label for="edit-description" class="title">
                    Provider description
                </label>
                <Textarea 
                    id="edit-name-ru"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="editModal.provider.description_ru"/>
            </CollapsePanel>

        </Collapse>

    </Modal>

    <!-- provider calendar -->
    <Modal
        v-if="calendarModal.show"
        :visible="true"
        title="Set working days"
        :okButtonProps="{disabled: true}"
        @cancel="calendarModal.show = false">

        <Calendar
            :renderDay="renderDay"
            :startDate="{year: new Date().getFullYear(), month: new Date().getMonth(), day: new Date().getDate()}"
            @changeMonth="changeMonth"
            @select="selectDate"/>

        <div class="title">
            Non-Working / Working
        </div>
        <Switch
            style="margin: 0 0 10px 0;"
            v-model:checked="calendarModal.selected.isWorking"
            @click="!calendarModal.selected.isWorking ? this.deleteWorkingDay() : this.createWorkingDay()"/>

        <Hours 
            v-if="calendarModal.selected.isWorking"
            v-model:hours="calendarModal.selected.workingHours"
            label="Set working hours"
            @change="setHours"/>

    </Modal>

    <!-- providers table -->
    <Table 
        :dataSource="table.providers.data" 
        :columns="table.columns"
        :pagination="{pageSize: table.providers.per_page, total: table.providers.total}"
        :loading="table.loading"
        @change="changeTable">
        
        <template #bodyCell="{column, record}">

            <template v-if="column.key === 'calendar'">
                <span
                    class="icon"
                    title="Working days"
                    @click="openCalendar(record)">
                    🗓
                </span>
            </template>

            <template v-if="column.key === 'edit'">
                <span
                    class="icon"
                    :title="`Edit ${record.name}`"
                    @click="openEditModal(record)">
                    ✏
                </span>
            </template>

            <template v-if="column.key === 'delete'">
                <span
                    class="icon"
                    :title="`Delete ${record.name}`"
                    @click="deleteProvider(record)">
                    ❌    
                </span>
            </template>
        
        </template>

    </Table>
        
</template>

<script>
import axios from 'axios'
import {
    Modal, Table, 
    Input, Switch, 
    Textarea, Collapse, 
    CollapsePanel,
} from 'ant-design-vue'
import AddButton from '../Elements/AddButton.vue'
import Calendar from '../Elements/Calendar.vue'
import Hours from '../Elements/Hours.vue'
import {errorHandler, dateStr,} from '../../utils.js'

export default {
    components: {
        Modal, Table,
        AddButton, Input,
        Switch, Hours,
        Calendar, Textarea,
        Collapse, CollapsePanel,
    },
    data() {
        return {
            table: {
                loading: true,
                current: 1,
                columns: [
                    {
                        title: 'Name',
                        dataIndex: 'name',
                        key: 'name',
                        sorter: {
                            compare: (a, b) => a.name.localeCompare(b.name),
                        },
                    },
                    {
                        title: 'E-mail',
                        dataIndex: 'email',
                        key: 'email',
                    },
                    {
                        title: 'Description',
                        dataIndex: 'description',
                        key: 'description',
                    },
                    {
                        key: 'calendar',
                        width: '10px',
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
                providers: [],
            },
            createModal: {
                show: false,
                loading: false,
                data: {
                    name: '',
                    email: '',
                    description: '',
                    name_ua: '',
                    description_ua: '',
                    name_ru: '',
                    description_ru: '',
                    sync_google_calendar: false,
                    google_calendar_id: '',
                },
            },
            editModal: {
                show: false,
                loading: false,
                provider: {},
            },
            calendarModal: {
                show: false,
                providerId: null,
                workingDays: [],
                selected: {
                    date: null,
                    isWorking: false,
                    workingHours: [],
                },
            },
        }
    },
    methods: {
        getProviders(params = {}) {
            this.table.loading = true
            axios.get('/wp-json/appointments/v1/providers', {
                params,
            }).then(res => {
                if (res.data.success) {
                    this.table.providers = res.data.data
                }
                this.table.loading = false
            }).catch(errorHandler) 
        },
        changeTable(pagination, filters, sort) {
            this.table.current = pagination.current
            this.getProviders({
                ...pagination,
                orderby: sort.field,
                order: sort.order == 'ascend' ? 'ASC' : 'DESC',
            })
        },
        createProvider() {
            this.createModal.loading = true
            axios.post('/wp-json/appointments/v1/providers', {
                name: this.createModal.data.name,
                email: this.createModal.data.email,
                description: this.createModal.data.description,
                name_ua: this.createModal.data.name_ua,
                description_ua: this.createModal.data.description_ua,
                name_ru: this.createModal.data.name_ru,
                description_ru: this.createModal.data.description_ru,
                sync_google_calendar: this.createModal.data.sync_google_calendar,
                google_calendar_id: this.createModal.data.google_calendar_id,
            }).then(res => {
                this.createModal.loading = false
                if (res.data.success) {
                    this.createModal.show = false
                    this.createModal.data.name = ''
                    this.createModal.data.email = ''
                    this.createModal.data.description = ''
                    this.createModal.data.name_ua = ''
                    this.createModal.data.description_ua = ''
                    this.createModal.data.name_ru = ''
                    this.createModal.data.description_ru = ''
                    this.createModal.data.sync_google_calendar = false
                    this.createModal.data.google_calendar_id = ''
                    this.getProviders({current: this.table.current})
                }
            }).catch(err => {
                this.createModal.loading = false
                errorHandler(err)
            }) 
        },
        openEditModal(provider) {
            this.editModal.provider = {...provider}
            this.editModal.show = true
        },
        editProvider() {
            this.editModal.loading = true
            axios.post(`/wp-json/appointments/v1/providers/${this.editModal.provider.id}`, {
                name: this.editModal.provider.name,
                email: this.editModal.provider.email,
                description: this.editModal.provider.description,
                name_ua: this.editModal.provider.name_ua,
                description_ua: this.editModal.provider.description_ua,
                name_ru: this.editModal.provider.name_ru,
                description_ru: this.editModal.provider.description_ru,
                sync_google_calendar: this.editModal.provider.sync_google_calendar,
                google_calendar_id: this.editModal.provider.google_calendar_id,
                _method: 'PUT',
            }).then(res => {
                this.editModal.loading = false
                if (res.data.success) {
                    Modal.success({
                        title: 'Edited',
                        content: 'Successfully edited.',
                    })
                    this.getProviders()
                }
            }).catch(err => {
                this.editModal.loading = false
                errorHandler(err)
            }) 
        },
        deleteProvider(provider) {
            Modal.confirm({
                title: `Are you sure to delete ${provider.name}?`,
                okText: 'Yes',
                cancelText: 'No',
                onOk: () => {
                    axios.delete(`/wp-json/appointments/v1/providers/${provider.id}`)
                        .then(res => {
                            if (res.data.success) {
                                this.getProviders({current: this.table.current})
                            }
                        }).catch(errorHandler) 
                },
            })
        },
        openCalendar(provider) {
            this.calendarModal.providerId = provider.id
            this.calendarModal.show = true
        },
        changeMonth(date) {
            this.calendarModal.workingDays = this.getWorkingDays(date.year, date.month, this.calendarModal.providerId)
        },
        getWorkingDays(year, month, providerId) {
            const req = new XMLHttpRequest()
            req.open(
                'GET', 
                `/wp-json/appointments/v1/working-days?year=${year}&month=${month+1}&provider_id=${providerId}`, 
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
                day.class = `${day.class} working`
            }

            return day
        },
        isWorkingDay(year, month, day) {
            for (let i = 0; i < this.calendarModal.workingDays.length; i++) {
                if (
                    this.calendarModal.workingDays[i].date == dateStr(year, month, day)
                ) {
                    return true
                }
            }

            return false
        },
        selectDate(date) { 
            this.calendarModal.selected.date = dateStr(date.year, date.month, date.day)
            this.calendarModal.selected.isWorking = false
            this.calendarModal.selected.workingHours = []
            for (let i = 0; i < this.calendarModal.workingDays.length; i++) {
                if (
                    this.calendarModal.workingDays[i].date == this.calendarModal.selected.date
                ) {
                    this.calendarModal.selected.isWorking = true
                    this.calendarModal.selected.workingHours = this.calendarModal.workingDays[i].working_hours
                }
            }
        },
        createWorkingDay() {
            axios.post('/wp-json/appointments/v1/working-days', {
                date: this.calendarModal.selected.date,
                provider_id: this.calendarModal.providerId,
            }).then(res => {
                if (res.data.success) {
                    this.calendarModal.workingDays.push(res.data.data)
                    this.calendarModal.selected.workingHours = res.data.data.working_hours
                }
            }).catch(err => {
                this.calendarModal.selected.isWorking = false
                errorHandler(err)
            })
        },
        deleteWorkingDay() {
            axios.post('/wp-json/appointments/v1/working-days', {
                date: this.calendarModal.selected.date,
                provider_id: this.calendarModal.providerId,
                _method: 'DELETE',
            }).then(res => {
                if (res.data.success) {
                    this.calendarModal.workingDays = this.calendarModal.workingDays
                        .filter(day => day.id != res.data.data.id)
                }
            }).catch(err => {
                this.calendarModal.selected.isWorking = true
                errorHandler(err)
            }) 
        },
        setHours() {
            axios.post('/wp-json/appointments/v1/working-days', {
                working_hours: this.calendarModal.selected.workingHours,
                date: this.calendarModal.selected.date,
                provider_id: this.calendarModal.providerId,
            }).then(res => {
                if (res.data.success) {
                    this.calendarModal.workingDays.forEach(day=> {
                        if (day.date == res.data.data.date) {
                            day.working_hours = res.data.data.working_hours
                        }
                    })
                }
            }).catch(errorHandler) 
        },
    },
    mounted() {
        this.getProviders()
    },
}
</script>

<style>
.working {
    background-color: #a49561b0 !important;
    color: white !important;
}
.working:hover {
    background-color: #514315 !important;
}
.working.selected {
    background-color: #514315 !important;
}
</style>