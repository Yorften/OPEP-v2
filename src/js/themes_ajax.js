window.onclick = function (event) {
  var popup = document.getElementById("popup");
  var popup2 = document.getElementById("popupEdit");
  if (event.target == popup) {
    popup.classList.add("hidden");
  } else if (event.target == popup2) {
    popup2.classList.add("hidden");
  }
};
// --------------------------------------------
// Add Tag

const addbtn = document.getElementById("addTheme");
addbtn.addEventListener("click", (event) => {
  event.preventDefault();
  var input_form = document.getElementById("input_form");
  var themeName = document.getElementById("themeName").value;
  var themeTags = document.querySelectorAll(".peer");
  const checkedValues = [];

  themeTags.forEach((themeTags) => {
    if (themeTags.checked) {
      checkedValues.push(themeTags.value);
    }
  });
  var input_form = document.getElementById("input_form");
  var error = document.getElementById("addErr");
  var regex = /^[a-zA-Z ]+$/;

  if (themeName === null || themeName === "") {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "Please write the theme's title";
    return 0;
  } else if (regex.test(themeName) === false) {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "Please type a valid theme title (phrase)";
    console.log("error");
    return 0;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudThemes.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      if (xhr.response) {
        error.parentElement.classList.remove("bg-red-500");
        error.parentElement.classList.toggle("bg-green-500");
        error.innerHTML = "Theme added successfully";
        console.log(xhr.response);
      } else {
        error.parentElement.classList.remove("bg-green-500");
        error.parentElement.classList.add("bg-red-500");
        error.innerHTML = "Theme already exists";
      }
    } else {
      console.log("Error while sending request");
    }
  };

  var theme = {
    themeName: themeName,
    checkedValues: checkedValues,
  };
  var jsonData = JSON.stringify(theme);
  xhr.send(jsonData);
  input_form.reset();
});

// --------------------------------------------
// Delete Tag
function deleteTheme(){
  
}
// --------------------------------------------
// Edit Tag
function showThemeDetails(tag, id){
  
}
// --------------------------------------------
// Show tags

// function getThemes() {
//   const tags = document.getElementById("tags");
//   var xhr = new XMLHttpRequest();
//   xhr.open("GET", "../blogpages/crudThemes.php", true);
//   xhr.onload = () => {
//     if (xhr.status === 200) {
//       let data = xhr.response;
//       console.log(data);
//       tags.innerHTML = data;
//     } else {
//       console.log("Error while sending request");
//     }
//   };
//   xhr.send();
// }

// --------------------------------------------
