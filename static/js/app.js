const body = document.querySelector("body");
const darkButton = document.getElementById("dark-mode");

let container;
let camera;
let renderer;
let scene;
let shoe;

const init = () => {
  container = document.querySelector(".home-right-container");

  // Create Scene
  scene = new THREE.Scene();

  const fov = 35;
  const aspect = container.clientWidth / container.clientHeight;
  const near = 0.1;
  const far = 500;

  // Camera Setup
  camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
  camera.position.set(0, 0, 5);

  const ambient = new THREE.AmbientLight(0x404040, 2);
  scene.add(ambient);

  const light = new THREE.DirectionalLight(0xffffff, 4);
  light.position.set(-10, 10, 10);
  scene.add(light);

  // const controls = new THREE.OrbitControls(camera);
  // controls.enablePan = false;
  // controls.enableZoom = false;
  // controls.enableDamping = true;
  // controls.minPolarAngle = 0.8;
  // controls.maxPolarAngle = 2.4;
  // controls.dampingFactor = 0.07;
  // controls.rotateSpeed = 0.07;

  // Renderer
  renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setPixelRatio(window.devicePixelRatio);

  container.appendChild(renderer.domElement);

  document.addEventListener("mousedown", onDocumentMouseDown, false);
  document.addEventListener("touchstart", onDocumentTouchStart, false);
  document.addEventListener("touchmove", onDocumentTouchMove, false);

  // Load Model
  let loader = new THREE.GLTFLoader();
  loader.load("../../assets/3d/scene.gltf", (gltf) => {
    scene.add(gltf.scene);
    // controls.update();
    shoe = gltf.scene.children[0];
    shoe.rotation.x = 1.22;
    shoe.rotation.y = 0.42;
    shoe.rotation.z = 2;
    animate();
  });
};

// !Testing

var targetRotationX = 0;
var targetRotationOnMouseDownX = 0;

var targetRotationY = 0;
var targetRotationOnMouseDownY = 0;

var mouseX = 0;
var mouseXOnMouseDown = 0;

var mouseY = 0;
var mouseYOnMouseDown = 0;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

var finalRotationY;

function onDocumentMouseDown(event) {
  event.preventDefault();

  document.addEventListener("mousemove", onDocumentMouseMove, false);
  document.addEventListener("mouseup", onDocumentMouseUp, false);
  document.addEventListener("mouseout", onDocumentMouseOut, false);

  mouseXOnMouseDown = event.clientX - windowHalfX;
  targetRotationOnMouseDownX = targetRotationX;

  mouseYOnMouseDown = event.clientY - windowHalfY;
  targetRotationOnMouseDownY = targetRotationY;
}

function onDocumentMouseMove(event) {
  mouseX = event.clientX - windowHalfX;
  mouseY = event.clientY - windowHalfY;

  targetRotationY =
    targetRotationOnMouseDownY + (mouseY - mouseYOnMouseDown) * 0.02;
  targetRotationX =
    targetRotationOnMouseDownX + (mouseX - mouseXOnMouseDown) * 0.02;
}

function onDocumentMouseUp(event) {
  document.removeEventListener("mousemove", onDocumentMouseMove, false);
  document.removeEventListener("mouseup", onDocumentMouseUp, false);
  document.removeEventListener("mouseout", onDocumentMouseOut, false);
}

function onDocumentMouseOut(event) {
  document.removeEventListener("mousemove", onDocumentMouseMove, false);
  document.removeEventListener("mouseup", onDocumentMouseUp, false);
  document.removeEventListener("mouseout", onDocumentMouseOut, false);
}

function onDocumentTouchStart(event) {
  if (event.touches.length == 1) {
    event.preventDefault();

    mouseXOnMouseDown = event.touches[0].pageX - windowHalfX;
    targetRotationOnMouseDownX = targetRotationX;

    mouseYOnMouseDown = event.touches[0].pageY - windowHalfY;
    targetRotationOnMouseDownY = targetRotationY;
  }
}

function onDocumentTouchMove(event) {
  if (event.touches.length == 1) {
    event.preventDefault();

    mouseX = event.touches[0].pageX - windowHalfX;
    targetRotationX =
      targetRotationOnMouseDownX + (mouseX - mouseXOnMouseDown) * 0.05;

    mouseY = event.touches[0].pageY - windowHalfY;
    targetRotationY =
      targetRotationOnMouseDownY + (mouseY - mouseYOnMouseDown) * 0.05;
  }
}

// !Testing

let isInDiv = false;

const animate = () => {
  requestAnimationFrame(animate);
  // shoe.rotation.z += 0.01;
  // !Testing
  container.addEventListener("mouseenter", () => (isInDiv = true));
  container.addEventListener("mouseout", () => (isInDiv = false));
  //horizontal rotation
  if (isInDiv) {
    shoe.rotation.y += (targetRotationX - shoe.rotation.y) * 0.1;

    //vertical rotation
    finalRotationY = targetRotationY - shoe.rotation.x;
    //     shoe.rotation.x += finalRotationY * 0.05;

    //     finalRotationY = (targetRotationY - shoe.rotation.x);
    if (shoe.rotation.x <= 3 && shoe.rotation.x >= -3) {
      shoe.rotation.x += finalRotationY * 0.5;
    }
    if (shoe.rotation.x > 3) {
      shoe.rotation.x = 3;
    }

    if (shoe.rotation.x < -3) {
      shoe.rotation.x = -3;
    }
  } else {
    // -1.22 0.42 2
    // !Testing
    shoe.rotation.x = -1.22;
    shoe.rotation.y = -0.42;
    shoe.rotation.z = 2;
  }
  renderer.render(scene, camera);
};

init();

// container.addEventListener("mousemove", (e) => {
//   // console.log((2 * e.pageX) / container.clientWidth);
//   shoe.rotation.z = (3 * e.pageX) / container.clientWidth;
//   // shoe.rotation.y = (-0.6 * e.pageY) / container.clientHeight;
// });

const onWindowResize = () => {
  camera.aspect = container.clientWidth / container.clientHeight;
  camera.updateProjectionMatrix();

  renderer.setSize(container.clientWidth, container.clientHeight);
};

window.addEventListener("resize", onWindowResize);

const toggleDarkMode = () => {
  body.classList.toggle("dark");
  darkButton.innerHTML = body.classList.contains("dark") ? "Light" : "Dark";
};
