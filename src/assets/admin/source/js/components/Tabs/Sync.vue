<template>

    <div>
        <h1 style="margin-top:0px;">Google Calendar</h1>

        <label for="service-account-jwt" class="title">
            Upload service account key(JSON)
        </label>
        <Upload
            id="service-account-jwt"
            accept="application/JSON"
            action="/wp-json/appointments/v1/sync/credentials/service-account-jwt"
            maxCount="1"
            name="service-account-jwt"
            :headers="{'X-WP-Nonce': wpApiSettings.nonce}"
            @change="(e) => {if(e.file.status == 'done') getSyncCredentials()}">
            <Button>
                Select file
            </Button>
        </Upload>

        <div v-if="service_account_jwt.client_email" style="margin-top:10px;">
            <span class="title">Current service account</span> 
            {{ service_account_jwt.client_email }}
        </div>
    </div>

</template>

<script>
import {Upload, Button} from 'ant-design-vue'
import axios from 'axios'
import {errorHandler} from '../../utils.js'

export default {
    inject: ['wpApiSettings',],
    components: {
        Upload, Button
    },
    data() {
        return {
            service_account_jwt: {},
        }
    },
    methods: {
        getSyncCredentials() {
            axios.get('/wp-json/appointments/v1/sync/credentials')
                .then(res => {
                    if (res.data.success) {
                        this.service_account_jwt = 
                            JSON.parse(res.data.data.service_account_jwt)
                    }
                }).catch(errorHandler)
        },  
    },
    mounted() {
        this.getSyncCredentials()
    },
}
</script>