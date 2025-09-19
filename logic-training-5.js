//Codewars - All Inclusive?
//Input: a string strng & an array of strings arr
//Output of function contain_all_rots(strng, arr) (or containAllRots or contain-all-rots): a boolean true if all
//rotations of strng are included in arr or false otherwise
//Examples:
//"bsjq" & ["bsjq", "qbsj", "sjqb", "twZNsslC", "jqbs"]) -> true
//"Ajylvpy" & ["Ajylvpy", "ylvpyAj", "jylvpyA", "lvpyAjy", "pyAjylv", "vpyAjyl", "ipywee"]) -> false
function containAllRots(strng, arr) {
    for (let i = 0; i < strng.length; i++) {
        strng = strng.slice(1) + strng[0];
        let found = false;
        for (let j = 0; j < arr.length; j++) {
            if (arr[j] == strng) {
                found = true;
            }
        }
        if (!found) {
            return false;
        }
    }
    return true;
} //using additional variable found as a state if the current arr looping is same as the current string rotation
//return false if that additional variable not getting true
//Pro solution 1
function containAllRots1(str, arr) {
    for (var i = 0; i < str.length; i++) {
        if (arr.indexOf(str.slice(i) + str.slice(0, i)) === -1) {
            return false
        }
    }
    return true
} //do looping for str length, check and do ration at the same time, arr.indexOf() check is the rotation string are
//being in the arr? if -1 (-1 means not or false), then return false immediately
//Pro solution 2
function containAllRots2(strng, arr) {
    return [...strng].map((_, i) => strng.substr(i) + strng.slice(0, i)).every(x => arr.includes(x));
} //[...strng] it’s just a quick way to turn the string into an array of characters so that .map() runs exactly 
//strng.length times, then .map((_, i) => ...), _ means “I’m ignoring the character itself.”, i is the current index.
//.every() returns one single boolean, it runs the callback for each element in the array, it checks arr.includes(x),
//if all of those checks are true, .every() returns true, if any one of them is false, .every() stops immediately 
//and returns false.
//Pro solution 3
function containAllRots3(strng, arr) {
    return strng.split('').every((_, i) => arr.includes(strng.slice(i) + strng.slice(0, i)));
} //same as before, but we check it and do rotation at the same time (when in the Pro solution 2, we do ratation first,
//then check if it's included later)

