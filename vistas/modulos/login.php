<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="vistas/css/estilos.css">
    <title>Iniciar Sesion</title>
</head>
<body>
    <div class="contenedor">
           
        <div class="user"><img class="iconu" src="vistas/img/plantilla/user.png" alt="Usuario" ></div>
           <h1 class="titulo">Iniciar Sesion</h1>

           <form method="post"class="formulario">
                <div class="form-group">
                       <img  class="icono" src="vistas/img/plantilla/icon1.png" alt=""> <input type="text" placeholder="Usuario" name="ingUsuario" required>
                    </div>


               <div class="form-group">
                    <img class="icono" src="vistas/img/plantilla/icon2.png" alt=""><input type="password" placeholder="Contraseña" name="ingPassword" required>
               </div>
                 <div class="ingresar">
                     <input type="submit" value="Ingresar" >
                 </div>

                 <?php

                    $login= new ControladorUsuarios();
                    $login -> ctrIngresoUsuario();

                 ?>


           </form>

         



    </div>
    
</body>
</html>