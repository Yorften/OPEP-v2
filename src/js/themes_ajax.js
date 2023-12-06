window.onclick = function (event) {
  var popup = document.getElementById("popup");
  if (event.target == popup) {
    popup.classList.add("hidden");
  }
};

window.onclick = function (event) {
  var popup2 = document.getElementById("popupEditTag");
  if (event.target == popup2) {
    popup2.classList.add("hidden");
    const checkboxes = document.querySelectorAll(
      'input[type="checkbox"].uncheck'
    );

    checkboxes.forEach((checkbox) => {
      checkbox.checked = false;
    });
  }
};

function closePopupEdit() {
  document.getElementById("popupEditTag").classList.add("hidden");
  const checkboxes = document.querySelectorAll(
    'input[type="checkbox"].uncheck'
  );

  checkboxes.forEach((checkbox) => {
    checkbox.checked = false;
  });
}

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
  document.getElementById("popupEditTag").classList.remove("hidden");
  let themeName = document.getElementById("themeName2");
  let themeId = document.getElementById("themeId");
  var themeTags = document.getElementById("tags" + id);
  var spans = themeTags.getElementsByTagName("span");
  var currentTags = [];
  var themeTags2 = document.querySelectorAll(".taglist");
  const allTags = [];

  for (var i = 0; i < spans.length; i++) {
    currentTags[i] = spans[i].getAttribute("value");
  }

  themeTags2.forEach((themeTags2) => {
    if (themeTags2) {
      allTags.push(themeTags2.value);
    }
  });

  for (var i = 0; i < currentTags.length; i++) {
    for (var j = allTags.length - 1; j >= 0; j--) {
      if (currentTags[i] === allTags[j]) {
        document.getElementById("tagedit" + j).checked = true;
        break;
      } else {
        document.getElementById("tagedit" + j).checked = false;
      }
    }
  }
  themeName.value = name;
  themeId.value = id;
}

document.getElementById("modifyTheme").addEventListener("click", (event) => {
  event.preventDefault();
  var themeName = document.getElementById("themeName2").value;
  var themeId = document.getElementById("themeId").value;
  var modify_form = document.getElementById("modify_form");
  var error = document.getElementById("modErr");
  var themeTags = document.querySelectorAll(".uncheck");
  const checkedValues2 = [];

  themeTags.forEach((themeTags) => {
    if (themeTags.checked) {
      checkedValues2.push(themeTags.value);
    }
  });

  var regex = /^[a-zA-Z ]+$/;

  if (themeName === null || themeName === "") {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "New value can't be empty";
    return 0;
  } else if (regex.test(themeName) === false) {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "Please type a valid theme title (phrase)";
    return 0;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudThemes.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      error.parentElement.classList.remove("bg-red-500");
      error.parentElement.classList.toggle("bg-green-500");
      error.innerHTML = "Theme updated successfully";
      console.log(xhr.response);
      getThemes();
    } else {
      console.log("Error while sending request");
    }
  };
  var theme = {
    themeName2: themeName,
    themeId2: themeId,
    checkedValues2: checkedValues2,
  };
  console.log(theme); 
  const data = JSON.stringify(theme);
  xhr.send(data);
});
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
