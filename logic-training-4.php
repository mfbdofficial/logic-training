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
?>