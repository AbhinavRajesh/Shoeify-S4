  <footer>
    <hr />
    Copyright &#169; | Abhinav Rajesh | 2021
  </footer>
    <script>
      const body = document.querySelector("body");
      const darkButton = document.getElementById("dark-mode");
      if ( localStorage.getItem("dark") === "true" ) {
        body.classList.remove("light");
        localStorage.setItem("dark", "true");
        darkButton.innerHTML = "Dark";
      } else {
        body.classList.add("light");
        localStorage.setItem("dark", "false");
        darkButton.innerHTML = "Dark";
      }
      const toggleDarkMode = () => {
        body.classList.toggle("light");
        localStorage.setItem("dark", !body.classList.contains("light"));
        darkButton.innerHTML = body.classList.contains("light") ? "Dark" : "Light";
      };
    </script>
    <script src="./static/js/ThreeJS/three.min.js"></script>
    <script src="./static/js/ThreeJS/GLTFLoader.js"></script>
    <script src="./static/js/ThreeJS/OrbitControls.js"></script>
    <script src="./static/js/app.js"></script>
  </body>
</html>
