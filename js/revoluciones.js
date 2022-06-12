var conexion;
if (document.addEventListener){
	window.addEventListener("load", comienzo);
}
else if (document.attachEvent){
	window.attachEvent("onload", comienzo);
}

function comienzo(){
    let seleccion=document.getElementById("maquina")
    if (document.addEventListener) {
		seleccion.addEventListener("change", revolucion);
	} else if (document.attachEvent) {
		seleccion.attachEvent("onchange", revolucion);
	}
}

function revolucion(){
	let valorTemp=document.getElementById("temporadas").value;
	let cadenaxml="<datos><resultado><equipo>"+valorEq+"</equipo><temporada>"+valorTemp+"</temporada></resultado></datos>";
	if (window.XMLHttpRequest)
		conexion= new XMLHttpRequest()
	else if (window.ActiveXObject)
		conexion=new ActiveXObject("Microsoft.XMLHTTP");
	if (document.addEventListener)
		conexion.addEventListener("readystatechange",addrpm)
	else if (document.attachEvent)
		conexion.attachEvent("onreadystatechange",addrpm);
	conexion.open("POST","php/resultados.php");
	conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	conexion.send(cadenaxml);
	
}

function addrpm() {
	if (conexion.readyState==4) {
		if (conexion.status==200) {
			let misdatos=conexion.responseXML;
			let valorPuesto=misdatos.getElementsByTagName("puesto").item(0).textContent;
			document.getElementById("contra").value=valorContra;
		}
	}
}