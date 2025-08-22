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