<?php
//Codewars - Basic Mathematical Operations
//operation(string/char), value1(number), value2(number). The function should return result of numbers after applying 
//the chosen operation.
function basicOp($op, $val1, $val2) {
    switch ($op) {
        case "+":
            return $val1 + $val2;
            break;
        case "-":
            return $val1 - $val2;
            break;
        case "*":
            return $val1 * $val2;
            break;
        default:
            return $val1 / $val2;
    }
}
//Pro solution 1
function basicOp($op, $val1, $val2) {
    switch ($op) {
        case '+':
            return $val1 + $val2;
        case '-':
            return $val1 - $val2;
        case '*':
            return $val1 * $val2;
        case '/':
            return $val1 / $val2;
    }
}
//Pro solution 2
function basicOp($op, $val1, $val2) {
  return eval("return {$val1}{$op}{$val2};");
}

//Codewars - Remove Exclamation Marks
//Write function RemoveExclamationMarks which removes all exclamation marks from a given string.
//"Hello World!" -> "Hello World"
function remove_exclamation_marks($string) {
    return str_replace("!", "", $string);
}
//Pro solution 1
function remove_exclamation_marks($string) {
    return strtr($string, ['!'=>'']);
}
//Pro solution 2
function remove_exclamation_marks($string) {
    return strtr($string, ['!' => '']);
}

//HackerRank - Electronics Shop
//A person wants to determine the most expensive computer keyboard and USB drive that can be purchased with a give
//budget. Given price lists for keyboards and USB drives and a budget, find the cost to buy them. If it is not 
//possible to buy both items, return -1.
//b = 60, keyboards = [40, 50, 60], drives = [5, 8, 12] -> 58 (the person can buy 40 keyboard + 12 USB drive = 52, 
//or a 50 keyboard + 8 USB drive = 58, choose the latter as the more expensive option, so return 58)
function getMoneySpent($keyboards, $drives, $b) {
    $maxBuy = -1;
    for ($i = 0; $i < count($keyboards); $i++) {
        for ($j = 0; $j < count($drives); $j++) {
            $spent = $keyboards[$i] + $drives[$j];
            if ($spent > $maxBuy && $spent <= $b) {
                $maxBuy = $spent;
            }
        }
    }
    return $maxBuy;
}

/*
//Codewars - Moving Zeros To The End
//Write an algorithm that takes an array and moves all of the zeros to the end, preserving the order of the other 
//elements.
//[false,1,0,1,2,0,1,3,"a"] -> [false,1,1,2,1,3,"a",0,0]
function moveZeros(array $items): array {
    for ($i = 0; $i < count($items); $i++) {
      if ($items[$i] === 0 || $items[$i] === 0.0) {
        unset($items[$i]);
        $items[] = 0;
      }
    }
    return array_values($items);
}
//Pro solution 1
function moveZeros(array $items): array {
    return array_pad(array_filter($items, function($x) {
        return $x !== 0 and $x !== 0.0; //filter array khusus yg nilainya bukan 0 dan bukan 0.0
    }), count($items), 0); //array_pad(array, length, value) returns a copy of the array padded to size specified by
} //length with value value.
//Pro solution 2
function moveZeros(array $items): array {
    $ret = array_diff($items, [0]); //array_diff() function compares the values of two (or more) arrays, and returns
    return array_merge($ret, array_fill(0, count($items) - count($ret), 0)); //the differences.This function compares
} //the values of two (or more) arrays, and return an array that contains the entries from array1 that are not present
//in array2, array3 etc.
//array_fill(start_index, length, value) to fills an array with length entries of the value of the value parameter, 
//keys starting at the start_index parameter.
//array_merge() to merges the elements of one or more arrays together so that the values of one are appended to the 
//end of the previous one.

//Codewars - Create Phone Number
//Write a function that accepts an array of 10 integers (between 0 and 9), that returns a string of those numbers in 
//the form of a phone number. 
//[1,2,3,4,5,6,7,8,9,0] -> "(123) 456-7890"
function createPhoneNumber($numbersArray) {
    return "(" . $numbersArray[0] . $numbersArray[1] . $numbersArray[2] . ")" .
        " " . $numbersArray[3] . $numbersArray[4] . $numbersArray[5] . "-" .
        $numbersArray[6] . $numbersArray[7] . $numbersArray[8] . $numbersArray[9];
}
//My other answer
function createPhoneNumber($numbersArray) {
    $phone = "(";
    for ($i = 0; $i < count($numbersArray); $i++) {
        $phone .= strval($numbersArray[$i]);
        if ($i == 2) {
            $phone .= ") ";
        }
        if ($i == 5) {
            $phone .= "-";
        }
    }
    return $phone;
}
//Pro solution 1
function createPhoneNumber(array $digits): string {
    return sprintf("(%d%d%d) %d%d%d-%d%d%d%d", ...$digits);
}
//Pro solution 2
function createPhoneNumber($numbersArray) {
    return vsprintf("(%d%d%d) %d%d%d-%d%d%d%d", $numbersArray);
}
*/