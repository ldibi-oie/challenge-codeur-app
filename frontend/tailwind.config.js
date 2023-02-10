/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx,vue}",
  ],
  darkMode: true,
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};