//Codewars - Help Suzuki Rake His Garden!
//the monastery has a magnificent Zen garden made of white gravel and rocks and it is raked diligently everyday by
//the monks. Suzuki having a keen eye is always on the lookout for anything creeping into the garden that must be
//removed during the daily raking such as insects or moss.
//you will be given a string representing the garden such as:
//rake out any items that are not a rock or gravel and replace them with gravel such that:
//"slug spider rock gravel gravel gravel gravel gravel gravel gravel"
//returns a string with all items except a rock or gravel replaced with gravel:
//"gravel gravel rock gravel gravel gravel gravel gravel gravel gravel"
function rakeGarden(garden) {
    let gardenStuff = garden.split(" ");
    for (let i = 0; i < gardenStuff.length; i++) {
        if (gardenStuff[i] != "gravel" && gardenStuff[i] != "rock") {
            gardenStuff[i] = "gravel";
        }
    }
    return gardenStuff.join(" ");
}
//Pro solution 1
const rakeGarden1 = garden => garden.split(' ').map(item => item === 'rock' ? 'rock' : 'gravel').join(' ');
//split the garden string, map it to check every item if it's rock? if yes then make it rock, if not then make it
//gravel (gravel and other stuff isn't rock, it will change into gravel anyway), then the last just join it
//Pro solution 2
function rakeGarden2(garden) {
    return garden.replace(/\b((?!\b(gravel|rock)\b)\w+)\b/g, 'gravel')
} //lets talk about the regex:
//\b → Word boundary, ensures we match whole words (not part of a bigger word).
//- (?! ... ) → Negative lookahead, meaning “the next thing must not match this pattern.”
//- \b(gravel|rock)\b → matches the exact words "gravel" or "rock".
//- \w+ → matches a sequence of letters/numbers/underscores (a word).
//the whole ((?!\b(gravel|rock)\b)\w+) means:
//- match a word only if it is not "gravel" or "rock".
//- the final \b ensures the match stops at the word's end.
//- the /g flag → global search, so it replaces all matches in the string.
//Pro solution 3
const rakeGarden3 = garden => garden.replace(/(?!rock\b)\b\w+/g,'gravel');
//what is /.../g do?
//- /.../ → Marks the start and end of the regular expression. 
//- g (global flag) → Means “don’t stop after the first match — find all matches in the string.”
//what is (?!rock\b) do? → negative lookahead
//- (? ... ) → a lookahead — checks ahead without consuming characters.
//- ?! → negative lookahead — match only if the pattern inside does not occur.
//- rock → Literal text “rock”.
//- \b → Word boundary (position between a word character \w and a non-word character \W or string edges).
//so: (?!rock\b) says: “From here, make sure the upcoming word is not exactly rock.”
//whats \b do? → word boundary
//- this ensures the match starts at the boundary of a word.
//- without this, it could match inside words like bedrock.
//what is \w+ do? → word characters
//- \w → Any word character [A-Za-z0-9_] (in JavaScript regex, it does not include accented letters unless using Unicode mode /u).
//- + → One or more of the preceding token.
//so: \w+ matches a whole word like apple, car, stone.
//how it works together? the pattern / (?!rock\b) \b \w+ /g says: (Look ahead to see if the next word is rock. If it 
//is rock, do not match here. If it is anything else, proceed. Ensure we start at a word boundary (\b). Match the 
//whole word (\w+). Replace it with "gravel").

//Codewars - Grasshopper (Grade Book)
//Complete the function so that it finds the average of the three scores passed to it and returns the letter value
//associated with that grade.
//Numerical Score			Letter Grade
//  90 	<= score <= 100			'A'
//  80 	<= score < 90			'B'
//	70 	<= score < 80			'C'
//	60 	<= score < 70			'D'
//	 0 	<= score < 60			'F'
//Tested values are all between 0 and 100. Theres is no need to check for negative values or values greater than 100.
function getGrade (s1, s2, s3) {
    let avg = (s1 + s2 + s3) / 3;
    if (avg >= 90) {
        return "A";
    } else if (avg >= 80) {
        return "B";
    } else if (avg >= 70) {
        return "C";
    } else if (avg >= 60) {
        return "D";
    } else {
        return "F";
    }
}
//Pro solution 1
function getGrade1 (s1, s2, s3) {
    var s = (s1 + s2 + s3) / 3
    return s >= 90 ? "A" : s >= 80 ? "B" : s >= 70 ? "C" : s >= 60 ? "D" : "F"
}
//Pro solution 2
function getGrade2(...scores) { 
    let average = scores.reduce((a, b) => a + b) / scores.length //need more research how thi reduce work
    if (average >= 90) return 'A'
    else if (average >= 80) return 'B'
    else if (average >= 70) return 'C'
    else if (average >= 60) return 'D'
    else return 'F'
} //good if the length is unknown, this code not using semicolon (;), is this work? how?
//Pro solution 3
var getGrade3 = (a, b, c) => 'FFFFFFDCBAA'.charAt((a + b + c) /3 / 10);
//need more research

