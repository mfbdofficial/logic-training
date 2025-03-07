<?php
//Codewars - Find The Capitals
//Write a function that takes a single non-empty string of only lowercase and uppercase ascii letters 
//(word) as its argument, and returns an ordered list containing the indices of all capital (uppercase) 
//letters in the string.
//"CodEWaRs" --> [0,3,4,6]
function capitals($word) {
    $indexUpperCase = [];
    for($i = 0; $i < strlen($word); $i++) {
        if(preg_match("/[A-Z]/", $word[$i])) {
            $indexUpperCase[] = $i;
        }
    }
    return $indexUpperCase;
};

//Codewars - Testing 1-2-3
//Your team is writing a fancy new text editor and you've been tasked with implementing the line 
//numbering. Write a function which takes a list of strings and returns each line prepended by the correct 
//number.The numbering starts at 1. The format is n: string. Notice the colon and space in between.
//[] --> []
//["a", "b", "c"] --> ["1: a", "2: b", "3: c"]
function number(array $lines): array {
    $prependedCorrectNumber = [];
    for($i = 0; $i < count($lines); $i++) {
        $stringNumber = strval($i + 1);
        $prependedCorrectNumber[] = $stringNumber . ": " . $lines[$i];
    }
    return $prependedCorrectNumber; // your code here
}
//pro solution 1
function number(array $lines): array {
    return array_map(function($l, $k){ //langsung mapping $l itu index-nya, $k itu value-nya
        return ($k + 1).": ".$l; //return bentuk seperti ini
    }, $lines, array_keys($lines)); //$lines menjadi $l, lalu array_keys($lines) menjadi $k
}

//Codewars - Persistent Bugger
//Write a function, persistence, that takes in a positive parameter num and returns its multiplicative 
//persistence, which is the number of times you must multiply the digits in num until you reach a single 
//digit.
//39 --> 3 (because 3*9 = 27, 2*7 = 14, 1*4 = 4 and 4 has only one digit, there are 3 multiplications)
//999 --> 4 (because 9*9*9 = 729, 7*2*9 = 126, 1*2*6 = 12, and finally 1*2 = 2, there are 4 multiplications)
//4 --> 0 (because 4 is already a one-digit number, there is no multiplication)
function persistence(int $num): int {
    $count = 0;
    while($num >= 10) {
        $nums = str_split(strval($num));
        $num = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            $num = $num * $nums[$i];
        }
        $count++;
    }
    return $count;
}
//pro solution 1
function persistence(int $num): int {
    $count = 0;
    while ($num > 9) {
        $num = array_product(str_split($num));
        $count++;
    }
    return $count;
}

//Codewars - No Zeros for Heroes
//Numbers ending with zeros are boring. They might be fun in your world, but not here. Get rid of them. 
//Only the ending ones.
//1450 -> 145; 960000 -> 96; 1050   -> 105; -1050 -> -105; 0 -> 0
function noBoringZeros(int $n): int {
    $nums = str_split(strval($n));
    if(count($nums) == 1) {
        return $n;
    }
    for($i = count($nums) - 1; $i >= 0; $i--) {
        if($nums[$i] == 0) {
            array_pop($nums);
        } else {
            return intval(implode("", $nums));
        }
    }
    return $n;
}
//Pro solution 1
function noBoringZeros(int $n): int {
    return (int) rtrim($n,'0');
}

//Codewars - Volume of a Cuboid
//Bob needs a fast way to calculate the volume of a cuboid with three values: the length, width and height 
//of the cuboid. Write a function to help Bob with this calculation.
function get_volume_of_cuboid($length, $width, $height) {
    return $length * $width * $height;
}
//Pro solution 1
function get_volume_of_cuboid(...$arg) : int {
    return array_product($arg);
}

