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

//Codewars - Complementary DNA
//Deoxyribonucleic acid (DNA) is a chemical found in the nucleus of cells and carries the "instructions"
//for the development and functioning of living organisms. To know more: http://en.wikipedia.org/wiki/DNA
//In DNA strings, symbols "A" and "T" are complements of each other, as "C" and "G". Your function
//receives one side of the DNA (string, except for Haskell); you need to return the other complementary
//side. DNA strand is never empty or there is no DNA at all (again, except for Haskell).
//More similar exercise are found here: http://rosalind.info/problems/list-view/ (source)
//"ATTGC" -> "TAACG"
//"GTAT" -> "CATA"
//Meaning in science : In DNA, "complementary" means that the two strands of the double helix have a
//specific pairing rule where Adenine (A) always pairs with Thymine (T) and Cytosine (C) always pairs with
//Guanine (G). These specific pairings are held together by hydrogen bonds, forming the rungs of the DNA
//ladder and allowing the two strands to fit together perfectly, like a lock and key, ensuring accurate
//replication and information transfer.
//What does it mean for DNA to be complementary?
//Specific Pairing -> The chemical structures of the nitrogenous bases dictate that A can only form bonds
//with T, and C can only form bonds with G.
function DNA_strand(string $s): string {
    for ($i = 0; $i < strlen($s); $i++) {
        if ($s[$i] == "A") {
            $s[$i] = "T";
        } else if ($s[$i] == "T") {
            $s[$i] = "A";
        } else if ($s[$i] == "G") {
            $s[$i] = "C";
        } else {
            $s[$i] = "G";
        }
    }
    return $s;
}
//Pro solution 1
function DNA_strand1($dna) {
    return strtr($dna, 'ACGT', 'TGCA'); //this is strtr() character-by-character translation (three arguments)
} //strtr() function in PHP is used for character translation or substring replacement within a string. It can be 
//used in two main ways: 
//- Character-by-character translation (three arguments).
//  string strtr (string $string , string $from , string $to)
//  In this form, strtr() replaces every occurrence of each character found in the $from string with the 
//  corresponding character in the $to string. If $from and $to have different lengths, the extra characters in the 
//  longer string are ignored. 
//- Substring replacement using an associative array (two arguments):
//  string strtr (string $string , array $replace_pairs)
//  In this form, $replace_pairs is an associative array where the keys are the substrings to be replaced, and the 
//  values are their corresponding replacements. strtr() will look for the longest possible match first and will not 
//  attempt to replace content within parts of the string that have already been replaced by a previous operation 
//  within the same strtr() call. This behavior distinguishes it from str_replace(), which can replace within replacements. 
//Pro solution 2
function DNA_strand2($dna) {
    return strtr($dna, ['A'=>'T', 'T'=>'A', 'C'=>'G', 'G'=>'C']);
} //this is strtr() substring replacement using an associative array (two arguments)
//Pro solution 3
function DNA_strand3($dna) {
    $conversion = ["A"=>"T","T"=>"A","G"=>"C", "C"=>"G"]; //create associative array as data for mapping
    $dna = str_split($dna) ;
    $res = "" ; 
    foreach($dna as $el){
        $res .= $conversion[$el] ;  
    }
    return $res ; 
} //split into array of string, then do concatenation at the end based associative array (we maded as data for mapping)

//Codewars - Sum of the First N-th Term of Series
//Your task is to write a function which returns the n-th term of the following series, which is the sum of the
//first n terms of the sequence (n is the input parameter).
//Series : 1 + 1/4 + 1/7 + 1/10 + 1/13 + 1/16 + ...
//You will need to figure out the rule of the series to complete this. The rules is you need to round the answer to
//2 decimal places and return it as String. If the given value is 0 then it should return "0.00". You will only be
//given Natural Numbers as arguments.
//n = 1 -> 1.00
//n = 2 -> 1.25
//n = 3 -> 1.57
function series_sum(int $n): string {
    $denominator = 1;
    $sum = 0;
    for ($i = $n; $i > 0; $i--) {
        $sum = $sum + (1 / $denominator);
        $denominator += 3;
    }
    return strval(number_format($sum, 2));
} //number_format(<integer_or_float>, 2) to change the float to have 2 decimal places, strval() is to change int or
//float into string 
//Pro solution 1
function series_sum1($n) {
    $sum = 0;
    for ($i = 0; $i <= ($n - 1); $i++) { //if $n = 3 then $i will be 0, 1, 2 (do 3 looping)
        $sum += (1 / (1 + (3 * $i))); //in the first looping $i = 0, so 1 / (1 + (3 * 0)) = 1 / 1 = 1
    } 
    return number_format($sum, 2, '.', '');
}
//Pro solution 2
function series_sum2($n) {
    return $n <= 0 ? '0.00' : sprintf('%.2f', array_sum(array_map(function ($c) {return 1 / ($c * 3 + 1);}, range(0, $n - 1))));
} //range(0, $n - 1), range is 0 untill $n - 1 (let's say if $n = 3, then range will be in 0 untill 2 -> 0, 1, 2)
//array_map(), doing (have return value) a callback function for every rage, $c is the current element from range
//function ($c) {return 1 / ($c * 3 + 1);}, this is the callback function do calculaton for $c -> 0, 1, 2 then the 
//result would be 1, 1/4, 1/7
//array_sum(), is sum all the element that you got (ex in our case is 1 + 1/4 +1/7)
//sprintf('%.2f', <int_or_float>), then change the int or float into string (%.2f means include 2 decimal places)
//Pro solution 3
function series_sum3($n) {
    $result = (float)0;
    while ($n > 0) {
        $result += (1 / (1 + (--$n * 3)));
    }
    return number_format($result, 2);
} //--$n is pre-decrement → it decreases $n first, then uses the new value.
//$n-- is post-decrement → it uses $n first, then decreases afterward.
//so this means if $n = 3; then decreses it first before calculation, in in while loop the $n still will be 3, 2, 1
//but in calculation $n becoma 2, 1, 0 (we decrease it first before the calculation)