//Codewars - Count the Divisors of a Number
//Count the number of divisors of a positive integer n. Random tests go up to n = 500000, but fixed tests
//go higher. Input output example :
//4 -> 3 (we have 3 divisors - 1, 2 and 4)
//5 -> 2 (we have 2 divisors - 1 and 5)
//12 -> 6 (we have 6 divisors - 1, 2, 3, 4, 6 and 12)
//30 -> 8 (we have 8 divisors - 1, 2, 3, 5, 6, 10, 15 and 30)
function getDivisorsCnt(n) {
    let count = 1;
    for (let i = 1; i <= n / 2; i++) {
        if (n % i == 0) {
            count++;
        }
    }
    return count;
} //is not logically wrong, but it’s too slow (inefficient) when n is large — that’s why you got 
//Execution Timed Out (12000 ms).
//My other solution 1
function getDivisorsCnt0(n) {
    let count = 0;
    for (let i = n; i > 0; i--) {
        if (n % i == 0) {
            count++;
        }
    }
    return count;
} //is not logically wrong, but it’s too slow (inefficient) when n is large — that’s why you got 
//Execution Timed Out (12000 ms).
//My other solution 2
function getDivisorsCnt00(n) {
    let count = 0;
    for (let i = 1; i <= Math.sqrt(n); i++) {
        if (n % i == 0) {
            if (i == n / i) {
                count++
            } else {
                count += 2;
            }
        }
    }
    return count;
} //this is the fast way divisors always come in pairs, if i is a divisor of n, then n / i is also a 
//divisor, for n = 100, the divisor pairs are: (1, 100), (2, 50), (4, 25), (5, 20), (10, 10).
//notice that after we reach the square root (10), the pairs start to repeat, we only need to find one 
//divisor in each pair, and we can find the other by simple division, 
//so basically we decrease the looping, we do loop just untill the root of the number (root number 
//included), when i = that root number then count +1 (for that root number), but when i isn't that root 
//number and n % i == 0, then we do count +2 (for that i and it's pair)
//Pro solution 1
function getDivisorsCnt1(n) {
    var num = 0;
    if (n == 1) return 1;
    if (n % Math.sqrt(n) == 0) num++; //check root number is pass (no comma, no float)? then counter num +1
    for(var i = 1; i < Math.sqrt(n); i++) {
        if( n % i == 0) {
            num += 2;
        }
    }
    return num;
} //same, do looping only untill the root of the number, but this time the root of n isn't included, but
//this part if (n == 1) return 1; we actually don't need it, cause n == 1 will already handled correctly
//Pro solution 2
function getDivisorsCnt2(n) {
    let counter = 0;
    if (n % Math.sqrt(n) == 0) {
        counter++;
    }
    for (let i = 1; i < Math.sqrt(n); i++) {
        if (n % i == 0) {
            counter += 2;
        }
    }
    return counter;
} //same, do looping only untill the root of the  (root of n isn't included), but don't need to check if 
//n = 1 (cause it still works anyway, we don't do loop if i < 1, cause i start from 1, so 1 < 1 is wrong)

//Codewars - Complementary DNA
//Deoxyribonucleic acid (DNA) is a chemical found in the nucleus of cells and carries the "instructions"
//for the development and functioning of living organisms. To know more: http://en.wikipedia.org/wiki/DNA
//In DNA strings, symbols "A" and "T" are complements of each other, as "C" and "G". Your function
//receives one side of the DNA (string, except for Haskell); you need to return the other complementary
//side. DNA strand is never empty or there is no DNA at all (again, except for Haskell).
//More similar exercise are found here: http://rosalind.info/problems/list-view/ (source)
//"ATTGC" -> "TAACG"
//"GTAT" -> "CATA"
//Meaning in science : In DNA, "complementary" means that the two strands of the double helix have a
//specific pairing rule where Adenine (A) always pairs with Thymine (T) and Cytosine (C) always pairs with
//Guanine (G). These specific pairings are held together by hydrogen bonds, forming the rungs of the DNA
//ladder and allowing the two strands to fit together perfectly, like a lock and key, ensuring accurate
//replication and information transfer.
//What does it mean for DNA to be complementary?
//Specific Pairing -> The chemical structures of the nitrogenous bases dictate that A can only form bonds
//with T, and C can only form bonds with G.
function dnaStrand(dna) {
    for (let i = 0; i < dna.length; i++) {
        if (dna[i] == "A") {
            dna = dna.substr(0, i) + "T" + dna.substr(i + 1);
        } else if (dna[i] == "T") {
            dna = dna.substr(0, i) + "A" + dna.substr(i + 1);
        } else if (dna[i] == "C") {
            dna = dna.substr(0, i) + "G" + dna.substr(i + 1);
        } else {
            dna = dna.substr(0, i) + "C" + dna.substr(i + 1);
        }
    }
    return dna;
} //substr(start) means: “return substring starting at start until the end.”, so ff start is greater than or equal to 
//the string length, it just returns an empty string "" (no error)
//My other solution
function dnaStrand0(dna) {
    const dnaReverser = {A: "T", T: "A", C: "G", G: "C"}; //create an object dnaReverser as mapping data
    return dna.split("").map(ch => dnaReverser[ch]).join(""); //split, do mapping to change the old value (as our
} //property name in our object mapping data), then get the new value (from the object's value)
//Pro solution 1
function DNAStrand1(dna) {
    return dna.replace(/./g, function(c) { //this /./g is regex matches every single character globally
        return DNAStrand1.pairs[c] //we access a property in our function to replace every single character with 
    }) //return from callback function c is current character
} 
DNAStrand1.pairs = {A: 'T', T: 'A', C: 'G', G: 'C'} //this pairs data will be returned based from property name called
//function in JavaScript is also object, so we can assign property into it
//Pro solution 2
let pairs = {A:'T',T:'A',C:'G',G:'C'};
const DNAStrand2 = dna => dna.replace(/./g, c => pairs[c]); 
//same as before but we don't make property in our function, but just simply make a new variable instead

