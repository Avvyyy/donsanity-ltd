// stores/cart.js
import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    allProducts: [],
    featuredProducts: [],
    cartItems: [],
  }),

  getters: {
    allProducts: (state) => state.allProducts,
    featuredProducts: (state) => state.featuredProducts,
    getCart: (state) => state.cartItems,
    getCartTotal: (state) => {
      return state.cartItems.length < 1
        ? 0
        : state.cartItems
            .map((item) => item.price * item.quantity)
            .reduce((a, b) => a + b, 0);
    },
  },

  actions: {
    // adding items to cart
    async addItemToCart(cartItem) {
      this.setCartItem(cartItem);
    },
    // Deleting items from cart
    async deleteCartItem(id) {
      this.removeCartItem(id);
    },

    // Mutations within actions
    setProducts(products) {
      this.allProducts = products;
    },
    setFeaturedProducts(products) {
      this.featuredProducts = products;
    },
    setCartItem(cartItem) {
      this.cartItems.push(cartItem);
    },
    removeCartItem(id) {
      this.cartItems = this.cartItems.filter((item) => item.id !== id);
    },
  },
});
