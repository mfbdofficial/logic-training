<?php
//Codewars - Rock Paper Scissors
//Let's play! You have to return which player won! In case of a draw return Draw!.
//"scissors", "paper" -> "Player 1 won!"
//"scissors", "rock" -> "Player 2 won!"
//"paper", "paper" -> "Draw!"
function rpc ($p1, $p2) {
    if ($p1 == $p2) {
        return "Draw!";
    }
    if ($p1 == "rock") {
        if ($p2 == "scissors") {
            return "Player 1 won!";
        } else if ($p2 == "paper") {
            return "Player 2 won!";
        }
    }
    if ($p1 == "paper") {
        if ($p2 == "rock") {
            return "Player 1 won!";
        } else if ($p2 == "scissors") {
            return "Player 2 won!";
        }
    }
    if ($p1 == "scissors") {
        if ($p2 == "paper") {
            return "Player 1 won!";
        } else if ($p2 == "rock") {
            return "Player 2 won!";
        }
    }
}
//Pro solution 1
function rpc ($p1, $p2) {
    if ($p1 === $p2) {
        return 'Draw!';
    } 
    if ($p1 === 'rock' && $p2 === 'scissors' || $p1 === 'scissors' && $p2 === 'paper' || $p1 === 'paper' && $p2 === 'rock') {
        return 'Player 1 won!'; //langsung cek saja cera bersamaan apakah menang? pakai logic OR
    } else { //selain menang? maka kalah
        return 'Player 2 won!';
    }
}
//Pro Solution 2
function rpc ($p1, $p2) {
    $whatDoesItBeat = ['rock' => 'scissors', 'paper' => 'rock', 'scissors' => 'paper']; //array associative
    if ($p1 === $p2) { //opsi yg menang menjadi key, value sebagai opsi yg dikalahkannya
        return 'Draw!';
    }
    return 'Player ' . ($whatDoesItBeat[$p1] === $p2 ? '1' : '2') . ' won!'; //return langsung teks dan
} //cek apakah key dan value sesuai? kalo true berarti player 1 menang, kalo alse berarti player 2 menang

//Codewars - Make Upper Case
//Write a function which converts the input string to uppercase.
function makeUpperCase(string $input): string {
    return strtoupper($input);
} 

//HackerRank - Migratory Birds
//Given an array of bird sightings where every element represents a bird type id, determine the id of the 
//most frequently sighted type. If more than 1 type has been spotted that maximum amount, return the 
//smallest of their ids.
//[1, 1, 2, 2, 3] -> 1 (types 1 & 2 is the most frequently sighted, choose the lower id, 1 < 2)
//[1, 4, 4, 4, 5, 3] -> (types 4 is the most frequently sighted)
function migratoryBirds($arr) {
    $idExists = [];
    for ($i = 0; $i < count($arr); $i++) {
        if (!in_array($arr[$i], $idExists)) {
            $idExists[] = $arr[$i];
        }
    }
    sort($idExists);
    $currentFrequentlyLowest;
    $max = 0;
    for ($j = 0; $j < count($idExists); $j++) {
        $counter = 0;
        for ($k = 0; $k < count($arr); $k++) {
            if ($idExists[$j] == $arr[$k]) {
                $counter++;
            }
        }
        if ($counter > $max) {
            $currentFrequentlyLowest = $j;
            $max = $counter;
        }
    }
    return $idExists[$currentFrequentlyLowest];
}
//Pro solution 1
function migratoryBirds($arr) {
    $counts = array_count_values($arr); //array_count_values() returns a new array using the values of old array as keys and their frequency in old array as values.
    ksort($counts); //ksort() will sorts array in place by keys in ascending order.
    arsort($counts); //arsort() urutkan array dari yg value paling besar, kalo value sama urutannya tetap
    return array_key_first($counts); //array_key_first() get first key of an associative array 
} 
//NOTE: //arsort() sorts array in place in descending order, such that its keys maintain their 
//correlation with the values they are associated with. This is used mainly when sorting associative arrays 
//where the actual element order is significant.
//Pro solution 2
function migratoryBirds($arr) {
    $res = array(0, 0, 0, 0, 0); //buat array kosong
    for($i = 0; $i < count($arr); $i++) {
        $res[$arr[$i]]++; //push array key tertentu dan counter up untuk value key tersebut
    }
    return (array_keys($res, max($res)))[0]; //array_keys() mengambil key dari array berdasarkan value,
} //di sini value yg diambil adalah yg besarnya maximum, lalu ambil untuk yg index pertama saja (0)

