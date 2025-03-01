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

//Codewars - No Zeros for Heroes
//Numbers ending with zeros are boring. They might be fun in your world, but not here. Get rid of them. 
//Only the ending ones.
//1450 -> 145; 960000 -> 96; 1050   -> 105; -1050 -> -105; 0 -> 0
function noBoringZeros(n) {
    let nums = n.toString().split("");
    if (nums.length == 1) {
        return n;
    }
    for (let i = nums.length - 1; i >= 0; i--) {
        if (nums[i] == 0) {
            nums.pop();
        } else {
            return parseInt(nums.join(""));
        }
    }
}
//Pro solution 1
function noBoringZeros(n) {
    while (n % 10 === 0 && n !== 0) {
        n = n / 10
    }
    return n
}
//Pro solution 2
function noBoringZeros(n) {
    return +`${n}`.replace(/0*$/, "");
}
//Pro solution 3
function noBoringZeros(n) {
    return Number(String(n).replace(/0+$/,''));
}

//Codewars - Volume of a Cuboid
//Bob needs a fast way to calculate the volume of a cuboid with three values: the length, width and height 
//of the cuboid. Write a function to help Bob with this calculation.
class Kata {
    static getVolumeOfCuboid(length, width, height) {
        return length * width * height;
    }
}
//Pro solution 1
const Kata = {
    getVolumeOfCuboid : (length, width, height) => length * width * height
}

