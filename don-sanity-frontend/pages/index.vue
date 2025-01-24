<script setup>
import { ref, onMounted } from "vue";

const activeCategory = ref(null); // Tracks the currently active category

// Fetch JSON data on component mount
// Using the fetchProducts composable
onMounted(async () => {
  await fetchProducts("http://localhost:8000/api/products/");
  console.log(products.value);
  // activeCategory.value = products.value[0]; // Set the first category as active by default
});
</script>

<template>
  <div>
    <!-- Hero Section -->
    <div
      class="bg-heroImage2 bg-center bg-cover lg:h-[80vh] h-[60vh] bg-no-repeat text-[#EFEFEF]"
    >
      <div
        class="md:w-80 md:h-72 w-2/3 h-2/3 p-5 transform translate-y-1/3 m-auto lg:translate-x-full sm:translate-x-1/2 bg-white text-left flex flex-col gap-3"
      >
        <h2
          class="font-extrabold font-monteserrat text-xl lg:text-3xl md:text-3xl drop-shadow-lg text-black"
        >
          Quality Wholesale Curtains
        </h2>
        <h3 class="font-emibold text-gray-400">
          Switch up your interior decor game with quality, affordable curtain
          materials
        </h3>
        <button
          type="button"
          class="bg-primary text-white w-40 p-3 hover:opacity-85 hover:transition-opacity rounded"
        >
          Discover More
        </button>
      </div>
    </div>

    <!-- Product Section -->
    <section class="my-16 md:px-20 px-10 text-center">
      <h2 class="font-bold text-2xl mb-5">Popular Curtain Materials</h2>
      <p class="text-gray-400 md:w-1/3 m-auto">
        Here are some samples of our in-demand materials - the hot cakes of the
        current market if you must
      </p>
      <div class="flex justify-center items-center gap-8 mt-5">
        <!-- <button
        v-for="category in products"
        :key="category.id"
        @click="activeCategory = category"
        :class="{
          'text-primary border-b-2 border-primary': activeCategory?.id === category.id,
          'text-gray-500': activeCategory?.id !== category.id
        }"
        class="font-bold pb-2"
      >
        {{ category.name }}
      </button> -->
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-10">
        <div
          v-for="product in products"
          :key="product.id"
          class="md:p-5 p-2"
        >
          <img
            :src="product.image"
            alt="Product Image"
            class="w-full h-48 object-cover rounded-lg"
          />
          <p>{{ product.name }}</p>
        </div>
      </div>
    </section>
  </div>
</template>
