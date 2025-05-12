// Crear las variables para los SignaturePad de cada canvas
let signaturePadCliente;
let signaturePadAirtek;
let canvasCliente;
let canvasAirtek;

// Inicializar los pads de firma cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtener los elementos canvas
    canvasCliente = document.getElementById("firmaCliente");
    canvasAirtek = document.getElementById("firmaAirtek");
    
    // Inicializar los SignaturePad
    if (canvasCliente) {
        signaturePadCliente = new SignaturePad(canvasCliente);
    }
    
    if (canvasAirtek) {
        signaturePadAirtek = new SignaturePad(canvasAirtek);
    }
    
    // Ajustar el tamaño de los canvas cuando se redimensiona la ventana
    window.addEventListener("resize", function() {
        if (signaturePadCliente && canvasCliente) {
            resizeCanvas(signaturePadCliente, canvasCliente);
        }
        if (signaturePadAirtek && canvasAirtek) {
            resizeCanvas(signaturePadAirtek, canvasAirtek);
        }
    });
    
    // Inicializar los canvas para que se ajusten al tamaño correcto desde el principio
    if (signaturePadCliente && canvasCliente) {
        resizeCanvas(signaturePadCliente, canvasCliente);
    }
    if (signaturePadAirtek && canvasAirtek) {
        resizeCanvas(signaturePadAirtek, canvasAirtek);
    }
    
    // Configurar el evento de envío del formulario
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", handleFormSubmit);
    }
});

// Función para ajustar el tamaño de cada canvas y asegurar que las firmas se dibujen bien
function resizeCanvas(signaturePad, canvas) {
    const ratio = Math.max(window.devicePixelRatio || 1, 1);
    
    const width = canvas.offsetWidth;
    const height = canvas.offsetHeight;

    canvas.width = width * ratio;
    canvas.height = height * ratio;

    canvas.style.width = width + "px";
    canvas.style.height = height + "px";

    canvas.getContext("2d").scale(ratio, ratio);

    signaturePad.clear(); // Limpiar la firma si cambia el tamaño
}

// Función para borrar la firma
function borrarFirma(canvasId) {
    if (canvasId === 'firmaCliente' && signaturePadCliente) {
        signaturePadCliente.clear();
    } else if (canvasId === 'firmaAirtek' && signaturePadAirtek) {
        signaturePadAirtek.clear();
    }
}

// Función para manejar el envío del formulario
function handleFormSubmit(e) {
    if (signaturePadCliente && !signaturePadCliente.isEmpty()) {
        const firmaClienteBase64 = signaturePadCliente.toDataURL();
        document.getElementById("firma_base64_cliente").value = firmaClienteBase64;
    } else {
        alert("Por favor firma el campo de la empresa origen antes de enviar.");
        e.preventDefault();
        return;
    }

    if (signaturePadAirtek && !signaturePadAirtek.isEmpty()) {
        const firmaAirtekBase64 = signaturePadAirtek.toDataURL();
        document.getElementById("firma_base64_airtek").value = firmaAirtekBase64;
    } else {
        alert("Por favor firma el campo de Air Tek antes de enviar.");
        e.preventDefault();
        return;
    }
} 