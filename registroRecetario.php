<?php
$medicamentosArray = array();
$medicamentosArray1 = array();
$medicamentosArray2 = array();

$fichero = './ficheros/medicamentosPsicotropos.txt';
if (file_exists($fichero) && is_readable($fichero)) {
    if ($handle1 = fopen($fichero, 'r')) {
        while (!feof($handle1)) {
            $lineas = fgets($handle1);
            if (!empty($lineas)) {
                $array1 = explode(" ", $lineas);
                if (count($array1) >= 2) {
                        $psicotropo = $array1[0]; //ok
                        $descripcion = $array1[1];
                        echo $psicotropo . '<br>'; //t3teni ga3 smawat dwayat
                        $medicamentosArray [] = array(
                            'psicotropo' => $psicotropo,
                        );
                        
                        //print_r($medicamentosArray);
                }
            }
        }
        fclose($handle1);
    } else {
        echo "No se puede abrir el archivo";
    }
}


echo '<br>' . '                      ';
echo '<br>' . '---------------------------';
echo '<br>' . '                      ';

/*obtener la receta (principio activo en recetas.txt)*/
$fichero1 = './ficheros/recetas.txt';
if (file_exists($fichero1) && is_readable($fichero1)) {
    if ($handle2 = fopen($fichero1, 'r')) {
        while (!feof($handle2)) {
            $lineas = fgets($handle2);
            if (!empty($lineas)) {
                $array = explode(" ", $lineas);
                if (count($array) >= 8) {
                        $nReceta = $array[0];
                        $nss = $array[1];
                        $nombre = $array[2];
                        $dni = $array[3];
                        $nColegiado = $array[4];
                        $fecha = $array[5];
                        $envases = $array[6];
                        $principio = $array[7]; //ok
                        echo $principio . '<br>';
                        $medicamentosArray2 [] = array(
                            'nReceta' => $nReceta,
                            'nss' => $nss,
                            'nombre' => $nombre,
                            'dni' => $dni,
                            'nColegiado' => $nColegiado,
                            'fecha' => $fecha,
                            'envases' => $envases,
                            'principio' => $principio,
        
                        );
                        
                        //print_r($medicamentosArray2);
                }
            }
        }
        fclose($handle2);
    } else {
        echo "No se puede acceder al archivo";
    }
}

echo '<br>' . '                      ';
echo '<br>' . '---------------------------';
echo '<br>' . '                      ';

//obtener la receta que esta en lista2.txt
$fichero2 = './ficheros/Lista2.txt';
if (file_exists($fichero2) && is_readable($fichero2)) {
    if ($handle3 = fopen($fichero2, 'r')) {
        while (!feof($handle3)) {
            $lineas = fgets($handle3);
            if (!empty($lineas)) {
                $array2 = explode(" ", $lineas);
                if (count($array2) >= 5) {
                        $ids = $array2[0];
                        $num = $array2[1];
                        $num1 = $array2[2];
                        $estupefaciente = $array2[3]; //ok
                        $descrip = $array2[4]; //ok
                        echo $estupefaciente . '<br>';
                        $medicamentosArray1 [] = array(
                            'estupefaciente' => $estupefaciente
                        );
                        //print_r($medicamentosArray1);
                        
                }
            }
        }
        fclose($handle3);
    } else {
        die('no se puede abrir el fichero');
    }
}

$libroRecetarioFile = './ficheros/libroRecetario.txt';
foreach ($medicamentosArray as $psicotropoArray) {
        foreach ($medicamentosArray2 as $principioArray) {
            $psicotropo = trim($psicotropoArray['psicotropo']);
            $principio = trim($principioArray['principio']);
            if ($psicotropo == $principio) {
                $linea = $principioArray['nReceta'] . ":" . $principioArray['fecha'] . ":" . $principio . ":" . $principioArray['envases'] . ":" . $principioArray['nColegiado'] . ":" . $principioArray['nss'] .":". 'psico';
                echo $linea . PHP_EOL;

                if (!$ficheroo = fopen($libroRecetarioFile, 'a+')) {
                    die("No se puede abrir o crear el archivo de texto");
                } else {
                    fwrite($ficheroo, $linea .PHP_EOL);
                    fclose($ficheroo);
                }
            } 
        }
    }

foreach ($medicamentosArray1 as $estupefacienteArray) {
        foreach ($medicamentosArray2 as $principioArray) {
            $estupefaciente = trim($estupefacienteArray['estupefaciente']);
            $principio = trim($principioArray['principio']);
            if ($estupefaciente == $principio) {
                $linea = $principioArray['nReceta'] . ":" . $principioArray['fecha'] . ":" . $principio . ":" . $principioArray['envases'] . ":" . $principioArray['nColegiado'] . ":" . $principioArray['nss'] .":".'lista2';
                echo $linea . PHP_EOL;

                if (!$ficheroo = fopen($libroRecetarioFile, 'a+')) {
                    die("No se puede abrir o crear el archivo de texto");
                } else {
                    fwrite($ficheroo, $linea . PHP_EOL);
                    fclose($ficheroo);
                }
                break;
            } 
        }
    }



/*
//verificar si los arrays son arrays
foreach ($medicamentosArray as $psicotropoArray) {
    if (!is_array($psicotropoArray) || !isset($psicotropoArray['psicotropo'])) {
        echo "psicotropoArray is not a valid array. Data: " . print_r($psicotropoArray, true) . PHP_EOL;
        continue; // Skip to the next iteration
    }
    
    $psicotropoValue = $psicotropoArray['psicotropo'];
    echo "Psicotropo: " . $psicotropoValue . PHP_EOL;
    // Perform additional actions with $psicotropoValue if needed
}
 */
?>