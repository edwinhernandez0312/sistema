function validar_datos() {
    let nombre=document.getElementById("nombre");
    let apellido=document.getElementById("apellidos");
    let correo=document.getElementById("correo");
    let pass1=document.getElementById("pass1");
    let pass2=document.getElementById("pass2");
    if(nombre.value<1 || apellido.value<1 || correo.value<1 || pass1.value<1 || pass2.value<1){
        document.getElementById("inco").classList.add("mostrar");
        document.getElementById("enviar").disabled = true;
        setTimeout(function () {
            document.getElementById("enviar").disabled = false;
        }, 3000);
    }else{
        document.getElementById("inco").classList.remove("mostrar");

    }
}
function verificarPasswords() {

    // Ontenemos los valores de los campos de contraseñas 
    pass1 = document.getElementById('pass1');
    pass2 = document.getElementById('pass2');

    // Verificamos si las constraseñas no coinciden 
        
        if (pass1.value != pass2.value || pass1.value<4 || pass2.value<4) {
    
            // Si las constraseñas no coinciden mostramos un mensaje 
            document.getElementById("error").classList.add("mostrar");
    
            return false;
        } else {
    
            // Si las contraseñas coinciden ocultamos el mensaje de error
            document.getElementById("error").classList.remove("mostrar");
    
            // Mostramos un mensaje mencionando que las Contraseñas coinciden 
            document.getElementById("ok").classList.remove("ocultar");
    
            // Desabilitamos el botón de login 
            document.getElementById("enviar").disabled = true;
    
            // Refrescamos la página (Simulación de envío del formulario) 
            setTimeout(function () {
                document.getElementById("enviar").disabled = false;
                location.reload();
            }, 3000);
    
            return true;
        }

}
