document.addEventListener("DOMContentLoaded", (event) => {
  ClassicEditor.create(document.querySelector("#body")).catch((error) => {
    console.error(error);
  });
});

//continuously updating online users count
setInterval(() => {
  let URL;
  if (!location.href.includes("admin")) {
    URL = "admin/includes/getOnlineUsers.php?getOnlineUsers=true";
  } else {
    URL = "includes/getOnlineUsers.php?getOnlineUsers=true";
  }
  fetch(URL)
    .then((response) => {
      console.log(response);
      return response.text();
    })
    .then(
      (onlineUsersCount) =>
        (document.querySelector(
          "#online-users-count"
        ).textContent = onlineUsersCount)
    )
    .catch((err) => console.log(err));
}, 1000);
