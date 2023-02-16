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
                location.reload();
            }, 3000);
    
            return true;
        }

}