//Codewars - Sum of the First N-th Term of Series
//Your task is to write a function which returns the n-th term of the following series, which is the sum of the
//first n terms of the sequence (n is the input parameter).
//Series : 1 + 1/4 + 1/7 + 1/10 + 1/13 + 1/16 + ...
//You will need to figure out the rule of the series to complete this. The rules is you need to round the answer to
//2 decimal places and return it as String. If the given value is 0 then it should return "0.00". You will only be
//given Natural Numbers as arguments.
//n = 1 -> 1.00
//n = 2 -> 1.25
//n = 3 -> 1.57
function SeriesSum(n) {
    let denominator = 1; 
    let sum = 0;
    for (let i = n; i > 0; i--) {
        sum = sum + (1 / denominator);
        denominator += 3;
    }
    return sum.toFixed(2).toString();
} //.toFixed(2) to change the float to have 2 decimal places, toString() is to change int or float into string 
//Pro solution 1
function SeriesSum1(n) {
    for (var s = 0, i = 0; i < n; i++) { //we can initialize more that 1 variable in the for loop
        s += 1 / (1 + i * 3)
    }
    return s.toFixed(2)
} //as we knew that .toFixed(2) is to change the float to have 2 decimal places, but it also change it into string
//too, so we actually don't need to do toString() again after it like my solution before
//Pro solution 2
function SeriesSum2(n, s = 0) { //initialize variable sum s = 0 in the function's parameter (only for the first time)
    return n ? SeriesSum(n - 1, s + 1 / (3 * n - 2)) : s.toFixed(2) //check is n true (not 0)? if yes then call
} //SeriesSum() function (this is recursion function), this will calculate the sum s from the back. For ex n = 3 :
//1st called -> n = 3   s = 0
//2nd called -> n = 2   s = 0 + 1 / (3 * 3 - 2) -> 1/7
//3rd called -> n = 1   s = 1/7 + 1 / (3 * 2 - 2) -> 1/7 + 1/2
//4th called -> n = 0   s = 1/7 + 1/2 + 1 / (3 * 1 - 2) -> 1/7 + 1/2 + 1/1
//n finally is 0, so do s.toFixed(2), when s itself is already 1/7 + 1/4 + 1
//Pro solution 3
function SeriesSum3(n) {
    for (a = 0, i = 1; i <= n * 3; i += 3) a += 1 / i; //if n = 3 then do loop until i <= 9 (3 * 3), when is always
    return a.toFixed(2); //do +3 in every loop, so i will be (1, 4, 7)
}
//Pro solution 4
function SeriesSum4(n) {
    return Array(n).fill(0).map((e, i) => 3 * i + 1).reduce((s, e) => s + 1 / e, 0).toFixed(2);
} //Array(n), creates an empty array of length n
//.fill(0), fills every slot with 0, for ex : Array(4).fill(0) → [0, 0, 0, 0]
//.map((e, i) => 3 * i + 1), loops over each element & replacing it with formula 3 * i + 1, i as index (0, 1, 2, …).
//.reduce((s, e) => s + 1/e, 0), accumulates (reduce) into a sum s, starts with s = 0, for each element e in 
//[1, 4, 7, 10], adds with 1/e, so it become 0 + 1/1 + 1/4 + 1/7 + 1/10
//.toFixed(2), formats the number with 2 decimals in string output, 1.4928 → "1.49"

