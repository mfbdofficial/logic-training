//Codewars - Find the Middle Element
//As a part of this Kata, you need to create a function that when provided with a triplet, returns the index of the
//numerical element that lies between the other two elements. The input to the function will be an array of three
//distinct numbers (Haskell: a tuple). Foe example :
//[2, 3, 1] => 0 (2 is the number that fits between 1 and 3 and the index of 2 in the input array is 0)
//[5, 10, 14] => 1 (10 is the number that fits between 5 and 14 and the index of 10 in the input array is 1)
function gimme (triplet) {
    let indexBetween = 0;
    for (let i = 0; i < triplet.length; i++) {
        if (i == 0) {
            if ((triplet[i] < triplet[1] && triplet[i] > triplet[2]) || (triplet[i] < triplet[2] && triplet[i] > triplet[1])) {
                indexBetween = i;
            }
        } else if (i == 1) {
            if ((triplet[i] < triplet[0] && triplet[i] > triplet[2]) || (triplet[i] < triplet[2] && triplet[i] > triplet[0])) {
                indexBetween = i;
            }
        } else {
            if ((triplet[i] < triplet[0] && triplet[i] > triplet[1]) || (triplet[i] < triplet[1] && triplet[i] > triplet[0])) {
                indexBetween = i;
            }
        }
    }
    return indexBetween;
}
//Pro solution 1
function gimme1(a) {
    return a.indexOf(a.concat().sort(function(a, b) { return a - b })[1]) //a.concat() will creates a shallow copy of the array a.
} //Array.prototype.sort() by default sorts alphabetically, so numbers get sorted like strings unless you provide 
//a custom comparator. Then a - b means: 
//If result is negative: a comes before b
//If result is positive: b comes before a
//If result is 0: no change
//Pro solution 2
const gimme2 = function (arr) {
    return arr.indexOf([...arr].sort((x, y) => x > y)[1]);
}; //the concept almost same with pro solution 1
//Pro solution 3
var gimme3 = function (inputArray) {
    let index = 0;
    let max = Math.max(...inputArray);
    let min = Math.min(...inputArray);
    for(let i = 0; i < inputArray.length; i++){
        if(inputArray[i] !== max && inputArray[i] !== min){        
            index = i;
        }
    }
    return index;
};

//Codewars - Moved in Squared Strings (I)
//You are given a string of n lines, each substring being n characters long: For example:
//s = "abcd\nefgh\nijkl\nmnop"
//We will study some transformations of this square of strings.
//Vertical mirror: vert_mirror (or vertMirror or vert-mirror)
//vert_mirror(s) => "dcba\nhgfe\nlkji\nponm"
//Horizontal mirror: hor_mirror (or horMirror or hor-mirror)
//hor_mirror(s) => "mnop\nijkl\nefgh\nabcd"
//or printed:
//vertical 	mirror   |horizontal	mirror
//abcd --> 	dcba     |abcd --> 		mnop
//efgh --> 	hgfe     |efgh --> 		ijkl
//ijkl --> 	lkji     |ijkl -->    	efgh
//mnop --> 	ponm     |mnop -->    	abcd
//Task : Write these two functions and high-order function oper(fct, s) where
//fct is the function of one variable f to apply to the string s (fct will be one of vertMirror, horMirror)
//Examples:
//s = "abcd\nefgh\nijkl\nmnop"
//oper(vert_mirror, s) => "dcba\nhgfe\nlkji\nponm"
//oper(hor_mirror, s) => "mnop\nijkl\nefgh\nabcd"
function vertMirror(strng) {
    let parts = strng.split("\n");
    let partsReverse = [];
    for (let i = 0; i < parts.length; i++) {
        let current = parts[i];
        let partReverse = "";
        for (let j = current.length - 1; j > -1; j--) {
            partReverse += current[j];
        }
        partsReverse.push(partReverse);
    }
    return partsReverse.join("\n");
}
function horMirror(strng) {
    let parts = strng.split("\n");
    let partsOpposite = [];
    for (let i = parts.length - 1; i > -1; i--) {
        partsOpposite.push(parts[i]);
    }
    return partsOpposite.join("\n");
}
function oper(fct, s) {
    return fct(s);
}
//Pro solution 1
function vertMirror1(str) {
    return str.split('\n').map(line => line.split('').reverse().join('')).join('\n')
}
function horMirror1(str) {
    return str.split('\n').reverse().join('\n')
}
function oper1(fct, s) {
    return fct(s)
}
//Pro solution 2
const vertMirror2 = s => s.map(s => [...s].reverse().join('')); //do more analysis for this part
const horMirror2 = s => s.reverse();
const oper2 = (fct, s) => fct(s.split("\n")).join("\n");