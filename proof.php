<!DOCTYPE html>
<html lang="es">  
<head>    
    <title>Título de la WEB</title>    
    <meta charset="UTF-8">
    <meta name="title" content="Título de la WEB">
    <meta name="description" content="Descripción de la WEB">    
  
</head>  
<style>
.input-field {
  position: relative;
  margin-bottom: 45px;
}

.input-field input {
  font-size: 14px;
  padding: 10px 10px 10px 5px;
  display: block;
  width: 100%;
  border: none;
  border-bottom: 1px solid #474747;
  background: transparent;
}

.input-field input:focus {
  outline: none;
  border-bottom: 2px solid #355C7D;
}

.input-field label {
  color: #474747;
  font-size: 14px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 10px;
  transition: 0.2s ease all;
}

.input-field input:focus ~ label,
.input-field input:valid ~ label {
  top: -10px;
  font-size: 14px;
  color: #355C7D;
}


</style>
<body>    

<div class="input-field" style='margin-top:50px'>
  <input type="search" id="username" required>
  <label for="username">Nombre de usuario</label>
</div>


</body>  
</html>