<template>
    <div>
        <div v-for="product in products.data" :key="product.slug">
        <img :src="product.image" :alt="product.name">
        <p>{{ product.name }}</p>
        <p>{{ product.price }}</p>
        form
    </div>
    </div>
</template>


<script setup>
    const {data: products } = useFetch('http://localhost:8000/api/products/');
    console.log(products.value);
</script>