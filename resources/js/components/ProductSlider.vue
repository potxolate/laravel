<template>
  <Carousel :items-to-show="4" :wrap-around="true">
    <Slide v-for="product in products" :key="product.id">      
      <div class="carousel__item px-md-2">
            <div class="caption text-center">
                <a :href="'/product/' + product.slug" class="text-decoration-none text-dark">
                  <img :src="product.image_url" :alt="product.name" class="card-img-top img-thumbnail mx-auto">
                </a>
                <h3 class="h6">
                    <a :href="product.slug" class="text-inherit text-decoration-none">
                        {{ product.name }}
                    </a>
                    <p>{{ product.price }}</p>
                </h3>
            </div> <!-- end caption -->
        </div>
    </Slide>
    
    <template #addons>
      <Navigation />
      <Pagination />
    </template>
  </Carousel>  
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default defineComponent({
  name: 'WrapAround',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  props:{
    productSlug:{
          required : true
      },
    products:{
        required : true
    }
  },
  mounted() {
      console.log(this.productSlug)
  },
  
})
</script>

<style>
.carousel__item {
  min-height: 200px;
  width: 90%;
  background-color: var(--vc-clr-secundary);
  color: var(--vc-clr-black);
  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  
}

.carousel__slide {
  padding: 10px;
  margin: auto;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
}
</style>
