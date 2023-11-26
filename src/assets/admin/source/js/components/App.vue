<template>

    <Wrapper>

        <Menu>

            <MenuItem title="Appointments" v-model="currentTab">
                <template #menuItemImg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg>
                </template>
            </MenuItem>
            
            <MenuItem title="Services" v-model="currentTab">
                <template #menuItemImg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable-circle" viewBox="0 0 16 16">
                        <path d="M12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z"/>
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1 0a7 7 0 1 0-13.202 3.249l1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2A7 7 0 0 0 15 8Zm-8.295.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z"/>
                    </svg>
                </template>
            </MenuItem>

            <MenuItem title="Providers" v-model="currentTab">
                <template #menuItemImg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                    </svg>
                </template>
            </MenuItem>

            <MenuItem title="Hours" v-model="currentTab">
                <template #menuItemImg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                </template>
            </MenuItem>

            <MenuItem title="Sync" v-model="currentTab">
                <template #menuItemImg>
                    <svg fill="white" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M17.75 3C19.5449 3 21 4.45507 21 6.25V12.0218C20.5368 11.7253 20.0335 11.4858 19.5 11.3135V8.5H4.5V17.75C4.5 18.7165 5.2835 19.5 6.25 19.5H11.3135C11.4858 20.0335 11.7253 20.5368 12.0218 21H6.25C4.45507 21 3 19.5449 3 17.75V6.25C3 4.45507 4.45507 3 6.25 3H17.75ZM17.75 4.5H6.25C5.2835 4.5 4.5 5.2835 4.5 6.25V7H19.5V6.25C19.5 5.2835 18.7165 4.5 17.75 4.5ZM12 17.5C12 20.5376 14.4624 23 17.5 23C20.5376 23 23 20.5376 23 17.5C23 14.4624 20.5376 12 17.5 12C14.4624 12 12 14.4624 12 17.5ZM20.5 14C20.7761 14 21 14.2239 21 14.5V16.5C21 16.7761 20.7761 17 20.5 17H18.5C18.2239 17 18 16.7761 18 16.5C18 16.2239 18.2239 16 18.5 16H19.5003C19.0436 15.392 18.3174 15 17.5 15C16.6666 15 15.9283 15.4073 15.4733 16.036C15.3113 16.2597 14.9987 16.3098 14.775 16.1478C14.5514 15.9859 14.5013 15.6733 14.6632 15.4496C15.2982 14.5724 16.3323 14 17.5 14C18.4798 14 19.3651 14.4027 20 15.0506V14.5C20 14.2239 20.2239 14 20.5 14ZM15 19.9494V20.5C15 20.7761 14.7761 21 14.5 21C14.2239 21 14 20.7761 14 20.5V18.5C14 18.2239 14.2239 18 14.5 18H16.5C16.7761 18 17 18.2239 17 18.5C17 18.7761 16.7761 19 16.5 19H15.4998C15.9564 19.608 16.6827 20 17.5 20C18.2663 20 18.9518 19.6558 19.4112 19.1118C19.5893 18.9008 19.9048 18.8742 20.1158 19.0523C20.3268 19.2305 20.3534 19.546 20.1752 19.7569C19.534 20.5164 18.5732 21 17.5 21C16.5203 21 15.6349 20.5973 15 19.9494Z"/></svg>    
                </template>
            </MenuItem>

            <MenuItem title="Settings" v-model="currentTab">
                <template #menuItemImg>
                    <svg fill="white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 32 32" width="50px" height="50px"><path d="M 13.1875 3 L 13.03125 3.8125 L 12.4375 6.78125 C 11.484375 7.15625 10.625 7.683594 9.84375 8.3125 L 6.9375 7.3125 L 6.15625 7.0625 L 5.75 7.78125 L 3.75 11.21875 L 3.34375 11.9375 L 3.9375 12.46875 L 6.1875 14.4375 C 6.105469 14.949219 6 15.460938 6 16 C 6 16.539063 6.105469 17.050781 6.1875 17.5625 L 3.9375 19.53125 L 3.34375 20.0625 L 3.75 20.78125 L 5.75 24.21875 L 6.15625 24.9375 L 6.9375 24.6875 L 9.84375 23.6875 C 10.625 24.316406 11.484375 24.84375 12.4375 25.21875 L 13.03125 28.1875 L 13.1875 29 L 18.8125 29 L 18.96875 28.1875 L 19.5625 25.21875 C 20.515625 24.84375 21.375 24.316406 22.15625 23.6875 L 25.0625 24.6875 L 25.84375 24.9375 L 26.25 24.21875 L 28.25 20.78125 L 28.65625 20.0625 L 28.0625 19.53125 L 25.8125 17.5625 C 25.894531 17.050781 26 16.539063 26 16 C 26 15.460938 25.894531 14.949219 25.8125 14.4375 L 28.0625 12.46875 L 28.65625 11.9375 L 28.25 11.21875 L 26.25 7.78125 L 25.84375 7.0625 L 25.0625 7.3125 L 22.15625 8.3125 C 21.375 7.683594 20.515625 7.15625 19.5625 6.78125 L 18.96875 3.8125 L 18.8125 3 Z M 14.8125 5 L 17.1875 5 L 17.6875 7.59375 L 17.8125 8.1875 L 18.375 8.375 C 19.511719 8.730469 20.542969 9.332031 21.40625 10.125 L 21.84375 10.53125 L 22.40625 10.34375 L 24.9375 9.46875 L 26.125 11.5 L 24.125 13.28125 L 23.65625 13.65625 L 23.8125 14.25 C 23.941406 14.820313 24 15.402344 24 16 C 24 16.597656 23.941406 17.179688 23.8125 17.75 L 23.6875 18.34375 L 24.125 18.71875 L 26.125 20.5 L 24.9375 22.53125 L 22.40625 21.65625 L 21.84375 21.46875 L 21.40625 21.875 C 20.542969 22.667969 19.511719 23.269531 18.375 23.625 L 17.8125 23.8125 L 17.6875 24.40625 L 17.1875 27 L 14.8125 27 L 14.3125 24.40625 L 14.1875 23.8125 L 13.625 23.625 C 12.488281 23.269531 11.457031 22.667969 10.59375 21.875 L 10.15625 21.46875 L 9.59375 21.65625 L 7.0625 22.53125 L 5.875 20.5 L 7.875 18.71875 L 8.34375 18.34375 L 8.1875 17.75 C 8.058594 17.179688 8 16.597656 8 16 C 8 15.402344 8.058594 14.820313 8.1875 14.25 L 8.34375 13.65625 L 7.875 13.28125 L 5.875 11.5 L 7.0625 9.46875 L 9.59375 10.34375 L 10.15625 10.53125 L 10.59375 10.125 C 11.457031 9.332031 12.488281 8.730469 13.625 8.375 L 14.1875 8.1875 L 14.3125 7.59375 Z M 16 11 C 13.25 11 11 13.25 11 16 C 11 18.75 13.25 21 16 21 C 18.75 21 21 18.75 21 16 C 21 13.25 18.75 11 16 11 Z M 16 13 C 17.667969 13 19 14.332031 19 16 C 19 17.667969 17.667969 19 16 19 C 14.332031 19 13 17.667969 13 16 C 13 14.332031 14.332031 13 16 13 Z"/></svg>
                </template>
            </MenuItem>

        </Menu>

        <Content>

            <component :is="currentTab">
            </component>

        </Content>

    </Wrapper>

