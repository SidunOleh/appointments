<template>

    <div class="setting" style="max-width:400px">
        <h2 style="margin-top:0px;">Set default working hours</h2>
        <Hours
            v-model:hours="settings.default_hours"/>
    </div>

    <div class="setting">
        <h2>Sync with Google Calendar</h2>

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

    <div class="setting">
        <h2>Restrictions for IP address</h2>
        <Switch
            id="enable-restrictions-for-ip"
            style="margin: 0 0 10px 0;"
            v-model:checked="settings.enable_restrictions_for_ip"/>

        <template v-if="settings.enable_restrictions_for_ip">
            <label for="max-appointments-for-ip" class="title">
                Max count appointments for month
            </label>
            <InputNumber
                id="max-appointments-for-ip"
                min="0"
                defaultValue="0"
                v-model:value="settings.max_appointments_for_ip"/>
        </template>
    </div>

    <Button @click="updateSettings">
        Update settings
    </Button>

</template>

<script>
import {
    Switch, InputNumber,
    Button, Modal,
    Upload, 
} from 'ant-design-vue'
import axios from 'axios'
import {errorHandler} from '../../utils.js'
import Hours from '../Elements/Hours.vue'
export default {
    components: {
        Switch, InputNumber,
        Button, Hours,
        Upload,
    },
    data() {
        return {
            settings: {
                default_hours: [],
                service_account_jwt: '',
                enable_restrictions_for_ip: false,
                max_appointments_for_ip: 0,
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
            axios.post('/wp-json/appointments/v1/settings', {
                _method: 'PUT',
                settings: this.settings,
            }).then(res => {
                this.getSettings()
                Modal.success({
                    title: 'Updated',
                    content: 'Successfully updated.',
                })
            }).catch(errorHandler)
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

.ant-input-number {
    width: 200px;
}

h2 {
    margin: 15px 0;
    font-size: 20px;
}
</style>