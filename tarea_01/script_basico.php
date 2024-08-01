<?php
// a. Declaración de Variables
$entero = 10; // Variable de tipo integer
$flotante = 3.14; // Variable de tipo float
$cadena = "Hola, mundo"; // Variable de tipo string
$booleano = true; // Variable de tipo boolean
$arreglo = array(1, 2, 3, 4, 5); // Variable de tipo array

// b. Operaciones Aritméticas
$suma = $entero + $flotante; // Suma de un entero y un flotante
$producto = $entero * 2; // Multiplicación de un entero por 2

echo "La suma de $entero y $flotante es: $suma<br>"; // Mostrando el resultado de la suma
echo "El producto de $entero y 2 es: $producto<br>"; // Mostrando el resultado del producto

// c. Manipulación de Cadenas
$cadena1 = "Hola";
$cadena2 = "mundo";
$cadenaConcatenada = $cadena1 . " " . $cadena2; // Concatenación de dos cadenas

echo "La cadena concatenada es: $cadenaConcatenada<br>"; // Mostrando la cadena concatenada
echo "La longitud de la cadena concatenada es: " . strlen($cadenaConcatenada) . "<br>"; // Mostrando la longitud de la cadena concatenada

// d. Uso de Condicionales
if ($booleano) {
    echo "El valor de la variable booleana es verdadero.<br>";
} else {
    echo "El valor de la variable booleana es falso.<br>";
}

// e. Creación de un Array
$arregloElementos = array("Cristian", "BKarina", "Kevin", "Matias", "Samantha");
echo "El tercer elemento del arreglo es: " . $arregloElementos[2] . "<br>"; // Mostrando el tercer elemento del arreglo
?>
