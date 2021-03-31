const body = document.querySelector("body");
const darkButton = document.getElementById("dark-mode");

const toggleDarkMode = () => {
  body.classList.toggle("dark");
  darkButton.innerHTML = body.classList.contains("dark") ? "Light" : "Dark";
};
