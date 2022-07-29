import * as THREE from 'three';
import { OrbitControls } from 'OrbitControls';
import { GLTFLoader } from 'GLTFLoader';
import * as dat from "https://cdn.skypack.dev/dat.gui";
const gui = new dat.GUI()

const world = {
    plane: {
        width: 10,
        height: 10,
        widthSegments: 10,
        heightSegments: 10
    }
}
gui.add(world.plane, 'width', 1, 20).onChange(generatePlane)
gui.add(world.plane, 'height', 1, 20).onChange(generatePlane)
gui.add(world.plane, 'widthSegments', 1, 50).onChange(generatePlane)
gui.add(world.plane, 'heightSegments', 1, 50).onChange(generatePlane)

function generatePlane() {
    planeMesh.geometry.dispose()
    planeMesh.geometry = new THREE.PlaneGeometry(world.plane.width, world.plane.height, world.plane.widthSegments, world.plane.heightSegments);

    const { array } = planeMesh.geometry.attributes.position
    for (let i = 0; i < array.length; i += 3) {
        const x = array[i];
        const y = array[i + 1];
        const z = array[i + 2]

        array[i + 2] = z + Math.random();
    }
}

const raycaster = new THREE.Raycaster();
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, innerWidth / innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer()
renderer.setSize(innerWidth, innerHeight);
renderer.setPixelRatio(devicePixelRatio);
document.body.appendChild(renderer.domElement);

/*const boxGeometry = new THREE.BoxGeometry(1, 1, 1);
const meterial = new THREE.MeshPhongMaterial({color: 0x00ff00});
const test = new THREE.MeshBasicMaterial({ color: 0x999999, wireframe: true, transparent: true, opacity: 0.85 })
const mesh = new THREE.Mesh(boxGeometry, meterial)
scene.add(mesh);*/

new OrbitControls(camera, renderer.domElement);

camera.position.z = 5;

const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(0, 0, 1)
scene.add(light);

const backLight = new THREE.DirectionalLight(0xffffff, 1);
backLight.position.set(0, 0, -1)
scene.add(backLight);


const planeGeometry = new THREE.PlaneGeometry(5, 5, 10, 10);
const planeMeterial = new THREE.MeshPhongMaterial({ 
    side: THREE.DoubleSide,
    flatShading: THREE.FlatShading
});
const planeMesh = new THREE.Mesh(planeGeometry, planeMeterial)

const { array } = planeMesh.geometry.attributes.position
for (let i = 0; i < array.length; i+=3) {
    const x = array[i];
    const y = array[i + 1];
    const z = array[i + 2]
    
    array[i + 2] = z + Math.random();
}

scene.add(planeMesh)

const mouse = {
    x: undefined,
    y: undefined
}

function animate() {
    requestAnimationFrame(animate)
    renderer.render(scene, camera)
    /*mesh.rotation.x += .01
    mesh.rotation.y += .01*/
    //planeMesh.rotation.x += .01;
    raycaster.setFromCamera(mouse, camera)
    const intersects = raycaster.intersectObject(planeMesh)
}

animate();

addEventListener('mousemove', (event) => {
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1 
    //console.log(mouse)
})