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
?>