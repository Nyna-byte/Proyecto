if (document.addEventListener){
	window.addEventListener("load", filaañadida);
	window.addEventListener("load", comienzo);
}
else if (document.attachEvent){
	window.attachEvent("onload", filaañadida);
	window.attachEvent("onload", comienzo);
}

function filaañadida(){ // Recarga la función comienzo cada vez que se añade una fila para añadirle el event listener
	let selects=document.getElementsByName("maquina");
	for(let i=0; i<selects.length; i++){
		if (document.removeEventListener) {
			selects[i].removeEventListener("change", puntada);
		} else if (document.detachEvent) {
			selects[i].detachEvent("onchange", puntada);
		}
	}
    let boton=document.getElementById("nueva");
    if (document.addEventListener) {
		boton.addEventListener("click", comienzo);
	} else if (document.attachEvent) {
		boton.attachEvent("onclick", comienzo);
	}
}

function comienzo(){
    let selects=document.getElementsByName("maquina");
	for(let i=0; i<selects.length; i++){
		if (document.addEventListener) {
			selects[i].addEventListener("change", puntada);
		}
		else if (document.attachEvent) {
			selects[i].attachEvent("onchange", puntada);
		}
	}
}

function puntada(){
	let selects=document.getElementsByName("maquina");
	let filas=document.querySelectorAll("tr"); // IMPORTANTE: EL THEAD TAMBIÉN ES UN TR
	for(let i=0; i<selects.length; i++){
		let puntada=filas[i+1].querySelector("#punt");
		if(selects[i].value==="Plana"){
			puntada.value="301";
		}
		else if(selects[i].value==="OW"){
			puntada.value="504";
		}
		else if(selects[i].value==="OWPS"){
			puntada.value="515";
		}
		else if(selects[i].value==="Cadeneta"){
			puntada.value="101";
		}
		else if(selects[i].value==="Zig-zag"){
			puntada.value="304";
		}
		else if(selects[i].value==="Bajos"){
			puntada.value="103";
		}
		else{
			puntada.value="";
		}

		// Para borrar y deshabilitar las revoluciones si se selecciona "mano"
		let rev=filas[i+1].querySelector("#revoluciones")
		if(selects[i].value==="Mano"){
			rev.disabled=true;
			rev.value="";
		}
		else if(rev.disabled){
			rev.disabled=false;
		}
	}
}