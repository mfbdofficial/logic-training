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

//Codewars - Lario and Muigi Pipe Problem
//Codewars - Lario and Muigi Pipe Problem
//Looks like some hoodlum plumber and his brother has been running around and damaging your stages again.
//The pipes connecting your level's stages together need to be fixed before you receive any more complaints.
//The pipes are correct when each pipe after the first is 1 more than the previous one. Given a list of 
//unique numbers sorted in ascending order, return a new list so that the values increment by 1 for each 
//index from the minimum value up to the maximum value (both included).
//[1, 3, 5, 6, 7, 8] -> [1, 2, 3, 4, 5, 6, 7, 8]
function pipeFix(numbers){
    let first = numbers[0];
    let last = numbers[numbers.length - 1];
    let result = [];
    for (let i = first; i <= last; i++) {
        result.push(i);
    }
    return result;
}
//Pro solution 1
let pipeFix = numbers => Array.from({length: numbers.pop() - numbers[0] + 1}, (v, i) => i + numbers[0]);
//pro solution 2
const pipeFix = numbers => Array(numbers.pop() - numbers[0] + 1).fill(0).map((e, i) => i + numbers[0]);
//Pro solution 3
function pipeFix(numbers) {
    let results = [], i = Math.min(...numbers);
    while(i <= Math.max(...numbers)) { 
        results.push(i); 
        i++; 
    }
    return results
}

//Codewars - Replace All Vowel to Exclamation Mark in the Sentence
//Replace all vowel to exclamation mark in the sentence. aeiouAEIOU is vowel.
//"Hi!" -> "H!!"
//"!Hi! Hi!" -> "!H!! H!!"
//"aeiou" -> "!!!!!"
//"ABCDE" -> "!BCD!"
function replace(s) {
    let exclamation = "";
    for (let i = 0; i < s.length; i++) {
        if (/[aiueo]/i.test(s[i])) {
            exclamation += "!";
        } else {
            exclamation += s[i];
        }
    }
    return exclamation;
}
//Pro solution 1
function replace(s){
    return s.replace(/[aeoiu]/ig, '!'); //beda ig dan gi di regex itu apa?
}
//Pro solution 2
function replace(s){
    return s.replace(/[aeiou]/gi,"!")
}
//Pro solution 3
const replace = s => (s.split('').map(e => 'aeiou'.includes(e.toLowerCase()) ? '!' : e)).join('');

//HackerRank - Sales by Match
//There is a large pile of socks that must be paired by color. Given an array of integers representing 
//the color of each sock, determine how many pairs of socks with matching colors there are. Example:
//n = 7, ar = [1, 2, 1, 2, 1, 3, 2] -> 2 (There is one pair of color 1 and one of color 2. There are 
//three odd socks left, one of each color. The number of pairs is 2)
//n = 9, ar = [10, 20, 20, 10, 10, 30, 50, 10, 20] -> 3 (2 pairs of 10 & 1 pair of 20)
function sockMerchant(n, ar) {
    let colorsDone = [];
    let pairs = 0;
    for (let i = 0; i < n; i++) {
        let count = 0;
        if (!colorsDone.includes(ar[i])) {
            let current = ar[i];
            colorsDone.push(ar[i]);
            for (let j = 0; j < n; j++) {
                if (current == ar[j]) {
                    count++;
                }
                if (count == 2) {
                    pairs++;
                    count = 0;
                }
            }
        }
    }
    return pairs;
}
//Pro solution 1
function sockMerchant(n, ar) {
    var res = 0;
    ar.sort(); //sorting the array
    for(let i = 0; i < n; i++) { //looping for sorted array
        if(ar[i] == ar[i + 1]) { //check if current index same as next index
            i++; //if same the index will increse faster, precedes (mendahului) that next index
            res++; //the result is increase (+1)
        }
    }
    return res;
}
//Pro solution 2
function sockMerchant(n, ar) {
    let storage = {}; //the concept is making a toggle for every color of the socks (false/true toggle)
    let pairs = 0; 
    for (var i = 0; i < n; i++) { 
        storage[ar[i]] = !storage[ar[i]]; //saat pertama lewat, toggle nyala jadi true, kalo toggle kedua ya bikin jadi false
        if (!storage[ar[i]]) pairs++; //every the 2nd toggle will do counter up for pairs (when current situation is false)
    }
    return pairs;
}
//First Time a Sock Appears
//  -storage[ar[i]] is initially undefined (falsy).
//  -!undefined is true, so storage[ar[i]] = true.
//  -No pair is counted.
//Second Time the Same Sock Appears
//  -storage[ar[i]] = true (from previous appearance).
//  -!true becomes false, so storage[ar[i]] = false.
//  -Now if (!storage[ar[i]]) is true, so pairs++.

