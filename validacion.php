<?php
include 'funciones.php';
//initializa all the variables of the inputs and the errors of every input
$nss = "";
$categoria = "";
$fecha1 = "";
$fecha2 = "";

$errorNss = "";
$errorCategoria = "";
$errorDate = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nss = validateNss($_POST["nss"]);
    $categoria = $_POST['categoria'];
    $fecha1 = validateDate($_POST['date1']);
    $fecha2 = validateDate($_POST['date2']);
    $fecha_objeto1 = new DateTime($fecha1);
    // Formatear la fecha como datetime de MySQL
    $fecha_mysql1 = $fecha_objeto1->format('Y-m-d');
    $fecha_objeto2 = new DateTime($fecha2);
    // Formatear la fecha como datetime de MySQL
    $fecha_mysql2 = $fecha_objeto2->format('Y-m-d');

}



function validateNss($input) {
    global $errorNss;
    if(empty($input)) {
        $errorNss = "por favor introduce un numero de seguridad social valido ";
        return "";
    } else {
        if(strlen($input) != 9) {
            $errorNss = "numero de seguridad deberia contener 9 numeros";
            return "";
        } elseif (preg_match('/\s/', $input)) {
            $errorNss = "numero de seguridad no debe contener espacios";
            return "";
        } else {
            return $input;
        }
    }
}

function validateDate($input) {
    global $errorDate;
    if (empty($input)) {
        $errorDate = "Por favor introduce una fecha";
        return '';  // En lugar de una cadena vacía, devuelve null para indicar que la fecha no es válida
    } else {
        return $input;
}
}


