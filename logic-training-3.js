//Codewars - Basic Mathematical Operations
//operation(string/char), value1(number), value2(number). The function should return result of numbers after applying 
//the chosen operation.
function basicOp(operation, value1, value2) {
    switch (operation) {
        case "+":
            return value1 + value2;
        case "-":
            return value1 - value2;
        case "*":
            return value1 * value2;
        default:
            return value1 / value2;
    }
}
//Pro solution 1
function basicOp(operation, value1, value2) {
    return eval(value1 + operation + value2);
}
//Pro solution 2
const basicOperations = {
    '+': (a,b) => a + b,
    '-': (a,b) => a - b,
    '*': (a,b) => a * b,
    '/': (a,b) => a / b,
}
const basicOp = (op, x, y) => basicOperations[op](x, y);

//Codewars - Remove Exclamation Marks
//Write function RemoveExclamationMarks which removes all exclamation marks from a given string.
//"Hello World!" -> "Hello World"
function removeExclamationMarks(s) {
    return s.replace(/!/gi, ""); //replace pakai regex, g for global, match all instances of the pattern in a string,
} //not just one and i for case-insensitive.
//Pro solution 1
function removeExclamationMarks(s) {
    return s.replace(/!/g, '');
}
//Pro solution 2
function removeExclamationMarks(s) {
    return s.split('!').join('');
}

//HackerRank - Electronics Shop
//A person wants to determine the most expensive computer keyboard and USB drive that can be purchased with a give
//budget. Given price lists for keyboards and USB drives and a budget, find the cost to buy them. If it is not 
//possible to buy both items, return -1.
//b = 60, keyboards = [40, 50, 60], drives = [5, 8, 12] -> 58 (the person can buy 40 keyboard + 12 USB drive = 52, 
//or a 50 keyboard + 8 USB drive = 58, choose the latter as the more expensive option, so return 58)
function getMoneySpent(keyboards, drives, b) {
    let maxBuy = -1;
    for (let i = 0; i < keyboards.length; i++) {
        for (let j = 0; j < drives.length; j++) {
            let spent = keyboards[i] + drives[j];
            if (spent > maxBuy && spent <= b) {
                maxBuy = spent;
            }
        }
    }
    return maxBuy;
}

//Codewars - Moving Zeros To The End
//Write an algorithm that takes an array and moves all of the zeros to the end, preserving the order of the other 
//elements.
//[false,1,0,1,2,0,1,3,"a"] -> [false,1,1,2,1,3,"a",0,0]
function moveZeros(arr) {
    let zeroFinded = 0;
    for (let i = 0; i < arr.length; i++) {
        if (arr[i] === 0 || arr[i] === 0.0) {
            arr.splice(i, 1); //saat melakukan splice() di JavaScript, index-nya itu akan bergeser tidak seperti PHP
            i--; //yang kalo unset() index-nya tetap menjadi bolong (melongkap)
            zeroFinded++;
        }
    }
    for (let j = 0; j < zeroFinded; j++) {
        arr.push(0);
    }
    return arr;
}
//Pro solution 1
var moveZeros = function (arr) {
    return arr.filter(function (x) {
        return x !== 0;
    }).concat(arr.filter(function (x) { //concat() menggabungkan 2 array disambung, mirip concatination string
        return x === 0;
    }));
}
//Pro solution 2
var moveZeros = function (arr) {
    return [...(arr.filter(n => n !== 0)), ...(arr.filter(n => n === 0))];
}
//Pro solution 3
function moveZeros(arr) {
    return arr.sort((a, b) => b === 0 ? -1 : 0);
}

//Codewars - Create Phone Number
//Write a function that accepts an array of 10 integers (between 0 and 9), that returns a string of those numbers in 
//the form of a phone number. 
//[1,2,3,4,5,6,7,8,9,0] -> "(123) 456-7890"
function createPhoneNumber(numbers) {
    return "(" + numbers[0] + numbers[1] + numbers[2] + ")" +
        " " + numbers[3] + numbers[4] + numbers[5] + "-" +
        numbers[6] + numbers[7] + numbers[8] + numbers[9];
}
//My other solution
function createPhoneNumber(numbers) {
    let phone = "(";
    for (let i = 0; i < numbers.length; i++) {
        phone += numbers[i];
        if (i == 2) {
            phone += ") ";
        }
        if (i == 5) {
            phone += "-";
        }
    }
    return phone;
}
//Pro solution 1
function createPhoneNumber(numbers){
    var format = "(xxx) xxx-xxxx";
    for(var i = 0; i < numbers.length; i++) {
      format = format.replace('x', numbers[i]);
    }
    return format;
}
//Pro solution 2
function createPhoneNumber(numbers){
    numbers = numbers.join('');
    return '(' + numbers.substring(0, 3) + ') ' + numbers.substring(3, 6) + '-' + numbers.substring(6);
}
//Pro solution 3
function createPhoneNumber(numbers){
    return numbers.join('').replace(/(...)(...)(.*)/, '($1) $2-$3');
}
//Pro solution 4
function createPhoneNumber(numbers){
    return numbers.reduce((p, c) => p.replace('x', c), "(xxx) xxx-xxxx");
}

