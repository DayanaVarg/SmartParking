function comprobarCodigo() {
	var cod = document.getElementById("cod").value;
	var mensajeError = document.getElementById("mensajeError");

	if (cod !== "15D49") {
		mensajeError.innerHTML =  "El codigo de acceso es incorrecto.";
		return false;
	} else {
		mensajeError.innerHTML = "";
		return true;
	}
}