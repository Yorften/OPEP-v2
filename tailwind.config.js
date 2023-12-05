/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "src/includes/*.html",
    "src/includes/*.php",
    "src/pages/*.php",
    "src/blogpages/*.php",
    "src/blog/*.php",
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
