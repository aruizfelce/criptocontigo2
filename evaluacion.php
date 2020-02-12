
  <script>
      // modificar aquí la cantidad de segundos y en el stilo .start
      var contador=60;
      
      setTimeout(()=>{
          document.querySelector(".meter .bar span").style.display="block";
          document.querySelector(".meter .bar span").classList.add("start");
          document.querySelector(".meter .num").innerHTML=contador;
          var interval=setInterval(()=>{
              contador--;
              document.querySelector(".meter .num").innerHTML=contador;
              if(contador<=0)
              {
                  clearInterval(interval);
                  finalCuentaAtras();
              }
          },1000);
      },500);
      
      function finalCuentaAtras() {
          alert("ha finalizado la cuenta atras");
          $("#formu").submit();
      }
    </script>

      <?php include 'encabezado.php'; ?>
      <?php include 'usuario.php'; ?>
      
      <?php
		include("conexion.php");
        $base=getPDO();
        $usuario=$_SESSION["idusuario"];
        $curso=$_GET["curso"];
      ?>
      
      <div style="background: none repeat scroll 0 0 #FFFFFF;
          border: 1px solid #DDDDDD;
          border-radius: 6px 6px 6px 6px;
          bottom: 50px;
          left: auto;
          margin-left: 220px;
          padding: 10px 0 0;
          position: fixed;
          text-align: center;
          width: 300px;
          heigth: 40px;
          z-index: 15;"> 
          <!--Aqui el Codigo-->
          <div class="meter">
            <div class="bar">
                <span></span>
            </div>
                <div class="num"></div>
          </div>
      </div>
      


      <div class="card bg-dark mb-3 mt-3">
        <div class="card-body text-white">
          <div class="card-header"><h3>Responde el Cuestionario</h3></div>
           <form id="formu" action='evaluacion.php?curso=<?php echo $curso ?>' method='POST'>
              <?php 
                $conexion = $base->query("SELECT * FROM cuestionario WHERE curso=$curso");
                $registros = $conexion->fetchAll(PDO::FETCH_OBJ);
                $lineas=1;
                foreach($registros as $preguntas):?>
                    <p><?php echo $preguntas->pregunta?></p>
                    
                    <select class="custom-select" size="4" id="pregunta1" name="<?php echo 'respuesta'.$lineas?>">
                        <option value="1"><?php echo $preguntas->respuesta1?></option>
                        <option value="2"><?php echo $preguntas->respuesta2?></option>
                        <option value="3"><?php echo $preguntas->respuesta3?></option>
                        <option value="4"><?php echo $preguntas->respuesta4?></option>
                    </select>
                    <input type="hidden" id="idpregunta1" name="<?php echo 'idpregunta'.$lineas++?>" value="<?php echo $preguntas->idpregunta?>">
                    <br><br>
                    
                <?php endforeach; 
                echo "<input type='hidden' name='cantidad_lineas' value='".$lineas."'>";
                if(!empty($_POST['guardar']) || $_SERVER['REQUEST_METHOD'] === 'POST')
                    {   
                        //elimina las respuestas del usuario de intentos anteriores
                       // $sql="DELETE FROM resultado WHERE usuario=$usuario;";
                       $sql="DELETE FROM resultado;";
                        $base->query($sql);
                        
                        //agrega en resultado las respuestas del usuario al cuestionario
                        for($i=1;$i<=$lineas-1;$i++)
                         {
                            $sql="INSERT INTO resultado VALUES(NULL,$usuario,'". $_POST['idpregunta'.$i]."','". $_POST['respuesta'.$i]."',1)";
                           // echo $sql;
                            $base->query($sql);
			                   }
                         //coloca en resultado si las respuestas fueron correctas(1) o incorrectas (0)
                         $sql="UPDATE resultado INNER JOIN cuestionario ON resultado.pregunta=cuestionario.idpregunta 
                                SET puntos = IF(respondio=correcta,1,0); ";
                         $base->query($sql);

                         //Totaliza el puntaje y se lo asigna a la tabla usuarios
                         //$sql="UPDATE usuarios INNER JOIN resultado ON resultado.usuario=usuarios.id 
                           //     SET puntaje = (SELECT Sum(resultado.puntos) AS sumapuntos FROM resultado)";
                         
                           $sql="SELECT * FROM puntuaciones WHERE usuario = $usuario AND curso=$curso";
                           $resultado = $base->prepare($sql);
                           $resultado->execute();
                           $numero_registros=$resultado->rowCount(); 
                   
                           if ($numero_registros==0)
                                $sql="INSERT INTO puntuaciones VALUES(NULL,$usuario,$curso,
                                     (SELECT Sum(resultado.puntos) AS sumapuntos FROM resultado),(SELECT Count(resultado.usuario) AS preguntas FROM resultado))";
                           else
                                $sql="UPDATE puntuaciones SET puntaje = (SELECT Sum(resultado.puntos) AS sumapuntos FROM resultado), cantidadpreguntas=(SELECT Count(resultado.usuario) AS preguntas FROM resultado)
                                      WHERE usuario = $usuario AND curso=$curso";                          
                           $base->query($sql);
                         
                         //direcciona a evaluar
                         echo '<meta http-equiv="Refresh" content="0;URL=evaluar.php?curso=' . $curso . '">';
                    }
            ?>    
          <div class="card-footer">
              <button class="btn btn-warning" name='guardar' value='guardar'>Evaluar </button>
              <a class="btn btn-warning" href="vercursos.php?curso=<?php echo $curso ?>">Regresar al Contenido</a>
          </div>
        </form>  
      </div>
            
     </div>
     
  </div>
    
 
  <?php include 'pie.php'; ?>