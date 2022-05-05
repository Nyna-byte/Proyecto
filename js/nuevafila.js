if (document.addEventListener){
	window.addEventListener("load", comienzo)
}
else if (document.attachEvent){
	window.attachEvent("onload", comienzo);
}

function comienzo(){
    let boton=document.getElementById("nueva");
    if (document.addEventListener) {
		boton.addEventListener("click", nuevafila);
	} else if (document.attachEvent) {
		boton.attachEvent("onclick", nuevafila);
	}
}

function nuevafila(){
    let filas=document.getElementsByTagName("tr");
    let nuevafila;
}