//Codewars - Functional Addition
//Create a function add(n)/Add(n) which returns a function that always adds n to any number
//Note for Java: the return type and methods have not been provided to make it a bit more challenging.
//$addOne = add(1);
//echo $addOne(3); -> 4
function add($n) {
    return function ($m) use ($n) {
        return $n + $m;
    };
}
//Pro solution 1
$add1 = fn($n) => fn($m) => $n + $m; //using arrow funtion syntax
//arrow functions fn automatically close over variables from the parent scope, so you don’t need to use ($n). And 
//you've to call that $add1 function like this 
//$addOne = $add(1);
//echo $addOne(3); -> 4
//Pro solution 2
$add2 = fn($n) => function ($m) use ($n) {
    return $n + $m;
}; //hybrid, using arrow function syntax first, then return with usual function, run it like this too
//$addOne = $add(1);
//echo $addOne(3); -> 4
//Pro solution 3
function add3($n) {
    return fn($m) => $n + $m;
} //hybrid, using usual function syntax first, then return with arrow function

//Codewars - A Rule of Divisibility by 13
//A divisibility rule is a shorthand way of determining whether a given integer is divisible by a fixed divisor
//without performing the division, usually by examining its digits. When you divide the successive powers of 10 by
//13 you get the following remainders of the integer divisions:
//1, 10, 9, 12, 3, 4
//because:
//10 ^ 0 ->  1 (mod 13)
//10 ^ 1 -> 10 (mod 13)
//10 ^ 2 ->  9 (mod 13)
//10 ^ 3 -> 12 (mod 13)
//10 ^ 4 ->  3 (mod 13)
//10 ^ 5 ->  4 (mod 13)
//why we only do this untill 10 ^ 5? because if we keep going the result would be repeated, for divisor = 13 the
//pattern is 1, 10, 9, 12, 3, 4 then it would be repeat again if we do 10 ^ 6, 10, ^ 7, 10 ^ 8, 10 ^ 9, 10 ^ 10,
//10 ^ 11 again, the result will be 1, 10, 9, 12, 3, 4 again (and continues so on), this pattern would be different
//based the divisor we're using, it this case. the rule is using 13.
//Then the whole pattern repeats. Hence the following method:
//Multiply
//- the right most digit of the number with the left most number in the sequence shown above,
//- the rsecond right most digit with the second left most digit of the number in the sequence.
//The cycle goes on and you sum all these products. Repeat this process until the sequence of sums is stationary.
//(stasioner = keadaan tetap, tidak bergerak, atau tidak berubah seiring waktu pada suatu sistem, objek, atau nilai)
//Example:
//What is the remainder when 1234567 is divided by 13?
//7      6     5      4     3     2     1  (digits of 1234567 from the right)
//×      ×     ×      ×     ×     ×     ×  (multiplication)
//1     10     9     12     3     4     1  (the repeating sequence)
//Therefore following the method we get:
//7×1 + 6×10 + 5×9 + 4×12 + 3×3 + 2×4 + 1×1 = 178
//We repeat the process with the number 178:
//8x1 + 7x10 + 1x9 = 87
//and again with 87:
//7x1 + 8x10 = 87
//From now on the sequence is stationary (we always get 87) and the remainder of 1234567 by 13 is the same as the
//remainder of 87 by 13 ( i.e 9).
//Task:
//Call thirt the function which processes this sequence of operations on an integer n (>=0). thirt will return the
//stationary number.
//thirt(1234567) calculates 178, then 87, then 87 and returns 87.
//thirt(321) calculates 48, 48 and returns 48
function thirt($n) {
    $prev = 0;
    while ($prev != $n) {
        $prev = $n;
        $sum = 0;
        for ($i = 0; $n > 0; $i++) {
            $lastDigit = $n % 10;
            $sum += $lastDigit * ((10 ** $i) % 13);
            $n = floor($n / 10);
        }
        $n = $sum;
    }
    return $n;
}
//Pro solution 1
function thirt1($n) {
    $sequence = [1, 10, 9, 12, 3, 4];
    $sum = 0;
    $index = 0;
    foreach (array_reverse(str_split($n)) as $char) {      
      $sum += (int)$char * $sequence[$index % 6];
      $index++;
    }
    return ($n === $sum) ? $n : thirt($sum);
} //need more research
//Pro solution 2
function thirt2($n) {
    $sum = 0;
    $s = strval($n);
    for($i = 0; $i < strlen($s); $i++){
      $sum += $s[strlen($s) - ($i+1)] * ((10 ** $i) % 13);
    }
    if($n == $sum){
      return $sum;
    }
    return thirt($sum);
} //need more research
//Pro solution 3
function thirt3($n) {
    $digits = str_split(strrev($n));
    $total = 0;
    foreach ($digits as $i => $digit) {
        $total += $digit * (10 ** $i % 13);
    }
    if ($total === $n)
        return $total;
    return thirt($total);
} //need more research
?>