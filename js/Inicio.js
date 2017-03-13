var peticion_http=null;
var peticion_http2=null;




function Origenes(){
    valida2();
}
function OrigenDestino(){
    valida();
}

function valida() {
    peticion_http = new XMLHttpRequest();
    if (peticion_http) {
        peticion_http.onload = procesaRespuesta;
        peticion_http.open("POST", "Respuestas/destinos.php", true);
        var parametros_xml = "datos="+crea_xml();
        console.log(parametros_xml);
        peticion_http.setRequestHeader("Content-Type",
            "application/x-www-form-urlencoded");
        peticion_http.send(parametros_xml);
    }
}
function crea_xml() {
    var origen = document.getElementById("origen").value;
    var destino = document.getElementById("destino").value;
    var xml = "<?xml version='1.0' encoding='UTF-8'?> <parametros>";
    xml = xml + "<origen>" + origen + "</origen>";
    xml = xml + "<destino>" + destino + "</destino>";
    xml = xml + "</parametros>";
    return xml;
}
function valida2() {
    peticion_http2 = new XMLHttpRequest();
    if (peticion_http2) {
        peticion_http2.onload = procesaRespuesta2;
        peticion_http2.open("POST", "Respuestas/origenes.php", true);
        var parametros_json = "origen="+document.getElementById("origen").value;
        peticion_http2.setRequestHeader("Content-Type",
            "application/x-www-form-urlencoded");
        peticion_http2.send(parametros_json);
    }
}


function procesaRespuesta() {

    var documento_xml = peticion_http.responseXML;
    var destino = documento_xml.getElementsByTagName("destino");
    var eti_destino = document.getElementById("destinos");
    var campo_destino = document.getElementById("destino");
    var ul =  eti_destino.getElementsByTagName("ul")[0];

    ul.innerHTML="";
    for (var i = 0; i < destino.length; i++) {
        ul.innerHTML+="<li onclick='cambiarDestino(\""+destino[i].firstChild.nodeValue+"\")'>"+destino[i].firstChild.nodeValue+"</li>";
    }
    if(campo_destino.value.toUpperCase()==destino[0].firstChild.nodeValue.toUpperCase()){
        document.getElementById("buscar").disabled=null;
        ul.innerHTML="";
    }else{
        document.getElementById("buscar").disabled=true;
    }

}
function procesaRespuesta2() {

    var documento_xml = peticion_http2.responseXML;
    var origen = documento_xml.getElementsByTagName("origen");
    var eti_origen = document.getElementById("origenes");
    var campo_origen = document.getElementById("origen");
    var ul =  eti_origen.getElementsByTagName("ul")[0];

    ul.innerHTML="";
    for (var i = 0; i < origen.length; i++) {
        ul.innerHTML+="<li onclick='cambiarOrigen(\""+origen[i].firstChild.nodeValue+"\")'>"+origen[i].firstChild.nodeValue+"</li>";
    }
    if(campo_origen.value.toUpperCase()==origen[0].firstChild.nodeValue.toUpperCase()){
        document.getElementById("destino").disabled=null;
        ul.innerHTML="";
    }else{
        document.getElementById("destino").disabled=true;
    }



}
function cambiarOrigen($nombre){
    document.getElementById("origen").value=$nombre;
    document.getElementById("origen").focus();
}
function cambiarDestino($nombre){
    document.getElementById("destino").value=$nombre;
    document.getElementById("destino").focus();
}
