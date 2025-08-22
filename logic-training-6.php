<?php 

//Codewars - All Inclusive?
//Input: a string strng & an array of strings arr
//Output of function contain_all_rots(strng, arr) (or containAllRots or contain-all-rots): a boolean true if all
//rotations of strng are included in arr or false otherwise
//Examples:
//"bsjq" & ["bsjq", "qbsj", "sjqb", "twZNsslC", "jqbs"]) -> true
//"Ajylvpy" & ["Ajylvpy", "ylvpyAj", "jylvpyA", "lvpyAjy", "pyAjylv", "vpyAjyl", "ipywee"]) -> false
function containAllRots($s, $arr) {
    for ($i = 0; $i < strlen($s); $i++) {
        $s = substr($s, 1) . substr($s, 0, 1);
        $found = false;
        for ($j = 0; $j < count($arr); $j++) {
            if ($s == $arr[$j]) {
                $found = true;
            }
        }
        if (!$found) {
            return false;
        }
    }
    return true;
} //using additional variable $found as a state if the current $arr looping is same as the current string rotation
//return false if that additional variable not getting true
//Pro solution 1
function containAllRots1($s, $arr) {
    foreach (str_split($s) as $char) { //do foreach, the current $char will always be the first character of $s
        $s = substr($s, 1) . $char; //because we modify the $s, this is how the rotation work with foreach
        if (!in_array($s, $arr)) return false; //check if there's one $s rotation not included in array $arr, then
    } //return false immediately
    return true;
}
//Pro solution 2
function containAllRots2($s, $arr) {
    for ($i = 0; $i < strlen($s);  $i++) { //same as Pro solution 1 before, but using for loop and substr for rotation
        $r = substr($s, $i, strlen($s) - $i) . substr($s, 0, $i); //"abc" . "" then "bc"
        if (array_search($r, $arr) === false) { //check if there's one $s rotation not included in array $arr, then
            return false; //return false immediately
        } 
    }
    return true;
} //substr($string, $offset, $length) -> returns a portion of a string specified by parameters for offset and length
//$offset as the start, $length is like how much character
//- substr("abc", 0, 3) . substr("abc", 0, 0) -> "abc" . ""
//- substr("abc", 1, 2) . substr("abc", 0, 1) -> "bc" . "a"
//- substr("abc", 2, 1) . substr("abc", 0, 2) -> "c" . "ab"
//Pro solution 3
function containAllRots3($s, $arr) {
    for ($i = 0; $i < strlen($s); $i++) {
        if (array_search(substr($s, $i).substr($s, 0, $i), $arr) === false) return false; //do rotation and check it
    } //at the same time
    return true;
}

