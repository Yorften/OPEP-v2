/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "src/includes/*.html",
    "src/includes/*.php",
    "src/pages/*.php",
    "src/blogpages/*.php",
<<<<<<< HEAD
=======
    "src/blogpages/themes.php",
>>>>>>> d0584b187cbc03605817c68611e76100301fac86
    "src/blog/*.php",
  ],
  theme: {
    extend: {
      boxShadow: {
        '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
      }
    },
  },
  plugins: [
    function ({ addVariant }) {
      addVariant("child", "& > *");
    },
  ],
};
