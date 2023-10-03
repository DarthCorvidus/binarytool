#!/usr/bin/env php
<?php

if(empty($argv[1])) {
	echo "Please supply a number".PHP_EOL;
	exit(1);
}

function dec2hex(int $int): array {
	$array = [];
	$hex = str_pad(dechex($int), 16, "0", STR_PAD_LEFT);
	for($i=0;$i<8;$i++) {
		$array[] = $hex[($i*2)].$hex[($i*2)+1];
	}
return $array;
}

function decArray(array $hexArray) {
	$dec = array();
	foreach($hexArray as $key => $value) {
		$dec[] = str_pad(hexdec($value), 3, " ", STR_PAD_LEFT);
	}
return $dec;
}

function hexArray2Integer(array $hexArray, $length) {
	$hexString = implode("", array_slice($hexArray, 8-$length, $length));
return number_format(hexdec($hexString), "0");
}

function RevHexArray2Integer(array $hexArray, $length) {
	$hexString = implode("", array_slice($hexArray, 0, $length));
return number_format(hexdec($hexString), "0");
}

function pad(string $string) {
	return str_pad($string, 31, " ", STR_PAD_LEFT);
}

function represent(array $hexArray, int $length) {
	$decArray = decArray($hexArray);
	$revHexArray = array_reverse($hexArray);
	$revDecArray = array_reverse($decArray);
	echo "  BE Hexadecimal: ".pad(implode("  ", array_slice($hexArray, 8-$length, $length)), 32, " ", STR_PAD_LEFT).PHP_EOL;
	echo "  BE Decimal:     ".pad(implode(" ", array_slice($decArray, 8-$length, $length)), 32, " ", STR_PAD_LEFT).PHP_EOL;
	echo "  BE Number:      ".pad(hexArray2Integer($hexArray, $length)).PHP_EOL;
	echo "  LE Hexadecimal: ".pad(implode("  ", array_slice($revHexArray, 0, $length)), 32, " ", STR_PAD_LEFT).PHP_EOL;
	echo "  LE Decimal:     ".pad(implode(" ", array_slice($revDecArray, 0, $length)), 32, " ", STR_PAD_LEFT).PHP_EOL;
	echo "  LE Number:      ".pad(revHexArray2Integer($revHexArray, $length)).PHP_EOL;
}

$hexArray = dec2hex($argv[1]);
$decArray = decArray($hexArray);
$revHexArray = array_reverse($hexArray);
$revDecArray = array_reverse($decArray);
echo "Notes: ".PHP_EOL;
echo "UINT8:".PHP_EOL;
echo "     Hexadecimal: ".pad($hexArray[7]).PHP_EOL;
echo "     Decimal:     ".pad($decArray[7]).PHP_EOL;
echo "     Number:      ".pad($decArray[7]).PHP_EOL;

echo "UINT16: ".PHP_EOL;
represent($hexArray, 2);

echo "UINT32: ".PHP_EOL;
represent($hexArray, 4);

echo "UINT64: ".PHP_EOL;
represent($hexArray, 8);

#echo "UINT32BE: ".implode(" ", array_slice($hex, 4, 4)).PHP_EOL;
#echo "UINT64BE: ".implode(" ", $hex).PHP_EOL;

#$reverse = array_reverse($hex);
#echo "Little endian:".PHP_EOL;
#echo "UINT8:    ".$hex[7].PHP_EOL;
#echo "UINT16LE: ".implode(" ", array_slice($reverse, 0, 2)).PHP_EOL;
#echo "UINT32LE: ".implode(" ", array_slice($reverse, 0, 4)).PHP_EOL;
#echo "UINT64LE: ".implode(" ", $reverse).PHP_EOL;