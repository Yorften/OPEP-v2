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
// Add theme

const addbtn = document.getElementById("addTheme");
addbtn.addEventListener("click", (event) => {
  event.preventDefault();
  var input_form = document.getElementById("input_form");
  var themeName = document.getElementById("themeName").value;
  var themeTags = document.querySelectorAll(".taglist");
  const checkedValues = [];

  themeTags.forEach((themeTags) => {
    if (themeTags.checked) {
      checkedValues.push(themeTags.value);
    }
  });
  // console.log(checkedValues);
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
        getThemes();
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
// Delete theme
function deleteTheme(themeId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../blogpages/crudThemes.php", true);
  const data = JSON.stringify({ themeId: themeId });
  xhr.send(data);
  xhr.onload = () => {
    if (xhr.status === 200) {
      console.log(themeId);
      console.log(xhr.responseText);
      getThemes();
    } else {
      console.log("Error while sending request");
    }
  };
}
// --------------------------------------------
// Edit theme
function showThemeDetails(name, id) {
  document.getElementById("popupEdit").classList.remove("hidden");
  let themeName = document.getElementById("themeName2");
  let themeId = document.getElementById("themeId");
  var themeTags = document.getElementById("tags" + id);
  var spans = themeTags.getElementsByTagName("span");
  var currentTags = [];
  var themeTags2 = document.querySelectorAll(".taglist");
  const allTags = [];
  for (var i = 0; i < spans.length; i++) {
    currentTags[i] = spans[i].getAttribute('value');
  }

  themeTags2.forEach((themeTags2) => {
    if (themeTags2) {
      allTags.push(themeTags2.value);
    }
  });

  console.log(allTags);
  for(var i = 0 ; i < currentTags.length ; i++){
    for(var j = 0 ; i < allTags.length; j++){
      if(currentTags[i] = allTags[j]){
        document.getElementById('tagedit'+i);
      }
    }
  }
  themeName.value = name;
  themeId.value = id;
}
// --------------------------------------------
// Show themes

function getThemes() {
  const themes = document.getElementById("themes");
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../blogpages/crudThemes.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      themes.innerHTML = data;
    } else {
      console.log("Error while sending request");
    }
  };
  xhr.send();
}

// --------------------------------------------
