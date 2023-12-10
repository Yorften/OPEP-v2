// --------------------------------------------
// Edit Article

// function applyNewArticle(commentId, articleId) {
//   var newComment = document.getElementById("newcomment" + commentId).value;
//   console.log(newComment);
//   var error = document.getElementById("modErr");
//   var regex = /^\s*(\S.*\S|\S)\s*$/;
//   if (newComment === null || newComment === "") {
//     error.parentElement.classList.remove("bg-green-500");
//     error.parentElement.classList.add("bg-red-500");
//     error.innerHTML = "You can't post an empty comment";
//     return 0;
//   } else if (regex.test(newComment) === false) {
//     error.parentElement.classList.remove("bg-green-500");
//     error.parentElement.classList.add("bg-red-500");
//     error.innerHTML = "You can't post an empty comment";
//     console.log("error");
//     return 0;
//   }

//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "http:../blogpages/crudComments.php", true);
//   xhr.onload = () => {
//     if (xhr.status === 200) {
//       getComments(articleId);
//     } else {
//       console.log("Error while sending request");
//     }
//   };
//   var newContent = {
//     newComment: newComment,
//     commentId2: commentId,
//   };
//   console.log(newContent);
//   var jsonData = JSON.stringify(newContent);
//   console.log(jsonData);
//   xhr.send(jsonData);
// }

function editArticle(articleId) {
  var comment = document.getElementById("p").textContent;
  var user = document.getElementById("user").textContent;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudComments.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      getComments(articleId);
    } else {
      console.log("Error while sending request");
    }
  };
}

function cancelEditArticle(articleId) {
  document.getElementById("comment" + commentId).innerHTML = `
  <div class="flex w-full justify-between">
    <h1 id="user${commentId}" class="text-gray-500"><i class='bx bx-user text-gray-500 text-xl border-gray-500'></i>${user}</h1>
      <div>
          <i onclick="editComment(${commentId},${articleId})" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
          <i onclick="deleteComment(${commentId},${articleId})" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
      </div>
</div>
<p id="p${commentId}">${comment}</p>    
  `;
}

// --------------------------------------------
