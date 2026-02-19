// FUNCIÓN PARA MOSTRAR VÍDEOS
function verVideo(url) {
    document.getElementById('video-iframe').src = url;
    document.getElementById('contenedor-reproductor').classList.add('mostrar');
}

function cerrarVideo() {
    document.getElementById('contenedor-reproductor').classList.remove('mostrar');
    document.getElementById('video-iframe').src = '';
}

// FUNCIÓN PARA CAMBIAR DE VISTA (WOD / RESERVAS)
function mostrarReservas() {
    // 1. Escondemos el panel de las 3 tarjetas principales
    const panelPrincipal = document.getElementById('contenido-principal');
    const bienvenida = document.querySelector('.cabecera-bienvenida');
    
    panelPrincipal.style.display = 'none';
    bienvenida.style.display = 'none';

    // 2. Mostramos el contenedor de reservas
    const seccionReservas = document.getElementById('seccion-reservas-detallada');
    seccionReservas.style.display = 'block';

    // 3. Opcional: Si quieres que el enlace de arriba se vea "activo"
    document.querySelectorAll('.enlaces a').forEach(a => a.classList.remove('activo'));
    document.querySelector('a[onclick="mostrarReservas()"]').classList.add('activo');
    
    console.log("Cambiando a vista de Reservas...");
}

//FUNCIÓN RESERVAS

 function seleccionarDia(dia, elemento) {
    console.log("Has pulsado en: " + dia); // Esto es para ver que la consola me funciona

    // 1. Quitar la clase activo a todos los botones y ponérsela al que he pulsado
    const botones = document.querySelectorAll('.boton-dia');
    botones.forEach(btn => btn.classList.remove('activo'));
    
    if(elemento) {
        elemento.classList.add('activo');
    }

    // 2. Limpiar y generar horarios
    const contenedor = document.getElementById('contenedor-horarios');
    if (!contenedor) return; // Seguridad por si no encuentra el div

    contenedor.innerHTML = ""; 

    let esSabado = dia.toLowerCase().includes('bado');
    let limiteHora = esSabado ? 12 : 21;

    for (let i = 7; i <= limiteHora; i++) {
         if(esSabado && i < 9)continue;

        const hora = i + ":00";
        //miro si la hora es par/impar
        let claseNombre = (i % 2===0) ? "Crosstraining" : "Funcional";

        const div = document.createElement('div');
        div.className = 'hora-item'; 
       
        div.innerHTML = `
            <span>${hora}</span>
            <button class="boton-reservar-hora" onclick="reservar('${dia}', '${claseNombre}','${hora}')">Reservar</button>
            <div class="botones-tipo-clases">
                <button>${claseNombre}</button>
                <button>OPEN BOX</button>
            </div>
        `;
        contenedor.appendChild(div);
    }

    
}

function reservar(dia,claseNombre, hora) {
    alert("Has reservado " + claseNombre + " el: " + dia + " a las " + hora);
}

//FUNCIÓN COOKIES
document.addEventListener("DOMContentLoaded", function() {
    // Comprobar si ya existe la cookie en el navegador
    if (!document.cookie.split('; ').find(row => row.startsWith('aceptado='))) {
        document.getElementById('banner-cookies').style.display = 'block';
    }
});

function aceptarCookie() {
    // Crear la cookie: nombre, valor, duración (1 mes) y ruta
    const d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
    document.cookie = "aceptado=true; expires=" + d.toUTCString() + "; path=/";
    
    // Ocultar el banner
    document.getElementById('banner-cookies').style.display = 'none';
}

function rechazarCookie() {
   
    document.getElementById('banner-cookies').style.display = 'none';
}

