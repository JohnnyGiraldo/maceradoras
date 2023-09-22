<script setup>
  
import { ref, onMounted } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    
});


const slideImg = ref(null);
const images = [
  "/img/img1.png",
  "/img/img2.png",
  "/img/img3.png"
];
let currentIndex = 0;

const slider = () => {
  if (currentIndex > images.length - 1) {
    currentIndex = 0;
  }
  slideImg.value.src = images[currentIndex];
  currentIndex++;
};

onMounted(() => {
  slideImg.value = document.getElementById("slideImg");
  setInterval(slider, 3000);
});

const canLogin = true; 
const canRegister = true; 

</script>

<template>
    <div>
      <div class="banner">
        <div class="slider">
          <img src="/img/img3.png" id="slideImg" alt="Imagen del slider" />
        </div>
        <div class="overlay">
          <div class="navbar">
            <div class="logo">
              <img :src="'/img/vernacare.png'" alt="Imagen del slider"/>
            </div>
          </div>
          <div class="content">
           <img src="/img/logo.png" alt="logo-alkamedica"/>
          </div>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
            <div class="buttons-container">
              <a v-if="canLogin" href="/login" class="btn-1"><h1>INICIAR SESIÓN</h1></a>
              <a v-if="canRegister" href="/register" class="btn-2"><h3>REGISTRARSE</h3></a>
            </div>
        </div>
      </div>
    </div>
  </template>
  <style>
*{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}
.banner{
    width: 100%;
    height: 100vh;
    position: relative;
    overflow: hidden;
}
.slider{
    width: 100%;
    height: 100vh;
    position: absolute;
    top: 0;
}
#slideImg{
    width: 100%;
    height: 100%;
    animation: zoom 3s linear infinite;
    
}
@keyframes zoom{
    0%{
        transform: scale(1.3);
    }
    15%{
        transform: scale(1);
    }
    85%{
        transform: scale(1);
    }
    100%{
        transform: scale(1.3);
    }
}
.btn-1 {
    background-color: #0E9D83;
}
.btn-1:hover{
    border: 2px solid #fff;
    background: #39748B;
}
.btn-2 {
    background-color: #39748B;
}
.btn-2:hover{
    border: 2px solid #fff;
    background: #0E9D83;
}
.overlay{
    width: 100%;
    height: 100vh;
    background: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7));
    position: absolute;
}
.navbar{
    width: 85%;
    display: flex;
    align-items: center;
    margin: 35px auto;
}
.logo{
    flex-basis: 15%;
}
.logo img{
    width: 320px;
    cursor: pointer;
}
.content{
    width: 60%;
    margin: 160px auto 0;
    color: #fff;
}
.content h1{
    font-size: 60px;
    text-align: center;
}
.content h3{
    width: 80%;
    margin: 20px auto 100px;
    font-weight: 100;
    line-height: 25px;
    text-align: center;
}
a{
    width: 200px;
    padding: 15px 0;
    text-align: center;
    margin: 0 10px;
    border-radius: 25px;
    font-weight: bold;
    border: 2px solid white;
    background: #430cf8;
    color: #fff;
    cursor: pointer;
    transition: background 0.5s;
    align-items: center;
}
a:hover { /* Corrección aquí */
    background: transparent;
    border: 2px solid #fff;
}
.a-2{
    border: 2px solid #fff;
    background: transparent;
}
.content {
    /* Otros estilos para el contenedor de contenido */
    text-align: center; /* Centra el contenido horizontalmente */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 10vh; /* Ajusta la altura mínima, puedes ajustar según sea necesario */
}

.content h1,
.content h3 {
    margin: 0; /* Elimina los márgenes predeterminados */
    padding: 0; /* También puedes eliminar el relleno predeterminado si lo hubiera */
}
.buttons-container {
    position: absolute;
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    flex-direction: row;
    align-items: center;
    text-align: center;
}
@media (max-width: 768px) { /* Cambia 768px al ancho máximo deseado para dispositivos móviles */
  .buttons-container {
    flex-direction: column; /* Cambia a disposición de columna en dispositivos móviles */
    align-items: center;
    text-align: center;
  }

  .buttons-container a {
    width: 100%; /* Establece el ancho al 100% para llenar el contenedor */
    max-width: 200px; /* Establece un ancho máximo */
    padding: 10px 0; /* Reducimos el espacio alrededor de los botones */
    margin: 10px 0; /* Añade un margen vertical */
  }

  .buttons-container a .mobile-button-text {
    font-size: 14px; /* Cambia el tamaño de fuente para dispositivos móviles */
  }
}

</style>
