function openPopup() {
  document.getElementById("popup").classList.remove("hidden");
}

function closePopup() {
  document.getElementById("popup").classList.add("hidden");
  document.getElementById("popupEdit").classList.add("hidden");
}

window.onclick = function (event) {
  var popup = document.getElementById("popup");
  var popup2 = document.getElementById("popupEdit");
  if (event.target == popup) {
    popup.classList.add("hidden");
  } else if (event.target == popup2) {
    popup2.classList.add("hidden");
  }
};

function showDetails(itemId) {
  document.getElementById("popupEdit").classList.remove("hidden");
  // Append the item ID to the URL without reloading the page
  history.pushState(null, null, "?categoryId=" + itemId);
}

function showPlantDetails(itemId) {
  document.getElementById("popupEdit").classList.remove("hidden");
  // Append the item ID to the URL without reloading the page
  // itemImage = itemImage.replace(/'/g, '');
  history.pushState(null, null, "?plantId=" + itemId);
}