//Codewars - Functional Addition
//Create a function add(n)/Add(n) which returns a function that always adds n to any number
//Note for Java: the return type and methods have not been provided to make it a bit more challenging.
//var addOne = Add(1)
//addOne(3) -> 4
function add(n) {
    return function (m) {
        return n + m;
    }
}
//Pro solution 1
var add1 = n => m => n + m; //using arrow funtion syntax
//Pro solution 2
var add2 = n => function (m) {
    return n + m;
} //hybrid, using arrow function syntax first, then return with usual function
//Pro solution 3
function add3(n) {
    return m => n + m;
} //hybrid, using usual function syntax first, then return with arrow function

//Codewars - A Rule of Divisibility by 13
//A divisibility rule is a shorthand way of determining whether a given integer is divisible by a fixed divisor
//without performing the division, usually by examining its digits. When you divide the successive powers of 10 by
//13 you get the following remainders of the integer divisions:
//1, 10, 9, 12, 3, 4
//because:
//10 ^ 0 ->  1 (mod 13)
//10 ^ 1 -> 10 (mod 13)
//10 ^ 2 ->  9 (mod 13)
//10 ^ 3 -> 12 (mod 13)
//10 ^ 4 ->  3 (mod 13)
//10 ^ 5 ->  4 (mod 13)
//why we only do this untill 10 ^ 5? because if we keep going the result would be repeated, for divisor = 13 the
//pattern is 1, 10, 9, 12, 3, 4 then it would be repeat again if we do 10 ^ 6, 10, ^ 7, 10 ^ 8, 10 ^ 9, 10 ^ 10,
//10 ^ 11 again, the result will be 1, 10, 9, 12, 3, 4 again (and continues so on), this pattern would be different
//based the divisor we're using, it this case. the rule is using 13.
//Then the whole pattern repeats. Hence the following method:
//Multiply
//- the right most digit of the number with the left most number in the sequence shown above,
//- the rsecond right most digit with the second left most digit of the number in the sequence.
//The cycle goes on and you sum all these products. Repeat this process until the sequence of sums is stationary.
//(stasioner = keadaan tetap, tidak bergerak, atau tidak berubah seiring waktu pada suatu sistem, objek, atau nilai)
//Example:
//What is the remainder when 1234567 is divided by 13?
//7      6     5      4     3     2     1  (digits of 1234567 from the right)
//×      ×     ×      ×     ×     ×     ×  (multiplication)
//1     10     9     12     3     4     1  (the repeating sequence)
//Therefore following the method we get:
//7×1 + 6×10 + 5×9 + 4×12 + 3×3 + 2×4 + 1×1 = 178
//We repeat the process with the number 178:
//8x1 + 7x10 + 1x9 = 87
//and again with 87:
//7x1 + 8x10 = 87
//From now on the sequence is stationary (we always get 87) and the remainder of 1234567 by 13 is the same as the
//remainder of 87 by 13 ( i.e 9).
//Task:
//Call thirt the function which processes this sequence of operations on an integer n (>=0). thirt will return the
//stationary number.
//thirt(1234567) calculates 178, then 87, then 87 and returns 87.
//thirt(321) calculates 48, 48 and returns 48
function thirt(n) {
    let prev = 0;
    while (prev != n) {
        prev = n;
        let sum = 0;
        for (let i = 0; n > 0; i++) {
            let lastDigit = n % 10;
            sum += lastDigit * ((10 ** i) % 13);
            n = Math.floor(n / 10); //the goal is to remove the last digit, but n / 10 in JavaScript will become 
        } //float automatically, 123 / 10 = 12.3, so we need Math.floor()
        n = sum; //we treat n as a current calculation value
    } 
    return n;
} //return when the looping is over, means now n value will always be the same as previous value
//Note : Except in Go, 123 / 10 = 12 (so the calculation would be different, even the logic is the same)
//Pro solution 1
function thirt1(n) {
    const nums = [1, 10, 9, 12, 3, 4]
    var sum = ('' + n).split('').reverse().reduce((sum, v, i) => sum + v * nums[i % nums.length], 0)
    return sum === n ? n : thirt(sum)
} //need more explanation
//Pro solution 2
function thirt2(n) {
    let r = [...(n + '')].reverse().reduce((t, d, i) => t + d * (Math.pow(10, i) % 13), 0);
    return n === r ? n : thirt(r);
} //need more explanation
//Pro solution 3
const thirt3 = n => (r => n === r ? n : thirt(r))([...String(n)].reverse().reduce((acc, v, i) => acc + v * (10 ** i % 13), 0));
//need more explanation

