/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './vendor/masmerise/livewire-toaster/resources/views/*.blade.php',
  ],
  mode : 'jit',
  theme: {
    extend: {},
  },
  plugins: [],
}