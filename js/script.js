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

// FUNCIÓN PARA CARGAR HORAS DE RESERVA
function cargarHoras(dia, elemento) {
    let botones = document.querySelectorAll('.boton-dia');
    botones.forEach(btn => btn.classList.remove('activo'));
    elemento.classList.add('activo');

    let contenedor = document.getElementById('lista-horas');
    contenedor.innerHTML = "";
    
    for (let h = 7; h <= 21; h++) {
        contenedor.innerHTML += `
            <div class="hora-item">
                <span>${h}:00h</span>
                <button class="boton-reservar-hora" onclick="confirmarReserva('${dia}', ${h})">RESERVAR</button>
            </div>`;
    }
}

function confirmarReserva(dia, hora) {
    alert("¡Reserva confirmada para el " + dia + " a las " + hora + ":00!");
}

// FUNCIÓN PARA DESPLEGAR EL WOD
function toggleWod(id) {
    let abiertos = document.querySelectorAll('.wod-desplegable');
    abiertos.forEach(elemento => {
        if (elemento.id !== id) {
            elemento.classList.remove('mostrar');
        }
    });
    document.getElementById(id).classList.toggle('mostrar');
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

    for (let i = 7; i <= 21; i++) {
        const hora = i + ":00";
        const div = document.createElement('div');
        div.className = 'hora-item'; 
        div.innerHTML = `
            <span>${hora}</span>
            <button class="boton-reservar-hora" onclick="reservar('${dia}', '${hora}')">Reservar</button>
        `;
        contenedor.appendChild(div);
    }

    
}

function reservar(dia, hora) {
    alert("Has reservado el: " + dia + " a las " + hora);
}