//Codewars - Remove Anchor from URL
//Complete the function/method so that it returns the url with anything after the anchor (#) removed.
//"www.codewars.com#about" --> "www.codewars.com"
//"www.codewars.com?page=1" --> "www.codewars.com?page=1"
function removeUrlAnchor(url){
    let cleanURL = "";
    for (let i = 0; i < url.length; i++) {
        if (url[i] == "#") {
            return cleanURL;
        }
        cleanURL = cleanURL + url[i];
    }
    return cleanURL;
}
//Pro solution 1
function removeUrlAnchor(url){
    return url.split('#')[0]; //split (pisahkan) string berdasarkan "#" lalu ambil yg pertama saja,
} //yaitu index ke 0
//Pro solution 2
function removeUrlAnchor(url){
    return url.replace(/#.*/gi, ""); //pakai regex, ganti bagian yg "#..." (ada anchor, juga karakter
} //seterusnya) menjadi string kosong ''

//Codewars - Check for factor
//Factors are numbers you can multiply together to get another number.
//2 and 3 are factors of 6 because: 2 * 3 = 6
//You can find a factor by dividing numbers. If the remainder is 0 then the number is a factor. You can
//use the mod operator (%) in most languages to check for a remainder
function checkForFactor (base, factor) {
    return base % factor == 0 ? true : false;
}
//Pro solution 1
function checkForFactor (base, factor) {
    return base % factor === 0;
}
//Pro solution 2
const checkForFactor = (base, factor) => !(base % factor);

//Codewars - Get the Middle Character
//You are going to be given a non-empty string. Your job is to return the middle character(s) of the 
//string. If the string's length is odd, return the middle character. If the string's length is even, 
//then return the middle 2 characters.
function getMiddle(s) {
    let middleIndex = Math.floor(s.length / 2); //floor membulatkan angka ke bawah
    if (s.length % 2 == 0) {
        return s[middleIndex - 1] + s[middleIndex]; 
    } else {
        return s[middleIndex];
    }
}
//Pro solution 1
function getMiddle(s) { 
    return s.substr(Math.ceil(s.length / 2 - 1), s.length % 2 === 0 ? 2 : 1); //substr mengambil string 
} //mulai dari urutan tertentu, lalu dengan jumlah karakter tertentu. Lalu ceil() membulatkan ke atas

//Codewars - Build Tower
//Build a pyramid-shaped tower, as an array/list of strings, given a positive integer number of floors. 
//A tower block is represented with "*" character. For example, a tower with 3 floors looks like this:
//[
//    "  *  ",
//    " *** ", 
//    "*****"
//]
function towerBuilder(nFloors) {
    let arrPyramid = [];
    let current = nFloors - 1;
    for (let i = 0; i < nFloors; i++) {
        let element = "";
        for (let j = 0; j < nFloors; j++) {
            if (j < current) {
                element += " ";
            } else {
                element += "*";
            }
        }
        for (let k = nFloors - 1; k > 0; k--) {
            if (k > current) {
                element += "*";
            } else {
                element += " ";
            }
        }
        current = current - 1;
        arrPyramid.push(element);
    }
    return arrPyramid
}
//Pro solution 1
function towerBuilder(nFloors) {
    var tower = [];
    for (var i = 0; i < nFloors; i++) {
      tower.push(" ".repeat(nFloors - i - 1) + "*".repeat((i * 2)+ 1) + " ".repeat(nFloors - i - 1));
    }
    return tower;
}
//Pro solution 2
function towerBuilder(n) {
    return Array.from({length: n}, function(v, k) {
        const spaces = ' '.repeat(n - k - 1);
        return spaces + '*'.repeat(k + k + 1) + spaces;
    });
}
//Pro solution 3
function towerBuilder(n) {
    return [...Array(n)].map((_, i) => " ".repeat(n - 1 - i) + "*".repeat(i * 2 + 1) + " ".repeat(n - 1 -i))
}

//Codewars - Counting Duplicates
//Write a function that will return the count of distinct case-insensitive alphabetic characters and 
//numeric digits that occur more than once in the input string. The input string can be assumed to contain 
//only alphabets (both uppercase and lowercase) and numeric digits.
//"abcde" -> 0 -> no characters repeats more than once)
//"aabbcde" -> 2 -> 'a' and 'b'
//"aabBcde" -> 2 -> 'a' occurs twice and 'b' twice (`b` and `B`)
//"indivisibility" -> 1 -> 'i' occurs six times
//"Indivisibilities" -> 2 -> 'i' occurs seven times and 's' occurs twice
function duplicateCount(text) {
    let alreadyThere = []; //array kosong untuk riwayat element yg sudah ada
    let count = 0; //counter jika ditemukan yg sesuai kriteria
    for (let i = 0; i < text.length; i++) { //perulangan semua character
        let state = false; //keadaan awal saat belum membandingkan
        if (alreadyThere.indexOf(text[i].toLowerCase()) == -1) { //hanya jalan untuk character yg belum ada
            for (let j = i + 1; j < text.length; j++) { //perulangan dengan character pembanding
                if (text[i].toLowerCase() == text[j].toLowerCase()) { //cek char sama (case-insensitive)?
                    state = true; //kalo ada yg sama maka state true
                }
            }
            alreadyThere.push(text[i].toLowerCase()); //masukkan ke riwayat
        }
        if (state == true) {//state true akan mengakibatkan counter up
            count++;
        }
    }
    return count;
}
//Pro solution 1
function duplicateCount(text){
    return (text.toLowerCase().split('').sort().join('').match(/([^])\1+/g) || []).length; //pakai regex
} //semua dijadikan lowercase, dipisah jadi array, disorting, digabungin lagi string-nya, lalu regex 
//lalu entah gimana proses-nya dari regex itu diambil length-nya dan itu hasilnya
//Pro solution 2
function duplicateCount(text){
    return text.toLowerCase().split('').filter(function(val, i, arr) {
        return arr.indexOf(val) !== i && arr.lastIndexOf(val) === i;
    }).length;
}

//Codewars - Array.diff
//Implement a function that computes the difference between two lists. The function should remove all 
//occurrences of elements from the first list (a) that are present in the second list (b). The order 
//of elements in the first list should be preserved in the result.
//If a = [1, 2] and b = [1], the result should be [2].
//If a = [1, 2, 2, 2, 3] and b = [2], the result should be [1, 3].
function arrayDiff(a, b) {
    let lengthA = a.length;
    for (let i = 0; i < b.length; i++) {
        for (let j = lengthA - 1; j > -1; j--) { //pakai perulangan angka yg besar, bukan dari 0,
            if (typeof a[j] !== 'undefined') { //jadi kita akan hapus element array-nya dari belakang
                if (b[i] == a[j]) { //karena di JavaScript akan bergesar (kalo di hapus) dan membuat kacau
                    a.splice(j, 1); 
                }
            }
        }
    } //sifat array di JavaScript sepertinya beda dengan PHP, index PHP akan terus menempel jika elemen
    return a; //di bagian tengahnya di hapus, kalo JavaScript element yg di belakang akan maju ke depan
} //mengisi index yg kosong (jika ada element di pertengahan yg dihapus)
//Pro solution 1
function array_diff(a, b) {
    return a.filter(e => !b.includes(e));
}
//Pro solution 2
function array_diff(a, b) {
    return a.filter(function(x) { 
        return b.indexOf(x) == -1; 
    });
}

//Codewars - Delete Occurrences of An Element If It Occurs More Than N Times
//Alice and Bob were on a holiday. Both of them took many pictures of the places they've been, and 
//now they want to show Charlie their entire collection. However, Charlie doesn't like these sessions, 
//since the motif usually repeats. He isn't fond of seeing the Eiffel tower 40 times. He tells them that 
//he will only sit for the session if they show the same motif at most N times. 
//[1, 2, 3, 1, 2, 1, 2, 3] & 2 -> [1, 2, 3, 1, 2]
//[20, 37, 20, 21] & 1 -> [20, 37, 21]
function deleteNth(arr, n) {
    let list = [];
    for (let i = 0; i < arr.length; i++) {
        let count = 0;
        for (let j = 0; j < list.length; j++) {
            if (arr[i] == list[j]) {
                count++;
            }
        }
        if (n > count) {
            list.push(arr[i]);
        }
    }
    return list;
}
//Pro solution 1
function deleteNth(arr, x) {
    var cache = {};
    return arr.filter(function(n) {
        cache[n] = (cache[n]||0) + 1; //still don't know how the hell is this work
        return cache[n] <= x;
    });
}
//Pro solution 2
const deleteNth = (a, x) => {
    let m = {};
    return a.filter( v => (m[v] = m[v]+1||1) <= x ); //still don't know how the hell is this work
} 