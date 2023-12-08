// --------------------------------------------
// Add Comment

const addbtn = document.getElementById("addComment");

addbtn.addEventListener("click", () => {
  var textarea = document.getElementById("comment");
  var commentContent = document.getElementById("comment").value;
  var sesstionId = document.getElementById("sessionid").value;
  var articleId = document.getElementById("articleid").value;
  var error = document.getElementById("addErr");
  var regex = /^\s*\S.*$/;

  if (commentContent === null || commentContent === "") {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "You can't post an empty comment";
    return 0;
  } else if (regex.test(commentContent) === false) {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "You can't post an empty comment";
    console.log("error");
    return 0;
  }

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudComments.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      textarea.value = "";
      getComments(articleId);
    } else {
      console.log("Error while sending request");
    }
  };

  var comment = {
    commentContent: commentContent,
    sesstionId: sesstionId,
    articleId: articleId,
  };
  var jsonData = JSON.stringify(comment);
  xhr.send(jsonData);
});

// --------------------------------------------
// Delete Comment

function deleteComment(commentId, articleId) {
  var xhr = new XMLHttpRequest();
  console.log(articleId);
  xhr.open("POST", "../blogpages/crudComments.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      console.log(xhr.response);
      getComments(articleId);
    } else {
      console.log("Error while sending request");
    }
  };
  const data = JSON.stringify({ commentId: commentId });
  console.log(data);
  xhr.send(data);
}
// --------------------------------------------
// Edit Comment

// document.getElementById("modifyComment").addEventListener("click", (event) => {
//   event.preventDefault();
//   var tagName = document.getElementById("tagname2").value;
//   var tagId = document.getElementById("tagId2").value;
//   var modify_form = document.getElementById("modify_form");
//   var error = document.getElementById("modErr");
//   var regex = /^[a-zA-Z]+$/;

//   if (tagName === null || tagName === "") {
//     error.parentElement.classList.remove("bg-green-500");
//     error.parentElement.classList.add("bg-red-500");
//     error.innerHTML = "New value can't be empty";
//     return 0;
//   } else if (regex.test(tagName) === false) {
//     error.parentElement.classList.remove("bg-green-500");
//     error.parentElement.classList.add("bg-red-500");
//     error.innerHTML = "Please type a valid tag (one word)";
//     return 0;
//   }

//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "http:../blogpages/crudComments.php", true);
//   xhr.onload = () => {
//     if (xhr.status === 200) {
//       if (xhr.response) {
//         error.parentElement.classList.remove("bg-red-500");
//         error.parentElement.classList.toggle("bg-green-500");
//         error.innerHTML = "Tag updated successfully";
//         getComments();
//       } else {
//         console.log("name already exists");
//         error.parentElement.classList.remove("bg-green-500");
//         error.parentElement.classList.add("bg-red-500");
//         error.innerHTML = "Tag already exists";
//         return 0;
//       }
//     } else {
//       console.log("Error while sending request");
//     }
//   };
//   var tag = {
//     tagName2: tagName,
//     tagId3: tagId,
//   };
//   const data = JSON.stringify(tag);
//   xhr.send(data);
//   modify_form.reset();
// });
// --------------------------------------------
// Show Comments

function getComments(articleId) {
  let comment = document.getElementById("comments");
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../blogpages/crudComments.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      console.log(data);
      comment.innerHTML = data;
    } else {
      console.log("Error while sending request");
    }
  };
  var id = {
    articleId2: articleId,
  };
  var jsondata = JSON.stringify(id);
  console.log(jsondata);
  xhr.send(jsondata);
}

// --------------------------------------------
