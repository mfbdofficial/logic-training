<?php
//Codewars - Find The Capitals
//Write a function that takes a single non-empty string of only lowercase and uppercase ascii letters 
//(word) as its argument, and returns an ordered list containing the indices of all capital (uppercase) 
//letters in the string.
//"CodEWaRs" --> [0,3,4,6]
function capitals($word) {
    $indexUpperCase = [];
    for($i = 0; $i < strlen($word); $i++) {
        if(preg_match("/[A-Z]/", $word[$i])) {
            $indexUpperCase[] = $i;
        }
    }
    return $indexUpperCase;
};

//Codewars - Testing 1-2-3
//Your team is writing a fancy new text editor and you've been tasked with implementing the line 
//numbering. Write a function which takes a list of strings and returns each line prepended by the correct 
//number.The numbering starts at 1. The format is n: string. Notice the colon and space in between.
//[] --> []
//["a", "b", "c"] --> ["1: a", "2: b", "3: c"]
function number(array $lines): array{
    $prependedCorrectNumber = [];
    for($i = 0; $i < count($lines); $i++) {
        $stringNumber = strval($i + 1);
        $prependedCorrectNumber[] = $stringNumber . ": " . $lines[$i];
    }
    return $prependedCorrectNumber; // your code here
}
//pro solution 1
function number(array $lines): array{
    return array_map(function($l, $k){ //langsung mapping $l itu index-nya, $k itu value-nya
        return ($k + 1).": ".$l; //return bentuk seperti ini
    }, $lines, array_keys($lines)); //$lines menjadi $l, lalu array_keys($lines) menjadi $k
}

//Codewars - Persistent Bugger
//Write a function, persistence, that takes in a positive parameter num and returns its multiplicative 
//persistence, which is the number of times you must multiply the digits in num until you reach a single 
//digit.
//39 --> 3 (because 3*9 = 27, 2*7 = 14, 1*4 = 4 and 4 has only one digit, there are 3 multiplications)
//999 --> 4 (because 9*9*9 = 729, 7*2*9 = 126, 1*2*6 = 12, and finally 1*2 = 2, there are 4 multiplications)
//4 --> 0 (because 4 is already a one-digit number, there is no multiplication)
function persistence(int $num): int {
    $count = 0;
    while($num >= 10) {
        $nums = str_split(strval($num));
        $num = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            $num = $num * $nums[$i];
        }
        $count++;
    }
    return $count;
}
//pro solution 1
function persistence(int $num): int {
    $count = 0;
    while ($num > 9) {
        $num = array_product(str_split($num));
        $count++;
    }
    return $count;
}

//Codewars - No Zeros for Heroes
//Numbers ending with zeros are boring. They might be fun in your world, but not here. Get rid of them. 
//Only the ending ones.
//1450 -> 145; 960000 -> 96; 1050   -> 105; -1050 -> -105; 0 -> 0
function noBoringZeros(int $n): int {
    $nums = str_split(strval($n));
    if(count($nums) == 1) {
        return $n;
    }
    for($i = count($nums) - 1; $i >= 0; $i--) {
        if($nums[$i] == 0) {
            array_pop($nums);
        } else {
            return intval(implode("", $nums));
        }
    }
    return $n;
}
//Pro solution 1
function noBoringZeros(int $n): int {
    return (int) rtrim($n,'0');
}

//Codewars - Volume of a Cuboid
//Bob needs a fast way to calculate the volume of a cuboid with three values: the length, width and height 
//of the cuboid. Write a function to help Bob with this calculation.
function get_volume_of_cuboid($length, $width, $height) {
    return $length * $width * $height;
}
//Pro solution 1
function get_volume_of_cuboid(...$arg) : int {
    return array_product($arg);
}

//Codewars - Remove Anchor from URL
//Complete the function/method so that it returns the url with anything after the anchor (#) removed.
//"www.codewars.com#about" --> "www.codewars.com"
//"www.codewars.com?page=1" --> "www.codewars.com?page=1"
function replaceAll($string) {
    $cleanURL = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == "#") {
            return $cleanURL;
        }
        $cleanURL .= $string[$i];
    }
    return $cleanURL;
}
//Pro solution 1
function replaceAll($string) {
    return explode("#", $string)[0]; //explode (pisahkan) string berdasarkan "#" lalu ambil yg pertama
} //saja, yaitu index ke 0
//Pro solution 2
function replaceAll(string $string) :string {
    return preg_replace('/#.*$/', '', $string); //pakai regex, ganti bagian yg "#..." (ada anchor,
} //juga karakter seterusnya) menjadi string kosong ''
//Pro solution 3
function replaceAll($s) {
    return strtok($s, "#");
}

