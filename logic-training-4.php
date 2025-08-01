<?php
//Codewars - Find the Middle Element
//As a part of this Kata, you need to create a function that when provided with a triplet, returns the index of the
//numerical element that lies between the other two elements. The input to the function will be an array of three
//distinct numbers (Haskell: a tuple). Foe example :
//[2, 3, 1] => 0 (2 is the number that fits between 1 and 3 and the index of 2 in the input array is 0)
//[5, 10, 14] => 1 (10 is the number that fits between 5 and 14 and the index of 10 in the input array is 1)
function gimme ($triplet) {
    $indexBetween = 0;
    for ($i = 0; $i < count($triplet); $i++) {
        if ($i == 0) {
            if (($triplet[$i] < $triplet[1] && $triplet[$i] > $triplet[2]) || ($triplet[$i] < $triplet[2] && $triplet[$i] > $triplet[1])) {
                $indexBetween = $i;
            }
        } else if ($i == 1) {
            if (($triplet[$i] < $triplet[0] && $triplet[$i] > $triplet[2]) || ($triplet[$i] < $triplet[2] && $triplet[$i] > $triplet[0])) {
                $indexBetween = $i;
            }
        } else {
            if (($triplet[$i] < $triplet[0] && $triplet[$i] > $triplet[1]) || ($triplet[$i] < $triplet[1] && $triplet[$i] > $triplet[0])) {
                $indexBetween = $i;
            }
        }
    }
    return $indexBetween;
}

//Codewars - Moved in Squared Strings (I)
//You are given a string of n lines, each substring being n characters long: For example:
//s = "abcd\nefgh\nijkl\nmnop"
//We will study some transformations of this square of strings.
//Vertical mirror: vert_mirror (or vertMirror or vert-mirror)
//vert_mirror(s) => "dcba\nhgfe\nlkji\nponm"
//Horizontal mirror: hor_mirror (or horMirror or hor-mirror)
//hor_mirror(s) => "mnop\nijkl\nefgh\nabcd"
//or printed:
//vertical 	mirror   |horizontal	mirror
//abcd --> 	dcba     |abcd --> 		mnop
//efgh --> 	hgfe     |efgh --> 		ijkl
//ijkl --> 	lkji     |ijkl -->    	efgh
//mnop --> 	ponm     |mnop -->    	abcd
//Task : Write these two functions and high-order function oper(fct, s) where
//fct is the function of one variable f to apply to the string s (fct will be one of vertMirror, horMirror)
//Examples:
//s = "abcd\nefgh\nijkl\nmnop"
//oper(vert_mirror, s) => "dcba\nhgfe\nlkji\nponm"
//oper(hor_mirror, s) => "mnop\nijkl\nefgh\nabcd"
function vertMirror($s) {
    $parts = explode("\n", $s);
    $partsReverse = [];
    for ($i = 0; $i < count($parts); $i++) {
        $current = $parts[$i];
        $partReverse = "";
        for ($j = strlen($current) - 1; $j > -1; $j--) {
            $partReverse .= $current[$j]; 
        }
        array_push($partsReverse, $partReverse);
    }
    return implode("\n", $partsReverse);
}
function horMirror($s) {
    $parts = explode("\n", $s);
    $partsOpposite = [];
    for ($i = count($parts) - 1; $i > -1; $i--) {
        array_push($partsOpposite, $parts[$i]);
    }
    return implode("\n", $partsOpposite);
}
function oper($fct, $s) {
    return $fct($s);
}
//Pro solution 1
function vertMirror1($s) {
    return implode("\n", array_map('strrev', explode("\n", $s))); //learn what array_map() with "strrev" parameter mean
}
function horMirror1($s) {
    return implode("\n", array_reverse(explode("\n", $s)));
}
function oper1($f, $s) {
    return $f($s);
}
//Pro solution 2
function vertMirror2($grid) { //why it started already as a grid?
    return array_map('strrev', $grid); //learn what array_map() with "strrev" parameter mean
} 
function horMirror2($grid) { //why it started already as a grid?
    return array_reverse($grid);
}
function oper2($fct, $s) {
    return implode("\n", $fct(explode("\n", $s)));
}

