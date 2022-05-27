if (document.addEventListener){
	window.addEventListener("load", comienzo);
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
    let table=document.getElementById("table");
    
	var row = table.insertRow(-1);
  	var cell1 = row.insertCell(0);
  	var cell2 = row.insertCell(1);
  	var cell3 = row.insertCell(2);
	var cell4 = row.insertCell(3);
	var cell5 = row.insertCell(4);
	var cell6 = row.insertCell(5);

	var desc=document.createElement("input");
	desc.setAttribute("type","text");
	desc.id="descripcion";
	desc.name="descripcion";
	desc.title="descripcion"; //Para añadir el alt al campo de la tabla
	cell1.appendChild(desc);

	var maq=document.createElement("select");
	maq.id="maquina";
	maq.name="maquina";
	maq.title="máquina";
	cell2.appendChild(maq);
	var option=document.createElement("option");
	option.value="plana";
	option.text="Plana";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="OW";
	option.text="O.W";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="OWPS";
	option.text="O.W + P.S";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Cadeneta";
	option.text="Cadeneta";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Zig-zag";
	option.text="Zig-zag";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Plancha";
	option.text="Plancha";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Prensa";
	option.text="Prensa";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Termofijadora";
	option.text="Termofijadora";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Ojales";
	option.text="Ojales";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Botones";
	option.text="Botones";
	maq.appendChild(option);
	option=document.createElement("option");
	option.value="Mano";
	option.text="Mano";
	maq.appendChild(option);
	cell2.appendChild(maq);

	var punt=document.createElement("input");
	punt.setAttribute("type","text");
	punt.id="punt";
	punt.name="punt";
	punt.title="puntada";
	cell3.appendChild(punt);

	var rev=document.createElement("input");
	rev.setAttribute("type","text");
	rev.id="revoluciones";
	rev.name="revoluciones";
	rev.title="revoluciones";
	cell4.appendChild(rev);

	var acc=document.createElement("input");
	acc.setAttribute("type","text");
	acc.id="accesorio";
	acc.name="accesorio";
	acc.title="accesorio";
	cell5.appendChild(acc);

	var tc=document.createElement("input");
	tc.setAttribute("type","text");
	tc.setAttribute("required", "");
	tc.id="TC";
	tc.name="TC[]";
	tc.title="TC";
	cell6.appendChild(tc);
}