if (empty($errorNss) && empty($errorDate)) {
echo $fecha_mysql1;
echo '<br>';
echo $fecha_mysql2;
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./style.css" type="text"/>
        </head>';
?>
<?=template_header()?>
<?php
echo '<body>';
        if ($categoria == 'psicotropos') {
            echo '<h2> Tabla de registros (libro recetario) !</h2><br>';
            //abrir el fichero en solo lectura (libroRecetario.txt)
            //siempre llamar al fichero y abrirlo (fopen) fuera del while
            if ($file = fopen("./ficheros/libroRecetario.txt", "r")) {
                echo '<table>
                <tr>
                    <th>fecha</th>
                    <th>el medicamento</th>
                    <th>Nss</th>
                </tr>';
                while (!feof($file)){
                    $lineas = fgets($file);
                    // Verificar si la línea es válida antes de procesarla
                    if (!empty($lineas)) {
                        $array = explode(":", $lineas);
                        // Verificar si el array tiene al menos la longitud esperada
                        if (count($array) >= 7) {
                            if ($nss == $array[5] && ($fecha_mysql1 >= $array[1] || $array[1] <= $fecha_mysql2)) {
                            echo '<tr>
                                <td>' . $array[1] . '</td>
                                <td>' . $array[2] . '</td>
                                <td>' . $array[5] . '</td>
                            </tr>';
                            } 
        
                        }
                    }
            }
            echo '</table>';
            fclose($file);
            } else {
                echo "No se puede abrir el archivo";
            }
        } elseif ($categoria == 'estupefacientes') {
            echo '<h2> Tabla de registros (libro contabilidad estupefacientes) !</h2><br>';
            //libroContabilidadEstpefacientes
            if ($file1 = fopen("./ficheros/libroContabilidadEstupefacientes.txt", "r")) {
                echo '<table>
                <tr>
                    <th>fecha</th>
                    <th>el medicamento</th>
                    <th>Nss</th>
                </tr>';
                while (!feof($file1)){
                    $lineas = fgets($file1);
                    // Verificar si la línea es válida antes de procesarla
                    if (!empty($lineas)) {
                        $array = explode(":", $lineas);
                        // Verificar si el array tiene al menos la longitud esperada
                        if (count($array) >= 7) {
                            if ($nss == $array[5] && ($fecha_mysql1 >= $array[1] || $array[1] <= $fecha_mysql2)) {
                            echo '<tr>
                                <td>' . $array[1] . '</td>
                                <td>' . $array[2] . '</td>
                                <td>' . $array[5] . '</td>
                            </tr>';
                            }
        
                        }
                    }
            }
            echo '</table>';
            fclose($file1);
            } else {
                echo "No se puede abrir el archivo";
            }
        } elseif ($categoria == 'todos') {
            echo '<h2> Tabla de registros (Todos los libros) !</h2><br>';
            // Libro Recetario
            if ($file = fopen("./ficheros/libroRecetario.txt", "r")) {
                echo '<table>
                <tr>
                    <th>fecha</th>
                    <th>el medicamento</th>
                    <th>Nss</th>
                </tr>';
                while (!feof($file)) {
                    $lineas = fgets($file);
                    if (!empty($lineas)) {
                        $array = explode(":", $lineas);
                        if (count($array) >= 7) {
                        if ($nss == $array[5] && ($fecha_mysql1 >= $array[1] || $array[1] <= $fecha_mysql2)) {
                            echo '<tr>
                                <td>' . $array[1] . '</td>
                                <td>' . $array[2] . '</td>
                                <td>' . $array[5] . '</td>
                            </tr>';
                        }
                    }
                    }
                }
                fclose($file);
            } else {
                echo "No se puede abrir el archivo";
            }

            // Libro Contabilidad Estupefacientes
            if ($file1 = fopen("./ficheros/libroContabilidadEstupefacientes.txt", "r")) {
                while (!feof($file1)) {
                    $lineas = fgets($file1);
                    if (!empty($lineas)) {
                        $array = explode(":", $lineas);
                        if (count($array) >= 7) {
                            if ($nss == $array[5] && ($fecha_mysql1 >= $array[1] || $array[1] <= $fecha_mysql2)) {
                            echo '<tr>
                                <td>' . $array[1] . '</td>
                                <td>' . $array[2] . '</td>
                                <td>' . $array[5] . '</td>
                            </tr>';
                        }
                    }
                    }
                }
                fclose($file1);
            } else {
                echo "No se puede abrir el archivo";
            }

            echo '</table>';

                
    }

} else {
?>
<?=template_header()?>
<?php
        echo '

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="./style.css" type="text"/>
                <style>
                body{
                    font-family: montserrat;
                    margin: 0;
                    background-color: rgb(236, 236, 236);
                    position: relative;
                    min-height: 100%;
                    color: #555555;
                    background-color: #FFFFFF;
                    margin: 0;
                    padding-bottom: 1200px; /* Same height as footer */
                    }
                form{
                    background-color: rgb(249, 246, 242);
                    border-radius: 15px;
                    box-shadow: #32325d40 0px 6px 12px -2px, #0000004d 0px 3px 7px -3px;
                    padding: 30px 50px;
                    width: 50%;
                    font-size: 18px;
                    height: 900px; /* ajusta la altura según tus necesidades */
                    margin: 140px 500px 500px 435px;
                    position: absolute;
                    top: 0; bottom: 0; left: 0; right: 0;
                    text-align: center;
                
                }
                </style>
            </head>
            <body>
                <form action="validacion.php" method="post"> 
                <h1> Completa este formulario de incidencias: </h1>
                <label for="nss">Numero seguridad :</label>';
                    if ($nss) {
                        echo '<input type="text" name="nss" value="' . $nss . '">';
                    } else {
                        echo '<input type="text" id="fullName" name="nss">';
                        echo '<span style="color: red;">'; 
                        echo $errorNss; 
                        echo '</span><br>';
                    }
                    echo '
                    Categoria receta: <select name="categoria">';
                    if($categoria) {
                        echo '
                        <option value="psicotropos">Psicotropos</option>
                        <option value="estupefacientes">estupefacientes</option>
                        <option value="todos">todos los medicamentos </option>            
                        </select><br><br>';
                    }
                    echo 'Rango de fechas: 
                    <br><label for="fecha"> Introduce fecha 1: </label> ';
                    if ($fecha1) {
                        echo '<input type="date" name="date1" value="'.$fecha1.'">';
                    } else {
                        echo '<input type="date" name="date1">
                        <span style="color: red;">';
                        echo $errorDate;
                        echo '</span><br>';
                    }
                    echo '<br><label for="fecha"> Introduce fecha 2: </label> ';
                    if ($fecha2) {
                        echo '<input type="date" name="date2" value="'.$fecha2.'">';
                    } else {
                        echo '<input type="date" name="date2">
                        <span style="color: red;">';
                        echo $errorDate;
                        echo '</span><br>';
                    }
                    echo '
                    <button type="submit">Submit</button>
                    <button type="reset"> Borrar </button>
                </form>
                </body>
            </html> ';
            
            }

?>
<?=template_footer()?>