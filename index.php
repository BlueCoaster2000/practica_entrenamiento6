<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 6</title>
    <?php 
        function mostrarForm($nombreSaneado,$apellidoSaneado,$edadSaneado,$alturaSaneado){

            echo <<< END
                <form action="#" method="post">
                    <p>
                    Nombre: <input type="text" name="nombre" id="nombre" value="$nombreSaneado">
                    </p>
                    <p>
                    Apellidos: <input type="text" name="apellidos" id="apellidos" value="$apellidoSaneado">
                    </p>
                    <p>
                    Edad: <input type="text" name="edad" id="edad" value="$edadSaneado">
                    </p>
                    <p>
                    Altura: <input type="text" name="altura" id="altura" value="$alturaSaneado">
                    </p>
                    <p>
                    <input type="submit" value="Enviar">
                    </p>
                </form>
            END;
         }

         function comprobarNombre(string $nombreSaneado){
             
           if(ctype_alpha($nombreSaneado) === true){
            return $nombreSaneado;
            }else{
                return false;
            }
         }

                    ?>
</head>
<body>
    <?php
        $nombreMal = false;
        $apellidoMal = false;
        $edadMal = false;
        $alturaMal = false;
        if($_POST){
            $nombreSaneado = htmlentities(trim($_POST['nombre']));
            $edadSaneado = htmlentities(trim($_POST['edad']));
            $apellidoSaneado = htmlentities(trim($_POST['apellidos']));
            $alturaSaneado = htmlentities(trim($_POST['altura']));
            
            $datos = array(
                'nombre' => $nombreSaneado,
                'apellidos' => $apellidoSaneado,
                'edad' => $edadSaneado,
                'altura' => $alturaSaneado
            );
            $argumentos = array(
                'nombre' => array(
                    'filter' => FILTER_CALLBACK,
                    'options' => 'comprobarNombre'
                ),
                'apellidos' => array(
                    'filter' => FILTER_CALLBACK,
                    'options' => 'comprobarNombre'
                ),
                'edad' => array(
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => array('min_range' => 1, 'max_range' => 100)
                ),
                'altura' => array(
                    'filter' => FILTER_VALIDATE_FLOAT,
                    'options' => array('min_range' => 0.5, 'max_range' => 2.5)
                )

            );
           $validaciones = filter_var_array($datos, $argumentos);
           //IFs para mostrar

           if($validaciones['nombre'] === false){

            echo"<p>El nombre {$validaciones['nombre']} es incorrecto</p>";
          //  mostrarForm($nombreSaneado, " "," "," ");
          $nombreMal = true;
          
             }else{
                 echo"<p>Tu nombre es {$validaciones['nombre']} </p>";
                 //   mostrarForm(" ", " "," "," ");
                 
                }
                
           if($validaciones['apellidos'] === false){
               
               echo"<p>El apellido {$validaciones['apellidos']} es incorrecto</p>";
               //mostrarForm(" ", $apellidoSaneado," "," ");
               $apellidoMal = true;
               
            }else{
                echo"<p>Tu apellido es {$validaciones['apellidos']} </p>";
                //  mostrarForm(" ", " "," "," ");
                
            }
            if($validaciones['edad'] === false){
                
                echo"<p>La edad {$validaciones['edad']} es incorrecto</p>";
                //  mostrarForm(" ", " ",$edadSaneado," ");
                $edadMal = true;
                
            }else{
                echo"<p>Tu edad es {$validaciones['edad']} </p>";
                //   mostrarForm(" ", " "," "," ");
                
            }
            if($validaciones['altura'] === false){
                
                echo"<p>Tu altura {$validaciones['altura']} es incorrecto</p>";
                // mostrarForm(" ", " "," ",$alturaSaneado);
                $alturaMal = true;
                
             }else{
               echo"<p>Tu altura es {$validaciones['altura']} m </p>";
               //  mostrarForm(" ", " "," "," ");
               
            }
            
            if( $nombreMal == true || $apellidoMal == true || $edadMal ==  true || $alturaMal == true){

               
                mostrarForm($nombreSaneado, $apellidoSaneado,$edadSaneado,$alturaSaneado);
                

            
            }else{

                mostrarForm(" ", " "," "," ");
            }
            
            
            // echo "<p>Tu nombre es {$_POST['nombre']} {$_POST['apellidos']} tu edad es {$_POST['edad']} y mides {$_POST['altura']}</p>";
        }else{
            
            mostrarForm(" ", " "," "," ");
        }
        
        
        ?>
</body>
</html>