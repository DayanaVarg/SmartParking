<script>
const video = document.createElement("video");
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");
const btnScanQR = document.getElementById("btn-scan-qr");
let scanning = false;

//barcode 
let scanningBarcode = false;
const videoBarcode = document.createElement("video");
const canvasElementBarcode = document.getElementById("camera");
const canvasBarcode = canvasElementBarcode.getContext("2d");

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
    Quagga.stop();
  });
  canvasElement.hidden = true;
  canvasElementBarcode.hidden = true;
  btnScanQR.hidden = false;
  
            scanningBarcode = false;
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

//funciones barcode

const encenderCamaraB = () => {
    navigator.mediaDevices
        .getUserMedia({ video: { facingMode: "environment" } })
        .then(function (stream) {
            scanningBarcode = true;
            btnScanQR.hidden = true;
            canvasElementBarcode.hidden = false;
            videoBarcode.setAttribute("playsinline", true);
            videoBarcode.srcObject = stream;
            videoBarcode.play();
            tickBarcode();
            escanearBarcode();
        });
}

function tickBarcode() {
    canvasElementBarcode.height = videoBarcode.videoHeight;
    canvasElementBarcode.width = videoBarcode.videoWidth;
    canvasBarcode.drawImage(videoBarcode, 0, 0, canvasElementBarcode.width, canvasElementBarcode.height);
    scanningBarcode && requestAnimationFrame(tickBarcode);
}


const escanearBarcode = () => {
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#camera')
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader", "upc_reader"]
        }
    }, function (err) {
        if (err) {
            console.log(err);
            return;
        }
        Quagga.start();
    });

    Quagga.onDetected(function (data) {
        if (scanningBarcode) {
          Quagga.stop();
          scanningBarcode = false;
          if(data.codeResult && data.codeResult.code && data.codeResult.code.startsWith('*')) {
            var code = data.codeResult.code.substring(1);
            var mensaje = `
            <p class="p1">Placa: <span class="dato">${code}</span></p>`
            Swal.fire({
            title: 'Vehiculo',
            html: mensaje,
            icon: 'info',
            iconColor: '#544A0D',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#d7bf21',
            }).then((result) => {
            if (result.isConfirmed) {
              var url = "<?= base_url('vehicle/registerFE')?>?placa=" + encodeURIComponent(code);
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
          Quagga.stop();
          activarSonido();
        cerrarCamara();     
        } 
    });
};

</script>




