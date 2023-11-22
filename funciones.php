<?php
function template_header() {
echo <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css"/>
</head>
<body>
<header class="website-head">
        <div class="logo"> Farmacia !</div>
        <ul class="menu">
            <li><a href="gestionaFarmacia.php"> Formulario </li>
            <li>About</li>
            <li><a href="./ficheros/libroRecetario.txt"> Libro recetario </a></li>
            <li><a href="./ficheros/libroContabilidadEstupefacientes.txt"> Libro contabilidad estupefacientes </a></li>
            <li>Contact</li>
        </ul>
</header> 
EOT;
}

// Template footer
function template_footer() {
    $year = date('Y');
    echo <<<EOT
            <footer>
                <div class="content-wrapper">
                    <p>&copy; $year, System</p>
                </div>
                <div class="content-wrapper">
                    <p>Created by Bouthayna Koualla</p>
                </div>
            </footer>
        </body>
    </html>
    EOT;
    }
    
    
    
    
?>