//Codewars - Sort and Star
//You will be given a list of strings. You must sort it alphabetically (case-sensitive, and based on the 
//ASCII values of the chars) and then return the first value. The returned value must be a string, and 
//have "***" between each of its letters. You should not remove or add elements from/to the array
function twoSort(array $arr): string {
    sort($arr);
    $firstElement = $arr[0];
    $resultString = $firstElement[0];
    for ($i = 1; $i < strlen($firstElement); $i++) {
        $resultString .= "***" . $firstElement[$i];
    }
    return $resultString; // your code here
}
//Pro solution 1
function twoSort($s) {
    asort($s); //sort() will sort an associative array in ascending order, according to the value
    return implode('***', str_split(array_shift($s))); //array element pertama diambil, lalu di-split
} //kemudian digabungkan (implode) dengan pemisah '***'
//NOTE: array_shift() shifts the first value of the array off and returns it, shortening the array by 
//one element and moving everything down. All numerical array keys will be modified to start counting 
//from zero while literal keys won't be affected.
//Pro solution 2
function twoSort( array $s ) : string {
    return implode('***', str_split(min($s))); //ambil nilai array yg minimum, di-split lalu implode juga
}

//Codewars - Write Number in Expanded Form
//You will be given a number and you will need to return it as a string in Expanded Form. For example:
//12 -> "10 + 2"
//45 -> "40 + 5"
//70304 -> "70000 + 300 + 4"
function expanded_form(int $n): string {
    $expanded = "";
    for ($i = 0; $i < strlen(strval($n)); $i++) {
        if (strval($n)[$i] !== "0") {
            if ($expanded === "") {
                $expanded .= strval($n)[$i];
            } else {
                $expanded .= " + " . strval($n)[$i];
            }
            for ($j = $i + 1; $j < strlen(strval($n)); $j++) {
                $expanded .= "0";
            }
        }
    }
    return $expanded;
}
//Pro solution 1
function expanded_form(int $n): string {
    $split = str_split($n);
    $num_digits = count($split);
    $numbers_arr = [];
    foreach ($split as $digit) {
        if ($digit != 0) {
            $numbers_arr[] = $digit . str_repeat(0, $num_digits - 1);
        }
        $num_digits--;
    }
    return implode(' + ', $numbers_arr);
} //belum dianalisa
//Pro solution 2
function expanded_form(int $n): string {
	for($i = strlen($n), $a = []; $i > 0;) {
		$a[] = $n - ($j = $n % (10 ** (--$i)));
		$n = $j;
	}
	return implode(' + ', array_filter($a));
} //belum dianalisa

