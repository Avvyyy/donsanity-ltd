<template>
  <div class="grid grid-cols-2 md:grid-cols-3 md:px-20 py-1 gap-10">
    <div class="group relative" v-for="(product, i) in data" :key="i">
      <img
        :src="`http://localhost:1337${product.attributes.image.data.attributes.formats.small.url}`"
        :alt="product.name"
        class="object-cover w-full"
      />

      <!-- Text overlay -->
      <div
        class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity text-justify p-2"
      >
        <h3 class="font-bold text-lg text-white">{{ product.name }}</h3>
        <NuxtLink to="`/products/${ product.id }`" class="text-white"
          >View Product</NuxtLink
        >
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps(["data"]);
</script>

<style scoped>
/* Optional: Add a smooth transition for the overlay */
.group:hover .group-hover\:opacity-100 {
  opacity: 1;
  transition: opacity 0.3s ease-in-out;
}
</style>
