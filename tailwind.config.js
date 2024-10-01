/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')
export default {
  content: [
    "./resources/views/*.blade.php",
    "./resources/js/**/*.js",
    // Tambahkan path lain yang sesuai dengan proyek kamu
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      },
      colors: {
        brown: {
          600: '#6B4F3A', // Coklat
          700: '#4E3B28', // Coklat lebih gelap
        },
      },
    },
  },
  plugins: [],
}