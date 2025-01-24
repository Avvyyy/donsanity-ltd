// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },

  css: [
    "~/assets/css/main.css", 
    "primeicons/primeicons.css"],

  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },

  compatibilityDate: "2024-11-22",
  modules: ["@nuxtjs/google-fonts", "@pinia/nuxt"],


  googleFonts: {
    families: {
      "Montserrat": true,
      "Outfit": true,
      "Inter": true,
    },
  },


});