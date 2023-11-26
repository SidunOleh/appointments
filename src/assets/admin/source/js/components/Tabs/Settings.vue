<template>

    <div class="setting">
        <label for="enable-restrictions-for-ip" class="title">
            Enable restrictions for IP address
        </label>
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
} from 'ant-design-vue'
import axios from 'axios'
import {errorHandler} from '../../utils.js'
export default {
    components: {
        Switch, InputNumber,
        Button,
    },
    data() {
        return {
            settings: {},
        }
    },
    methods: {
        getSettings() {
            axios.get('/wp-json/appointments/v1/settings')
                .then(res => {
                    if (res.data.success) {
                        this.settings = res.data.data
                    }
                }).catch(errorHandler)
        },
        updateSettings() {
            axios.post('/wp-json/appointments/v1/settings', {
                _method: 'PUT',
                settings: this.settings,
            }).then(res => {
                Modal.success({
                    title: 'Updated',
                    content: 'Successfully updated.',
                })
            }).catch(errorHandler)
        },
    },
    mounted() {
        this.getSettings()
    }
}
</script>

<style scoped>
.setting {
    margin-bottom: 5px;
}
.ant-input-number {
    width: 200px;
}
</style>