//Codewars - The Highest Profit Wins
//Ben has a very simple idea to make some profit: he buys something and sells it again. Of course, this wouldn't
//give him any profit at all if he was simply to buy and sell it at the same price. Instead, he's going to buy it
//for the lowest possible price and sell it at the highest.
//Write a function that returns both the minimum and maximum number of the given list/array.
//[1,2,3,4,5] -> [1,5]
//[2334454,5] -> [5,2334454]
//[1] -> [1,1]
function MinMax($arr) {
    $min = $arr[0];
    $max = $arr[0];
    for ($i = 0; $i < count($arr); $i++) {
        if ($max < $arr[$i]) {
            $max = $arr[$i];
        } else if ($min > $arr[$i]) {
            $min = $arr[$i];
        }
    }
    return [$min, $max];
}
//My other solution 1
function MinMax1($arr) {
    $sortedArr = sort($arr);
    return [$arr[0], $arr[count($arr) - 1]];
} //just sort it and get the first and last element
function MinMax2($arr) {
    return [min($arr), max($arr)];
} //just return min and max value from that array using built-in function

//Codewars - Factorial
//Your task is to write function factorial
//5 -> 120 (5 x 4 x 3 x 2 x 1)
function factorial($n) {
    $result = 1;
    for ($i = $n; $i > 0; $i--) {
        $result *= $i;
    }
    return $result;
}
//My other solution 1
function factorial1($n) {
    if ($n < 2) {
        return 1;
    }
    return $n * factorial1($n - 1);
} //using recursive function method
//My other solution 2
function factorial2($n) {
    $result = 1;
    while ($n > 0) {
        $result *= $n;
        $n--;
    }
    return $result;
} //do while statement as long as n value more that 0 (untill n = 1), decrease n value for every loop

//Codewars - Simple Multiplication with 8 and 9
//multiplying a given number by eight (8) if it is an even number and by nine (9) otherwise.
function simpleMultiplication($number) {
    if ($number % 2 == 0) {
        return $number * 8;
    } else {
        return $number * 9;
    }
}

//Codewars - Strong Number
//Strong number is a number with the sum of the factorial of its digits is equal to the number itself.
//For example, 145 is strong, because 1! + 4! + 5! = 1 + 24 + 120 = 145. Given a positive number, find if it
//is strong or not, and return either "STRONG!!!!" or "Not Strong !!".
//123 -> "Not Strong !!" (123 is not a strong number, because 1! + 2! + 3! = 9 is not equal to 123)
//145 -> "STRONG!!!!" (145 is a strong number, because 1! + 4! + 5! = 1 + 24 + 120 = 145)
function toNumberCustom($num) {
    return intval($num);
} 
function strong($n) {
    $arr = array_map('toNumberCustom', str_split(strval($n))); //when we do array_map, it means we do
    $result = 0; //declaration again for our call back, that's why the toNumberCustom need to be outside
    for ($i = 0; $i < count($arr); $i++) {
        $factorial = 1;
        for ($j = $arr[$i]; $j > 0; $j--) {
            $factorial *= $j;
        }
        $result += $factorial;
    }
    if ($n == $result) {
        return "STRONG!!!!";
    } else {
        return "Not Strong !!";
    }
}
//Pro solution 1
function strong1($n) : string {
    $sum = 0;
    foreach(str_split($n) as $v) {
        $sum += $v == 0 ? 1 : array_product(range(1, $v)); //just in case if $v = 0, because if we do
    } //range(1, 0) it would be error, beside of that 0! is 1 anyway
    return $sum == $n ? 'STRONG!!!!' : 'Not Strong !!';
}
//Pro solution 2
function strong2($n) {
    $sum = array_sum(array_map(function ($x) { 
        return ($x == 0) ? 1 : array_product(range(1, (int)$x));
    }, str_split(strval($n))));
    return ($sum == $n) ? "STRONG!!!!" : "Not Strong !!";
} //do it straigt making $sum varibale, do mapping (array_product) for integer splitted $n, then sum it with array_sum

