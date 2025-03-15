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