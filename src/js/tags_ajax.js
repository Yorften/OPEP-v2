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

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/opep-v2/src/blogpages/crudTags.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      getTags();
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
  xhr.open("POST", "http://localhost/opep-v2/src/blogpages/crudTags.php", true);
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

function showTagDetails(tagId2) {
  document.getElementById("popupEdit").classList.remove("hidden");
  let tagName = document.getElementById("tagname2");
  document.getElementById("tagId2").value = tagId2;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/opep-v2/src/blogpages/crudTags.php", true);
  xhr.responseType = "json";
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      for (var i in data) {
        tagName.value = data[i].tagName;
      }
      console.log(xhr.response);
    } else {
      console.log("Error while sending request");
    }
  };
  const data = JSON.stringify({ tagId2: tagId2 });
  xhr.send(data);
}

document.getElementById("modifyTag").addEventListener("click", (event) => {
  event.preventDefault();
  var tagName = document.getElementById("tagname2").value;
  var tagId = document.getElementById("tagId2").value;
  var modify_form = document.getElementById("modify_form");
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/opep-v2/src/blogpages/crudTags.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      getTags();
      document.getElementById("popupEdit").classList.add("hidden");
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
  xhr.open("GET", "http://localhost/opep-v2/src/blogpages/crudTags.php", true);
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