//Codewars - Opposites Attract
//Timmy & Sarah think they are in love, but around where they live, they will only know once they pick a flower 
//each. If one of the flowers has an even number of petals and the other has an odd number of petals it means they 
//are in love. Write a function that will take the number of petals of each flower and return true if they are in 
//love and false if they aren't.
function lovefunc(flower1, flower2) {
    if (flower1 % 2 == flower2 % 2) {
        return false;
    }
    return true;
}
//Pro Solution 1
function lovefunc(flower1, flower2){
    return flower1 % 2 !== flower2 % 2;
}
//Pro Solution 2
function lovefunc(flower1, flower2){
    return (flower1 + flower2) % 2 === 1;
}
//Pro Solution 3
         const
        lovefunc
      =( Ͼ , Ͽ )=> 
          ! !
( ( Ͼ & 1) ^ (1 & Ͽ ) ); //how tf this is work haha

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
function printerError(s) {
    let counter = 0;
    for (let i = 0; i < s.length; i++) {
        if (!/[a-m]/.test(s[i])) {
            counter++;
        }
    }
    return counter + "/" + s.length;
}
//Pro Solution 1
const printerError = s => `${s.replace(/[a-m]/gi, "").length}/${s.length}`;
//Pro Solution 2
var printerError = s => (s.match(/[n-z]/g) || []).length + '/' + s.length;
//Pro Solution 3
const printerError = (s) => [ (s.match(/[n-z]/g) || []).length, s.length ].join('/');

//HackerRank - Drawing Book
//Always turn pages one at a time. When they open the book, page  is always on the right side: When they flip page 1,
//they see pages 2 and 3. Each page except the last page will always be printed on both sides. The last page may only 
//be printed on the front, given the length of the book. If the book is n pages long, and a student wants to turn to
//page p, what is the minimum number of pages to turn? They can start at the beginning or the end of the book.
//n = 5, p = 3 -> 1 (flip 1 page from front, flip 1 page from back)
//n = 6, p = 2 -> 1 (flip 1 page from front, flip 2 page from back)
//n = 5, p = 4 -> 0 (flip 2 page from front, flip 0 page from back)
function pageCount(n, p) {
    let front = Math.floor(p / 2);
    let back = 0;
    if (n % 2 != 0) {
        back = Math.floor((n - p) / 2);
    } else {
        back = Math.ceil((n - p) / 2);
    }
    return front < back ? front : back;
}

//Codewars - Return Negative
//In this simple assignment you are given a number and have to make it negative. But maybe the number is already 
//negative? 1 -> -1, -5 -> -5, 0 -> 0, 0,12 -> -0,12
function makeNegative(num) {
    return num > 0 ? 0 - num : num;
}
//Pro solution 1
function makeNegative(num) {
    return -Math.abs(num);
}
//Pro solution 2
function makeNegative(num) {
    return num < 0 ? num : -num;
}

//Codewars - Keep Up the Hoop
//Alex just got a new hula hoop, he loves it but feels discouraged because his little brother is better than him. 
//Write a program where Alex can input (n) how many times the hoop goes round and it will return him an encouraging 
//message:
//- If Alex gets 10 or more hoops, return the string "Great, now move on to tricks".
//- If he doesn't get 10 hoops, return the string "Keep at it until you get it".
function hoopCount (n) {
    return n >= 10 ? "Great, now move on to tricks" : "Keep at it until you get it";
}
//Pro solution 1
const hoopCount = n => n < 10 ? 'Keep at it until you get it' : 'Great, now move on to tricks';
//Pro solution 2
function hoopCount (n) {
    if (n >= 10) {
        return "Great, now move on to tricks";
    } else {
        return "Keep at it until you get it";
    }
}

//HackerRank - Counting Valleys
//An avid hiker keeps meticulous records of their hikes. During the last hike that took exactly "steps" steps, for 
//every step it was noted if it was an uphill, U, or a downhill, D step. Hikes always start and end at sea level, 
//and each step up or down represents a 1 unit change in altitude. We define the following terms:
//- A mountain is a sequence of consecutive steps above sea level, starting with a step up from sea level and ending 
//  with a step down to sea level.
//- A valley is a sequence of consecutive steps below sea level, starting with a step down from sea level and ending 
//  with a step up to sea level.
//steps = 8, path = "UDDDUDUU" -> 1 (If we represent _ as sea level, a step up as /, and a step down as \, the hike 
//can be drawn as (the hiker enters and leaves 1 valley):
//_/\      _
//   \    /
//    \/\/
function countingValleys(steps, path) {
    let altitude = 0;
    let isValley = false;
    let valleyCount = 0;
    for (let i = 0; i < path.length; i++) {
        if (path[i] == "U") {
            altitude++;
        } else {
            altitude--;
        }
        if (altitude < 0) {
            isValley = true;
        }
        if (isValley && altitude == 0) {
            isValley = false;
            valleyCount++;
        }
    }
    return valleyCount;
}
//Pro solution 1
function countingValleys(n, s) {
    let seaLevel = 0;
    let currLevel = 0;
    let valleys = 0; 
    for (let i = 0; i < s.length; i++) {
        if (s[i] === 'U') {
            currLevel += 1;
            if (currLevel == 0) {
                valleys += 1;
            }
        } else {
            currLevel -= 1;
        }     
    }  
    return valleys;
}