//HackerRank - Day of the Programmer
//Marie invented a Time Machine and wants to test it by time-traveling to visit Russia on the Day of 
//the Programmer (the 256th day of the year) during a year in the inclusive range from 1700 to 2700.
//From 1700 to 1917, Russia's official calendar was the Julian calendar; since 1919 they used the Gregorian 
//calendar system. The transition from the Julian to Gregorian calendar system occurred in 1918, when the 
//next day after January 31st was February 14th. This means that in 1918, February 14th was the 32nd day 
//of the year in Russia. 
//In both calendar systems, February is the only month with a variable amount of days; it has 29 days 
//during a leap year, and 28 days during all other years. In the Julian calendar, leap years are divisible 
//by 4; in the Gregorian calendar, leap years are either of the following:
//Divisible by 400 || Divisible by 4 and not divisible by 100.
//Given a year, y, find the date of the 256th day of that year according to the official Russian calendar 
//during that year. Then print it in the format dd.mm.yyyy, where dd is the two-digit day, mm is the 
//two-digit month, and yyyy is y.
//2017 -> "13.09.2017" (In the year y = 2017, January has 31 days, February has 28 days, March has 31 days, 
//April has 30 days, May has 31 days, June has 30 days, July has 31 days, and August has 31 days. When we 
//sum the total number of days in the first eight months, we get 31 + 28 + 31 + 30 + 31 + 30 + 31 + 31 = 243. 
//Day of the Programmer is the 256th day, so then calculate 256 - 243 = 13 to determine that it falls on 
//day 13 of the 9th month {September})
//2016 -> "12.09.2016" (we get 31 + 29 + 31 + 30 + 31 + 30 + 31 + 31 = 244. Day of the Programmer is the 
//256th day, so then calculate 256 - 244 = 12 to determine that it falls on day 12 of the 9th month {September})
//1800 -> "12.09.1800" (Since 1800 is leap year as per Julian calendar. Day lies on 12 September.)
function dayOfProgrammer($year) {
    if ($year == 1918) {
        return "26.09.1918";
    }
    if ($year > 1918) {
        if ($year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0)) {
            return "12.09." . $year;
        } else {
            return "13.09." . $year;
        }
    } else {
        if ($year % 4 == 0) {
            return "12.09." . $year;
        } else {
            return "13.09." . $year;
        } 
    }
}
//Pro solution 1
function dayOfProgrammer($year) {
    $system = match (true) {
        $year < 1918 => "julian",
        $year > 1918 => "gregorian",
        default => "transition",
    };
    $isLeapYear = false;
    switch ($system) {
        case "julian":
            $isLeapYear = $year % 4 === 0;
            break;
        case "gregorian":
            $isLeapYear = $year % 400 === 0 || $year % 4 === 0 && $year % 100 !== 0;
            break;
        default:
            return "26.09.1918";
            break;
    }
    if ($isLeapYear) {
        return "12.09.$year";
    } else {
        return "13.09.$year";
    }
}

//Codewars - Total Amount of Points
//Our football team's match results are recorded in a collection of strings. Each match is represented 
//by a string in the format "x:y", where x is our team's score and y is our opponents score. For example:
//["3:1", "2:2", "0:1", ...]. Points are awarded for each match as follows:
//if x > y: 3 points (win)
//if x < y: 0 points (loss)
//if x = y: 1 point (tie)
//We need to write a function that takes this collection and returns the number of points our team (x) got 
//in the championship by the rules given above.
//['1:0','2:0','3:0','4:0','2:1','3:1','4:1','3:2','4:2','4:3'] -> 30 (10 wins, 0 loss, 0 tie)
//['1:1','2:2','3:3','4:4','2:2','3:3','4:4','3:3','4:4','4:4'] -> 10 (0 win, 0 loss, 10 ties)
//['1:0','2:0','3:0','4:4','2:2','3:3','1:4','2:3','2:4','3:4'] -> 12 (3 wins, 4 losses, 3 ties)
function points(array $games): int {
    $points = 0;
    for ($i = 0; $i < count($games); $i++) {
        $scores = explode(":", $games[$i]);
        if ($scores[0] > $scores[1]) {
            $points += 3;
        } else if ($scores[0] == $scores[1]) {
            $points += 1;
        } 
    }
    return $points;
}
//Pro solution 1
function points(array $games): int {
    return array_sum(array_map(function($e) {
        list($x, $y) = explode(':', $e);
        return $x > $y ? 3 : ($x < $y ? 0 : 1);
    }, $games));
}

//Codewars - Regex Validate PIN Code
//ATM machines allow 4 or 6 digit PIN codes and PIN codes cannot contain anything but exactly 4 digits or 
//exactly 6 digits. If the function is passed a valid PIN string, return true, else return false.
//"1234" -> true
//"12345" -> false
//"a234" -> false
function validatePin(string $pin): bool {
    if (strlen($pin) == 4 || strlen($pin) == 6) { 
        return preg_match("/^\d+$/", $pin) ? true : false; //^ means start of string untill $ end of string
    } else { //then \d matches any digit, + means one or more times (we're using regex)
        return false;
    }
}
//Pro solution 1
function validatePin(string $pin): bool {
    return ctype_digit($pin) && (strlen($pin) === 4 || strlen($pin) === 6);
}
//Pro solution 2
function validatePin(string $pin): bool {
    return preg_match('/^\d{4}$|^\d{6}$/', $pin) === 1;
}

