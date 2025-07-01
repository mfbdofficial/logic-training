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
function basicOp1($op, $val1, $val2) {
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
function basicOp2($op, $val1, $val2) {
  return eval("return {$val1}{$op}{$val2};");
}

//Codewars - Remove Exclamation Marks
//Write function RemoveExclamationMarks which removes all exclamation marks from a given string.
//"Hello World!" -> "Hello World"
function remove_exclamation_marks($string) {
    return str_replace("!", "", $string);
}
//Pro solution 1
function remove_exclamation_marks1($string) {
    return strtr($string, ['!'=>'']);
}
//Pro solution 2
function remove_exclamation_marks2($string) {
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
function moveZeros1(array $items): array {
    return array_pad(array_filter($items, function($x) {
        return $x !== 0 and $x !== 0.0; //filter array khusus yg nilainya bukan 0 dan bukan 0.0
    }), count($items), 0); //array_pad(array, length, value) returns a copy of the array padded to size specified by
} //length with value value.
//Pro solution 2
function moveZeros2(array $items): array {
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
function createPhoneNumber1($numbersArray) {
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
function createPhoneNumber2(array $digits): string {
    return sprintf("(%d%d%d) %d%d%d-%d%d%d%d", ...$digits);
}
//Pro solution 2
function createPhoneNumber3($numbersArray) {
    return vsprintf("(%d%d%d) %d%d%d-%d%d%d%d", $numbersArray);
}

//HackerRank - Cats and a Mouse
//Two cats and a mouse are at various positions on a line. You will be given their starting positions. Your task is 
//to determine which cat will reach the mouse first, assuming the mouse does not move and the cats travel at equal 
//speed. If the cats arrive at the same time, the mouse will be allowed to move and it will escape while they fight.
//U given x, y, z representing the respective positions for cats A and B, and for mouse C
//- If cat A catches the mouse first, print Cat A.
//- If cat B catches the mouse first, print Cat B.
//- If both cats reach the mouse at the same time, print Mouse C as the two cats fight and mouse escapes.
//x = 2, y = 5, z = 4 -> "Cat B" (The cats are at positions 2 {Cat A} and 5 {Cat B}, and the mouse is at position 4.
//Cat B, at position 5 will arrive first since it is only 1 unit away while the other is 2 units away)
function catAndMouse($x, $y, $z) {
    $cat1Distance = $x > $z ? $x - $z : $z - $x;
    $cat2Distance = $y > $z ? $y - $z : $z - $y;
    if ($cat1Distance == $cat2Distance) {
        return "Mouse C";
    } else if ($cat1Distance < $cat2Distance) {
        return "Cat A";
    } else {
        return "Cat B";
    }
}
//Pro solution 1
function catAndMouse1($x, $y, $z) {
    if (abs($x - $z) == abs($y - $z)) {
        return "Mouse C";
    }
    return abs($x - $z) < abs($y - $z) ? "Cat A" : "Cat B";
}
//Pro solution 2
function catAndMouse2($x, $y, $z) {
    $distCatA = abs($z - $x);
    $distCatB = abs($z - $y);
    return $distCatA == $distCatB ? "Mouse C" : ($distCatA > $distCatB ? "Cat B" : "Cat A");
}

//Codewars - Duplicate Encoder
//The goal of this exercise is to convert a string to a new string where each character in the new string is "(" if 
//that character appears only once in the original string, or ")" if that character appears more than once in the 
//original string. Ignore capitalization when determining if a character is a duplicate.
//"din" -> "((("
//"recede" -> "()()()"
//"Success" -> ")())())"
//"(( @" -> "))((" 
function duplicate_encode($word) {
    $word = strtolower($word);
    $encoded = "";
    for ($i = 0; $i < strlen($word); $i++) {
        $current = $word[$i];
        $count = 0;
        for ($j = 0; $j < strlen($word); $j++) {
            if ($word[$j] == $current) {
                $count++;
            } 
        }
        if ($count > 1) {
            $encoded .= ")";
        } else if ($count == 1) {
            $encoded .= "(";
        }
    }
    return $encoded;
}
//Pro solution 1
function duplicate_encode1($word){
	$word = str_split(strtolower($word)); //string dijadikan array terpisah
	$str = "";
	foreach($word as $key) { //perulangan untuk setiap array-nya
		(count(array_keys($word, $key)) > 1) ? $str .= ")" : $str .= "("; //hitung jumlah element berdasarkan value
	}	
	return $str;			
}
//Pro solution 2
function duplicate_encode2(string $word) : string
{
    $splittedWord = str_split(strtolower($word));
  	$countMap = array_count_values($splittedWord); //returns an array using the values of array (which must be ints 
    $finalString = ''; //or strings) as keys and their frequency in array as values.
    foreach ($splittedWord as $letter) {
        ($countMap[$letter] === 1) ? $finalString .= '(' : $finalString .= ')';
    }   
    return $finalString;
}

//Codewars - Determine Offspring Sex Based on Genes XX and XY Chromosomes
//The male gametes or sperm cells in humans and other mammals are heterogametic and contain one of two types of sex 
//chromosomes. They are either X or Y. The female gametes or eggs however, contain only the X sex chromosome and are
//homogametic. The sperm cell determines the sex of an individual in this case. If a sperm cell containing an X 
//chromosome fertilizes an egg, the resulting zygote will be XX or female. If the sperm cell contains a Y chromosome, 
//then the resulting zygote will be XY or male. Determine if the sex of the offspring will be male or female based on 
//the X or Y chromosome present in the male's sperm. 
//- If the sperm contains the X chromosome, return "Congratulations! You're going to have a daughter."; 
//- If the sperm contains the Y chromosome, return "Congratulations! You're going to have a son.";
function chromosomeCheck(string $sperm): string {
    if ($sperm == "XY") {
        return 'Congratulations! You\'re going to have a son.';
    } else {
        return 'Congratulations! You\'re going to have a daughter.';
    }
}
//Pro solution 1
function chromosomeCheck1($sperm) {
    return 'Congratulations! You\'re going to have a ' . ($sperm == "XY" ? 'son' : 'daughter') . '.';
}

//HackerRank - Forming a Magic Square
//We define a magic square to be an n x n matrix of distinct positive integers from 1 to n^2 where the sum of any 
//row, column, or diagonal of length n is always equal to the same number: the magic constant.

//Codewars - Directions Reduction
//Once upon a time, on a way through the old wild mountainous west, a man was given directions to go from one point 
//to another. The directions were "NORTH", "SOUTH", "WEST", "EAST". Clearly "NORTH" and "SOUTH" are opposite, "WEST" and "EAST" too.
//Going to one direction and coming back the opposite direction right away is a needless effort. Since this is the 
//wild west, with dreadful weather and not much water, it's important to save yourself some energy, otherwise you might 
//die of thirst!
//How I crossed a mountainous desert the smart way? The directions given to the man are, for example, the following (depending on the language):
//["NORTH", "SOUTH", "SOUTH", "EAST", "WEST", "NORTH", "WEST"].
//You can immediately see that going "NORTH" and immediately "SOUTH" is not reasonable, better stay to the same place! 
//So the task is to give to the man a simplified version of the plan. A better plan in this case is simply:
//["WEST"]
//Other examples:
//In ["NORTH", "SOUTH", "EAST", "WEST"], the direction "NORTH" + "SOUTH" is going north and coming back right away.
//The path becomes ["EAST", "WEST"], now "EAST" and "WEST" annihilate each other, therefore, the final result is [] (nil in Clojure).
function dirReduc($arr) {
    $notYet = true;
    $oldPlan = $arr;
    while ($notYet) {
        $newPlan = [];
        for ($i = 0; $i < count($oldPlan); $i++) {
            if ($i + 1 < count($oldPlan)) {
                $current = strtolower($oldPlan[$i]);
                $next = strtolower($oldPlan[$i + 1]);
                if ($current == "north") {
                    if ($next == "south") {
                        $i++;
                    } else {
                        $newPlan[] = $oldPlan[$i];
                    }
                } else if ($current == "south") {
                    if ($next == "north") {
                        $i++;
                    } else {
                        $newPlan[] = $oldPlan[$i];
                    }
                } else if ($current == "east") {
                    if ($next == "west") {
                        $i++;
                    } else {
                        $newPlan[] = $oldPlan[$i];
                    }
                } else if ($current == "west") {
                    if ($next == "east") {
                        $i++;
                    } else {
                        $newPlan[] = $oldPlan[$i];
                    }
                }
            } else {
                $newPlan[] = $oldPlan[$i];
            }
        }
        if ($oldPlan == $newPlan) {
            $notYet = false;
        } else {
            $oldPlan = $newPlan;
        } 
    }
    return $newPlan;
} //ex : [N, S, S, W, W, E, E, S, N, N] => [S, W, E, N] -> [S, N] -> []
//Pro solution 1
function dirReduc1($arr) {
    $ops = ['NORTH'=>'SOUTH', 'SOUTH'=>'NORTH', 'EAST'=>'WEST', 'WEST'=>'EAST'];
    $stack = [];
    foreach ($arr as $k => $v) {
        if (end($stack) == $ops[$v]) {
            array_pop($stack);
        } else {
            $stack[] = $v;
        }
    }
    return $stack;
} //ex : [N, S, S, W, W, E, E, S, N, N] => [N] -> [] -> [S] -> [S, W] -> [S, W, W] -> [S, W] -> [S] -> [S, S] -> [S] -> []
//Pro solution 2
function dirReduc2($arr) {
    for ($i = 0 ; $i < sizeof($arr) - 1 ; $i++) {
        if ($arr[$i] == "NORTH" && $arr[$i + 1] == "SOUTH" ||
            $arr[$i] == "SOUTH" && $arr[$i + 1] == "NORTH" ||
            $arr[$i] == "WEST" && $arr[$i + 1] == "EAST" ||
            $arr[$i] == "EAST" && $arr[$i + 1] == "WEST") {
            array_splice($arr, $i, 2);
            $arr = dirReduc($arr);
        }
    }
    return $arr;
}

//Codewars - Surface Area and Volume of a Box
//Write a function that returns the total surface area and volume of a box. The given input will be three 
//positive non-zero integers: width, height, and depth.
function getSize($width, $height, $depth) {
    $totalSurfaceArea = 2 * (($width * $height) + ($width * $depth) + ($height * $depth));
    $volume = $width * $height * $depth;
    return [$totalSurfaceArea, $volume];
}

//Codewars - Simple Fun #176: Reverse Letter
//Given a string str, reverse it and omit all non-alphabetic characters. Input & output -> [input] string str & [output] a string. Example:
//For str = "krishan", the output should be "nahsirk".
//For str = "ultr53o?n", the output should be "nortlu".
function reverseLetter(string $str): string{
    $reverse = "";
    for ($i = strlen($str); $i > 0; $i--) {
        if (ctype_alpha($str[$i - 1])) { //ctyoe_alpha to check a string is only contain alphabetic characters
            $reverse .= $str[$i -1];
        }
    }
    return $reverse;
}

//Codewars - Number of Decimal Digits
//Determine the total number of digits in the integer (n>=0) given as input to the function. For example,
//9 is a single digit, 66 has 2 digits and 128685 has 6 digits. Be careful to avoid overflows/underflows.
//All inputs will be valid.
function digits(int $n): int {
    $nString = strval($n);
    return strlen($nString);
}
//Pro solution 1
function digits1(int $n): int {
    return strlen((string) $n);
}
//Pro solution 2
function digits2(int $n): int {
    return $n ? log10($n) + 1 : 1;
}
//Pro solution 3
function digits3(int $n): int {
    return $n < 10 ? 1 : 1 + digits3($n / 10);
} //looping with it's own function untill $n < 10