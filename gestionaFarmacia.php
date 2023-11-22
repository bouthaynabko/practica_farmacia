<?php
include 'funciones.php';
?>
<?=template_header()?>
<head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./style.css" type="text"/>
</head>
<body>
    <form action="validacion.php" method="post"> 
    <h1> Completa este formulario de Farmacia: </h1>
        <label for="nss">Numero seguridad :</label>
        <input type="text" name="nss">
        <br>
        Categoria receta: <select name="categoria">
            <option value="psicotropos">Psicotropos</option>
            <option value="estupefacientes">estupefacientes</option>
            <option value="todos">todos los medicamentos </option>
        </select>
        <br>
        Rango de fechas: 
        <br>
        <label for='fecha'> Introduce fecha 1: </label> 
        <input type="date" name="date1">
        <br>
        <label for='fecha'> Introduce fecha 2: </label> 
        <input type="date" name="date2">
        <br>
        <button type="submit"> Submit </button>
        <button type="reset"> Borrar </button>
        <button type="button"> button </button>
    </form>
    </body>
    </html>

<?=template_footer()?>





