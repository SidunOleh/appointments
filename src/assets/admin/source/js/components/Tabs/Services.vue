<template>

    <!-- create service -->
    <Modal
        :visible="createModal.show"
        title="Create service"
        okText="Create"
        @ok="createService"
        @cancel="createModal.show = false"
        :okButtonProps="{loading: createModal.loading,}">

        <label for="create-name" class="title">
            Service name
        </label>
        <Input 
            id="create-name"
            placeholder="Enter name"
            v-model:value="createModal.data.name"/>

        <label for="create-duration" class="title">
            Service duration(in minutes)
        </label>
        <InputNumber 
            style="width: 100%;"
            id="create-duration"
            v-model:value="createModal.data.duration"
            min="0"/>

        <label for="create-price" class="title">
            Service price
        </label>
        <InputNumber 
            style="width: 100%;"
            id="create-price"
            v-model:value="createModal.data.price"
            min="0"
            :formatter="value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
            :parser="value => value.replace(/\$\s?|(,*)/g, '')"/>

        <label for="create-providers" class="title">
            Service providers
        </label>
        <Select
            style="width: 100%;"
            id="create-providers"
            :options="providersOptions"
            placeholder="Select providers"
            mode="multiple"
            v-model:value="createModal.data.providers_ids"/>

        <label for="create-description" class="title">
            Service description
        </label>
        <Textarea 
            id="create-description"
            placeholder="Write description"
            style="width: 100%;"
            v-model:value="createModal.data.description"/>

        <Collapse accordion>

            <CollapsePanel header="🇺🇦 UA">
                <label for="create-name-ua" class="title">
                    Service name
                </label>
                <Input
                    id="create-name-ua"
                    placeholder="Enter name" 
                    v-model:value="createModal.data.name_ua"/>
                <label for="create-description-ua" class="title">
                    Service description
                </label>
                <Textarea 
                    id="create-description-ua"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="createModal.data.description_ua"/>
            </CollapsePanel>

            <CollapsePanel header="🇷🇺 RU">
                <label for="create-name-ru" class="title">
                    Service name
                </label>
                <Input
                    id="create-name-ru"
                    placeholder="Enter name" 
                    v-model:value="createModal.data.name_ru"/>
                <label for="create-description" class="title">
                    Service description
                </label>
                <Textarea 
                    id="create-name-ru"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="createModal.data.description_ru"/>
            </CollapsePanel>

        </Collapse>

    </Modal>

    <AddButton title="Add service" @click="createModal.show = true"/> 

    <!-- edit service -->
    <Modal
        :visible="editModal.show"
        title="Edit service"
        okText="Edit"
        @ok="editService"
        @cancel="editModal.show = false"
        :okButtonProps="{loading: editModal.loading,}">

        <label for="name" class="title">
            Service name
        </label>
        <Input 
            id="name"  
            placeholder="Service name"
            v-model:value="editModal.service.name"/>

        <label for="create-duration" class="title">
            Service duration(in minutes)
        </label>
        <InputNumber 
            style="width: 100%;"
            id="create-duration"
            v-model:value="editModal.service.duration"
            min="0"/>

        <label for="edit-price" class="title">
            Service price
        </label>
        <InputNumber 
            style="width: 100%;"
            id="edit-price"
            v-model:value="editModal.service.price"
            min="0"
            :formatter="value => `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
            :parser="value => value.replace(/\$\s?|(,*)/g, '')"/>

        <label for="edit-providers" class="title">
            Service providers
        </label>
        <Select
            style="width: 100%;"
            id="edit-providers"
            :options="providersOptions"
            placeholder="Select providers"
            mode="multiple"
            v-model:value="editModal.service.providers_ids"/>

        <label for="edit-description" class="title">
            Service description
        </label>
        <Textarea 
            id="edit-description"
            placeholder="Write description"
            style="width: 100%;"
            v-model:value="editModal.service.description"/>

        <Collapse accordion>

            <CollapsePanel header="🇺🇦 UA">
                <label for="edit-name-ua" class="title">
                    Service name
                </label>
                <Input
                    id="edit-name-ua"
                    placeholder="Enter name" 
                    v-model:value="editModal.service.name_ua"/>
                <label for="edit-description-ua" class="title">
                    Service description
                </label>
                <Textarea 
                    id="edit-description-ua"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="editModal.service.description_ua"/>
            </CollapsePanel>

            <CollapsePanel header="🇷🇺 RU">
                <label for="edit-name-ru" class="title">
                    Service name
                </label>
                <Input
                    id="edit-name-ru"
                    placeholder="Enter name" 
                    v-model:value="editModal.service.name_ru"/>
                <label for="edit-description" class="title">
                    Service description
                </label>
                <Textarea 
                    id="edit-name-ru"
                    placeholder="Write description"
                    style="width: 100%;"
                    v-model:value="editModal.service.description_ru"/>
            </CollapsePanel>

        </Collapse>

    </Modal>

    <!-- services table -->
    <Table 
        :dataSource="table.services.data" 
        :columns="table.columns"
        :pagination="{pageSize: table.services.per_page, total: table.services.total}"
        :loading="table.loading">
        
        <template #bodyCell="{column, record}">

            <template v-if="column.key === 'providers'">
                <a-tag
                    v-for="provider in record.providers"
                    :key="provider.id"
                    class="provider"
                    color="geekblue"
                    style="white-space: nowrap;">
                    {{ provider.name }}
                </a-tag>
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
                    @click="deleteService(record)">
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
    Input, Textarea, 
    InputNumber, Select,
    Collapse, CollapsePanel,
} from 'ant-design-vue'
import AddButton from '../Elements/AddButton.vue'
import {errorHandler} from '../../utils.js'

