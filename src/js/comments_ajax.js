// --------------------------------------------
// Add Comment
var textarea = document.getElementById("comment");
const addbtn = document.getElementById("addComment");
addbtn.addEventListener("click", addComment);

textarea.addEventListener("keydown", (e) => {
  if (e.key === "Enter" && !e.shiftKey) {
    addComment();
  }
});

function addComment() {
  var commentContent = document.getElementById("comment").value;
  var sesstionId = document.getElementById("sessionid").value;
  var articleId = document.getElementById("articleid").value;
  var error = document.getElementById("addErr");
  var regex = /^\s*(\S.*\S|\S)\s*$/;
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
      error.parentElement.classList.remove("bg-red-500");
      error.innerHTML = "";
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
}

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

function undoDelete(commentId, articleId) {
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
  const data = JSON.stringify({ commentId2: commentId });
  console.log(data);
  xhr.send(data);
}
// --------------------------------------------
// Edit Comment

function applyNewComment(commentId, articleId) {
  var newComment = document.getElementById("newcomment" + commentId).value;
  console.log(newComment);
  var error = document.getElementById("modErr");
  var regex = /^\s*(\S.*\S|\S)\s*$/;
  if (newComment === null || newComment === "") {
    error.parentElement.classList.remove("bg-green-500");
    error.parentElement.classList.add("bg-red-500");
    error.innerHTML = "You can't post an empty comment";
    return 0;
  } else if (regex.test(newComment) === false) {
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
      getComments(articleId);
    } else {
      console.log("Error while sending request");
    }
  };
  var newContent = {
    newComment: newComment,
    commentId3: commentId,
  };
  console.log(newContent);
  var jsonData = JSON.stringify(newContent);
  console.log(jsonData);
  xhr.send(jsonData);
}

function editComment(commentId, articleId) {
  var comment = document.getElementById("p" + commentId).textContent;
  var user = document.getElementById("user" + commentId).textContent;
  document.getElementById("comment" + commentId).innerHTML = `
  <div class="bg-red-500 mb-3 px-2 rounded-lg w-full">
                <p id="modErr" class="text-white text-lg text-center"></p>
            </div>
  <textarea name="comment" id="newcomment${commentId}" cols="30" rows="5" class="w-full resize-none shadow-xl border-t-2 rounded-xl p-4 mb-4" placeholder="Leave a comment!">${comment}</textarea>
  <div class="w-full flex justify-end gap-4">
      <button onclick="applyNewComment(${commentId},${articleId})" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg ">Apply</button>
      <button onclick="cancelEdit(${commentId},${articleId},'${comment}','${user}')" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg ">Cancel</button>
  </div>
  `;
}

function cancelEdit(commentId, articleId, comment, user) {
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
