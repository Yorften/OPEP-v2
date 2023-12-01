const filters = document.querySelectorAll(".filters");

function handleClick(event) {
  filters.forEach((link) => {
    link.classList.remove("bg-amber-600");
  });

  event.target.classList.add("bg-amber-600");

  const urlParams = new URLSearchParams(event.target.getAttribute("href"));
  const categoryName = urlParams.get("categoryName");

  sessionStorage.setItem("selectedCategory", categoryName);
}

document.addEventListener("DOMContentLoaded", () => {
  const selectedCategory = sessionStorage.getItem("selectedCategory");

  if (selectedCategory) {
    filters.forEach((link) => {
      const urlParams = new URLSearchParams(link.getAttribute("href"));
      const categoryName = urlParams.get("categoryName");
      if (categoryName === selectedCategory) {
        link.classList.add("bg-amber-600");
      }
    });
  }
});

filters.forEach((link) => {
  link.addEventListener("click", handleClick);
});


document.addEventListener("DOMContentLoaded", () => {
  sessionStorage.clear();
});