//Codewars - Remove Anchor from URL
//Complete the function/method so that it returns the url with anything after the anchor (#) removed.
//"www.codewars.com#about" --> "www.codewars.com"
//"www.codewars.com?page=1" --> "www.codewars.com?page=1"
function replaceAll($string) {
    $cleanURL = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if ($string[$i] == "#") {
            return $cleanURL;
        }
        $cleanURL .= $string[$i];
    }
    return $cleanURL;
}
//Pro solution 1
function replaceAll($string) {
    return explode("#", $string)[0]; //explode (pisahkan) string berdasarkan "#" lalu ambil yg pertama
} //saja, yaitu index ke 0
//Pro solution 2
function replaceAll(string $string) :string {
    return preg_replace('/#.*$/', '', $string); //pakai regex, ganti bagian yg "#..." (ada anchor,
} //juga karakter seterusnya) menjadi string kosong ''
//Pro solution 3
function replaceAll($s) {
    return strtok($s, "#");
}

//Codewars - Check for factor
//Factors are numbers you can multiply together to get another number.
//2 and 3 are factors of 6 because: 2 * 3 = 6
//You can find a factor by dividing numbers. If the remainder is 0 then the number is a factor. You can
//use the mod operator (%) in most languages to check for a remainder
function checkForFactor($base, $factor) {
    return $base % $factor == 0 ? true : false;
}
//Pro solution 1
function checkForFactor($base, $factor) {
    return $base % $factor === 0;
}
//Pro solution 2
function checkForFactor($base, $factor) {
    return !($base % $factor);
}

//Codewars - Get the Middle Character
//You are going to be given a non-empty string. Your job is to return the middle character(s) of the 
//string. If the string's length is odd, return the middle character. If the string's length is even, 
//then return the middle 2 characters.
function getMiddle($text) {
    $middleIndex = floor(strlen($text) / 2); //floor membulatkan angka ke bawah
    if (strlen($text) % 2 == 0) {
        return $text[$middleIndex - 1] . $text[$middleIndex];
    } else {
        return $text[$middleIndex];
    }
}
//Pro solution 1
function getMiddle($text) {
    $len = strlen($text);
    if ($len % 2 === 0) {
        return substr($text, $len / 2 - 1, 2); //substr mengambil string mulai dari urutan tertentu,
    } //lalu dengan jumlah karakter tertentu
    return substr($text, $len / 2, 1);
}
//Pro solution 2
function getMiddle($text) {
	$start = floor((strlen($text) - 1) / 2); //floor membulatkan angka ke  bawah
    $len = strlen($text) % 2 ? 1 : 2; //kalo hasil % 2 = 0 maka menjadi false, kalo 1 maka menjadi true
	return substr($text, $start, $len);
}

//Codewars - Build Tower
//Build a pyramid-shaped tower, as an array/list of strings, given a positive integer number of floors. 
//A tower block is represented with "*" character. For example, a tower with 3 floors looks like this:
//[
//    "  *  ",
//    " *** ", 
//    "*****"
//]
function tower_builder(int $n): array {
    $arrPyramid = [];
    $current1 = $n - 1;
    $current2 = 0; 
    for($i = 0; $i < $n; $i++) { //perulangan untuk baris sesuai $n
        $element = "";
        for($j = 0; $j < $n; $j++) { //perulangan untuk string bintang di bagian kiri $n
            if($j < $current1) {
                $element .= " ";
            } else {
                $element .= "*";
            }
        }
        for($k = 0; $k < $n - 1; $k++) { //perulangan untuk string bintang di bagian kanan $n - 1
            if($k < $current2) {
                $element .= "*";
            } else {
                $element .= " ";
            }
        }
      $current1 = $current1 - 1;
      $current2++;
      $arrPyramid[] = $element;
    }
    return $arrPyramid;
}
//Model memakai 1 current counter dows
function tower_builder(int $n): array {
    $arrPyramid = [];
    $current = $n - 1; //current pembanding memakai angka dari $n
    for($i = 0; $i < $n; $i++) {
      $element = "";
        for($j = 0; $j < $n; $j++) {
            if($j < $current) {
                $element .= " ";
            } else {
                $element .= "*";
            }
        }
        for($k = $n - 1; $k > 0; $k--) { //model for ini harus terbalik karena align bintang terbalik
            if($k > $current) {
                $element .= "*";
            } else {
                $element .= " ";
            }
        }
        $current = $current - 1;
        $arrPyramid[] = $element;
    }
    return $arrPyramid;
}
//Pro solution 1
function tower_builder(int $n): array {
    $pad = $n * 2 - 1;
    $x = 1; 
	$arr = [];
    while ($n --> 0) {
    	$arr[] = str_pad(str_repeat('*', $x), $pad, ' ', STR_PAD_BOTH);
        $x += 2;
    }
    return $arr;
}
//Pro solution 2
function tower_builder(int $n): array {
    $result = array();
    for($i = 1; $i <= $n; $i++) {
        $result[] = str_repeat(' ', $n-$i) . str_repeat('*', ($i-1)*2+1) . str_repeat(' ', $n-$i);
    }
    return $result;
}