//Codewars - Help Suzuki Rake His Garden!
//the monastery has a magnificent Zen garden made of white gravel and rocks and it is raked diligently everyday by
//the monks. Suzuki having a keen eye is always on the lookout for anything creeping into the garden that must be
//removed during the daily raking such as insects or moss.
//you will be given a string representing the garden such as:
//rake out any items that are not a rock or gravel and replace them with gravel such that:
//"slug spider rock gravel gravel gravel gravel gravel gravel gravel"
//returns a string with all items except a rock or gravel replaced with gravel:
//"gravel gravel rock gravel gravel gravel gravel gravel gravel gravel"
function rakeGarden($garden) {
    $gardenStuff = explode(" ", $garden);
    for ($i = 0; $i < count($gardenStuff); $i++) {
        if ($gardenStuff[$i] != "gravel" && $gardenStuff[$i] != "rock") {
            $gardenStuff[$i] = "gravel";
        }
    }
    return implode(" ", $gardenStuff);
}
//My other solution 1
function rakeGarden0($garden) {
    return preg_replace("/\b((?!\b(gravel|rock)\b)\w+)\b/", "gravel", $garden);
} //lets talk about the regex:
//\b → Word boundary, ensures we match whole words (not part of a bigger word).
//- (?! ... ) → Negative lookahead, meaning “the next thing must not match this pattern.”
//- \b(gravel|rock)\b → matches the exact words "gravel" or "rock".
//- \w+ → matches a sequence of letters/numbers/underscores (a word).
//the whole ((?!\b(gravel|rock)\b)\w+) means:
//- match a word only if it is not "gravel" or "rock".
//- the final \b ensures the match stops at the word's end.
//we don't need g in regex PHP, preg_replace() in PHP already replaces all matches globally by default, the g flag 
//is a JavaScript thing, not PHP.
//My other solution 2
$rakeGarden00 = fn($garden) => preg_replace("/(?!rock\b)\b\w+/", "gravel", $garden);
//what is /.../ do?
//- /.../ → Marks the start and end of the regular expression. 
//- we don't need g in regex PHP, preg_replace() in PHP already replaces all matches globally by default, the g flag 
//  is a JavaScript thing, not PHP.
//what is (?!rock\b) do? → negative lookahead
//- (? ... ) → a lookahead — checks ahead without consuming characters.
//- ?! → negative lookahead — match only if the pattern inside does not occur.
//- rock → Literal text “rock”.
//- \b → Word boundary (position between a word character \w and a non-word character \W or string edges).
//so: (?!rock\b) says: “From here, make sure the upcoming word is not exactly rock.”
//whats \b do? → word boundary
//- this ensures the match starts at the boundary of a word.
//- without this, it could match inside words like bedrock.
//what is \w+ do? → word characters
//- \w → Any word character [A-Za-z0-9_] (in JavaScript regex, it does not include accented letters unless using Unicode mode /u).
//- + → One or more of the preceding token.
//so: \w+ matches a whole word like apple, car, stone.

//Codewars - Grasshopper (Grade Book)
//Complete the function so that it finds the average of the three scores passed to it and returns the letter value
//associated with that grade.
//Numerical Score			Letter Grade
//  90 	<= score <= 100			'A'
//  80 	<= score < 90			'B'
//	70 	<= score < 80			'C'
//	60 	<= score < 70			'D'
//	 0 	<= score < 60			'F'
//Tested values are all between 0 and 100. Theres is no need to check for negative values or values greater than 100.
function getGrade($a, $b, $c) {
    $avg = ($a + $b + $c) / 3;
    if ($avg >= 90) {
        return "A";
    } else if ($avg >= 80) {
        return "B";
    } else if ($avg >= 70) {
        return "C";
    } else if ($avg >= 60) {
        return "D";
    } else {
        return "F";
    }
}
//Pro solution 1
function getGrade1($a, $b, $c) {
    $tmp = ($a + $b + $c) / 3;
    if ($tmp >= 90) return 'A';
    if ($tmp >= 80) return 'B';
    if ($tmp >= 70) return 'C';
    if( $tmp >= 60) return 'D'; 
    return 'F';
} //more simplified if conditional statement syntax
//Pro solution 2
function getGrade2($a, $b, $c) {
    $score = ($a + $b + $c) / 3;
    return match(true) {
        $score >= 90 => 'A',
        $score >= 80 => 'B',
        $score >= 70 => 'C',
        $score >= 60 => 'D',
        default => 'F',
    };
} //match expression is a powerful feature introduced in PHP 8.0. It is often presented as a modern, 
//superior alternative to the switch statement, but it's more accurate to think of it as a more powerful 
//and strict "expression" version of switch, this is the key features of match syntax L
//- it returns a value: unlike switch, which is a control structure, match is an expression, this allows 
//  for more concise code as you don't need a break statement for each case. The entire expression returns
//  a single value.
//- strict comparison (===): match performs strict comparison by default, this means it checks both the 
//  value and the type, which helps prevent unexpected behavior that can sometimes occur with switch's 
//  loose comparison (==).
//- no fall-through: the match expression does not "fall through" from one case to the next. The first 
//  matching case is executed, and then the expression immediately returns. This eliminates the need for 
//  break statements.
//- required default clause: you must include a default case to handle all possibilities, if no default is 
//  provided and none of the cases match, PHP will throw an UncaughtValueError.
//- match(true): in this example, the expression being matched is true, this is a common pattern that 
//  makes the match expression behave like a series of if/else if statements, it evaluates each condition 
//  on the left side of => ($score >= 90, etc.) in order until one evaluates to true, and then returns the 
//  corresponding value on the right.
//Pro solution 3
function getGrade3($a, $b, $c) {
    $avg = ($a + $b + $c) / 3;
    switch (true) {
        case $avg < 60:
            return "F";
        case $avg < 70:
            return "D";
        case $avg < 80:
            return "C";
        case $avg < 90:
            return "B";
    }
    return "A";
} //using switch instead of doing if statement repeatedly
//Pro solution 4
function getGrade4($a, $b, $c) {
    $mean = (int)(($a + $b + $c) / 3); 
    $grade = str_split('ABCDF'); 
    $result = (ceil((100 - $mean) / 10)) > 5 ? 5 : (ceil((100 - $mean) / 10)); 
    return  $result == 0 ? $grade[$result] : $grade[$result - 1]; 
}

