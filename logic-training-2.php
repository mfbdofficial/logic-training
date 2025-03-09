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