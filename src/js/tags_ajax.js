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

const addbtn = document.getElementById("addTag");

const addTag = (event) => {
  event.preventDefault();
  var tagName = document.getElementById("tagname").value;
  var input_form = document.getElementById("input_form");
  var error = document.getElementById("addErr");
  var regex = /^[a-zA-Z]+$/;

  if (tagName === null || tagName === "") {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "Please write the tag's name";
    return 0;
  } else if (regex.test(tagName) === false) {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "Please type a valid tag (one word)";
    console.log("error");
    return 0;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudTags.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      if (xhr.response) {
        error.parentElement.classList.remove("bg-red-500");
        error.parentElement.classList.toggle("bg-green-500");
        error.innerHTML = "Tag added successfully";
        getTags();
      } else {
        error.parentElement.classList.remove("bg-green-500");
        error.parentElement.classList.add("bg-red-500");
        error.innerHTML = "Tag already exists";
      }
    } else {
      console.log("Error while sending request");
    }
  };

  // var tag = {
  //   tagName : tagName,
  // }

  var jsonData = JSON.stringify({ tagName: tagName });
  xhr.send(jsonData);
  input_form.reset();
};

addbtn.addEventListener("click", addTag);

// --------------------------------------------
// Delete Tag

function deleteTag(tagId) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../blogpages/crudTags.php", true);
  const data = JSON.stringify({ tagId: tagId });
  xhr.send(data);
  xhr.onload = () => {
    if (xhr.status === 200) {
      getTags();
    } else {
      console.log("Error while sending request");
    }
  };
}
// --------------------------------------------
// Edit Tag

function showTagDetails(tag, id) {
  document.getElementById("popupEdit").classList.remove("hidden");
  let tagName = document.getElementById("tagname2");
  let tagId = document.getElementById("tagId2");
  tagName.value = tag;
  tagId.value = id;
}

document.getElementById("modifyTag").addEventListener("click", (event) => {
  event.preventDefault();
  var tagName = document.getElementById("tagname2").value;
  var tagId = document.getElementById("tagId2").value;
  var modify_form = document.getElementById("modify_form");
  var error = document.getElementById("modErr");
  var regex = /^[a-zA-Z]+$/;

  if (tagName === null || tagName === "") {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "New value can't be empty";
    return 0;
  } else if (regex.test(tagName) === false) {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "Please type a valid tag (one word)";
    return 0;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudTags.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      if (xhr.response) {
        error.parentElement.classList.remove("bg-red-500");
        error.parentElement.classList.toggle("bg-green-500");
        error.innerHTML = "Tag updated successfully";
        getTags();
      } else {
        console.log("name already exists");
        error.parentElement.classList.remove("bg-green-500");
        error.parentElement.classList.add("bg-red-500");
        error.innerHTML = "Tag already exists";
        return 0;
      }
    } else {
      console.log("Error while sending request");
    }
  };
  var tag = {
    tagName2: tagName,
    tagId3: tagId,
  };
  const data = JSON.stringify(tag);
  xhr.send(data);
  modify_form.reset();
});
// --------------------------------------------
// Show tags

function getTags() {
  const tags = document.getElementById("tags");
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../blogpages/crudTags.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      console.log(data);
      tags.innerHTML = data;
    } else {
      console.log("Error while sending request");
    }
  };
  xhr.send();
}

// --------------------------------------------
