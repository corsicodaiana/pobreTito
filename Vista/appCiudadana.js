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

        if(contrasenia == contraseniaControl){
            document.getElementById('alertaContrasenia').display = 'none';
            var data = {
                "nombreVecino" : nombreVecino + ' ' + apellidoVecino,
                "cuitVecino" : cuitVecino,
                "domicilioVecino" : domicilioVecino,
                "localidadVecino" : localidadVecino,
                "emailVecino" : emailVecino,
                "contrasenia" : contrasenia
            };
            axios.post(rutaApi, {
                funcion: 'guardarVecino',
                data: data
            })
            .then(function(response){
                var data = response.data;
                if (data.error) {
                    Swal.fire(data.mensaje, '', 'warning');
                } else {
                    Swal.fire("Vecino registrado correctamente", '', 'success').then(function(){
                        window.location.href = "/pobretito/vista/index.html";
                    }).catch(function(error){
                        console.log(error);
                    });
                }
            })
            .catch(function(error){
                console.log(error);
            });
        }else{
            document.getElementById('alertaContrasenia').display = 'block';
        }  

    }else{
        document.getElementById('alertaDatosIncompletos').display = 'block';
    }
}

function iniciarSesion(){
    cuit = document.getElementById('cuitLogin').value;
    contrasenia = document.getElementById('contraseniaLogin').value;

    if(cuit != '' && contrasenia !=''){
        document.getElementById('alertaDatosIncompletos').display = 'none';
        document.getElementById('alertaContrasenia').display = 'none';
            var data = {
                "cuitVecino" : cuit,
                "contrasenia" : contrasenia
            };
            axios.post(rutaApi, {
                funcion: 'iniciarSesion',
                data: data
            })
            .then(function(response){
                var data = response.data;
                if (data.error) {
                    document.getElementById('alertaContrasenia').display = 'block';
                } else {
                    window.location.href = "/pobretito/vista/home.html";
                    cargarDatosRequerimiento(cuit);
                }
            })
            .catch(function(error){
                console.log(error);
            });

    }else{
        document.getElementById('alertaDatosIncompletos').display = 'block';
    }

}

function cargarDatosRequerimiento(cuit){
    //Cargar datos vecino
    document.getElementById('cuitVecino').value = cuit;
    var data = {
        "cuitVecino" : cuit,
    };
    axios.post(rutaApi, {
        funcion: 'cargarVecino',
        data: data
    })
    .then(function(response){
        var data = response.data;
        if (data.error) {
            alert('No se pueden cargar los datos del vecino, intente mas tarde');
        } else {
            nombreVecino = data.vecino.nombre;
            document.getElementById('datosVecino').innerHTML = '<p>'+cuit+' - '+nombreVecino+'</p>'
        }
    })
    .catch(function(error){
        console.log(error);
    });
    //Cargar datos motivo
}

function guardarRequerimiento(){
    cuitVecino = document.getElementById('cuitVecino').value;
    motivo = document.getElementById('selectMotivo').value;
    detalle = document.getElementById('selectDetalle').value;
    foto = document.getElementById('file-input').value;
    observacion = document.getElementById('textarea-input').value;

    if(motivo != '' && detalle != '' && cuitVecino != '' && foto != '' && observacion != ''){
        document.getElementById('alertaDatosIncompletos').display = 'none';
        var data = {
            "cuitVecino" : cuitVecino,
            "motivo" : motivo,
            "detalle" : detalle,
            "foto" : foto,
            "observacion" : observacion
        };
        axios.post(rutaApi, {
            funcion: 'guardarRequerimiento',
            data: data
        })
        .then(function(response){
            var data = response.data;
            if (data.error) {
                Swal.fire(data.mensaje, '', 'warning');
            } else {
                Swal.fire("Requerimiento registrado correctamente", '', 'success').then(function(){
                    window.location.href = "/pobretito/vista/home.html";
                    cargarDatosRequerimiento(cuitVecino);
                }).catch(function(error){
                    console.log(error);
                });
            }
        })
        .catch(function(error){
            console.log(error);
        }); 
    }else{
        document.getElementById('alertaDatosIncompletos').display = 'block';
    }
}