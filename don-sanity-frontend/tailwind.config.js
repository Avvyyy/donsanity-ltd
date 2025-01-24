/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        monteserrat: ["Montserrat"],
        inter: ["Inter"],
        outfit: ["Outfit"],
      },
      backgroundImage: {
        'heroImage': "url('/public/img/hero-menu.jpg')",
        'heroImage2': "url('/public/img/hero-image-2.jpg')",
      },
      colors: {
        "primary": "#965e1d",
      }
    },
  },
  plugins: [],
}