//Codewars - Counting Duplicates
//Write a function that will return the count of distinct case-insensitive alphabetic characters and 
//numeric digits that occur more than once in the input string. The input string can be assumed to contain 
//only alphabets (both uppercase and lowercase) and numeric digits.
//"abcde" -> 0 -> no characters repeats more than once)
//"aabbcde" -> 2 -> 'a' and 'b'
//"aabBcde" -> 2 -> 'a' occurs twice and 'b' twice (`b` and `B`)
//"indivisibility" -> 1 -> 'i' occurs six times
//"Indivisibilities" -> 2 -> 'i' occurs seven times and 's' occurs twice
function duplicateCount($text) {
    $alreadyThere = []; //array kosong untuk riwayat element yg sudah ada
    $count = 0; //counter jika ditemukan yg sesuai kriteria
    for ($i = 0; $i < strlen($text); $i++) { //perulangan semua character
        $state = false; //keadaan awal saat belum membandingkan
        if (!in_array(strtolower($text[$i]), $alreadyThere)) { //hanya jalan untuk character yg belum ada
            for ($j = $i + 1; $j < strlen($text); $j++) { //perulangan dengan character pembanding
                if (strcasecmp($text[$i], $text[$j]) == 0) { //cek apakah char sama (case-insensitive)?
                    $state = true; //kalo ada yg sama maka state true
                }
            }
            $alreadyThere[] = strtolower($text[$i]); //masukkan ke riwayat
        }
        if ($state == true) { //state true akan mengakibatkan counter up
            $count++; 
        }
    }
    return $count;
}
//Pro solution 1
function duplicateCount($text) {
    $dupCount = 0; //counter
    $text = array_count_values(str_split(strtolower($text))); //text jadikan lowercase, dipisah jadi array
    foreach ($text as $val) { //perulangan dari hasil array_count_values()
        if ($val > 1) { 
            $dupCount = $dupCount+1; //kalo frekuensi-nya lebih dari 1 maka counter up
        }   
    }
    return $dupCount;
}
//NOTE : array_count_values() returns an array using the values of array (which must be ints or strings) 
//as keys and their frequency in array as values.
//Pro solution 2
function duplicateCount($text) {
    $text = strtolower($text);
    $count = 0;
    foreach (count_chars($text, 1) as $val) { 
        if ($val > 1) {
            $count++;
        }
    }
    return $count;
}
//NOTE : count_chars(string $string, int $mode = 0): array|string, Counts the number of occurrences of 
//every byte-value (0..255) in string and returns it in various ways. There's some mode in count_chars() :
//0 - an array with the byte-value as key and the frequency of every byte as value.
//1 - same as 0 but only byte-values with a frequency greater than zero are listed.
//2 - same as 0 but only byte-values with a frequency equal to zero are listed.
//3 - a string containing all unique characters is returned.
//4 - a string containing all unused characters is returned.

