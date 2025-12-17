<?php
//Codewars - Scaling Squared Strings
//You are given a string of n lines, each substring being n characters long. For example:
//s = "abcd\nefgh\nijkl\nmnop"
//We will study the "horizontal" and the "vertical" scaling of this square of strings. A k-horizontal scaling of a 
//string consists of replicating k times each character of the string (except '\n'). Example: 
//2-horizontal scaling of s: => "aabbccdd\neeffgghh\niijjkkll\nmmnnoopp"
//A v-vertical scaling of a string consists of replicating v times each part of the squared string. Example: 
//2-vertical scaling of s: => "abcd\nabcd\nefgh\nefgh\nijkl\nijkl\nmnop\nmnop"
//Function scale(strng, k, v) will perform a k-horizontal scaling and a v-vertical scaling. Example: 
//a = "abcd\nefgh\nijkl\nmnop"
//scale(a, 2, 3) -> "aabbccdd\naabbccdd\naabbccdd\neeffgghh\neeffgghh\neeffgghh\niijjkkll\niijjkkll\niijjkkll\nmmnnoopp\nmmnnoopp\nmmnnoopp"
//abcd   ----->   aabbccdd
//efgh            aabbccdd
//ijkl            aabbccdd
//mnop            eeffgghh
//                eeffgghh
//                eeffgghh
//                iijjkkll
//                iijjkkll
//                iijjkkll
//                mmnnoopp
//                mmnnoopp
//                mmnnoopp
function scale($s, $k, $n) {
    if ($s == "") {
        return $s;
    }
    $sArray = explode("\n", $s);
    $sArrayLen = count($sArray);
    for ($i = 0; $i < $sArrayLen; $i++) {
        $current = str_split($sArray[$i]);
        $currentLen = count($current);
        for ($j = 0; $j < $currentLen; $j++) {
            $letter = "";
            for ($l = $k; $l > 0; $l--) {
                $letter .= $current[$j];
            }
            $current[$j] = $letter;
        }
        $sArray[$i] = join("", $current);
    }
    $sHorizontal = join("\n", $sArray);
    $sArrayHorizontal = explode("\n", $sHorizontal);
    $sArrayHorizontalLen = count($sArrayHorizontal);
    for ($m = 0; $m < $sArrayHorizontalLen; $m++) {
        $value = $sArrayHorizontal[$m];
        for ($p = $n; $p > 1; $p--) {
            $sArrayHorizontal[$m] .= "\n" . $value;
        }
    }
    return join("\n", $sArrayHorizontal);
}
//Pro solution 1
function scale1($s, $k, $n) {
    $lines = explode(PHP_EOL, $s); //split string $s into array of lines "abc\ndef" → ["abc", "def"].
    $result = ''; 
    foreach($lines as $line) {
        $hScaleString = ''; //initialize temporary string for the horizontally scaled version of this line.
        for($i = 0; $i < strlen($line); $i++) { //loop over characters, go through every character in the current line
            $hScaleString .= str_repeat($line[$i], $k); //repeat each character in $k times
        }
        $result .= str_repeat($hScaleString . PHP_EOL, $n); //after building one horizontally scaled line, repeat 
    } //the whole line $n times, each followed by a newline (vertical scaling). Append to $result.
    return $s ? trim($result) : ''; //if $s is not empty, remove trailing newline with trim().
}
//Pro solution 2
function scale2($s, $k, $n) {
    $s = preg_replace( '/[^\n]/',  str_repeat('$0', $k), "$s\n" ); //add an extra \n at the end with $s\n"
    $s = preg_replace( '/(\w*\n)/', str_repeat('$1', $n), $s );
    return trim($s);
} //in the first preg_replace(), [^\n]/ to match any character except newline, $0 will be the match itself, then
//repeat that itself element in $k times
//in the second preg_replace(), using regex /(\w*\n)/, when \w* → any word characters (letters, digits, underscore), 
//and \n → until newline, the whole thing is captured into $1 (so this $1 as a placeholder to the regex matched or 
//itself element like $0 before), then repeat the captured line $n times, finally we just trim() it to remove the
//last newline
//Pro solution 3
function scale3($s, $k, $n) {
    $result = '';
    foreach(explode("\n", $s) as $word) { //explode the string and do foreach at the same time
        $result .= str_repeat(implode('', array_map(function($letter) use($k) { //then we do str_repeat . "\n" for
            return str_repeat($letter, $k); //every line when that line itself is already mapped to be horizontally 
        }, str_split($word))) . "\n", $n); //scaled (with splited by str_split and repeated with str_repeat for 
    } //$k times)
    return trim($result); //finally we just trim() it to remove the last newline
}

//Codewars - Deodorant Evaporator
//This program tests the life of an evaporator containing a gas. We know the content of the evaporator (content in
//ml), the percentage of foam or gas lost every day (evap_per_day) and the threshold (threshold) in percentage
//beyond which the evaporator is no longer useful. All numbers are strictly positive. The program reports the nth
//day (as an integer) on which the evaporator will be out of use.
//evaporator(10, 10, 5) -> 29
//Mathematical explanation :
//you have: content = 10 ml, evap_per_day = 10% lost per day, threshold = 5% of the original content
//the evaporator becomes “out of use” when the current content < 5% of the initial content.
//5% of 10 ml = 0.5 ml, so the evaporator stops when the remaining content is < 0.5 ml.
//day-by-day explanation : each day, the content loses 10% (so it keeps 90%).
//let’s calculate the case manually:
//	Day 0: 10.000 ml
//	Day 1: 10 × 0.9 = 9.000
//	Day 2: 9 × 0.9 = 8.100
//	Day 3: 8.1 × 0.9 = 7.290
//	.....
//  continue until the amount < 0.5 ml
//the formula after n days: remaining = 10 × (0.9)^n
//we want: 10 × (0.9)^n < 0.5
//divide both sides by 10: (0.9)^n < 0.05
//now we solve using logs: n > ln(0.05) / ln(0.9)
//calculate: ln(0.05) ≈ -2.9957 and ln(0.9) ≈ -0.1053
//n > −2.9957 / −0.1053 ≈ 28.45
//Since days must be integers, we round up → 29 days.
function evaporator($content, $evap_per_day, $threshold) {
    $eligbilityLimits = ($content * $threshold) / 100; //calculate limit when evaporator considered out of use
    $dayCount = 0; //make a counter (as a days spent)
    while ($content > $eligbilityLimits) {
        $content = $content - ($content * $evap_per_day) / 100;
        $dayCount++;
    }
    return $dayCount;
} //the logic is just decrease the evaporator's content day-by-day, and stop looping when it's out of use
//Pro solution 1
function evaporator1($content, $evap_per_day, $threshold) {
    $size = 100; 
    $count = 0; 
    while ($size > $threshold) { //do looping as long as evaporator still useable
        $size -= $size * $evap_per_day / 100;
        $count++;
    }
    return $count;
} //same as before but the code is more short using -= syntax
//Pro solution 2
function evaporator2($content, $evap_per_day, $threshold): int {
    return 1 + floor(log($threshold / 100) / log((100 - $evap_per_day) / 100 ));
} //using math log equation
?>