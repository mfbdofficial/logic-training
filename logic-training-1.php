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