//Codewars - Array.diff
//Implement a function that computes the difference between two lists. The function should remove all 
//occurrences of elements from the first list (a) that are present in the second list (b). The order 
//of elements in the first list should be preserved in the result.
//If a = [1, 2] and b = [1], the result should be [2].
//If a = [1, 2, 2, 2, 3] and b = [2], the result should be [1, 3].
function arrayDiff($a, $b) {
    $lengthA = count($a); //kenapa bikin variable baru?
    for ($i = 0; $i < count($b); $i++) {
        for  ($j = 0; $j < $lengthA; $j++) { //karena nanti kita akan hapus element di $a maka nilai
            if (isset($a[$j])) { //dari count($a) akan berubah dan mengacaukan looping
                if ($b[$i] == $a[$j]) {
                    unset($a[$j]); //menghapus value dari array $a maka count($a) berubah (memendek)
                }
            }
        }
    }
    $newArr = [];
    foreach ($a as $value) {
        $newArr[] = $value;
    }
    return $newArr;
}
//Pro solution 1
function arrayDiff($a, $b) {
    return array_values(array_diff($a, $b)); //array_diff() menghapus array yg ada di array pembanding,
} //lalu langsung array_values() untuk pebaiki urutan index array-nya
//Pro solution 2
function arrayDiff($a, $b) {
	foreach ($a as $key => $element){ //perulangan untuk array $a-nya
		if (in_array($a[$key], $b)){ //cek apakah ada di array pembanding $b?
			unset($a[$key]); //kalo ada langsung unset()
        };
    }
	return array_values($a);
}

//Codewars - Delete Occurrences of An Element If It Occurs More Than N Times
//Alice and Bob were on a holiday. Both of them took many pictures of the places they've been, and 
//now they want to show Charlie their entire collection. However, Charlie doesn't like these sessions, 
//since the motif usually repeats. He isn't fond of seeing the Eiffel tower 40 times. He tells them that 
//he will only sit for the session if they show the same motif at most N times. 
//[1, 2, 3, 1, 2, 1, 2, 3] & 2 -> [1, 2, 3, 1, 2]
//[20, 37, 20, 21] & 1 -> [20, 37, 21]
function deleteNth($arr, $n) {
    $list = [];
    for ($i = 0; $i < count($arr); $i++) {
        $count = 0;
        for ($j = 0; $j < count($list); $j++) {
            if ($arr[$i] == $list[$j]) {
                $count++;
            }
        }
        if ($n > $count) {
            $list[] = $arr[$i];
        }
    }
    return $list;
}

//Codewars - You're a Square!
//Given an integral number, determine if it's a square number. In mathematics, a square number or perfect
//square is an integer that is the square of an integer; in other words, it is the product of some 
//integer with itself.
//-1  =>  false, 0  =>  true, 3  =>  false, 4  =>  true, 25  =>  true, 26  =>  false
function isSquare($n) {
    if (floor(sqrt($n)) == sqrt($n)) {
        return true;
    }
    return false;
}
//Pro solution 1
function isSquare($n) {
    return !fmod(sqrt($n), 1);
}

//HackerRank - Breaking the Records
//Given the scores for a season, determine the number of times that score breaks it's records for most 
//and least points scored during the season.
//Description, breakingRecords has the following parameter(s): int scores[n]: points scored per game
//Returns int[2]: An array with the numbers of times she broke her records. Index  is for breaking most 
//points records, and index  is for breaking least points records.
//[10, 5, 20, 20, 4, 5, 2, 25, 1] -> [2, 4]
//Explanation : 10 5  20 20 4  5  2  25 1
//              00 01 11 11 12 12 13 23 24
//[3, 4, 21, 36, 10, 28, 35, 5, 24, 42] -> [4, 0]
//Explanation : 3  4  21 36 10 28 35 5  24 42
//              00 10 20 30 30 30 30 30 30 40
function breakingRecords($scores) {
    $countMax = 0;
    $countMin = 0;
    $currentMax = $scores[0];
    $currentMin = $scores[0];
    for ($i = 1; $i < count($scores); $i++) {
        if ($scores[$i] > $currentMax) {
            $currentMax = $scores[$i];
            $countMax++;
        } else if ($scores[$i] < $currentMin) {
            $currentMin = $scores[$i];
            $countMin++;
        }
    }
    return [$countMax, $countMin];
}

