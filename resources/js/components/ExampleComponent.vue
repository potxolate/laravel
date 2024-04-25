<template>
    <div class="search-container text-left">
        <input type="text" id="search" placeholder="Buscar..." v-model="searchTerm" @input="search" class="form-control">
        <input type="hidden" id="product_id" name="product_id" v-model="productId">

        <div class="suggestions" v-if="filteredResults.length > 0">
            <ul class="text-left">
                <li v-for="result in filteredResults" :key="result.id" class="list-unstyled">
                    <a @click="selectResult(result)">{{ result.name }}</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchTerm: '',
            searchResults: [],
            filteredResults: [],
            productId: ''
        };
    },
    methods: {
        search() {
            // Reemplazar con la URL real de la API
            const url = `http://192.168.1.128:8000/autocomplete?q=${this.searchTerm}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    this.searchResults = data;
                    this.filterResults();
                });
        },
        filterResults() {
            this.filteredResults = this.searchResults.filter(result => {
                return result.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
        selectResult(result) {
            this.searchTerm = result.name;
            this.productId = result.id;
            this.filteredResults = [];
        }
    }
};
</script>

<style scoped>
.search-container {
    position: relative;
}

.suggestions {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}
</style>
