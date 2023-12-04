document.getElementById("addTag").addEventListener("click", () => {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "http://localhost/opep-v2/src/blogpages/crudTags.php");
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      var iframe = document.getElementById("contentFrame");
      iframe.src = iframe.src;
    }
  };

  xhr.send(
    new URLSearchParams(new FormData(document.getElementById("input_form")))
  );
});
