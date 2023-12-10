function editArticle(articleId) {
  var title = document.getElementById("title").textContent;
  var tag = document.getElementById("tag").textContent;
  var content = document.getElementById("content").innerText;
  var themeId = document.getElementById("themeId").value;
  var articleId = document.getElementById("articleid").value;
  var article = document.getElementById("article");
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudArticles.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      //   console.log(data);
      article.innerHTML = data;
    } else {
      console.log("Error while sending request");
    }
  };
  var data = {
    articleId: articleId,
    themeId: themeId,
    tag: tag,
    title: title,
    content: content,
  };
  var jsondata = JSON.stringify(data);
  xhr.send(jsondata);
}

// --------------------------------------------
// Fetch Tags

function fetchTags() {
  var theme = document.getElementById("theme").value;
  var tag = document.getElementById("tag");

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudArticles.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      //   console.log(data);
      tag.innerHTML = data;
    } else {
      console.log("Error while sending request");
    }
  };

  var data = {
    themeId2: theme,
  };
  //   console.log(data);
  var jsonData = JSON.stringify(data);
  //   console.log(jsonData);
  xhr.send(jsonData);
}

function cancelEditArticle(articleId) {
  var article = document.getElementById("article");
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudArticles.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      let data = xhr.response;
      article.innerHTML = data;
    } else {
      console.log("Error while sending request");
    }
  };

  var data = {
    articleId2: articleId,
  };
  var jsonData = JSON.stringify(data);
  xhr.send(jsonData);
}

function applyNewArticle(articleId) {
  var title = document.getElementById("title").value;
  var content = document.getElementById("content").value;
  var tag = document.getElementById("tag").value;
  var themeId = document.getElementById("theme").value;

  console.log(content);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http:../blogpages/crudArticles.php", true);
  xhr.onload = () => {
    if (xhr.status === 200) {
      console.log(xhr.response);
      cancelEditArticle(articleId);
    } else {
      console.log("Error while sending request");
    }
  };

  var data = {
    articleId3: articleId,
    themeId: themeId,
    tag: tag,
    title: title,
    content: content,
  };
  var jsonData = JSON.stringify(data);
  console.log(data);
  xhr.send(jsonData);
}
