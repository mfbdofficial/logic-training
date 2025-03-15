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

//Codewars - Sort and Star
//You will be given a list of strings. You must sort it alphabetically (case-sensitive, and based on the 
//ASCII values of the chars) and then return the first value. The returned value must be a string, and 
//have "***" between each of its letters. You should not remove or add elements from/to the array
function twoSort(s) {
    s.sort();
    let firstElement = s[0];
    let resultString = firstElement[0];
    for (let i = 1; i < firstElement.length; i++) {
        resultString += '***' + firstElement[i];
    }
    return resultString;
}
//Pro solution 1
function twoSort(s) {
    return s.sort()[0].split('').join('***'); //sorting lalu ambil element pertama, di-split, lalu 
} //digabung pakai join() dengan pemisah '***'
//Pro solution 2
const twoSort = s => s.sort()[0].split('').join('***');

//Codewars - Write Number in Expanded Form
//You will be given a number and you will need to return it as a string in Expanded Form. For example:
//12 -> "10 + 2"
//45 -> "40 + 5"
//70304 -> "70000 + 300 + 4"
function expandedForm(num) {
    let expanded = "";
    for (let i = 0; i < num.toString().length; i++) {
        if (num.toString()[i] !== "0") {
            if (expanded === "") {
                expanded += num.toString()[i];
            } else {
                expanded += ' + ' + num.toString()[i];
            } 
            for (let j = i + 1; j < num.toString().length; j++) {
                expanded += "0";
            }
        } 
    }
    return expanded;
}
//Pro solution 1
const expandedForm = n => n.toString().split("").reverse()
                            .map( (a, i) => a * Math.pow(10, i))
                            .filter(a => a > 0)
                            .reverse()
                            .join(" + "); //belum dianalisa
//Pro solution 2
function expandedForm(num) {
    return String(num).split("")
            .map((num, index, arr) => num + "0".repeat(arr.length - index -1 ))
            .filter((num) => Number(num) != 0)
            .join(" + ")
} //belum dianalisa
//Pro solution 3
function expandedForm(num) {
	num = String(num);
	let result = [];
	for (var i = 0; i < num.length; i++) {
		if (num[i] == 0) continue;
		else result.push(num[i] + "0".repeat(num.length -i -1))
	}
	return result.join(" + ")
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
function dayOfProgrammer(year) {
    if (year == 1918) {
        return "26.09.1918";
    }
    if (year > 1918) {
        if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)) {
            return "12.09." + year;
        } else {
            return "13.09." + year;
        }
    } else {
        if (year % 4 == 0) {
            return "12.09." + year;
        } else {
            return "13.09." + year;
        }
    }
}
//Pro solution 1
function dayOfProgrammer(year) {
    if (year == 1918) {
        return `26.09.${year}`; //corner case
    } else if (year > 1918) {
        const isLeapYear = (year % 4 == 0) && (year % 100 != 0) || year % 400 == 0; //calculating leap year in Gregorian Calendar
        return `${isLeapYear ? 12 : 13}.09.${year}`;
    } else {
        return `${year % 4 == 0 ? 12 : 13}.09.${year}`; //calculating leap year in Julian Calendar
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
function points(games) {
    let points = 0;
    for (let i = 0; i < games.length; i++) {
        let scores = games[i].split(":");
        if (scores[0] > scores[1]) {
            points += 3;
        } else if (scores[0] == scores[1]) {
            points += 1;
        }
    }
    return points;
}
//Pro solution 1
const points = games => games.reduce((output,current) => {
    return output += current[0] > current[2] ? 3 : current[0] === current[2] ? 1 : 0;
}, 0);
//Pro solution 2
const points = g => g.reduce((a, [x, _, y]) => a + (x > y ? 3 : x == y), 0);

//Codewars - Regex Validate PIN Code
//ATM machines allow 4 or 6 digit PIN codes and PIN codes cannot contain anything but exactly 4 digits or 
//exactly 6 digits. If the function is passed a valid PIN string, return true, else return false.
//"1234" -> true
//"12345" -> false
//"a234" -> false
function validatePIN (pin) {
    if (pin.length === 4 || pin.length === 6) {
        return /^\d+$/.test(pin);
    } else {
        return false;
    }
}
//Pro solution 1
function validatePIN(pin) {
    return /^(\d{4}|\d{6})$/.test(pin); //just use regex for 4 digits and 6 digits
}
//Pro Solution 2
function validatePIN (pin) {
    var pinlen = pin.length;
    var isCorrectLength = (pinlen == 4 || pinlen == 6);
    var hasOnlyNumbers = pin.match(/^\d+$/);
    if(isCorrectLength && hasOnlyNumbers){
        return true;
    }
    return false;
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
function bonAppetit(bill, k, b) {
    let length = bill.length;
    bill.splice(k, 1);
    let sum = 0;
    for (let i = 0; i < length; i++) {
        if (bill[i]) {
            sum += bill[i];
        }
    }
    let actual = sum / 2;
    if (actual === b) {
        console.log("Bon Appetit");
    } else {
        console.log(b - actual);
    }
}
