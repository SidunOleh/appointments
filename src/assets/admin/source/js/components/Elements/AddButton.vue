<template>

    <div    
        class="btn" 
        :title="title"
        @click="$emit('click')">
        +
    </div>

</template>

<style scoped>
.btn {
    padding: 10px;
    border: 1px solid  #a49561b0;
    border-radius: 5px;
    margin-bottom: 10px;
    text-align: center;
    font-size: 30px;
    color: #a49561b0;
    cursor: pointer;
}
.btn:hover {
    border: 1px solid transparent;
    background-color: #514315;
    color: white;
}
</style>