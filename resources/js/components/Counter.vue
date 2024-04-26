<script setup>
    import { ref } from 'vue'
    const count = ref(0);    
</script>

<template>
    <div class="col-12 d-flex justify-content-center">    
        <button @click="count++" class="btn btn-primary m-2 py-2">
            Buy
        </button>
        <p class="m-3">{{ count }}</p>    
    </div>
</template>