//Codewars - Multiplication Table
//Your task, is to create N×N multiplication table, of size provided in parameter. For example, when given size is 3:
//1 2 3
//2 4 6
//3 6 9
//For the given example, the return value should be: [[1,2,3],[2,4,6],[3,6,9]]
function multiplicationTable(size) {
    let matrix = [];
    for (let i = 1; i <= size; i++) {
        matrix[i - 1] = [];
        let current = i;
        for (let j = 1; j <= size; j++) {
            matrix[i - 1][j - 1] = current;
            current += i;
        }
    }
    return matrix;
}
//My other solution
function multiplicationTable0(size) {
    let matrix = [];
    for (let i = 0; i < size; i++) {
        matrix[i] = [];
        for (let j = 0; j < size; j++) {
            matrix[i][j] = (i + 1) * (j + 1);
        }
    }
    return matrix;
}
//Pro solution 1
const multiplicationTable1 = n => {
    const res = [];
    for (let i = 1; i <= n; i++) {
        const row = []; 
        for (let j = 1; j <= n; j++) //if there's only one statement inside the loop, you allowed not using {} syntax
            row.push(i * j); //push values into row
        res.push(row); //push the finished row into res
    }
    return res;
} //create separated row array instead, the push it into the line res later 
//Pro solution 2
const multiplicationTable2 = function(size) {
    return Array.apply(null, new Array(size)).map(function(val, i) {
        return Array.apply(null, new Array(size)).map(function(val, j) {
            return (i + 1) * (j + 1);
        });
    });
} //need more explanation
//Pro solution 3
const multiplicationTable3 = function(n) {
    return Array.from({length:n}, (_, i) => Array.from({length:n}, (_, j) => (i + 1) * (j + 1)));
} //need more explanation