</template>

<script>
import Wrapper from './Elements/Wrapper.vue'
import Menu from './Elements/Menu.vue'
import MenuItem from './Elements/MenuItem.vue'
import Content from './Elements/Content.vue'
import Appointments from './Tabs/Appointments.vue'
import Services from './Tabs/Services.vue'
import Providers from './Tabs/Providers.vue'
import Hours from './Tabs/Hours.vue'
import Sync from './Tabs/Sync.vue'
import Settings from './Tabs/Settings.vue'

export default {
    components: {
        Wrapper, Content,
        Menu, MenuItem,
        Appointments, Services,
        Providers, Hours,
        Sync, Settings,
    },
    data() {
        return {
            currentTab: 'Appointments',
        }
    },
}
</script>

<style>
#wpcontent {
    padding-left: 0px !important;
}
#wpbody-content {
    padding-bottom: 0px !important;
}
#wpfooter {
    display: none !important;
}
#adminmenuwrap {
    z-index: 10002;
}
#adminmenuback {
    z-index: 10001;
}
.title {
    display: block;
    font-size: 14px;
    margin: 0 0 5px 0;
    font-weight: 600;
}
.icon {
    font-size: 17px;
    cursor: pointer;
}
.menu-item svg {
    width: 30px;
    height: 30px;
    color: #ffffff;
}
.ant-modal-footer button[disabled] {
    display: none;
}
.ant-spin-dot-item {
    background-color: #a49561 !important;
}
.ant-input-group-wrapper, 
.ant-input-number-wrapper, 
.ant-select,
.ant-input,
.ant-input-number {
    margin-bottom: 10px;
}
.calendar {
    margin-bottom: 10px;
}
.loading {
    position: relative;
}
.loading::before {
    content: "";
    position: absolute;
    z-index: 1000;
    top: 0;
    left: 0;
    background: -webkit-gradient(linear, left top, right bottom, color-stop(40%, #eeeeee), color-stop(50%, #dddddd), color-stop(60%, #eeeeee));
    background: linear-gradient(to bottom right, #eeeeee 40%, #dddddd 50%, #eeeeee 60%);
    background-size: 200% 200%;
    background-repeat: no-repeat;
    -webkit-animation: placeholderShimmer 2s infinite linear;
    animation: placeholderShimmer 2s infinite linear;
    height: 100%;
    width: 100%;
    opacity: 0.6;
}
@-webkit-keyframes placeholderShimmer {
    0% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0 0;
    }
}
@keyframes placeholderShimmer {
    0% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0 0;
    }
}
.ant-table-content {
    overflow: auto;
}
@media screen and (max-width: 782px) {
    .wp-responsive-open #wpbody {
        right: -14.5em !important;
    }
}
</style>