//Codewars - Unique In Order
//Implement the function unique_in_order which takes as argument a sequence and returns a list of items 
//without any elements with the same value next to each other and preserving the original order of elements.
//"AAAABBBCCDAABBB" -> ['A', 'B', 'C', 'D', 'A', 'B']
//"ABBCcAD"  -> ['A', 'B', 'C', 'c', 'A', 'D']
//[1,2,2,3,3] -> [1,2,3]
//[] or "" -> []
function uniqueInOrder($iterable) {
    if (is_array($iterable)) {
        if (count($iterable) === 0) {
            return [];
        }
        $itemList = [$iterable[0]];
        for ($i = 1; $i < count($iterable); $i++) {
            if ($iterable[$i] !== $itemList[count($itemList) - 1]) {
                $itemList[] = $iterable[$i];
            }
        }
        return $itemList;
    }
    if ($iterable == "") {
        return [];
    }
    $itemList = [$iterable[0]];
    for ($j = 1; $j < strlen($iterable); $j++) {
        if ($iterable[$j] !== $itemList[count($itemList) - 1]) {
            $itemList[] = $iterable[$j];
        }
    }
    return $itemList;
}
//Pro solution 1
function uniqueInOrder($iterable) { 
    $arr = is_string($iterable) ? str_split($iterable) : $iterable; //jika string maka diubah jadi array
    $ret = array_reduce($arr, function($carry, $item) { //array_reduce() applies iteratively the callback
        if ($item != end($carry)) { //function to the elements of the array
            $carry[] = $item;
        }
        return $carry;
    }, []); //parameter terakhir [] disebut initial, If the optional initial is available, it will be 
    return $ret; //used at the beginning of the process, or as a final result in case the array is empty.
}
//Pro solution 2
function uniqueInOrder($iterable) {
    return array_values(array_filter(!is_array($iterable) ? str_split($iterable) : $iterable, function($current, $index) use ($iterable) {
        return ($current !== $iterable[$index - 1]);
    }, 1)); //array_filter mode 1
}
//NOTE : array_filter() Iterates over each value in the array passing them to the callback function. 
//If the callback function returns true, the current value from array is returned into the result array.
//Ada 2 mode array_filter() : 
//1. ARRAY_FILTER_USE_KEY - pass key as the only argument to callback instead of the value
//2. ARRAY_FILTER_USE_BOTH - pass both value and key as arguments to callback instead of the value

//Codewars - Is This a Triangle
//Implement a function that accepts 3 integer values a, b, c. The function should return true if a 
//triangle can be built with the sides of given length and false in any other case.
//1,2,2 -> true
//4,2,3 -> true
//2,2,2 -> true
//1,2,3 -> false
//-5,1,3 -> false
//0,2,3 -> false
//1,2,9 -> false 
function isTriangle(int $a, int $b, int $c): bool { //Syarat segitiga (simak di bawah):
    if ($a <= 0 || $b <= 0 || $c <= 0) { //tidak boleh ada sisi yg sepanjang 0 atau lebih kecil dari 0
        return false;
    }
    if ($a >= $b && $a >= $c) {
        $longestSide = $a;
        $sidesLeft = [$b, $c];
    } else if ($b >= $a && $b >= $c) {
        $longestSide = $b;
        $sidesLeft = [$a, $c];
    } else if ($c >= $a && $c >= $b) {
        $longestSide = $c;
        $sidesLeft = [$a, $b];
    } 
    if ($longestSide < ($sidesLeft[0] + $sidesLeft[1])) { //sisi yg paling panjang tidak melebihi hasil
        return true; //jumlah dari 2 sisi lainnya yg lebih pendek (bayangkan saja, 2 sisi pendek jika
    } //dijumlahkan sama saja itu posisinya sudah lurus dan jadi garis sambung panjang, jika 1 sisi yg
    return false; //paling panjang digabungkan, maka gaakan bisa buat bentuk segitiga atau garis bablas)
}
//Pro solution 1
function isTriangle(int $a, int $b, int $c): bool {
    $arr = array($a, $b, $c);
    sort($arr);
    return $arr[0] + $arr[1] > $arr[2];
}
//Pro solution 2
function isTriangle(int $a, int $b, int $c): bool {
    return 2 * max($a, $b, $c) < $a + $b + $c; //sisi yg paling panjang jika dikali 2 maka hasilnya ga
} //melebihi atau sama dengan jumlah keseluruhan sisi?