export default {
    components: {
        Modal, Table,
        AddButton, Input,
        Textarea, InputNumber,
        Select, Collapse,
        CollapsePanel,
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
                        title: 'Duration(in minutes)',
                        dataIndex: 'duration',
                        key: 'duration',
                    },
                    {
                        title: 'Price',
                        dataIndex: 'price',
                        key: 'price',
                        sorter: {
                            compare: (a, b) => a.price - b.price,
                        },
                    },
                    {
                        title: 'Providers',
                        dataIndex: 'providers',
                        key: 'providers',
                    },
                    {
                        title: 'Description',
                        dataIndex: 'description',
                        key: 'description',
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
                services: [],
            },
            providers: [],
            createModal: {
                show: false,
                loading: false,
                data: {
                    name: '',
                    duration: 0,
                    price: 0,
                    providers_ids: [],
                    description: '',
                    name_ua: '',
                    description_ua: '',
                    name_ru: '',
                    description_ru: '',
                },
            },
            editModal: {
                show: false,
                loading: false,
                service: {},
            },
        }
    },
    computed: {
        providersOptions() {
            const providersOptions = []
            this.providers.forEach(provider => {
                providersOptions.push({
                    label: provider.name,
                    value: provider.id,
                })
            })

            return providersOptions
        },
    },
    methods: {
        getServices(params = {}) {
            this.table.loading = true
            axios.get('/wp-json/appointments/v1/services', {
                params,
            }).then(res => {
                if (res.data.success) {
                    this.table.services = res.data.data
                }
                this.table.loading = false
            }).catch(errorHandler)
        },
        changeTable(pagination, filters, sort) {
            this.table.current = pagination.current
            this.getServices({
                ...pagination,
                orderby: sort.field,
                order: sort.order == 'ascend' ? 'ASC' : 'DESC',
            })
        },
        getProviders() {
            axios.get('/wp-json/appointments/v1/providers', {
                params: {
                    pageSize: 1000,
                },
            }).then(res => {
                if (res.data.success) {
                    this.providers = res.data.data.data
                }
            }).catch(errorHandler)
        },
        createService() {
            this.createModal.loading = true
            axios.post('/wp-json/appointments/v1/services', {
                name: this.createModal.data.name,
                duration: this.createModal.data.duration,
                price: this.createModal.data.price,
                description: this.createModal.data.description,
                providers_ids: this.createModal.data.providers_ids,
                name_ua: this.createModal.data.name_ua,
                description_ua: this.createModal.data.description_ua,
                name_ru: this.createModal.data.name_ru,
                description_ru: this.createModal.data.description_ru,
            }).then(res => {
                this.createModal.loading = false
                if (res.data.success) {
                    this.createModal.show = false
                    this.createModal.data.name = ''
                    this.createModal.data.description = ''
                    this.createModal.data.price = 0
                    this.createModal.data.providers_ids = []
                    this.createModal.data.name_ua = ''
                    this.createModal.data.description_ua = ''
                    this.createModal.data.name_ru = ''
                    this.createModal.data.description_ru = ''
                    this.getServices({current: this.table.current})
                }
            }).catch(err => {
                this.createModal.loading = false
                errorHandler(err)
            })
        },
        openEditModal(service) {
            this.editModal.service = {...service}
            this.editModal.service.providers_ids = []
            this.editModal.service.providers.forEach(provider => {
                this.editModal.service.providers_ids.push(provider.id)
            })
            this.editModal.show = true
        },
        editService() {
            this.editModal.loading = true
            axios.post(`/wp-json/appointments/v1/services/${this.editModal.service.id}`, {
                name: this.editModal.service.name,
                duration: this.editModal.service.duration,
                price: this.editModal.service.price,
                description: this.editModal.service.description,
                providers_ids: this.editModal.service.providers_ids,
                name_ua: this.editModal.service.name_ua,
                description_ua: this.editModal.service.description_ua,
                name_ru: this.editModal.service.name_ru,
                description_ru: this.editModal.service.description_ru,
                _method: 'PUT',
            }).then(res => {
                this.editModal.loading = false
                if (res.data.success) {
                    Modal.success({
                        title: 'Edited',
                        content: 'Successfully edited.',
                    })
                    this.getServices()
                }
            }).catch(err => {
                this.editModal.loading = false
                errorHandler(err)
            })
        },
        deleteService(service) {
            Modal.confirm({
                title: `Are you sure to delete ${service.name}?`,
                okText: 'Yes',
                cancelText: 'No',
                onOk: () => {
                    axios.delete(`/wp-json/appointments/v1/services/${service.id}`)
                        .then(res => {
                            if (res.data.success) {
                                this.getServices({current: this.table.current})
                            }
                        }).catch(errorHandler)
                },
            })
        },
    },
    mounted() {
        this.getServices()
        this.getProviders()
    },
}
</script>

<style scoped>
.provider {
    margin: 0 5px;
    padding: 10px;
    background-color: #bbb18d;
    border-radius: 5px;
    color: white;
}
</style>