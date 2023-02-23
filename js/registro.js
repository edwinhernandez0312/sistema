function validar_datos() {
    let nombre = document.getElementById("nombre");
    let apellido = document.getElementById("apellidos");
    let correo = document.getElementById("correo");
    let pass1 = document.getElementById("pass1");
    let pass2 = document.getElementById("pass2");
    if (nombre.value.trim() < 1 || apellido.value.trim() < 1 || correo.value.trim() < 1 || pass1.value.trim() < 1 || pass2.value.trim() < 1) {
        document.getElementById("inco").classList.add("mostrar");
        document.getElementById("enviar").disabled = true;
        setTimeout(function () {
            document.getElementById("enviar").disabled = false;
        }, 3000);
    } else {
        document.getElementById("inco").classList.remove("mostrar");
    }
}

function validar_campos() {
    let email=document.getElementById("email");
    let pass=document.getElementById("pass");
    if(email.value.trim()<1 || pass.value.trim()<1){
        document.getElementById("inco").classList.add("mostrar");
        document.getElementById("enviar").disabled = true;
        setTimeout(function () {
            document.getElementById("enviar").disabled = false;
        }, 3000);
    }else{
        document.getElementById("inco").classList.remove("mostrar");
    }
}
function validar_campo() {
    let email=document.getElementById("email");
    if(email.value.trim()<1){
        document.getElementById("inco").classList.add("mostrar");
        document.getElementById("enviar").disabled = true;
        setTimeout(function () {
            document.getElementById("enviar").disabled = false;
        }, 3000);
    }else{
        document.getElementById("inco").classList.remove("mostrar");
    }
}
function validar_pass() {
    let pass1=document.getElementById("pass1");
    let pass2=document.getElementById("pass2");
    if(pass1.value.trim()<1 || pass2.value.trim()<1){
        document.getElementById("inco").classList.add("mostrar");
        document.getElementById("enviar").disabled = true;
        setTimeout(function () {
            document.getElementById("enviar").disabled = false;
        }, 3000);
    }else{
        document.getElementById("inco").classList.remove("mostrar");
    }
    
}