<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/estilos.css">
    <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    
    <title>Criptocontigo</title>

    <style>
        .meter {
            position: relative;
            width:300px;
            box-sizing: border-box;
        }
        
        .meter .bar {
            height: 40px;
            background: #555;
            border-radius: 25px;
            box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
            padding: 10px;
            width:100%;
        }
        
        .meter .num {
            color:White;
            position: absolute;
            top:1px;
            text-align:center;
            font-weight:bold;
            font-family:Arial;
            padding: 10px;
            width:100%;
        }
        
        .meter .bar span {
            display: none;
            height: 100%;
            width:100%;
            border-radius: 20px;
            background-color: rgb(43,194,83);
            box-shadow:
            inset 0 2px 9px  rgba(255,255,255,0.3),
            inset 0 -2px 6px rgba(0,0,0,0.4);
            position: relative;
            overflow: hidden;
        }
        
        .start {
            /* modificar la cantidad de segundos y en la varable contador de javascript */
            animation: move 60s linear;
        }
        
        @keyframes move {
            0% {
                width: 0;
            }
            100% {
                width: 100%;
            }
        }
    </style>
  </head>
  <body>
    
    <div class="container">
    <div class="card text-center  bg-warning mb-3">
            <div class="card-body">
                <div class="d-flex flex-row align-items-center">
                    <div>
                        <a class="btn btn-warning btn-lg btn-block" href="index.php" role="button"><img src="img/cabecera.jpg"> </a>    
                    </div>
                
                    <div><h1 class="display-3">Criptocontigo</h1></div>
                </div>
          </div>
        
          
        </div>
      