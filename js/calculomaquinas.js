if (document.addEventListener){
	window.addEventListener("load", calculomaquinas);
}
else if (document.attachEvent){
	window.attachEvent("onload", calculomaquinas);
}

function onlyUnique(value, index, self) { // Función para el filtro, devuelve valores sin repetidos
    return self.indexOf(value) === index;
}

function calculomaquinas() {
    let tabla=document.querySelector("#table");
    let filas=tabla.getElementsByTagName("tr");
	console.log(document.getElementById('base'));
    let base=document.getElementById('base').innerHTML;
    // Seleccionamos todos los nombres de máquinas en la tabla
    let selects=tabla.querySelectorAll(".maquina");
    let nombremaquinas=[];
    for(let i=0; i<selects.length; i++){
        nombremaquinas.push(selects[i].innerHTML);
    }
    let maquinas = nombremaquinas.filter(onlyUnique);

    let contenedor=document.getElementById("listamaquinas");
    for(let i=0; i<maquinas.length; i++){
        let sumatiempos=0;
        for(let j=1; j<filas.length; j++){
            let select=selects[j-1].innerHTML;
            if(maquinas[i]===select){
                let valor=parseInt(filas[j].querySelector(".tc").innerHTML, 10);
                sumatiempos+=valor;
            }
        }
        let nmaquinas=Math.round(sumatiempos/base);
        // Muestra la cantidad de máquinas en el div listamaquinas
        let linea=document.createElement("p");
        let textNode = document.createTextNode(maquinas[i]+": "+nmaquinas);
        linea.appendChild(textNode);
        contenedor.appendChild(linea);
    }
}