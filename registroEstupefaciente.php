<?php
//sacar los principios activos de (recetas.txt), y meter toda la info en el libro de contabilidad
//estupefacientes , de la misma manera del registro recetario
//con la misma forma 

//lista4.txt
$medicamentosArray = array();
//lista1.txt
$medicamentosArray1 = array();
//recetas.txt
$medicamentosArray2 = array();

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

//obtener la receta que esta en lista2.txt
$fichero2 = './ficheros/Lista1.txt';
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


//obtener la receta que esta en lista4.txt
$fichero2 = './ficheros/Lista4.txt';
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
                        $medicamentosArray [] = array(
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

$libroContabilidadFile = './ficheros/libroContabilidadEstupefacientes.txt';
foreach ($medicamentosArray as $estupefacienteLista4) {
        foreach ($medicamentosArray2 as $principioArray) {
            $estupefacienteL4 = trim($estupefacienteLista4['estupefaciente']);
            $principio = trim($principioArray['principio']);

            //echo "psicotropo: $psicotropo, estupefaciente: $estupefaciente, principio: $principio" . PHP_EOL;

            if ($estupefacienteL4 == $principio) {
                $linea = $principioArray['nReceta'] . ":" . $principioArray['fecha'] . ":" . $principio . ":" . $principioArray['envases'] . ":" . $principioArray['nColegiado'] . ":" . $principioArray['nss'] .":" .'Lista4'.PHP_EOL;
                echo $linea;

                if (!$ficheroo = fopen($libroContabilidadFile, 'a+')) {
                    die("No se puede abrir o crear el archivo de texto");
                } else {
                    fwrite($ficheroo, $linea);
                    fclose($ficheroo);
                }
            } 
        }
    }


foreach ($medicamentosArray1 as $estupefacienteLista1) {
        foreach ($medicamentosArray2 as $principioArray) {
            $estupefacienteL1 = trim($estupefacienteLista1['estupefaciente']);
            $principio = trim($principioArray['principio']);
            //echo "psicotropo: $psicotropo, estupefaciente: $estupefaciente, principio: $principio" . PHP_EOL;

            if ($estupefacienteL1 == $principio) {
                $linea = $principioArray['nReceta'] . ":" . $principioArray['fecha'] . ":" . $principio . ":" . $principioArray['envases'] . ":" . $principioArray['nColegiado'] . ":" . $principioArray['nss'] .":" .'lista1'. PHP_EOL;
                echo $linea;

                if (!$ficheroo = fopen($libroContabilidadFile, 'a+')) {
                    die("No se puede abrir o crear el archivo de texto");
                } else {
                    fwrite($ficheroo, $linea);
                    fclose($ficheroo);
                }
            } 
        }
    }





?>