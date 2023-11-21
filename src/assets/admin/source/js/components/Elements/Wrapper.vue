<template>

    <div class="wrapper">
        <slot></slot>
    </div>
    
</template>

<style>
.wrapper {
    min-height: 100vh;
    display: flex;
    overflow: auto;
}
</style>