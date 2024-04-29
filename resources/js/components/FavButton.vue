<template>
    <div class="text-center m-2">
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
      }
    },
    data() {
      return {
        isFavorite: false
      };
    },
    methods: {
      toggleFavorite() {
        // Aquí puedes hacer una solicitud a tu backend para guardar o quitar el producto de favoritos
        this.isFavorite = !this.isFavorite;
        // Por ejemplo, puedes hacer una petición AJAX a una ruta definida en tu backend de Laravel
        axios.post('/api/product/favorite/' + this.productId )
          .then(response => {
            alert(response.data.message);
          })
          .catch(error => {
            console.error(error);
          });
      }
    }
  };
  </script>
  