//Codewars - Count the Divisors of a Number
//Count the number of divisors of a positive integer n. Random tests go up to n = 500000, but fixed tests
//go higher. Input output example :
//4 -> 3 (we have 3 divisors - 1, 2 and 4)
//5 -> 2 (we have 2 divisors - 1 and 5)
//12 -> 6 (we have 6 divisors - 1, 2, 3, 4, 6 and 12)
//30 -> 8 (we have 8 divisors - 1, 2, 3, 5, 6, 10, 15 and 30)
function divisors(int $n): int {
    $count = 0;
    for ($i = $n; $i > 0; $i--) {
        if ($n % $i == 0) {
            $count++;
        }
    }
    return $count;
}
//My other solution 
function divisors0(int $n): int {
    $count = 1;
    for ($i = 1; $i <= $n / 2; $i++) {
        if ($n % $i == 0) {
            $count++;
        }
    }
    return $count;
}
//Pro solution 1
function divisors1(int $n): int {
    $count = 0;
    for ($i = 1; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            if ($i == $n / $i) {
                $count++;
            } else {
                $count += 2;
            }
        }
    }
    return $count;
} //this is the fast way divisors always come in pairs, if $i is a divisor of $n, then $n / $i is also a 
//divisor, for $n = 100, the divisor pairs are: (1, 100), (2, 50), (4, 25), (5, 20), (10, 10).
//notice that after we reach the square root (10), the pairs start to repeat, we only need to find one 
//divisor in each pair, and we can find the other by simple division, 
//so basically we decrease the looping, we do loop just untill the root of the number (root number 
//included), when $i = that root number then $count +1 (for that root number), but when $i isn't that root 
//number and $n % $i == 0, then we do $count +2 (for that $i and it's pair)
//Pro solution 2
function divisors2($n) {
    for ($i = 1; $i <= $n / 2; $i++) {
        if ($n % $i == 0) $div++;
    }
    return $div + 1; 
} //same as my other solution but do +1 for the result in the last (for $n % $n itself)
//Pro solution 3
function divisors3($n) {
    return count(array_filter(range(1, $n), function($d)use($n) {return $n % $d == 0;}));
} //do filter for array in range 1 untill $n, the if eaach element match the closure function rules, it
//would be included in the new array (this is array_filter's result), then just count it how much we got
//let's understand more about this syntax function($d)use($n) {return $n % $d == 0;}
//- function($d) → defines an anonymous function (a closure).
//- use ($n) → tells PHP: “this closure should also capture $n from the outer scope.”
//- inside, you can use $n even though it’s not defined inside the function.
?>