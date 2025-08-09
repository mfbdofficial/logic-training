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
?>