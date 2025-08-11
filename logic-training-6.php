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
?>