//Codewars - Check for factor
//Factors are numbers you can multiply together to get another number.
//2 and 3 are factors of 6 because: 2 * 3 = 6
//You can find a factor by dividing numbers. If the remainder is 0 then the number is a factor. You can
//use the mod operator (%) in most languages to check for a remainder
function checkForFactor($base, $factor) {
    return $base % $factor == 0 ? true : false;
}
//Pro solution 1
function checkForFactor($base, $factor) {
    return $base % $factor === 0;
}
//Pro solution 2
function checkForFactor($base, $factor) {
    return !($base % $factor);
}

//Codewars - Get the Middle Character
//You are going to be given a non-empty string. Your job is to return the middle character(s) of the 
//string. If the string's length is odd, return the middle character. If the string's length is even, 
//then return the middle 2 characters.
function getMiddle($text) {
    $middleIndex = floor(strlen($text) / 2); //floor membulatkan angka ke bawah
    if (strlen($text) % 2 == 0) {
        return $text[$middleIndex - 1] . $text[$middleIndex];
    } else {
        return $text[$middleIndex];
    }
}
//Pro solution 1
function getMiddle($text) {
    $len = strlen($text);
    if ($len % 2 === 0) {
        return substr($text, $len / 2 - 1, 2); //substr mengambil string mulai dari urutan tertentu,
    } //lalu dengan jumlah karakter tertentu
    return substr($text, $len / 2, 1);
}
//Pro solution 2
function getMiddle($text) {
	$start = floor((strlen($text) - 1) / 2); //floor membulatkan angka ke  bawah
    $len = strlen($text) % 2 ? 1 : 2; //kalo hasil % 2 = 0 maka menjadi false, kalo 1 maka menjadi true
	return substr($text, $start, $len);
}

//Codewars - Build Tower
//Build a pyramid-shaped tower, as an array/list of strings, given a positive integer number of floors. 
//A tower block is represented with "*" character. For example, a tower with 3 floors looks like this:
//[
//    "  *  ",
//    " *** ", 
//    "*****"
//]
function tower_builder(int $n): array {
    $arrPyramid = [];
    $current1 = $n - 1;
    $current2 = 0; 
    for($i = 0; $i < $n; $i++) { //perulangan untuk baris sesuai $n
        $element = "";
        for($j = 0; $j < $n; $j++) { //perulangan untuk string bintang di bagian kiri $n
            if($j < $current1) {
                $element .= " ";
            } else {
                $element .= "*";
            }
        }
        for($k = 0; $k < $n - 1; $k++) { //perulangan untuk string bintang di bagian kanan $n - 1
            if($k < $current2) {
                $element .= "*";
            } else {
                $element .= " ";
            }
        }
      $current1 = $current1 - 1;
      $current2++;
      $arrPyramid[] = $element;
    }
    return $arrPyramid;
}
//Model memakai 1 current counter dows
function tower_builder(int $n): array {
    $arrPyramid = [];
    $current = $n - 1; //current pembanding memakai angka dari $n
    for($i = 0; $i < $n; $i++) {
      $element = "";
        for($j = 0; $j < $n; $j++) {
            if($j < $current) {
                $element .= " ";
            } else {
                $element .= "*";
            }
        }
        for($k = $n - 1; $k > 0; $k--) { //model for ini harus terbalik karena align bintang terbalik
            if($k > $current) {
                $element .= "*";
            } else {
                $element .= " ";
            }
        }
        $current = $current - 1;
        $arrPyramid[] = $element;
    }
    return $arrPyramid;
}
//Pro solution 1
function tower_builder(int $n): array {
    $pad = $n * 2 - 1;
    $x = 1; 
	$arr = [];
    while ($n --> 0) {
    	$arr[] = str_pad(str_repeat('*', $x), $pad, ' ', STR_PAD_BOTH);
        $x += 2;
    }
    return $arr;
}
//Pro solution 2
function tower_builder(int $n): array {
    $result = array();
    for($i = 1; $i <= $n; $i++) {
        $result[] = str_repeat(' ', $n-$i) . str_repeat('*', ($i-1)*2+1) . str_repeat(' ', $n-$i);
    }
    return $result;
}