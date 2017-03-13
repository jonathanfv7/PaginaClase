function comprobar_rellenos() {
    var campos= document.getElementsByTagName("input");
    for(var i=0;i<=7;i++){
        if(campos[i].value.length==0){
            document.getElementById("btn_registro").disabled=true;
            return;
        }
    }
    document.getElementById("btn_registro").disabled=null;
}
function validar(){
    return validaDNI() && validaPass();
}

function validaDNI(){
    var dni = document.getElementsByName("dni")[0].value;
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    if(letras[(dni.substring(0,8)%23)]==dni.substring(8,9)){
        ajaxExisteDNI();
        return true;
    }else{
        alert("DNI NO VALIDO");
        document.getElementsByName("dni")[0].value="";
        return false;
    }


}

function validaPass(){
    var pass1=document.getElementsByName("pass")[0].value;
    var pass2=document.getElementsByName("passr")[0].value;
    if(pass1!==pass2){
      alert("Las contraseñas no coinciden");
      document.getElementsByName("pass")[0].value="";
      document.getElementsByName("passr")[0].value="";
      return false;
    }else{
        return true;
    }
}

function ajaxExisteDNI(){

        peticion_http = new XMLHttpRequest();
        if (peticion_http) {
            peticion_http.onload = procesaRespuesta;
            peticion_http.open("POST", "Respuestas/ExisteDNI.php", true);
            var parametros = "dni="+document.getElementsByName("dni")[0].value;
            peticion_http.setRequestHeader("Content-Type",
                "application/x-www-form-urlencoded");
            peticion_http.send(parametros);
        }

}
function procesaRespuesta() {

    var respuesta = peticion_http.responseText;

    var objeto_json = JSON.parse(peticion_http.responseText);

    var ExisteDNI = objeto_json.ExisteDNI;
    if(ExisteDNI){
        alert("El DNI introducido ya esta registrado");
        document.getElementsByName("dni")[0].value="";
    }

}