export const fetchProductComposable = () => {
  const products = ref([]);
  const pending = ref(false);

  const fetchProducts = async (url) => {
    pending.value = true; // Set loading state
    try {
      const { data } = await useFetch(url);
      products.value = data.value || [];
    } catch (err) {
      console.error("Failed to fetch products:", err);
      throw err;
    } finally {
      pending.value = false; 
    }
  };

  return { products, fetchProducts, pending };
};
