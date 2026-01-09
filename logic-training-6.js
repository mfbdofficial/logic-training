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

//Codewars - Drying Potatoes
//John bought potatoes: their weight is 100 kilograms. Potatoes contain water and dry matter. The water content is 
//99 percent of the total weight. He thinks they are too wet and puts them in an oven - at low temperature - for 
//them to lose some water. At the output the water content is only 98%. What is the total weight in kilograms (water
//content plus dry matter) coming out of the oven? He finds 50 kilograms and he thinks he made a mistake: "So much 
//weight lost for such a small change in water content!" Can you help him?
//Write function potatoes with p0 (initial percent of water), w0 (initial weight), p1 (final percent of water)
//potatoes() should return the final weight coming out of the oven w1 truncated as an int.
//Example: potatoes(99, 100, 98) --> 50, potatoes(82, 127, 80) --> 114
//Math analyze step by step for example 1:
//1. Calculate dry matter: if water is 99%, then dry matter is 1%
//	dry matter = 1% of 100 kg = 1 kg (that 1 kg of dry matter stays constant forever)
//2. After drying: water = 98%, dry matter = 2% (that same 1 kg dry matter is now 2% of the total weight)
//3. Calculate final weight: 1 kg = 2% of total weight
//	total weight = (1 / 2%) x 100% = 50 kg
//Math analyze step by step for example 2:
//1. Calculate dry matter: if water is 82%, then dry matter is 100% - 82% = 18%
//	dry matter = 18% of 127 kg = 22,86 kg (that 22,6 kg of dry matter stays constant forever)
//2. After drying: water = 80%, dry matter = 20% (that same 22,86 kg dry matter is now 20% of the total weight)
//3. Calculate final weight: 22,86 kg = 20% of total weight
//	total weight = (22,86 / 20%) x 100% = 114,3 kg 
function potatoes(p0, w0, p1) {
    let dryMatter = 100 - p0;
    let dryMatterWeight = (dryMatter / 100) * w0;
    let finalDryMatter = 100 - p1;
    let w1 = (dryMatterWeight / finalDryMatter) * 100;
    return Math.floor(w1)
}
//Pro solution 1
function potatoes1(p0, w0, p1) {
    return Math.floor(w0 * (100 - p0) / (100 - p1))
} //do it straight as a return
//Pro solution 2
function potatoes2(p0, w0, p1) {
    return ~~(w0 * (100.0 - p0) / (100.0 - p1))
} //same as before, do it straight, ~~ is a fast way to convert a number to a 32-bit integer by truncating the 
//decimal part, this is how it works (both 2 is the same):
//~~x ≈ Math.trunc(x)
//~~x ≈ parseInt(x, 10) (for positive numbers)
//Pro solution 3
const potatoes3 = (p0, w0, p1) => (100 - p0) / (100 - p1) * w0 ^ 0;
//same, straight return the calculation, but with arrow function syntax, ^ is the bitwise XOR (exclusive OR) 
//operator, when we do x ^ 0:
//JavaScript converts x to a 32-bit signed integer, performs XOR with 0, then returns the integer result
//since XOR with 0 does nothing to the bits so: 
//x XOR 0 = x (the real purpose is NOT XOR, the purpose is the integer conversion)
//Pro solution 4
function potatoes4(p0, w0, p1) {
  //do the math first
  //50 = 100-99+49
  //w1 = w0 - w0*p0 + w1*p1
  // =>
  //w1 - w1*p1 = w0 - w0*p0
  //w1*(1 -p1) = w0 - w0*p0
  //w1 = (w0 - w0*p0) / (1 - p1)
  return Math.trunc(Math.fround((w0 - w0 * (p0 / 100)) / (1 - (p1 / 100))));
}