//HackerRank - Bill Division
//Two friends Anna and Brian, are deciding how to split the bill at a dinner. Each will only pay for the 
//items they consume. Brian gets the check and calculates Anna's portion. You must determine if his 
//calculation is correct. For example, assume the bill has the following prices: bill = [2, 4, 6]. Anna 
//declines to eat item k = bill[2] which costs 6. If Brian calculates the bill correctly, Anna will pay
//(2 + 4) / 2 = 3. If he includes the cost of bill[2], he will calculate (2 + 4 + 6) / 2 = 6. In the 
//second case, he should refund 3 to Anna.
//Complete the bonAppetit function in the editor below. It should print Bon Appetit if the bill is fairly 
//split. Otherwise, it should print the integer amount of money that Brian owes Anna. bonAppetit has the 
//following parameter(s):
//-bill: an array of integers representing the cost of each item ordered
//-k: an integer representing the zero-based index of the item Anna doesn't eat
//-c: the amount of money that Anna charged to the bill
//If Brian did not overcharge Anna, print Bon Appetit on a new line; otherwise, print the difference 
//(i.e., bill charged - bill actual) that Brian must refund to Anna. This will always be an integer.
//k = 1, bill = [3, 10, 2, 9], b = 12 -> 5
//k = 1, bill = [3, 10, 2, 9], b = 7 -> Bon Appetit
function bonAppetit($bill, $k, $b) {
    $length = count($bill);
    unset($bill[$k]);
    $sum = 0;
    for ($i = 0; $i < $length; $i++) {
        if (isset($bill[$i])) {
            $sum += $bill[$i];
        }
    }
    $actual = $sum / 2; //the food was eated together, so every food item will split by 2
    if ($b === $actual) {
        echo "Bon Appetit"; //in here the task is to print it out, so we use echo rather than just return
    } else {
        echo $b - $actual;
    }
}

//Codewars - Lario and Muigi Pipe Problem
//Looks like some hoodlum plumber and his brother has been running around and damaging your stages again.
//The pipes connecting your level's stages together need to be fixed before you receive any more complaints.
//The pipes are correct when each pipe after the first is 1 more than the previous one. Given a list of 
//unique numbers sorted in ascending order, return a new list so that the values increment by 1 for each 
//index from the minimum value up to the maximum value (both included).
//[1, 3, 5, 6, 7, 8] -> [1, 2, 3, 4, 5, 6, 7, 8]
function pipeFix(array $numbers): array {
    $first = $numbers[0];
    $last = $numbers[count($numbers) - 1];
    $result = [];
    for ($i = $first; $i <= $last; $i++) {
        $result[] = $i;
    }
    return $result; 
}
//Pro solution 1
function pipeFix($numbers) {
    return range(min($numbers), max($numbers));
}
//Pro solution 2
function pipeFix($a) {
    return range($a[0], $a[count($a) - 1]);
}

//Codewars - Replace All Vowel to Exclamation Mark in the Sentence
//Replace all vowel to exclamation mark in the sentence. aeiouAEIOU is vowel.
//"Hi!" -> "H!!"
//"!Hi! Hi!" -> "!H!! H!!"
//"aeiou" -> "!!!!!"
//"ABCDE" -> "!BCD!"
function replace(string $s): string {
    $exclamation = "";
    for ($i = 0; $i < strlen($s); $i++) {
        if (preg_match("/[aiueo]/i", $s[$i])) {
            $exclamation .= "!";
        } else {
            $exclamation .= $s[$i];
        }
    }
    return $exclamation;
}
//Pro solution 1
function replace(string $s): string {
    return preg_replace('/[aeiou]/i', "!", $s);
}
//Pro solution 2
function replace(string $s): string {
    return str_ireplace(['a', 'e', 'i', 'o', 'u'], '!', $s);
}
//Pro solution 3
function replace(string $s): string {
    return str_replace(str_split('aeiouAEIOU'), '!', $s);
}

