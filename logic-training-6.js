//Codewars - Scaling Squared Strings
//You are given a string of n lines, each substring being n characters long. For example:
//s = "abcd\nefgh\nijkl\nmnop"
//We will study the "horizontal" and the "vertical" scaling of this square of strings. A k-horizontal scaling of a 
//string consists of replicating k times each character of the string (except '\n'). Example: 
//2-horizontal scaling of s: => "aabbccdd\neeffgghh\niijjkkll\nmmnnoopp"
//A v-vertical scaling of a string consists of replicating v times each part of the squared string. Example: 
//2-vertical scaling of s: => "abcd\nabcd\nefgh\nefgh\nijkl\nijkl\nmnop\nmnop"
//Function scale(strng, k, v) will perform a k-horizontal scaling and a v-vertical scaling. Example: 
//a = "abcd\nefgh\nijkl\nmnop"
//scale(a, 2, 3) -> "aabbccdd\naabbccdd\naabbccdd\neeffgghh\neeffgghh\neeffgghh\niijjkkll\niijjkkll\niijjkkll\nmmnnoopp\nmmnnoopp\nmmnnoopp"
//abcd   ----->   aabbccdd
//efgh            aabbccdd
//ijkl            aabbccdd
//mnop            eeffgghh
//                eeffgghh
//                eeffgghh
//                iijjkkll
//                iijjkkll
//                iijjkkll
//                mmnnoopp
//                mmnnoopp
//                mmnnoopp
function scale(strng, k, n) {
    if (strng == "") {
        return strng;
    } 
    let sArray = strng.split("\n");
    let sArrayLen = sArray.length
    for (let i = 0; i < sArrayLen; i++) {
        let current = sArray[i].split("")
        let currentLen = current.length
        for (let j = 0; j < currentLen; j++) {
            let letter = "";
            for (let l = k; l > 0; l--) {
                letter += current[j]
            }
            current[j] = letter;
        }
        sArray[i] = current.join("");
    }
    let sHorizontal = sArray.join("\n");
    let sArrayHorizontal = sHorizontal.split("\n"); //["aabbcc", "ddeeff", "gghhii"]
    let sArrayHorizontalLen = sArrayHorizontal.length
    for (let m = 0; m < sArrayHorizontalLen; m++) {
        let value = sArrayHorizontal[m];
        for (let p = n; p > 1; p--) {
            sArrayHorizontal[m] += "\n" + value;
        }
    }
    return sArrayHorizontal.join("\n");
}
//Pro solution 1
const scale1 = (str, k, n) => str
    .replace(/[^\n]/g,  c => Array(k + 1).join(c)) 
    .replace(/[^\n]+/g, c => Array(n + 1).join("\n" + c).slice(1));
//in the first .replace, Regex /[^\n]/g matches every character except newline. For each character c, it creates an 
//array of length k+1 → .join(c), so we create an empty array with lengt k + 1, then join it with it's value (c)
//as delimiter, that make use duplicates that character in k times.
//in the second .replace, Regex /[^\n]+/g matches each line (a run of non-newline characters), For each line c, it 
//builds an array with n + 1 slots, joins them with "\n" + c, then slices off the first \n
//Pro solution 2
const scale = (strng, h, v) => {
    return (strng + '\n').replace(/[^\n]/g, '$&'.repeat(h)).replace(/([^\n]+\n)/g, '$&'.repeat(v)).trim();
}; //add the string with '\n', this is usefull for the second .replace with regex
//first .replace, regex /[^\n]/g matches every character except newline, the '$&' (special replacement token) means 
//the matched text itself, then repeat it for h times.
//second .replace, regex /([^\n]+\n)/g matches a whole line including it's trailing \n (that's why we add "\n" at 
//the start, if not, the last line wouldn't matched), then repeat that line value itself (matched) for v times, then
//we just cut the whitespace with trim(). 
//The .trim() method is a built-in function for strings. Its purpose is to remove whitespace characters from both 
//ends of a string. It does not affect characters inside the string. What counts as "whitespace"? According to the 
//ECMAScript specification, .trim() removes: Space (" "), Tab ("\t"), Newline ("\n"), Carriage return ("\r"), 
//Non-breaking space and some other Unicode whitespace characters.
//Pro solution 3
const scale = (strng, k, n) => strng.replace(/./g, `$&`.repeat(k)).replace(/.+/g, `$&\n`.repeat(n).trim());
//in the first .replace(), ./g to matches every single character (except newlines), $& is the whole match itself like 
//before, then do .repeat() like before.
//in the second .replace(), /.+/g matches each line (because . excludes \n, but with + it grabs until \n), 
//$&\n.repeat(n) repeats the whole line with a newline n times. Then cut the whitespace with trim() like before.

