<template>
    <div>
      <ul>
        <li v-for="result in results" :key="result.domain">
          {{ result.domain }}: {{ result.price }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      urls: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        results: [],
      };
    },
    mounted() {
      this.fetchPrices();
    },
    methods: {
      async fetchPrices() {
        for (let url of this.urls) {
          try {
            const proxyUrl = `https://cors-anywhere.herokuapp.com/${url.url}`;
            const response = await fetch(proxyUrl);
            const text = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(text, 'text/html');
            
            // Aquí debes ajustar el selector al que se ajusta la estructura del HTML de tu ecommerce
            const priceElement = doc.querySelector('[itemprop="price"]');
            const price = priceElement ? priceElement.content : 'Precio no encontrado';
            
            const domain = new URL(url.url).hostname;
            this.results.push({
              domain,
              price,
            });
          } catch (error) {
            console.error('Error fetching price:', error);
          }
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos opcionales */
  </style>
  