//Codewars - Round Up to the Next Multiple of 5
//Given an integer as input, can you round it to the next (greater than or equal) multiple of 5?
//0 -> 0, 2 -> 5, 3 -> 5, 12 -> 15, 21 -> 25, 30 -> 30, -2 -> 0, -5 -> -5
function round_to_next_5(int $n): int{
    if ($n % 5 == 0) {
        return $n; 
    }
    return ceil($n / 5) * 5;
}
//Pro solution 1
function round_to_next_5(int $n): int{ 
    while ($n % 5 !== 0) {
        $n++;
    } 
    return $n;
}
//Pro solution 2
function round_to_next_5(int $n): int {
    for ($i = 0; $i <= 5; $i++) {
        if (($n + $i) % 5 === 0) return $n + $i;
    }
}

//HackerRank - Subarray Division
//Two children, Lily and Ron, want to share a chocolate bar. Each of the squares has an integer on it.
//Lily decides to share a contiguous segment of the bar selected such that:
//-The length of the segment matches Ron's birth month.
//-The sum of the integers on the squares is equal to his birth day.
//Determine how many ways she can divide the chocolate.
//s = [2, 2, 1, 3, 2]; d = 4; m = 2 -> 2 (from [2 + 2] and [1 + 3])
//s = [1, 1, 1, 1, 1, 1]; d = 3; m = 2 -> 0 (tidak ada deret sepanjang m=2 yg kalo di-sum hasilnya d = 3)
//s = [4, 1]; d = 2; m = 1 -> 1 (deret di-sum-kan sejauh 1 yg hasilnya 4 hanya ada 1)
function birthday($s, $d, $m) {
    $count = 0;
    for ($i = 0; $i < count($s); $i++) {
        $sum = 0;
        if ($i + $m - 1 < count($s)) {
          for ($j = $i; $j < $i + $m; $j++) {
            $sum += $s[$j];
          }  
        }
        if ($sum == $d) {
            $count++;
        }
    }
    return $count;
}
//Pro solution 1
function birthday($s, $d, $m) {
    $count = 0;
	for ($i = 0; $i <= count($s)-$m; $i++) {
		$sum = array_sum(array_slice($s, $i, $m)); //this way is more simple to get the sum of current
		if ($sum == $d) {
			$count++;
		}
	}
	return $count;
} //not tried it yet

//Codewars - Two to One
//Take 2 strings s1 and s2 including only letters from a to z. Return a new sorted string (alphabetical 
//ascending), the longest possible containing distinct letters, each taken only once, coming from s1 or s2.
//a = "xyaabbbccccdefww" & b = "xxxxyyyyabklmopq" -> "abcdefklmopqwxy"
//a = "abcdefghijklmnopqrstuvwxyz" & b = "abcdefghijklmnopqrstuvwxyz" -> "abcdefghijklmnopqrstuvwxyz"
function longest($a, $b) {
    $allString = $a . $b;
    $allStringArr = str_split($allString);
    sort($allStringArr);
    $newArr = [$allStringArr[0]];
    for ($i = 1; $i < count($allStringArr); $i++) {
        if ($newArr[count($newArr) - 1] !== $allStringArr[$i]) {
            $newArr[] = $allStringArr[$i];
        } 
    }
    return implode($newArr);
}
//Pro solution 1
function longest($a, $b) {
    return count_chars($a . $b, 3);
}
//Pro solution 2
function longest($a, $b) {
    $chars = array_unique(str_split($a . $b));
    sort($chars);
    return implode('', $chars);
}

