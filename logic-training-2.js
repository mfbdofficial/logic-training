//Codewars - Rock Paper Scissors
//Let's play! You have to return which player won! In case of a draw return Draw!.
//"scissors", "paper" -> "Player 1 won!"
//"scissors", "rock" -> "Player 2 won!"
//"paper", "paper" -> "Draw!"
function rps(p1, p2) {
    if (p1 == p2) {
        return "Draw!";
    }
    if (p1 == "rock" && p2 == "scissors" || p1 == "paper" && p2 == "rock" || p1 == "scissors" && p2 == "paper") {
        return "Player 1 won!";
    } else {
        return "Player 2 won!";
    }
};
//Pro solution 1
function rps(p1, p2) {
    if (p1 === p2) {
        return "Draw!";
    }
    var rules = {rock: "scissors", paper: "rock", scissors: "paper"}; //memanfaatkan bentuk object key properti
    if (p2 === rules[p1]) { //sebagai opsi yg menang, lalu value properti sebagai opsi yg dikalahkannya
        return "Player 1 won!"; //cek apakah nilai p2 sesuai sebagai value yg kalah dengan key p1?
    } else {
        return "Player 2 won!";
    }
};
//Pro solution 2
function rps(p1, p2) {
    if(p1 === p2) {
        return 'Draw!'
    }; 
    return `Player ${/rockscissors|scissorspaper|paperrock/.test(p1 + p2) ? 1 : 2} won!`; //pakai regex
} //cek apakah jika teks p1 dan p2 jika digabungkan sesuai regex-nya? kalo true maka p1 menang

//Codewars - Make Upper Case
//Write a function which converts the input string to uppercase.
function makeUpperCase(str) {
    return str.toUpperCase();
}
//Pro solution 1
const makeUpperCase = str => str.toUpperCase();

//HackerRank - Migratory Birds
//Given an array of bird sightings where every element represents a bird type id, determine the id of the 
//most frequently sighted type. If more than 1 type has been spotted that maximum amount, return the 
//smallest of their ids.
//[1, 1, 2, 2, 3] -> 1 (types 1 & 2 is the most frequently sighted, choose the lower id, 1 < 2)
//[1, 4, 4, 4, 5, 3] -> (types 4 is the most frequently sighted)
function migratoryBirds(arr) {
    let idExists = [];
    for (let i = 0; i < arr.length; i++) {
        if (!idExists.includes(arr[i])) {
            idExists.push(arr[i]);
        }
    }
    idExists.sort();
    let currentFrequentlyLowest;
    let max = 0;
    for (let j = 0; j < idExists.length; j++) {
        let counter = 0;
        for (let k = 0; k < arr.length; k++) {
            if (idExists[j] == arr[k]) {
                counter++;
            }
        }
        if (counter > max) {
            currentFrequentlyLowest = j;
            max = counter;
        }
    }
    return idExists[currentFrequentlyLowest];
}
//Pro solution 1
function migratoryBirds(arr) {
    let spotted = new Array(5).fill(0); //buat array kosong
    for (let bird of arr) { //bird sebagai value dari arr
        spotted[bird - 1] = (spotted[bird - 1] || 0) + 1; //bird - 1 dijadikan sebagai key, juga melakukan
    } //counter up jika sudah ada
    return spotted.indexOf(Math.max(...spotted)) + 1; //mencari key dari value counter yg maximum
}
//Pro solution 2
function migratoryBirds(arr) { //belum selesai dianalisa
    let sorted = arr.sort();
    let ans = sorted[0];
    let maxOccur = 1,
        counter = 0;
    for (let i = 0; i < sorted.length; i++) {
        counter = (sorted[i] === sorted[i-1]) ? counter + 1 : 0;
        if (counter > maxOccur) {
            ans = sorted[i];
            maxOccur = counter;
        }
    }
    return ans;
}