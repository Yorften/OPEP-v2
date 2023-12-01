/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "src/includes/*.html",
    "src/includes/*.php",
    "src/pages/*.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};