//HackerRank - Sales by Match
//There is a large pile of socks that must be paired by color. Given an array of integers representing 
//the color of each sock, determine how many pairs of socks with matching colors there are. Example:
//n = 7, ar = [1, 2, 1, 2, 1, 3, 2] -> 2 (There is one pair of color 1 and one of color 2. There are 
//three odd socks left, one of each color. The number of pairs is 2)
//n = 9, ar = [10, 20, 20, 10, 10, 30, 50, 10, 20] -> 3 (2 pairs of 10 & 1 pair of 20)
function sockMerchant($n, $ar) {
    $colorsDone = [];
    $pairs = 0;
    for ($i = 0; $i < $n; $i++) {
        $count = 0;
        if (!in_array($ar[$i], $colorsDone)) {
            $current = $ar[$i];
            $colorsDone[] = $ar[$i];
            for ($j = 0; $j < $n; $j++) {
                if ($current == $ar[$j]) {
                    $count++;
                }
                if ($count == 2) {
                    $count = 0;
                    $pairs++;
                }
            }
        }
    }
    return $pairs;
}
//Pro solution 1
function sockMerchant($n, $ar) {
    $result = 0;
    $counted = array_count_values($ar); //array_count_values() returns a new array using the values of old array as keys and their frequency in old array as values.
    foreach($counted as $value) { //doing looping for every element of associative array (key -> frequency)
        $result += floor($value / 2); //doing result calculation for every element (result is increase)
    }
    return $result;
}
//Pro solution 2
function sockMerchant($n, $ar) {
    sort($ar);
    $counterPairs = 0;
    for ($i = 1; $i < count($ar); $i++) {
        if ($ar[$i] == $ar[$i - 1]) {
            $counterPairs++;
            array_splice($ar, $i - 1, 2); //splice an array start from certain index for certain length
            $i--;
        }
    } //the concept is like the array would be decrease (result increase) by the time if there's pair in sorted array
    return $counterPairs;
}

//Codewars - Opposites Attract
//Timmy & Sarah think they are in love, but around where they live, they will only know once they pick a flower 
//each. If one of the flowers has an even number of petals and the other has an odd number of petals it means they 
//are in love. Write a function that will take the number of petals of each flower and return true if they are in 
//love and false if they aren't.
function lovefunc(int $flower1, int $flower2) : bool{
    if ($flower1 % 2 == 0 && $flower2 % 2 == 0 || $flower1 % 2 != 0 && $flower2 %2 != 0) {
        return false;
    }
    return true;
}
//Pro Solution 1
function lovefunc(int $flower1, int $flower2) : bool {
    return ($flower1 % 2 !== $flower2 % 2);
}
//Pro Solution 2
function lovefunc($flower1, $flower2) {
    return (bool) (($flower1 + $flower2) % 2); //kalo angka yg sama dijumlahkan pasti hasilnya genap, kalo angka yg
} //beda dijumlahkan pasti hasilnya ganjil
//Pro Solution 3
function lovefunc($f1, $f2):bool {
    return ($f1 + $f2) % 2;
}

//Codewars - Printer Errors
//In a factory a printer prints labels for boxes. For one kind of boxes the printer has to use colors which, for the 
//sake of simplicity, are named with letters from a to m. The colors used by the printer are recorded in a control 
//string. For example a "good" control string would be aaabbbbhaijjjm meaning that the printer used three times color 
//a, four times color b, one time color h then one time color a...
//Sometimes there are problems: lack of colors, technical malfunction and a "bad" control string is produced e.g. 
//aaaxbbbbyyhwawiwjjjwwm with letters not from a to m. You have to write a function printer_error which given a 
//string will return the error rate of the printer as a string representing a rational whose numerator is the number
//of errors and the denominator the length of the control string. Don't reduce this fraction to a simpler expression.
//"aaabbbbhaijjjm" -> "0/14"
//"aaaxbbbbyyhwawiwjjjwwm" -> "8/22"
function printerError($s) {
    $counter = 0;
    for ($i = 0; $i < strlen($s); $i++) {
        if (!preg_match("/[a-m]/", $s[$i])) {
            $counter++;
        }
    }
    return $counter . "/" . strlen($s);
}
//Pro Solution 1
function printerError($s) {
    return strlen(preg_replace('/[a-m]/i', '', $s)) . '/' . strlen($s);
}
//Pro Solution 2
function printerError($s) {
    $errorCount = strlen(str_replace(range('a', 'm'), '', $s));
    $totalCount = strlen($s);
    return $errorCount . '/' . $totalCount;
}
//Pro Solution 3
function printerError($s) {
    return preg_match_all('/[^a-m]/', $s) . '/' . strlen($s);
}

//HackerRank - Drawing Book
