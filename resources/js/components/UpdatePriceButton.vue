<template>
    <div>
      <button @click="updatePrice" class="btn btn-sm btn-primary">
        Actualizar
      </button>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      linkId: {
        type: Number,
        required: true,
      },
    },
    methods: {
      async updatePrice() {
        try {
        
            
          const response = await axios.post(`/links/${this.linkId}/update-price`);
          alert('Precio actualizado correctamente');
          window.location.reload(); // Recargar la página para reflejar el nuevo precio
        } catch (error) {
          alert('Error al actualizar el precio');
          console.error(error);
        }
      },
    },
  };
  </script>