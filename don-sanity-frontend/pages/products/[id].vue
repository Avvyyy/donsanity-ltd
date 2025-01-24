<script setup>
import { ref, onBeforeMount, computed, watch } from "vue";
import { useRoute } from "vue-router";


const route = useRoute();

// Convert route param to a reactive number
const productId = computed(() => Number(route.params.id));


</script>


<template>
    <!-- Loading State -->
    <div v-if="pending" class="flex items-center space-x-4">
      <div class="h-12 w-12 rounded-full bg-gray-200 animate-pulse"></div>
      <div class="space-y-2">
        <div class="h-4 w-[250px] bg-gray-200 animate-pulse"></div>
        <div class="h-4 w-[200px] bg-gray-200 animate-pulse"></div>
      </div>
    </div>
  
    <!-- Product Details -->
    <div v-else-if="product" class="product-details p-10 flex flex-col md:flex-row items-center gap-10">
      <img
        :src="product.image"
        :alt="product.name"
        class="product-image object-cover md:w-1/2 w-3/4"
      />
      <div class="md:basis-1/2 basis-full flex flex-col gap-2">
        <h1 class="text-primary font-bold text-3xl md:text-2xl">
          {{ product.name }}
        </h1>
        <p>{{ product.description }}</p>
        <div class="product-info">
          <p>₦ {{ product.price }} Naira</p>
          <p>Color: {{ product.color }}</p>
          <p>Pattern: {{ product.pattern }}</p>
        </div>
  
        <button type="button" class="add-to-cart-btn">
          Add to Cart <i class="pi pi-shopping-cart"></i>
        </button>
      </div>
    </div>
  
    <!-- Error or No Product Found -->
    <div v-else class="text-center text-red-500">
      <p>Product not found.</p>
    </div>
  </template>
  
