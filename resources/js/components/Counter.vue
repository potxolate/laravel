<script setup>
    import { ref } from 'vue'

    const count = ref(0)
</script>

<template>
    <div class="col-12">
    {{ count }}

    <button @click="count++" class="btn btn-info">
        Buy
    </button>
    </div>
</template>