function registrarVecino(){
    nombreVecino = document.getElementById('nombreVecino').value;
    apellidoVecino = document.getElementById('apellidoVecino').value;
    cuitVecino = document.getElementById('cuitVecino').value;
    domicilioVecino = document.getElementById('domicilioVecino').value;
    localidadVecino = document.getElementById('localidadVecino').value;
    emailVecino = document.getElementById('emailVecino').value;
    contrasenia = document.getElementById('contrasenia').value;
    contraseniaControl = document.getElementById('contraseniaControl').value;

    if(nombreVecino != '' && apellidoVecino != '' && cuitVecino != '' && domicilioVecino != '' && localidadVecino != '' && 
        emailVecino != '' && contrasenia != '' && contraseniaControl != ''){
        document.getElementById('alertaDatosIncompletos').display = 'none';

        

    }else{
        document.getElementById('alertaDatosIncompletos').display = 'block';
    }
}