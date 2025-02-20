<template>
    <div class="text-center">
      <button @click="toggleFavorite" class="btn btn-success p-1">
        {{ isFavorite ? 'Quitar de favoritos' : 'Agregar a favoritos' }}
      </button>
    </div>
  </template>
  
  <script>

import axios from 'axios';

  export default {
    props: {
      productId: {
        type: Number,
        required: true
      },
      initialFavorite: {
        type: Boolean,
        required: true
      }
    },
    data() {
      return {
        isFavorite: this.initialFavorite, // Carga el estado inicial desde el backend
        loading: false
      };
    },
    methods: {
      toggleFavorite() {
        this.loading = true;
        const baseURL = import.meta.env.VITE_APP_URL || "http://localhost";
        // Por ejemplo, puedes hacer una petición AJAX a una ruta definida en tu backend de Laravel
        axios.post(`${baseURL}/api/product/favorite/` + this.productId )
          .then(response => {
            this.isFavorite = !this.isFavorite;
            alert(response.data.message);
          })
          .catch(error => {
            console.error(error);
          })
          .finally(() => {
          this.loading = false;
        });
      }
    }
  };
  </script>
  