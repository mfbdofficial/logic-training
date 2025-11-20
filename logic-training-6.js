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