//Codewars - Deodorant Evaporator
//This program tests the life of an evaporator containing a gas. We know the content of the evaporator (content in
//ml), the percentage of foam or gas lost every day (evap_per_day) and the threshold (threshold) in percentage
//beyond which the evaporator is no longer useful. All numbers are strictly positive. The program reports the nth
//day (as an integer) on which the evaporator will be out of use.
//evaporator(10, 10, 5) -> 29
//Mathematical explanation :
//you have: content = 10 ml, evap_per_day = 10% lost per day, threshold = 5% of the original content
//the evaporator becomes “out of use” when the current content < 5% of the initial content.
//5% of 10 ml = 0.5 ml, so the evaporator stops when the remaining content is < 0.5 ml.
//day-by-day explanation : each day, the content loses 10% (so it keeps 90%).
//let’s calculate the case manually:
//	Day 0: 10.000 ml
//	Day 1: 10 × 0.9 = 9.000
//	Day 2: 9 × 0.9 = 8.100
//	Day 3: 8.1 × 0.9 = 7.290
//	.....
//  continue until the amount < 0.5 ml
//the formula after n days: remaining = 10 × (0.9)^n
//we want: 10 × (0.9)^n < 0.5
//divide both sides by 10: (0.9)^n < 0.05
//now we solve using logs: n > ln(0.05) / ln(0.9)
//calculate: ln(0.05) ≈ -2.9957 and ln(0.9) ≈ -0.1053
//n > −2.9957 / −0.1053 ≈ 28.45
//Since days must be integers, we round up → 29 days.
function evaporator(content, evapPerDay, threshold) {
    let eligbilityLimits = (content * threshold) / 100; //calculate limit when evaporator considered out of use
    let dayCount = 0; //make a counter (as a days spent)
    while (content > eligbilityLimits) { //do looping as long as evaporator still useable
        content = content - (content * evapPerDay) / 100;
        dayCount++;
    }
    return dayCount;
} //the logic is just decrease the evaporator's content day-by-day, and stop looping when it's out of use
//Pro solution 1
function evaporator1 (content, evap_per_day, threshold) { 
    threshold = threshold / 100 //calculate limit when evaporator considered out of use
    evap_per_day = evap_per_day / 100 //calculate how much % value that gas in the evaporator deccrease everyday
    return Math.ceil(Math.log(threshold) / Math.log(1 - evap_per_day))
} //using math log equation
//Pro solution 2
function evaporator2(content, evap_per_day, threshold) {
    function recurse(pctLeft = 100, counter = 0) {
        if (pctLeft <= threshold) { 
            return counter; 
        } else { 
            return recurse(pctLeft * (1 - evap_per_day / 100), ++counter); //run recursive func while do counter up
        } //in the next recursive func, the value of content will always decrease cause we multiple it with 1 - %
    }; //value of gas that gone everyday
    return recurse();
} //do it with recursive way

//Codewars - A Rule of Divisibility by 7
//A number m of the form 10x + y is divisible by 7 if and only if x − 2y is divisible by 7. 
//In other words, subtract twice the last digit from the number formed by the remaining digits. 
//Continue to do this until a number known to be divisible by 7 is obtained; you can stop when this 
//number has at most 2 digits because you are supposed to know if a number of at most 2 digits is 
//divisible by 7 or not. The original number is divisible by 7 if and only if the last number
//obtained using this procedure is divisible by 7.
//Examples:
//1. m = 371 -> 37 − (2×1) -> 37 − 2 = 35 ; thus, since 35 is divisible by 7, 371 is divisible by 7,
//  the number of steps to get the result is 1.
//2. m = 1603 -> 160 - (2 x 3) -> 154 -> 15 - 8 = 7 and 7 is divisible by 7.
//3. m = 372 -> 37 − (2×2) -> 37 − 4 = 33 ; thus, since 33 is not divisible by 7, 372 is not 
//  divisible by 7.
//4. m = 477557101->47755708->4775554->477547->47740->4774->469->28 and 28 is divisible by 7, so is 
//  477557101. The number of steps is 7.
//Task:
//Your task is to return to the function seven(m) (m integer >= 0) an array (or a pair, depending on 
//the language) of numbers, the first being the last number m with at most 2 digits obtained by your 
//function (this last m will be divisible or not by 7), the second one being the number of steps to 
//get the result. Return on the stack [last-number-m-with-at-most-2-digits, number-of-steps]. 
//Unit test examples : 
//seven(371) should return [35, 1]
//seven(1603) should return [7, 2]
//seven(477557101) should return [28, 7]
function seven(m) {
    let step = 0;
    while (m >= 100) {
        step += 1;
        m = Math.floor(m / 10) - 2 * (m % 10);
    }
    return [m, step];
}
//Pro solution 1
function seven1(m) {
    var i = 0;
    while(m.toString().length > 2) {
        m = Math.floor(m / 10) - (m % 10) * 2;
        i++;
    }  
    return [m, i];
} //same as my solution, but need to change the number m into string first
//Pro solution 2
function seven2(m, n = 0) { //declare the step n in the function parameter
    return m < 100 ? [m, n] : seven(Math.floor(m / 10) - 2 * (m % 10), ++n); //use ternary operator syntax, then
} //using recursive funtion concept, the ++n (pre-increment) syntax is for increases the variable's value before 
//it's used in an expression, while n++ (post-increment) uses the variable's current value in the expression and 
//then increases it