//Codewars - Moves in Squared Strings (II)
//You are given a string of n lines, each substring being n characters long: For example:
//s = "abcd\nefgh\nijkl\nmnop"
//We will study some transformations of this square of strings.
//  - rot(s):
//    clock rotation 180 degrees.
//    rot(s) => "ponm\nlkji\nhgfe\ndcba"
//  - selfie_and_rot(s) (or selfieAndRot or selfie-and-rot):
//    It is an initial string combined with its 180-degree clock-rotated version, interspersed with dots proportional
//    to the length of the segments, to better illustrate the rotation when printed.
//    SelfieAndRot(s) => "abcd....\nefgh....\nijkl....\nmnop....\n....ponm\n....lkji\n....hgfe\n....dcba"
//
//|rot             |selfie_and_rot
//|abcd --> ponm   |abcd --> abcd....
//|efgh     lkji   |efgh     efgh....
//|ijkl     hgfe   |ijkl     ijkl....
//|mnop     dcba   |mnop     mnop....
//                           ....ponm
//                           ....lkji
//                           ....hgfe
//                           ....dcba
// Note : notice that the number of dots is the common length of "abcd", "efgh", "ijkl", "mnop".
// task: write these two functions rot and selfie_and_rot and also high-order function oper(fct, s) where fct is the
// function of one variable f to apply to the string s (fct will be one of rot, selfie_and_rot)
function rot(strng) {
    let sArray = strng.split("\n");
    for (let i = 0; i < sArray.length; i++) {
        let current = sArray[i].split("");
        for (let j = 0, k = current.length-1; j < k; j++, k--) {
            //current[j], current[k] = current[k], current[j]; //this kind of syntax don't work in JavaScript
            let temp = current[j];
            current[j] = current[k];
            current[k] = temp;
        }
        sArray[i] = current.join("");
    }
    for (let l = 0, m = sArray.length-1; l < m; l++, m--) {
        let temp = sArray[l];
        sArray[l] = sArray[m];
        sArray[m] = temp;
    }
    return sArray.join("\n");
}
function selfieAndRot(strng) {
    let sArray = strng.split("\n");
    for (let i = 0; i < sArray.length; i++) {
        let currentLength = sArray[i].length;
        for (let j = 0; j < currentLength; j++) {
            sArray[i] = sArray[i] + ".";
        }
    }
    return sArray.join("\n") + "\n" + rot(sArray.join("\n"));
}
function oper(fct, s) {
    return fct(s);
}
//My other solution
function rot(strng) {
    let sArray = strng.split("\n");
    for (let i = 0; i < sArray.length; i++) {
        let current = sArray[i].split("");
        sArray[i] = current.reverse().join(""); //just using reverse() built-in function (not manually using loop)
    }
    return sArray.reverse().join("\n"); //just using reverse() built-in function (not manually using loop)
}
function selfieAndRot(strng) {
    let sArray = strng.split("\n");
    for (let i = 0; i < sArray.length; i++) {
        let currentLength = sArray[i].length;
        for (let j = 0; j < currentLength; j++) {
            sArray[i] = sArray[i] + ".";
        }
    }
    return sArray.join("\n") + "\n" + rot(sArray.join("\n"));
}
function oper(fct, s) {
    return fct(s);
}
//Pro solution 1
function rot(s) {
    return s.split("").reverse().join(""); //just reverse it and it's done, why? when we do split "\n" become 1 element
} //the reason is in JavaScript (and most languages), "\n" is not two characters (it’s one single character)
function selfieAndRot(s) {
    return (s = s.replace(/.+/g, t => t + t.replace(/./g, "."))) + "\n" + rot(s); //using regex :
} //first /.+/g  -> we will match 3 data ("abc", "def", "ghi")
//- . will match any character except newline 
//- + means “one or more of the previous”, so it matches a whole line (everything up until the newline).
//- /g is global flag, so it applies the replacement for every line in the string s.
//for every data matched, then we do t => t + t.replace(/./g, ".") (we do the value itself + regex again)
//that second regex is /./g 
//- . will match any character except newline matches every character in that line.
//- /g is also global flag
//then replace it with ".", so ("a", "b", "c") becomes (".", ".", "."), so "abc" change into "..."
function oper(fn, s) {
    return fn(s);
}
//Pro solution 2
const rot = strng => [...strng].reverse().join(``); //just reverse the string
const selfieAndRot = strng => (strng = strng.replace(/.+/g, val => val + `.`.repeat(val.length))) + `\n` + rot(strng);
//matched it with regex like before, but for step 2 isn't using regex again, but juga replace the value matched with
//value itself + ".", when this "." part is repeated for value matched's length times, so let's say "abc" has 
//length = 3, so repeat the "." 3 times, and it will become "..."
const oper = (fct, s) => fct(s);