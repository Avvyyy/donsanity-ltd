<script setup>
import { ref } from "vue";
import { useRoute } from "#vue-router";
import { useCartStore } from '@/stores/cart';

// Using the cartStore to handle global cart states
// Refer to stores/cart.js
const cartStore = useCartStore();


const isOpen = ref(false);
const toggleMenu = () => {
  isOpen.value = !isOpen.value;
};
const year = new Date().getFullYear();

const route = useRoute();


</script>

<template>
  <div class="font-inter">
    <header
      class="flex flex-col items-stretch justify-between px-4 sm:px-10 py-6 border-b-2 border-b-black sticky top-0 bg-white z-50"
    >
      <div class="flex flex-col sm:flex-row items-center justify-between">
        <div class="flex w-full sm:w-auto items-center justify-between">
          <!-- Toggle Button -->
          <button
            type="button"
            class="lg:hidden md:hidden inline-block text-2xl"
            @click="toggleMenu"
          >
            <i :class="isOpen ? 'pi pi-times' : 'pi pi-align-right'"></i>
          </button>

          <!-- Logo -->
          <h1 class="font-monteserrat font-bold text-2xl md:text-xl">
            Don-Sanity Ltd.
          </h1>
        </div>

        <!-- Desktop navLinks -->
        <nav class="hidden sm:flex items-center">
          <div class="flex flex-row gap-6 font-outfit">
            <NuxtLink to="/" class="text-base" :class="route.path === '/' ? 'border-b-2 border-b-primary text-primary' : 'underline-none'">Home</NuxtLink>
            <NuxtLink to="/about" class="text-base" :class="route.path === '/about' ? 'border-b-2 border-b-primary text-primary' : 'underline-none'">About</NuxtLink>
            <NuxtLink to="/products" class="text-base" :class="route.path === '/products' ? 'border-b-2 border-b-primary text-primary' : 'underline-none'">Products</NuxtLink>
          </div>
        </nav>

        <div class="flex items-center gap-5">
          <!-- Desktop Search Bar -->
          <form
            action=""
            method="search"
            class="hidden sm:flex items-center border border-black px-4 py-2 rounded-full w-64"
          >
            <input
              type="search"
              name="productSearch"
              id="productSearch"
              placeholder="Search materials"
              class="w-full outline-none flex-1 text-base placeholder:text-sm"
            />
            <button type="submit" class="text-xl text-gray-500">
              <i class="pi pi-search"></i>
            </button>
          </form>

          <!-- desktop navlinks -->
          <div class="hidden sm:flex gap-6 flex-row items-center">
            <NuxtLink
              to="/wishlist"
              @click="isOpen = false"
              title="Wishlist"
              class="text-xl"
            >
              <i class="pi pi-heart"></i>
            </NuxtLink>
            <NuxtLink
              to="/login"
              @click="isOpen = false"
              title="Login"
              class="text-xl"
            >
              <i class="pi pi-user"></i>
            </NuxtLink>
            <NuxtLink
              to="/cart"
              @click="isOpen = false"
              title="Cart"
              class="text-xl flex gap-1"
            >
              <i class="pi pi-shopping-cart"></i>
              <p class="text-sm">{{ cartStore.cartItems.length }}</p>
            </NuxtLink>
          </div>
        </div>
      </div>

      <!-- Mobile navLinks -->
      <nav
        class="sm:hidden flex-col fixed top-[82px] left-0 h-full w-2/3 bg-white shadow-lg z-50 transform transition-transform duration-300"
        :class="isOpen ? 'translate-x-0' : '-translate-x-full'"
      >
        <div class="flex flex-col gap-6 p-6 font-outfit">
          <NuxtLink to="/" @click="isOpen = false" class="text-xl"
            >Home</NuxtLink
          >
          <NuxtLink to="/about" @click="isOpen = false" class="text-xl"
            >About</NuxtLink
          >
          <NuxtLink to="/products" @click="isOpen = false" class="text-xl"
            >Products</NuxtLink
          >

          <div class="flex gap-6 flex-row items-center mt-4">
            <NuxtLink
              to="/wishlist"
              @click="isOpen = false"
              title="Wishlist"
              class="text-xl"
            >
              <i class="pi pi-heart"></i>
            </NuxtLink>
            <NuxtLink
              to="/login"
              @click="isOpen = false"
              title="Login"
              class="text-xl"
            >
              <i class="pi pi-user"></i>
            </NuxtLink>
            <NuxtLink
              to="/cart"
              @click="isOpen = false"
              title="Cart"
              class="text-xl flex gap-1"
            >
              <i class="pi pi-shopping-cart"></i>
              <p class="text-sm">{{ cartStore.cartItems.length }}</p>
            </NuxtLink>
          </div>
        </div>
      </nav>
    </header>

    <!-- Mobile Search Bar -->
    <div class="sm:hidden w-full px-4 py-3 bg-gray-50">
      <form
        action=""
        method="search"
        class="flex items-center border border-black px-4 py-2 rounded-full w-full"
      >
        <input
          type="search"
          name="productSearch"
          id="mobileProductSearch"
          placeholder="Search materials"
          class="w-full outline-none flex-1 text-base placeholder:text-sm"
        />
        <button type="submit" class="text-xl text-gray-500">
          <i class="pi pi-search"></i>
        </button>
      </form>
    </div>

    <main>
      <NuxtPage />
    </main>

    <footer
      class="bg-white text-black w-full text-center font-semibold text-monteserrat shadow-lg py-4"
    >
      Don-Sanity Ltd. <span class="text-primary">&copy;</span> {{ year }}
    </footer>
  </div>
</template>

<style>
input[type="search"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
</style>
