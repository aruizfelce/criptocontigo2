
      <?php include 'encabezado.php'; 
        
        session_start();
      ?>

      <div class="card text-center  bg-dark mb-3">
        <div class="card-body text-white">
          <br><br>
          <h1 class="display-2"><span style="color:white">Bienvenido</span></h1>
          <br><br>
          <div class="container">
            <div class="row">
              <div class="col-8">
              <form action="insertarUsuario.php" method="post">
                    <div class="form-group row">
                      <label for="idUsuario" class="col-sm-2 col-form-label">Id</label>
                      <div class="col-sm-6">
                        <input type="text" autofocus pattern="[A-Za-z0-9]+" required minlenght="5" maxlength="10"  class="form-control" name="idUsuario" id="idUsuario" placeholder="Ingrese su ID">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="cedula" class="col-sm-2 col-form-label">Cédula</label>
                      <div class="col-sm-6">
                        <input type="text" pattern="[0-9].{5,9}"  required  class="form-control" name="cedula" id="cedula" placeholder="Ingrese su Cédula. Solo números">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                      <div class="col-sm-10">
                        <input type="text" required pattern="[A-Za-z]*" minlenght="3" maxlength="30" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su Nombre. Solo letras">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="apellido" class="col-sm-2 col-form-label">Apellido</label>
                      <div class="col-sm-10">
                        <input type="text" pattern="[A-Za-z]*" required minlenght="3" maxlength="30" class="form-control" name="apellido" id="apellido" placeholder="Ingrese su Apellido. Solo LEtras">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-6">
                        <input type="password" required minlenght="5" maxlength="10" class="form-control" name="password" id="password" placeholder="Ingrese su Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <!-- <label for="tipo" class="col-sm-2 col-form-label">Tipo</label>
                      <div class="col-sm-6">
                        <select class="form-control" name="administrador">
                          <option value="2">Seleccione</option>
                          <option value="1">Profesor</option>
                          <option value="0">Alumno</option>
                        </select>
                      </div> -->
                      <input type="hidden" name="administrador" value="0">
                    </div>

                    
                    <div class="form-group row">
                      <div class="col-sm-10">
                        <input class="btn btn-warning" type="submit" name="enviando" value="Registrar">
                      </div>
                    </div>
                  </form>
                  
               </div>   
            
              <div class="col-4">
                  <?php
                      if($_SESSION["existe"]==1) 
                        {
                  ?>       
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Usuario ya existe
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div> 
                  <?php    
                         }
                  ?>  
                  
              </div>  
            </div>  
          </div>
    </div>
  </div>
    
 

   <?php include 'pie.php'; ?>