//Codewars - Playing with Digits
//Some numbers have funny properties. For example:
//89 --> 8¹ + 9² = 89 * 1
//695 --> 6² + 9³ + 5⁴= 1390 = 695 * 2
//46288 --> 4³ + 6⁴+ 2⁵ + 8⁶ + 8⁷ = 2360688 = 46288 * 51
//Given two positive integers n and p, we want to find a positive integer k, if it exists, such that the 
//sum of the digits of n raised to consecutive powers starting from p is equal to k * n. In other words, 
//writing the consecutive digits of n as a, b, c, d ..., is there an integer k such that :
//(a^p + b^(p+1) + c^(p+2) + d^(p+3) + ...)
//If it is the case we will return k, if not return -1 (n and p will always be strictly positive integers)
//n = 89; p = 1 -> 1 since 8¹ + 9² = 89 = 89 * 1
//n = 92; p = 1 -> -1 since there is no k such that 9¹ + 2² equals 92 * k
//n = 695; p = 2 -> 2 since 6² + 9³ + 5⁴= 1390 = 695 * 2
//n = 46288; p = 3 -> 51 since 4³ + 6⁴+ 2⁵ + 8⁶ + 8⁷ = 2360688 = 46288 * 51
function digPow($n, $p) {
    $nArr = str_split($n);
    $sumAll = 0;
    for ($i = 0; $i < count($nArr); $i++) {
        $sumElement = $nArr[$i];
        for ($j = 0; $j < $p + $i - 1; $j++) {
            $sumElement *= $nArr[$i];
        }
        $sumAll += $sumElement;
    }
    if ($sumAll % $n == 0) {
        return $sumAll / $n;
    }
    return -1;
}
//Pro solution 1
function digPow($n, $p) {
    $mathSum = 0;
    foreach (str_split((string)$n) as $index => $value) {
        $mathSum += pow($value, $index + $p);
    }
    return (is_int($mathSum / $n)) ? $mathSum / $n : -1;
}
//Pro solution 2
function digPow($n, $p) {
    $digits = str_split($n); // Split $n into array
    array_walk($digits, function (&$elem, $index, $param) { $elem = pow($elem, $param + $index); }, $p);
    $calc_result = array_sum($digits); //calculate sum
    return (($calc_result % $n == 0) ? ($calc_result / $n) : -1);  //return $calc_result / $n if
} //$calc_result % $n == 0, return -1 otherwise
//NOTE : array_walk() in this code is for walk through digits to calculate x ^ p + index

//HackerRank - Divisible Sum Pairs
//Given an array of integers and a positive integer k, determine the number of (i, j) pairs where 
//i < j and  ar[i] + ar[j] is divisible by k. Example 
//n = 6; k = 5; ar = [1, 2, 3, 4, 5, 6] -> 3 (Three pairs meet the criteria: [1, 4], [2, 3], and [4, 6].
//n = 6; k = 3; ar = [1, 3, 2, 6, 1, 2] -> 5 (Three pairs meet the criteria: [1, 2], [1, 2], [3, 6],
//[2, 1] & [1, 2]
//Intinya cari jumlah ada berapa pair (pasangan angka) kalo yg keduanya dijumlahkan itu bise dibagi pas
//dengan k sebagai divisor (sisa jumlahnya jika dibagi k adalah 0)
function divisibleSumPairs($n, $k, $ar) {
    $count = 0;
    for($i = 0; $i < $n; $i++) {
        if ($i + 1 < $n){
            for ($j = $i + 1; $j < $n; $j++) {
                if (($ar[$i] + $ar[$j]) % $k == 0) {
                    $count++;
                }
            }
        }
    }
    return $count;
}