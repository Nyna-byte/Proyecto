// Llevaba esto hecho hasta que me di quenta de que es mucho menos lioso y raro si lo hago en PHP
// Lo subo por si acaso de todos modos, no hace nada aún

if (document.addEventListener){
	window.addEventListener("load", calculartabla);
}
else if (document.attachEvent){
	window.attachEvent("onload", calculartabla);
}

function calculartabla(){
    let operarios=parseInt(document.getElementById('operarios').innerHTML);
    let base=document.getElementById('base').innerHTML;
    let filas=tabla.getElementsByTagName("tr");

    let tabla=document.querySelector("#table");
    let selects=tabla.querySelectorAll(".maquina");
    let tiempos=tabla.querySelectorAll(".tc");
    let nombreMaquinas=[];
    let tcs=[];
    for(let i=0; i<selects.length; i++){
        nombreMaquinas.push(selects[i].innerHTML);
        tcs.push(parseInt(tiempos[i].innerHTML));
    }

    let arrayOperarios=[];
    for(let i=0; i<operarios; i++){
        let fasesOperario=[];
        let tcOperario=0;
        do {
            let maquinaOperario=null;
            for(let j=0; j<tcs.length; j++){
                if(tcs[j]!==null){
                    if (maquinaOperario === null && tcOperario === 0){
                        tcOperario+=tcs[j];
                        maquinaOperario=nombreMaquinas[j];
                        fasesOperario.push(filas[j-1]);
                        tcs[j]=null; // Lo pongo a null porque si lo saco del array se pierde el número de fase
                    }
                    else if(tcOperario+tcs[j]<=base && maquinaOperario===nombreMaquinas[j]){
                        tcOperario+=tcs[j];
                        fasesOperario.push(filas[j-1]);
                        tcs[j]=null;
                    }
                    else if(tcOperario+tcs[j]>base && maquinaOperario===nombreMaquinas[j]){
                        let resto=tcs[j]-(base-tcOperario);
                        tcs[j]=resto;
                        filas[j-1].querySelector(".maquina").innerHTML=resto;
                        fasesOperario.push(filas[j-1]);
                    }
                }
            }
            // Así se da prioridad a que un empleado esté en una sola máquina
            // Si tras recorrer el array de fases no tiene suficiente TC entonces toma parte de la primera fase que haya
            if(maquinaOperario===null || tcOperario<base){
                for(let j=0; j<tcs.length; j++){
                    if(tcs[j]!==null){
                        fasesOperario.push(j);
                        let resto=tcs[j]-(base.tcOperario);
                        tcs[j]=resto;
                    }
                }
            }
        } while (tcOperario<base);
    }
}