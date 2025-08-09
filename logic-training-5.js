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