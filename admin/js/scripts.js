document.addEventListener("DOMContentLoaded", (event) => {
  ClassicEditor.create(document.querySelector("#body")).catch((error) => {
    console.error(error);
  });
});