//Codewars - Rotate for a Max
//Take a number: 56789. Rotate left, you get 67895.
//Keep the first digit in place and rotate left the other digits: 68957.
//Keep the first two digits in place and rotate the other ones: 68579.
//Keep the first three digits and rotate left the rest: 68597.
//Now it is over since keeping the first four it remains only one digit which rotated is itself.
//You have the following sequence of numbers:
//56789 -> 67895 -> 68957 -> 68579 -> 68597
//and you must return the greatest: 68957.
function maxRot($n) {
    $nString = strval($n);
    $nArray = str_split($nString);
    $max = $n;
    for ($i = 0; $i < count($nArray); $i++) {
        array_push($nArray, $nArray[$i]);
        array_splice($nArray, $i, 1); //remove item on index i for 1 element length
        $currentRotate = intval(join('', $nArray));
        if ($max < $currentRotate) {
            $max = $currentRotate;
        }
    }
    return $max;
}
//Pro solution 1
function maxRot1($n) : int {
    $max = $n;
    $rotations = strlen($n) - 1;
    for ($i = 0; $i < $rotations; $i++) {
        $n = substr($n, 0, $i) . rotate(substr($n, $i));
        $max = max($max, $n);
    }
    return $max;
}
function rotate1($s) {
    return substr($s, 1) . substr($s, 0, 1);
}
//Pro solution 2
function maxRot2($n) {
    $max = $n;
    $val = strval($n);
    $limit = strlen($val);
    for ($i = 0; $i <= $limit; $i++) {
        $main = substr($val, 0, $i);
        $sub = str_split(substr($val, $i));
        $temp = array_shift($sub);
        $val = $main.implode($sub).$temp;
        if ($max<intval($val)) $max = intval($val);
    }
    return $max;
}

//Codewars - Powers of 2
//Complete the function that takes a non-negative integer n as input, and returns a list of all the powers
//of 2 with the exponent ranging from 0 to n (inclusive).
//n = 0 -> [1] because [2^0]
//n = 1 -> [1, 2] because [2^0, 2^1]
//n = 2 -> [1, 2, 4] because [2^0, 2^1, 2^2]
function powersOfTwo(int $n): array{
    $list = [];
    for ($i = 0; $i <= $n; $i++) {
        array_push($list, 2 ** $i);
    }
    return $list;
}
//Pro solution 1
function powersOfTwo1(int $n): array{
    return array_map(fn($num) => 2 ** $num, range(0, $n)); //create array with this range(0, $n) means 0 until n
} //fn($num) => 2 ** $num, function for mapping (return the exponential 2 of $num)
//Pro solution 2
function powersOfTwo2(int $n): array{
    return array_map(fn($v) => $v = pow(2, $v), range(0, $n));
} //same as Pro solution 1, but we use pow() built in function in our function for mapping

