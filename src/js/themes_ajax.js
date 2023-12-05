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

  console.log(themeName);
  console.log(checkedValues);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudThemes.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      console.log(xhr.response);
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

// --------------------------------------------
// Edit Tag

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
