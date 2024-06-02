/** @type {import('tailwindcss').Config} */
const { iconsPlugin, dynamicIconsPlugin } = require('@egoist/tailwindcss-icons')

module.exports = {
    plugins: [iconsPlugin(), dynamicIconsPlugin()]
}

export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      'node_modules/preline/dist/*.js'
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('preline/plugin')
  ],
}