//Codewars - Wilson Primes
//Wilson primes satisfy this condition (P is a prime number)
//(P - 1)! + 1 divided by P * P
//So it would be ((P - 1)! + 1) / (P * P)
//This should give a whole number, where P! is the factorial of P
//Your task is to create a function that returns true if the given number is a Wilson prime and false otherwise.
//in this Wilson Prime, P is only maded by Prime number. What is Prime number itself?
//it's the number that greater than 1 & it must be divisible only by 1 and itself (not by any other number).
function amIWilsonLogic($p) {
    if ($p < 2) {
        return false;
    }
    $nMin1Factorial = 1;
    for ($i = 1; $i < $p; $i++) {
        $nMin1Factorial *= $i;
    }
    $result = ($nMin1Factorial + 1) % ($p * $p);
    if ($result == 0) {
        return true ;
    } else {
        return false;
    }
} //base logic, it's actually correct, but this will error for 563 why?
//When you do (563 - 1)! = 562! is a huge number (~10^1290). JavaScript numbers (Number type) can’t handle that 
//without precision loss after ~15-17 digits. So the modulo (nMin1Factorial + 1) % (p * p) becomes inaccurate, 
//and you get a wrong result.
function amIWilson($p) {
    if ($p < 2) return false;
    $fact = gmp_init(1);
    for ($i = 1; $i < $p; $i++) {
        $fact = gmp_mul($fact, $i);
    }
    $numerator = gmp_add($fact, 1);
    $denominator = gmp_mul($p, $p);
    return gmp_cmp(gmp_mod($numerator, $denominator), 0) === 0;
} //You’ll also need to make sure the gmp extension is enabled in your PHP setup. Just check by running: phpinfo();
//GMP stands for GNU Multiple Precision arithmetic library. It is a powerful math extension in PHP that allows you 
//to do high-precision arithmetic, including:
//- very large integers (like factorials of 500+), 
//- large fractions and modular operations, 
//- precise arithmetic beyond what normal int or float can handle
//How to enable GMP in Linux : run -> sudo apt install php-gmp, restart ur web server, then run -> sudo service apache2 restart
//How to enable GMP in Windows : open -> php.ini, uncomment this line -> extension=php_gmp.dll, then restart XAMPP
//If you can't use GMP, I can show you a version using bcmath (slower but available more often).
function amIWilsonBCMath($p) {
    if ($p < 2) return false;
    $factorial = '1';
    for ($i = 1; $i < $p; $i++) { //calculate (p - 1)!
        $factorial = bcmul($factorial, (string)$i);
    }
    $numerator = bcadd($factorial, '1'); //(p - 1)! + 1
    $denominator = bcmul((string)$p, (string)$p); //p^2
    $mod = bcmod($numerator, $denominator); //numerator % denominator
    return $mod === '0';
}

//Codewars - Mumbling
//"abcd" -> "A-Bb-Ccc-Dddd"
//"RqaEzty" -> "R-Qq-Aaa-Eeee-Zzzzz-Tttttt-Yyyyyyy"
//"cwAt" -> "C-Ww-Aaa-Tttt"
function accum($s) {
    $group = [];
    for ($i = 0; $i < strlen($s); $i++) {
        $current = "";
        for ($j = 0; $j < $i + 1; $j++) {
            if ($j == 0) {
                $current .= strtoupper($s[$i]);
            } else {
                $current .= strtolower($s[$i]);
            }
        }
        array_push($group, $current);
    }
    return implode("-", $group);
}
//Pro solution 1
function accum1($s) {
    $parts = [];
    foreach (str_split($s) as $index => $part) {
        $parts[] = strtoupper($part) . str_repeat(strtolower($part), $index);
    }
    return implode('-', $parts);
} //split the string $s, do foreach, concat between uppercase part and lowercase part
//for lowercase part, str_repeat(strtolower($part), $index) means get string $part and repeat it for $index times
//Pro solution 2
function accum2($s) {
    foreach (str_split($s) as $position => $char) {
        $words[] = ucwords(str_repeat(strtolower($char), $position + 1));
    } //the ucwords() function converts the first character of each word in a string to uppercase.
    return implode('-', $words);
}//split the string $s, do foreach, repeat lowercase for $index or $position + 1 times, change it to camelcase, implode
//Pro solution 3
function accum3($s) {
    $result = "";
    for($i = 0; $i < strlen($s); $i++){
        $letter = $s[$i];
        $result .= strtoupper($letter) . str_repeat(strtolower($letter), $i) . "-";
    } //instead making an array and implode it, we just do concat directly with "-" included
    return trim($result, "-"); //cut the last "-" founded
}
?>