<template>

    <div 
        :class="{'current': modelValue == title, 'menu-item': true,}"
        :title="title" 
        @click="$emit('update:modelValue', title)">
        
        <slot name="menuItemImg"></slot>

    </div>

</template>

<script>
export default {
    props: ['title', 'modelValue',]
}
</script>

<style scoped>
.menu-item {
    padding: 8px 0;
    text-align: center;
    cursor: pointer;
}
.menu-item:hover, .menu-item.current {
    background-color: #514315;
}
</style>
