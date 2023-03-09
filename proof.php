<!DOCTYPE html>
<html lang="es">  
<head>    
    <title>Título de la WEB</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Título de la WEB">
    <meta name="description" content="Descripción de la WEB">    
  
</head>  
<style>
.btn-mds {
  display: inline-block;
  font-size: 16px;
  font-weight: 500;
  color: #fff;
  padding: 12px 24px;
  background-color: #2196F3;
  border: none;
  border-radius: 50px; /* Bordes redondeados */
  cursor: pointer;
  position: relative;
  overflow: hidden;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3); /* Sombra que simula profundidad */
}

.btn-mds:before {
  content: "";
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 0;
  height: 0;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.5);
  opacity: 0;
}

.btn-mds:active:before {
  width: 120%;
  height: 120%;
  opacity: 1;
  transition: all 0.3s ease-out;
}

.btn-mds:focus {
  outline: none;
}



</style>

<button class="btn-mds">Save</button>


</body>  
</html>