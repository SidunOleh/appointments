<template>

    <Divider 
        orientation="left" 
        orientation-margin="0px" 
        style="font-size:20px;font-weight:700;margin-top:0px;">
        Set default working hours
    </Divider>

    <div class="setting" style="max-width:400px">
        <Hours
            v-model:hours="settings.default_hours"/>
    </div>

    <Divider 
        orientation="left" 
        orientation-margin="0px" 
        style="font-size:20px;font-weight:700;">
        Sync with Google Calendar
    </Divider>

    <div class="setting">
        <label for="service-account-jwt" class="title">
            Upload service account key(JSON)
        </label>
        <Upload
            id="service-account-jwt"
            accept="application/JSON"
            maxCount="1"
            :beforeUpload="(file) => {setServiceAccountJwt(file);return false;}">
            <Button>
                Select file
            </Button>
        </Upload>

        <div v-if="serviceAccountEmail" style="margin-top:10px;">
            <span class="title">Current service account</span> 
            {{ serviceAccountEmail }}
        </div>
    </div>

    <Divider 
        orientation="left" 
        orientation-margin="0px" 
        style="font-size:20px;font-weight:700;">
        Restrictions for IP address
    </Divider>

    <div class="setting">
        <Switch
            id="enable-restrictions-for-ip"
            style="margin: 0 0 10px 0;"
            v-model:checked="settings.enable_restrictions_for_ip"/>

        <template v-if="settings.enable_restrictions_for_ip">
            <label for="max-appointments-for-ip" class="title">
                Max count of appointments
            </label>
            <InputNumber
                id="max-appointments-for-ip"
                min="0"
                defaultValue="0"
                v-model:value="settings.max_appointments_for_ip"/>

            <label for="max-appointments-for-ip" class="title">
                Time period
            </label>
            <Select
                style="width: 100%;"
                id="time-period"
                :options="timePeriods"
                placeholder="Select time period"
                v-model:value="settings.time_period"/>
        </template>
    </div>

    <Button @click="updateSettings" :loading="loading">
        Update settings
    </Button>

</template>

<script>
import {
    Switch, InputNumber,
    Button, Modal,
    Upload, Divider,
    Select,
} from 'ant-design-vue'
import axios from 'axios'
import {errorHandler} from '../../utils.js'
import Hours from '../Elements/Hours.vue'
export default {
    components: {
        Switch, InputNumber,
        Button, Hours,
        Upload, Divider,
        Select,
    },
    data() {
        return {
            loading: false,
            timePeriods: [
                {
                    label: 'All time',
                    value: 'all',
                }, 
                {
                    label: 'Year',
                    value: 'year',
                },
                {
                    label: 'Month',
                    value: 'month',
                },
                {
                    label: 'Week',
                    value: 'week',
                },
                {
                    label: 'Day',
                    value: 'day',
                },
            ],
            settings: {
                default_hours: [],
                service_account_jwt: '',
                enable_restrictions_for_ip: false,
                max_appointments_for_ip: 0,
                time_period: 'all',
            },
        }
    },
    computed: {
        serviceAccountEmail() {
            if (! this.settings.service_account_jwt) return ''
            const serviceAccountJwt = JSON.parse(this.settings.service_account_jwt)
            return serviceAccountJwt.client_email
        },
    },
    methods: {
        getSettings() {
            axios.get('/wp-json/appointments/v1/settings')
                .then(res => {
                    if (res.data.success) {
                        for (let setting in res.data.data) {
                            this.settings[setting] = res.data.data[setting]
                        }
                    }
                }).catch(errorHandler)
        },
        updateSettings() {
            this.loading = true
            axios.post('/wp-json/appointments/v1/settings', {
                _method: 'PUT',
                settings: this.settings,
            }).then(res => {
                this.getSettings()
                setTimeout(() => this.loading = false, 250)
                Modal.success({
                    title: 'Updated',
                    content: 'Successfully updated.',
                })
            }).catch(err => {
                setTimeout(() => this.loading = false, 250)
                errorHandler(err)
            })
        },
        setServiceAccountJwt(file) {
            const reader = new FileReader()
            let fileContent = ''
            reader.onload = (e) => fileContent += e.target.result
            reader.onloadend = (e) => this.settings.service_account_jwt = fileContent
            reader.readAsText(file)
        },
    },
    mounted() {
        this.getSettings()
    }
}
</script>

<style scoped>
.setting {
    margin-bottom: 25px;
}

.ant-input-number,
.ant-select {
    width: 200px !important;
}
</style>