//Codewars - What Dominates Your Array?
//A zero-indexed array arr consisting of n integers is given. The dominator of array arr is the value that occurs 
//in more than half of the elements of arr. For example, consider array arr such that arr = [3,4,3,2,3,1,3,3]. The 
//dominator of arr is 3 because it occurs in 5 out of 8 elements of arr and 5 is more than a half of 8. Write a 
//function dominator(arr) that, given a zero-indexed array arr consisting of n integers, returns the dominator of 
//arr. The function should return −1 if array does not have a dominator. All values in arr will be >=0.
function dominator(arr) {
    let halfLimit = arr.length / 2;
    let numDone = [];
    for (let i = 0; i < arr.length; i++) {
        let current = arr[i];
        let counter = 0;
        if (!numDone.includes(current)) {
            for (let j = 0; j < arr.length; j++) {
                if (current == arr[j]) {
                    counter++;
                }
            }
            numDone.push(current);
        }
        if (counter > halfLimit) {
            return current;
        }
    }
    return -1;
} //the most common basic way
//My other solution 1
function dominator0(arr) {
    let halfLimit = arr.length / 2;
    let numDone = [];
    for (let i = 0; i < arr.length; i++) {
        let current = arr[i];
        let counter = 0;
        if (!contains0(numDone, current)) {
            for (let j = 0; j < arr.length; j++) {
                if (current == arr[j]) {
                    counter++;
                }
            }
            numDone.push(current);
        }
        if (counter > halfLimit) {
            return current;
        }
    }
    return -1;
}
function contains0(arr, current) {
    for (let i = 0; i < arr.length; i++) {
        if (current == arr[i]) {
            return true;
        }
    }
    return false;
} //same as before, but we use another function manually to change the .includes() if that's not allowed
//My other solution 2
function dominator00(arr) {
    if (arr.length <= 0) {
        return -1;
    }
    let candidate = arr[0]; //phase 1, find candidate (using Boyer-Moore algorithm)
    let count = 1;
    for (let i = 1; i < arr.length; i++) {
        if (candidate == arr[i]) {
            count++; //increase count when we see the same number
        } else {
            count--; //decrease count when we see a different number
        }
        if (count == 0) { //when count reaches 0, we abandon the current candidate and choose a new one
            candidate = arr[i];
            count = 1;
        }
    }
    let occurance = 0; //phase 2, verify candidate
    for (let j = 0; j < arr.length; j++) { //make sure the candidate we get is really the majority (more than the half), by count it
        if (candidate == arr[j]) { //using for loop
            occurance++;
        }
    }
    if (occurance > arr.length / 2) { //then compare it with the half size based from slice's length divide by 2
        return candidate;
    }
    return -1;
} //filter every empty array, find majority candidate using Boyer-Moore algorith, then verify the cannditate > half
//more about Boyer-Moore algorithm:
//- A dominator appears more than half
//- Pair every dominator value with a different value → dominator still survives
//so the process we do is:
//- Increase count when we see the same number
//- Decrease count when we see a different number
//- When count reaches 0, we abandon the current candidate and choose a new one
//why this always works (simple proof)
//- Dominator count > n/2
//- All non-dominator elements combined < n/2
//- Pairing cancels one dominator with one non-dominator
//- Dominator cannot be fully canceled
//- It must remain as final candidate
//mental model: “Every different number cancels one vote of the current candidate; only a true majority can survive.”
//Pro solution 1
function dominator1(arr) {
    arr.sort(); //just do sorting first
    for (var i = 0, v = 0, c = 0; i < arr.length; i++) { //do loop for every element, c as counter, v as current value
        if (v == arr[i]) c++; //cause it already sorted, everytime finding same value v, then just counter up
            else { //if finding difference value v, then just change the value v with the new one
                v = arr[i];
                c = 1;
            }
        if (c > arr.length / 2) return v; //if finding the moment when the counter c is more than half, then intercept
    } //it, just return the value v immediately
    return -1;
}
//Pro solution 2
function dominator2(arr) {
    for(let i = 0, obj = {}; i < arr.length; i++) {
  	    obj[arr[i]] = obj[arr[i]] + 1 || 1
  	    if(obj[arr[i]] > arr.length / 2) return arr[i]
    }
    return -1 
} //playing with object, need more research
//Pro solution 3
const dominator3 = arr => {
   let count  = {};
    arr.forEach(el => {
        count[el] ? count[el]++ : count[el] = 1;
    })
    for (let k in count) {
        if (count[k] > arr.length / 2) return + k
    }
    return -1;
}

//Codewars - Char Code Calculation
//Given a string, turn each character into its ASCII character code and join them together to create a number - 
//let's call this number total1:
//'ABC' --> 'A' = 65, 'B' = 66, 'C' = 67 --> 656667
//Then replace any incidence of the number 7 with the number 1, and call this number 'total2':
//total1 = 656667
//              ^
//total2 = 656661
//Then return the difference between the sum of the digits in total1 and total2:
// (6 + 5 + 6 + 6 + 6 + 7)
//-(6 + 5 + 6 + 6 + 6 + 1)
//-------------------------
//                      6
function calc(x) {
    let xArr = x.split("");
    let xArrASCII = [];
    xArr.forEach(letter => {
        xArrASCII.push(letter.charCodeAt(0));
    })  
    let xArrTotal1 = xArrASCII.join("").split("");
    let xArrTotal2 = [];
    xArrTotal1.forEach(sNumber => {
        if (sNumber == "7") {
            sNumber = "1";
        }
        xArrTotal2.push(number);
    })
    let total1 = 0;
    xArrTotal1.forEach(sNumber => {
        let number = Number(sNumber);
        total1 += number; 
    })
    let total2 = 0;
    xArrTotal2.forEach(sNumber => {
        let number = Number(sNumber);
        total2 += number; 
    })
    return total1 - total2;
}
//Pro solution 1
function calc1(x) {
    let sum = n => [...n].reduce((a,b) => +a + +b); //function to sum every string number digit in a string
    let total1 = x.replace(/./g, x => x.charCodeAt(0)); //use regex to convert every string letter into Unicode (0 as the index in charCodeAt) 
    let total2 = total1.replace(/7/g, '1'); //use regex to change every "7" Unicode string in total1 into "1" 
    return sum(total1) - sum(total2); //do substraction between total1 and total2
} 
//Pro solution 2
const calc2 = x => (x.replace(/./g, x => x.charCodeAt()).match(/7/g) || []).length * 6; //regex replace to Unicode,
//do regex to match every "7", count the length and multiple it with 6, when 6 itself is the different value will be 
//counted (7 - 1 = 6). So it's like we count how much we found string "7" and multiple it with 6
//Pro solution 3
function calc3(x) {
    return x.split('').map(c => c.charCodeAt(0)).join('').split('').map(Number).filter(x => x === 7).length * 6;
} //split the string, do map to change every element into Unicode, join it fist (as a map condition rules), split
//the joined Unicode again, do map again to filter if we found 7, count it's length and multiple with 6 (like before)