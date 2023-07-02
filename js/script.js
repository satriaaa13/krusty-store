/* Ketika terjadi inputan maka label akan menghilang*/

const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");

usernameInput.addEventListener("input", () => {
  if (usernameInput.value === "") {
    usernameInput.nextElementSibling.style.opacity = "0.5";
  } else {
    usernameInput.nextElementSibling.style.opacity = "0";
  }
});

passwordInput.addEventListener("input", () => {
  if (passwordInput.value === "") {
    passwordInput.nextElementSibling.style.opacity = "0.5";
  } else {
    passwordInput.nextElementSibling.style.opacity = "0";
  }
});
