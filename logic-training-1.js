//Codewars - Find The Capitals
//Write a function that takes a single non-empty string of only lowercase and uppercase ascii letters 
//(word) as its argument, and returns an ordered list containing the indices of all capital (uppercase) 
//letters in the string.
//"CodEWaRs" --> [0,3,4,6]
var capitals = function(word) {
    let indexUpperCase = [];
    for(let i = 0; i < word.length; i++) {
        if(/[A-Z]/.test(word[i])) {
            indexUpperCase.push(i);
        }
    }
    return indexUpperCase;
};
//Codewars - Testing 1-2-3
//Your team is writing a fancy new text editor and you've been tasked with implementing the line 
//numbering. Write a function which takes a list of strings and returns each line prepended by the correct 
//number.The numbering starts at 1. The format is n: string. Notice the colon and space in between.
//[] --> []
//["a", "b", "c"] --> ["1: a", "2: b", "3: c"]
var number = function(array) {
    let prependedCorrectNumber = [];
    for(let i = 0; i < array.length; i++) {
        let num = i + 1;
        let stringNumber = num.toString();
        prependedCorrectNumber.push(stringNumber + ": " + array[i]);
    }
    return prependedCorrectNumber;
}
//pro solution 1
var number = function(array) {
    return array.map(function (line, i) { //langsung mapping, line menjadi value, i menjadi index
        return (i + 1) + ": " + line;
    });
}

//Codewars - Persistent Bugger
//Write a function, persistence, that takes in a positive parameter num and returns its multiplicative 
//persistence, which is the number of times you must multiply the digits in num until you reach a single 
//digit.
//39 --> 3 (because 3*9 = 27, 2*7 = 14, 1*4 = 4 and 4 has only one digit, there are 3 multiplications)
//999 --> 4 (because 9*9*9 = 729, 7*2*9 = 126, 1*2*6 = 12, and finally 1*2 = 2, there are 4 multiplications)
//4 --> 0 (because 4 is already a one-digit number, there is no multiplication)
function persistence(num) {
    let count = 0;
    while(num > 9) {
        let stringNum = num.toString();
        let nums = stringNum.split('');
        num = nums[0];
        for(let i = 1; i < nums.length; i++) {
            num = num * nums[i];
        }
        count++;
    }
    return count;
}
//pro solution 1
function persistence(num) {
    var times = 0;
    num = num.toString(); //num dijadikan string
    while (num.length > 1) { //cek apakah panjang string lebih dari 1?
        times++;
        num = num.split('').map(Number).reduce((acc, current) => acc * current).toString(); //string num di-split,
    } //lalu di-mapping menjadi array of number, kemudian pakai operasi reduce untuk dapetin array product
    return times; 
 }
 //pro solution 2
 function persistence(num) {
    for (var i = 0; num > 9; i++) { //for dijadikan bekerja seolah buat count dan while statement sekaligus
        num = num.toString().split('').reduce((acc, current) => acc * current); //mirip pro solution 1
    }
    return i;
 }
