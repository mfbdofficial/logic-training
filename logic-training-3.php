<?php
/*
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
*/