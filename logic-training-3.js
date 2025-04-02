/*
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
*/