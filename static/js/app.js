let container, camera, renderer, scene, shoe, light, controls;

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

  const ambient = new THREE.AmbientLight(0x404040, 1);
  scene.add(ambient);

  light = new THREE.DirectionalLight(0xffffff, 2);
  light.position.set(-30, 30, 30);
  light.castShadow = true;
  scene.add(light);

  // Renderer
  renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
  renderer.setSize(container.clientWidth, container.clientHeight);
  renderer.setPixelRatio(window.devicePixelRatio);

  controls = new THREE.OrbitControls(camera, renderer.domElement);
  controls.enablePan = false;
  controls.enableZoom = false;
  controls.enableDamping = true;
  controls.dampingFactor = 0.07;
  controls.rotateSpeed = 0.7;

  container.appendChild(renderer.domElement);

  // Load Model
  let loader = new THREE.GLTFLoader();
  loader.load("./assets/3d/scene.gltf", (gltf) => {
    scene.add(gltf.scene);
    shoe = gltf.scene.children[0];
    shoe.rotation.x = -1.22;
    shoe.rotation.y = -0.42;
    shoe.rotation.z = 2;
    animate();
  });
};

let isInDiv = false;

const animate = () => {
  requestAnimationFrame(animate);
  controls.update();
  light.position.copy(camera.position);
  renderer.render(scene, camera);
};

if (
  window.location.pathname === "/Shoeify-S4/" ||
  window.location.pathname === "/Shoeify-S4/index.php"
)
  init();

const onWindowResize = () => {
  camera.aspect = container.clientWidth / container.clientHeight;
  camera.updateProjectionMatrix();

  renderer.setSize(container.clientWidth, container.clientHeight);
};

if (
  window.location.pathname === "/Shoeify-S4/" ||
  window.location.pathname === "/Shoeify-S4/index.php"
)
  window.addEventListener("resize", onWindowResize);
