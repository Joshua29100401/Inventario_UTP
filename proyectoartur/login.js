const usuario_encargado = {
    'encargadoD2@encar.com': 'encarD2',
    'encargadoD1@encar.com': 'encarD1'
  };

  const usuario_administrador = {'administrador@admin.com': 'admin123'}

  const Acceder = document.getElementById('btnAcceder');
  Acceder.addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe de manera predeterminada

    const usuario = document.getElementById('floatingInput').value;
    const contrasena = document.getElementById('floatingPassword').value;

    PermitirAcceso(usuario, contrasena);
  });


  function PermitirAcceso(usuario,contrasena)
  {
    if(usuario_encargado[usuario]&&usuario_encargado[usuario]==contrasena)
        {
            window.location.href = 'tablas.html';
        }
    else if (usuario_administrador[usuario]&&usuario_administrador[usuario]==contrasena)
        {
            window.location.href = 'tablas.html';
        }
    else {
        alert("Usuario o contrasenia incorrecto")
    }
  }