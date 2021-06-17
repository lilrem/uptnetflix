<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>qwq</h1>

<form action="{{route('registro.form')}}" method="post">
{{csrf_field()}}
    <input type="text" name="nombre" placeholder="Nombre">
    <br>
    <br>
    <input type="text" name="ap_p" placeholder="Apellido">
    <br>
    <br>
    <input type="text" name="ap_m" placeholder="Apellido Materno">
    <br>
    <br>
    <input type="number" placeholder="Edad" name="edad">
    <br>
    <br>
    <input type="email" name="correo" placeholder="Correo">
    <br>
    <br>
    <input type="password" placeholder="Contraseña" name="contrasenia">
    <br>
    <br>
    <input type="password" placeholder="Repetir Contraseña" name="contrasenia2">
    <br>
    <br>
    <input type="text" placeholder="Número de tarjeta" name="num_tarjeta">
    <br>
    <br>
    <input type="text" placeholder="Tipo de Tarjeta" name="tipo">
    <br>
    <br>
    <input type="text" placeholder="Nombre del Banco" name="banco">
    <br>
    <br>
    <input type="submit" value="Registrar" class="button" name="registro">
</form>
</body>
</html>
