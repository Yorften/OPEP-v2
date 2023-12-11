const searchBar = document.querySelector("#search-bar");

const searchbar = document.querySelector("#search-bar");
const article = document.querySelector(".article");
const currentURL = window.location.href;

const url = new URL(currentURL);

const themeId = url.searchParams.get("theme");
let idTh = themeId;

searchbar.addEventListener("input", function (event) {
  event.preventDefault();
  var searchValue = searchBar.value;
  console.log(searchValue);

  displayDataArticle(idTh, searchValue);
});

function displayDataArticle(idTh, search) {
  let xhr = new XMLHttpRequest();
  if (search) {
    xhr.open(
      "GET",
      `../blogpages/getArticleData.php?search=${search}&idTh=${idTh}`
    );
  } else {
    xhr.open("GET", `../blogpages/getArticleData.php?idTh=${idTh}`);
  }

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(xhr.response);
      article.innerHTML = this.responseText;
    }
  };

  xhr.send();
}
const tags = document.querySelectorAll(".tag");

tags.forEach((item) => {
  item.addEventListener("click", (event) => {
    event.preventDefault();
    const tagValue = event.target.value;
    event.target.checked = true;
    const tagUrl = url.searchParams.get("tag");
    let newURL;
    console.log(tagValue);
    if (tagUrl) {
      url.searchParams.set("tag", tagValue);
      newURL = url.href;
    } else {
      url.searchParams.append("tag", tagValue);
      newURL = url.href;
    }

    window.location.assign(newURL);
  });
});
