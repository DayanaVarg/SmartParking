<script>
//crea elemento
const video = document.createElement("video");

//nuestro camvas
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

//div donde llegara nuestro canvas
const btnScanQR = document.getElementById("btn-scan-qr");

//lectura desactivada
let scanning = false;

//funcion para encender la camara
const encenderCamara = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function (stream) {
      scanning = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

//funciones para levantar las funiones de encendido de la camara
function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}

//apagara la camara
const cerrarCamara = () => {
  video.srcObject.getTracks().forEach((track) => {
    track.stop();
  });
  canvasElement.hidden = true;
  btnScanQR.hidden = false;
};

const activarSonido = () => {
  var audio = document.getElementById('audioScaner');
  audio.play();
}

//callback cuando termina de leer el codigo QR
qrcode.callback = (respuesta) => {
  if (respuesta) {
    // Parsear la respuesta JSON
    var datosQR = JSON.parse(respuesta);
    var license = datosQR.Placa;
    
    // Construir el mensaje para mostrar en SweetAlert
    var mensaje = `
      <p class="p1">Fecha de Entrada: <span class="dato">${datosQR.FechaEntrada}</span></p>
      <p class="p1">Hora de Entrada: <span class="dato">${datosQR.HoraEntrada}</span></p>
      <p class="p1">Placa: <span class="dato">${datosQR.Placa}</span></p>
    `;

    if(datosQR.FechaEntrada && datosQR.HoraEntrada && datosQR.Placa !== null){
        Swal.fire({
        title: 'Vehiculo',
        html: mensaje,
        icon: 'info',
        iconColor: '#544A0D',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#d7bf21',
        }).then((result) => {
        if (result.isConfirmed) {
          var url = "<?= base_url('vehicle/registerF')?>?fecha=" + encodeURIComponent(datosQR.FechaEntrada) + "&hora=" + encodeURIComponent(datosQR.HoraEntrada) + "&placa=" + encodeURIComponent(datosQR.Placa);
          window.location.href = url;
        }
        }); 
    }else{
      Swal.fire({
        title: 'Error',
        text: 'El código es inválido',
        icon: 'error',
        dangerMode: true,
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#8E98A8',
      });
    }
    activarSonido();
    cerrarCamara();
  }
};
//evento para mostrar la camara sin el boton 
window.addEventListener('load', (e) => {
  encenderCamara();
})
</script>




