<template>
  <div>
    <div v-if="error"><p>Product Not Found {{ error }}</p></div>
    <featuredProducts :data="featuredProducts" v-else/>
  </div>
</template>

<script setup>
import { useCartStore } from "@/stores/cart";

const cartStore = useCartStore();

const { data: featuredProducts, error } = await useAsyncData(
  "featuredProducts",
  async ($strapi) => {
    try {
      const response = await $strapi.get("/products", {
        params: {
          featured: true,
          populate: '*',
        },
      });
      return response.data;
    } catch (error) {
      console.error("Error fetching products", error);
      throw error;
    }
  }
);

if (featuredProducts.value) {
  cartStore.setFeaturedProducts(featuredProducts.value);
} else if (error.value) {
  console.error("Error fetching products", error);
}
</script>
