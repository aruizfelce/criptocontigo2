
  <?php
    
    $idUsuario = $_POST["idUsuario"];
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $password = $_POST["password"];
    
    include("conexion.php");
    
    $base=getPDO();

      if ($base){ 
        //procedimiento para agregar al nuevo usuario
        $sql="SELECT * FROM usuarios WHERE idUsuario = :login";
        
        $resultado = $base->prepare($sql);
        
        $login = htmlentities(addslashes($_POST["idUsuario"]));
        $resultado->bindValue(":login",$login);

        $resultado->execute();
        
        $numero_registros=$resultado->rowCount(); 

        if ($numero_registros==0){
          $sql = "INSERT INTO usuarios (idUsuario,cedula,nombre,apellido,password) 
          VALUES (:idusuario,:cedula,:nombre,:apellido,:password)";

          $resultado = $base->prepare($sql);
          $resultado->execute(array(":idusuario"=>$idUsuario, 
                                    ":cedula" => $cedula, 
                                    ":nombre"=>$nombre, 
                                    ":apellido"=>$apellido, 
                                    ":password"=>$password                                  
                                    ));
          
          $resultado->closeCursor();
          
          session_start();  //al crear el usuario automáticamente queda logueado y va al menu
          $_SESSION["usuario"] = $nombre . " " . $apellido; 
          header("location:menu.php");
        }
         else{ //si el usuario existe emite error
          session_start();
          $_SESSION["existe"] = 1;     
          header("location:registrar.php"); //redirige a la pagina registrar
         }
     }
       else{
        echo "Hubo un error con la conexion";
     }
    
  ?>