//HackerRank - Cats and a Mouse
//Two cats and a mouse are at various positions on a line. You will be given their starting positions. Your task is 
//to determine which cat will reach the mouse first, assuming the mouse does not move and the cats travel at equal 
//speed. If the cats arrive at the same time, the mouse will be allowed to move and it will escape while they fight.
//U given x, y, z representing the respective positions for cats A and B, and for mouse C
//- If cat A catches the mouse first, print Cat A.
//- If cat B catches the mouse first, print Cat B.
//- If both cats reach the mouse at the same time, print Mouse C as the two cats fight and mouse escapes.
//x = 2, y = 5, z = 4 -> "Cat B" (The cats are at positions 2 {Cat A} and 5 {Cat B}, and the mouse is at position 4.
//Cat B, at position 5 will arrive first since it is only 1 unit away while the other is 2 units away)
function catAndMouse(x, y, z) {
    let cat1Distance = x > z ? x - z : z - x;
    let cat2Distance = y > z ? y - z : z - y;
    if (cat1Distance == cat2Distance) {
        return "Mouse C";
    } else if (cat1Distance < cat2Distance) {
        return "Cat A";
    } else {
        return "Cat B";
    }
}
//Pro solution 1
function catAndMouse(x, y, z) {
    if (Math.abs(x - z) == Math.abs(y - z)) {
        return "Mouse C";
    }
    return Math.abs(x - z) < Math.abs(y - z) ? "Cat A" : "Cat B";
}
//Pro solution 2
function catAndMouse(x, y, z) {
    const catADistance = Math.abs(x - z);
    const catBDistance = Math.abs(y - z);
    return catADistance == catBDistance ? "Mouse C" : (catADistance > catBDistance ? "Cat B" : "Cat A");
}

/*
//Codewars - Duplicate Encoder
//The goal of this exercise is to convert a string to a new string where each character in the new string is "(" if 
//that character appears only once in the original string, or ")" if that character appears more than once in the 
//original string. Ignore capitalization when determining if a character is a duplicate.
//"din" -> "((("
//"recede" -> "()()()"
//"Success" -> ")())())"
//"(( @" -> "))((" 
function duplicateEncode(word){
    word = word.toLowerCase();
    let encoded = "";
    for (let i = 0; i < word.length; i++) {
        let current = word[i];
        let count = 0;
        for (let j = 0; j < word.length; j++) {
            if (word[j] == current) {
                count++;
            }
        }
        if (count > 1) {
            encoded += ")";
        } else if (count == 1) {
            encoded += "(";
        }
    }
    return encoded;
}
//Pro solution 1
function duplicateEncode(word){
    return word
        .toLowerCase()
        .split('')
        .map(function (a, i, w) { //parameter di callback map() JavaScript itu adalah currentValue, index, arr
            return w.indexOf(a) == w.lastIndexOf(a) ? '(' : ')' //indexOf() mengembalikan first index
        }) //lastIndexOf() mengembalikan last index
        .join(''); //jadi kalo fist & last index sama maka cuma ada 1 di array
}
//Pro solution 2
function duplicateEncode(word) {
    word = word.toLowerCase();
    return word.replace(/./g, m => word.indexOf(m) == word.lastIndexOf(m) ? '(' : ')');
}

//Codewars - Determine Offspring Sex Based on Genes XX and XY Chromosomes
//The male gametes or sperm cells in humans and other mammals are heterogametic and contain one of two types of sex 
//chromosomes. They are either X or Y. The female gametes or eggs however, contain only the X sex chromosome and are
//homogametic. The sperm cell determines the sex of an individual in this case. If a sperm cell containing an X 
//chromosome fertilizes an egg, the resulting zygote will be XX or female. If the sperm cell contains a Y chromosome, 
//then the resulting zygote will be XY or male. Determine if the sex of the offspring will be male or female based on 
//the X or Y chromosome present in the male's sperm. 
//- If the sperm contains the X chromosome, return "Congratulations! You're going to have a daughter."; 
//- If the sperm contains the Y chromosome, return "Congratulations! You're going to have a son.";
function chromosomeCheck(sperm) {
    if (sperm == "XY") {
        return 'Congratulations! You\'re going to have a son.';
    } else {
        return 'Congratulations! You\'re going to have a daughter.';
    }
}
//Pro solution 1
function chromosomeCheck(sperm) {
    return `Congratulations! You're going to have a ${sperm === 'XY' ? 'son' : 'daughter'}.`
}

//HackerRank - Forming a Magic Square
//We define a magic square to be an n x n matrix of distinct positive integers from 1 to n^2 where the sum of any 
//row, column, or diagonal of length n is always equal to the same number: the magic constant.
*/