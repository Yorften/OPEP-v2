  // --------------------------------------------
  // Add Tag
  
  const addbtn = document.getElementById("addComment");
  
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
    xhr.open("POST", "http:../blogpages/crudComments.php", true);
    xhr.onload = () => {
      if (xhr.status === 200) {
        if (xhr.response) {
          error.parentElement.classList.remove("bg-red-500");
          error.parentElement.classList.toggle("bg-green-500");
          error.innerHTML = "Tag added successfully";
          getComments();
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
  
  function deleteTag(commentId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../blogpages/crudComments.php", true);
    const data = JSON.stringify({ commentId: commentId });
    xhr.send(data);
    xhr.onload = () => {
      if (xhr.status === 200) {
        getComments();
      } else {
        console.log("Error while sending request");
      }
    };
  }
  // --------------------------------------------
  // Edit Tag

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
    xhr.open("POST", "http:../blogpages/crudComments.php", true);
    xhr.onload = () => {
      if (xhr.status === 200) {
        if (xhr.response) {
          error.parentElement.classList.remove("bg-red-500");
          error.parentElement.classList.toggle("bg-green-500");
          error.innerHTML = "Tag updated successfully";
          getComments();
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
  
  function getComments() {
    const tags = document.getElementById("comments");
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../blogpages/crudComments.php", true);
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