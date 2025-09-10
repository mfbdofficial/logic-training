package main

import (
	"fmt"
	"math"
	"regexp"
	"slices"
	"strings"
)

func main() {

}

// Codewars - All Inclusive?
// Input: a string strng & an array of strings arr
// Output of function contain_all_rots(strng, arr) (or containAllRots or contain-all-rots): a boolean true if all
// rotations of strng are included in arr or false otherwise
// Examples:
// "bsjq" & ["bsjq", "qbsj", "sjqb", "twZNsslC", "jqbs"]) -> true
// "Ajylvpy" & ["Ajylvpy", "ylvpyAj", "jylvpyA", "lvpyAjy", "pyAjylv", "vpyAjyl", "ipywee"]) -> false
func ContainAllRots(strng string, arr []string) bool {
	//rotate the string, check if that string contained in the array, once found it isn't, return false
	for i := 0; i < len(strng); i++ {
		strng = string(strng[len(strng)-1]) + strng
		strng = strng[:len(strng)-1]
		if !slices.Contains(arr, strng) {
			return false
		}
	}
	return true
} //do looping to rotate the string, check if that string contained in the array, once found it isn't, return false
// My other solution
func ContainAllRots0(strng string, arr []string) bool {
	state := false
	for i := 0; i < len(strng); i++ {
		strng = string(strng[len(strng)-1]) + strng
		strng = strng[:len(strng)-1]
		state = false
		for _, value := range arr {
			if value == strng {
				state = true
			}
		}
		if !state {
			return false
		}
	}
	return true
} //do looping to rotate the string, then looping the array to check one of element same as the string,
// return false immediately if no element found that same as the current string in every rotation
// Pro solution 1
func ContainAllRots1(strng string, arr []string) bool {
	rotations := make(map[string]struct{}) //part 1
	for i := range strng {                 //part 2
		rotations[strng[i:]+strng[:i]] = struct{}{} //struct{} is a type declaration: it means a struct with no
	} //fields, this type takes zero memory, struct{}{} is a value of that type: just like int(5) creates an int, struct{}{} creates a value of an empty struct.
	for _, v := range arr { //part 3
		delete(rotations, v)
	}
	return len(rotations) == 0 //part 4
}

// part 1
// - map[string]struct{}: A set-like map — where keys are strings, and values are empty structs (making a map and define that map will have string as the keys and empty struct as the values)
// - struct{}: Takes up 0 bytes (efficient).
// - this line creates an empty map to hold all rotations of the input string.
// part 2
//   - let’s say strng = "abc". This loop will generate all circular rotations:
//     i = 0: "abc"[0:] + "abc"[:0] → "abc" + "" = "abc"
//     i = 1: "abc"[1:] + "abc"[:1] → "bc" + "a" = "bca"
//     i = 2: "abc"[2:] + "abc"[:2] → "c" + "ab" = "cab"
//   - each of these is added to the rotations map:
//     rotations["abc"] = struct{}{}
//     rotations["bca"] = struct{}{}
//     rotations["cab"] = struct{}{}
//
// part 3
// - iterates over each string v in the arr slice.
// - delete(rotations, v) will remove it if it exists in the map.
// - after this loop, any rotation that was found in arr will be removed from the map.
// part 4
// - if the map is now empty, that means: All possible rotations were found in arr
// - if any rotation wasn't found in arr, it would still exist in the map, so the length would be > 0.
// Pro solution 2
func ContainAllRots2(strng string, arr []string) bool {
	counter := 0
	master := []string{}
	for i, _ := range strng {
		master = append(master, strng[i:]+strng[:i])
	}
	for _, j := range master {
		for _, k := range arr {
			if j == k {
				counter++
				break
			}
		}
	}
	return len(strng) == counter
} //counter up for every match between each element of arr to each string rotation, all amount of string rotation
// generally would be same as the string length, so we compare the counter with the string's length
// Pro solution 3
func ContainAllRots3(strng string, arr []string) bool {
	if len(arr) == 0 {
		return true
	}
	for i := 0; i < len(strng); i++ {
		rotationFound := false
		for y := 0; y < len(arr) && !rotationFound; y++ {
			if arr[y] == strng {
				rotationFound = true
			}
		}
		if !rotationFound {
			return false
		}
		strng = string(strng[1:]) + string(strng[0])
	}
	return true
}

// Codewars - Help Suzuki Rake His Garden!
// the monastery has a magnificent Zen garden made of white gravel and rocks and it is raked diligently everyday by
// the monks. Suzuki having a keen eye is always on the lookout for anything creeping into the garden that must be
// removed during the daily raking such as insects or moss.
// you will be given a string representing the garden such as:
// rake out any items that are not a rock or gravel and replace them with gravel such that:
// "slug spider rock gravel gravel gravel gravel gravel gravel gravel"
// returns a string with all items except a rock or gravel replaced with gravel:
// "gravel gravel rock gravel gravel gravel gravel gravel gravel gravel"
func RakeGarden(garden string) string {
	gardenStuff := strings.Split(garden, " ") //need to import "strings" package
	for i := 0; i < len(gardenStuff); i++ {
		if gardenStuff[i] != "gravel" {
			if gardenStuff[i] != "rock" {
				gardenStuff[i] = "gravel"
			}
		}
	}
	return strings.Join(gardenStuff, " ") //need to import "strings" package
} //solit, chech every stuff in the garden, if it's not gravel and not rock, then change it into gravel,
// My other solution
func RakeGarden0(garden string) string {
	gardenStuff := strings.Split(garden, " ") //need to import "strings" package
	for i := 0; i < len(gardenStuff); i++ {
		if gardenStuff[i] != "gravel" && gardenStuff[i] != "rock" {
			gardenStuff[i] = "gravel"
		}
	}
	return strings.Join(gardenStuff, " ") //need to import "strings" package
} //same as before, but we using AND operator instead (better than doing nested if)
// Pro solution 1
func RakeGarden1(garden string) string {
	words := strings.Split(garden, " ") //need to import "strings" package
	for i, word := range words {
		if word != "rock" && word != "gravel" {
			words[i] = "gravel"
		}
	}
	return strings.Join(words, " ") //need to import "strings" package
} //use range instead to do looping, check if the current value, if it's not rock and no gravel, change the slice (array)
// Pro solution 2
func RakeGarden2(garden string) string {
	var sb strings.Builder                     //strings.Builder builds the string incrementally in a dynamically managed byte slice,
	d := ""                                    //reducing unnecessary memory reallocations, we can make empty string insted and do concat (but that eat more memory)
	for _, s := range strings.Fields(garden) { //strings.Fields to split a string into a slice of substrings
		if s != "rock" && s != "gravel" {
			s = "gravel"
		}
		sb.WriteString(d) //strings.Builder.WriteString() for efficient string concatenation in Go. Unlike using
		sb.WriteString(s) //the + operator, which can lead to multiple string allocations due to string immutability
		d = " "           //in the first loop d still "" for the first part of sentence, after that d become " "
	}
	return sb.String()
} //difference between strings.Fields and strings.Split, string.Fields :
// a. delimiter - any sequence of one or more whitespace characters
// b. consecutive delimiters - treated as a single delimiter, no empty strings
// c. empty strings - discarded
// d. flexibility - less flexible, fixed to whitespace
// strings.Split :
// a. delimiter - a specific, user-defined string
// b. consecutive delimiters - creates empty strings if multiple delimiters occur
// c. empty strings - included in the result slice if present
// d. flexibility - more flexible, allows any string as delimiter
// Pro solution 3
func RakeGarden3(garden string) string {
	return regexp.MustCompile(`\S+`).ReplaceAllStringFunc(garden, func(s string) string { //in regex, \S mean any
		if s == "rock" { //non-whitespace character, + mean one or more of them
			return "rock" //then MustCompile compiles this regex at runtime, and panics if it’s invalid (instead of
		} //returning an error like regexp.Compile does)
		return "gravel" //.ReplaceAllStringFunc(garden, func(s string) string {...}) to finds all matches of the regex,
	}) //calls your callback function with each match as s, then replaces the match in the string with the return value from your function
} //need to import "regexp" package.
//the final form is actually like this <regexCompiled>.ReplaceAllStringFunc(<string>, <callback>)

// Codewars - Grasshopper (Grade Book)
// Complete the function so that it finds the average of the three scores passed to it and returns the letter value
// associated with that grade.
// Numerical Score			Letter Grade
//
//	90 	<= score <= 100			'A'
//	80 	<= score < 90			'B'
//	70 	<= score < 80			'C'
//	60 	<= score < 70			'D'
//	 0 	<= score < 60			'F'
//
// Tested values are all between 0 and 100. Theres is no need to check for negative values or values greater than 100.
func GetGrade(a, b, c int) rune {
	avg := (a + b + c) / 3
	if avg >= 90 {
		return 'A'
	} else if avg >= 80 {
		return 'B'
	} else if avg >= 70 {
		return 'C'
	} else if avg >= 60 {
		return 'D'
	} else {
		return 'F'
	}
} //in Go, a rune is an alias for int32, tt represents a Unicode code point (basically a number that corresponds to
// a character), for example like this code :
// var r rune = 'A'  		//single quotes → rune literal
// fmt.Println(r)    		//65 (Unicode code point for 'A')
// fmt.Printf("%c\n", r) 	//A
// rune is not a string, string is sequence of characters (like "Hello") and rune is a single Unicode character
// Pro solution 1
func GetGrade1(a, b, c int) rune {
	switch (a + b + c) / 30 { //calculate the average immediately in the switch condition
	case 10:
		return 'A'
	case 9:
		return 'A'
	case 8:
		return 'B'
	case 7:
		return 'C'
	case 6:
		return 'D'
	default:
		return 'F'
	}
} //using switch case to heck the average value
// Pro solution 2
func GetGrade2(a, b, c int) rune {
	return rune("FFFFFFDCBAA"[(a+b+c)/30])
} //in This case, "FFFFFFDCBAA" is a string literal, strings in Go can be indexed like arrays → "ABCDEFG"[0] gives
// you the byte (ASCII value) of 'A'. So "FFFFFFDCBAA"[index] → returns the byte at position index.
// so in the "FFFFFFDCBAA" there's 10 length, so we just gonna se the front digit, if (a+b+c)/30 is 8,6666 then we
// gonna focus just on 8 (this would be the index)
// Pro solution 3
func GetGrade3(a, b, c int) rune {
	return []rune{'F', 'F', 'F', 'F', 'F', 'F', 'D', 'C', 'B', 'A', 'A'}[(a+b+c)/30]
} //same as before, but he declare the rune in the first place (not change a string into a rune)

// Codewars - Count the Divisors of a Number
// Count the number of divisors of a positive integer n. Random tests go up to n = 500000, but fixed tests
// go higher. Input output example :
// 4 -> 3 (we have 3 divisors - 1, 2 and 4)
// 5 -> 2 (we have 2 divisors - 1 and 5)
// 12 -> 6 (we have 6 divisors - 1, 2, 3, 4, 6 and 12)
// 30 -> 8 (we have 8 divisors - 1, 2, 3, 5, 6, 10, 15 and 30)
func Divisors(n int) int {
	count := 0
	for i := n; i > 0; i-- {
		if n%i == 0 {
			count++
		}
	}
	return count
} //do looping as many as n, everytime n % current loop value is 0, do counter up
// Pro solution 1
func Divisors1(n int) int {
	nDiv := 1
	for i := 1; i <= n/2; i++ {
		if n%i == 0 {
			nDiv++
		}
	}
	return nDiv
} //same using looping, but count start from 1 (consider the n itself element)
// and do looping just until n / 2 because there's no way gonna be result of the division with a remainder
// of 0 on current value of i is between half n and n itself (makes the calculation faster)
// Pro solution 2
func Divisors2(n int) int {
	if n == 1 {
		return 1
	} else if n == 0 {
		return 0
	}
	count := 2
	for i := 2; i <= n/2; i++ {
		if n%i == 0 {
			count++
		}
	}
	return count
} //same, but check it first to secure the functional from special case like 1 and 0

// Codewars - Complementary DNA
// Deoxyribonucleic acid (DNA) is a chemical found in the nucleus of cells and carries the "instructions"
// for the development and functioning of living organisms. To know more: http://en.wikipedia.org/wiki/DNA
// In DNA strings, symbols "A" and "T" are complements of each other, as "C" and "G". Your function
// receives one side of the DNA (string, except for Haskell); you need to return the other complementary
// side. DNA strand is never empty or there is no DNA at all (again, except for Haskell).
// More similar exercise are found here: http://rosalind.info/problems/list-view/ (source)
// Meaning in science : In DNA, "complementary" means that the two strands of the double helix have a
// specific pairing rule where Adenine (A) always pairs with Thymine (T) and Cytosine (C) always pairs with
// Guanine (G). These specific pairings are held together by hydrogen bonds, forming the rungs of the DNA
// ladder and allowing the two strands to fit together perfectly, like a lock and key, ensuring accurate
// replication and information transfer.
// What does it mean for DNA to be complementary?
// Specific Pairing -> The chemical structures of the nitrogenous bases dictate that A can only form bonds
// with T, and C can only form bonds with G.
func DNAStrand(dna string) string {
	for i := 0; i < len(dna); i++ {
		dnaRunes := []rune(dna)
		if dnaRunes[i] == 'A' {
			dnaRunes[i] = 'T'
		} else if dnaRunes[i] == 'T' {
			dnaRunes[i] = 'A'
		} else if dnaRunes[i] == 'C' {
			dnaRunes[i] = 'G'
		} else if dnaRunes[i] == 'G' {
			dnaRunes[i] = 'C'
		}
		dna = string(dnaRunes)
	}
	return dna
} //"T" is different with 'T' in Go? string and runes?
// Pro solution 1
var dnaReplacer *strings.Replacer = strings.NewReplacer( //need to import "strings" package
	"A", "T",
	"T", "A",
	"C", "G",
	"G", "C",
) //this is another something that we gonna use in the main function DNAStrand1
func DNAStrand1(dna string) string {
	return dnaReplacer.Replace(dna)
} //how is this work?
// Pro solution 2
func DNAStrand2(dna string) string {
	replacer := strings.NewReplacer("A", "T", "T", "A", "G", "C", "C", "G") //need to import "strings" package
	return (replacer.Replace(dna))
} //same as before, but we don't make the functionality into another function (straight in main function)
// Pro solution 3
func DNAStrand3(dna string) string {
	return strings.NewReplacer("A", "T", "T", "A", "G", "C", "C", "G").Replace(dna)
} //same as before, but do it in one line (not making variable for strings.NewReplacer() part)
// Pro solution 4
func DNAStrand4(dna string) string {
	var complements = map[string]string{"A": "T", "C": "G", "G": "C", "T": "A"}
	var and string
	for _, char := range dna {
		and += complements[string(char)]
	}
	return and
} //use mapping way

// Codewars - Sum of the First N-th Term of Series
// Your task is to write a function which returns the n-th term of the following series, which is the sum of the
// first n terms of the sequence (n is the input parameter).
// Series : 1 + 1/4 + 1/7 + 1/10 + 1/13 + 1/16 + ...
// You will need to figure out the rule of the series to complete this. The rules is you need to round the answer to
// 2 decimal places and return it as String. If the given value is 0 then it should return "0.00". You will only be
// given Natural Numbers as arguments.
// n = 1 -> 1.00
// n = 2 -> 1.25
// n = 3 -> 1.57
func SeriesSum(n int) string {
	denominator := 1.0
	sum := 0.0
	for i := n; i > 0; i-- {
		sum = sum + (1.0 / denominator)
		denominator += 3.0
	}
	return fmt.Sprintf("%.2f", sum) //need to import "fmt" package
} //fmt.Sprintf() is to convert a float into a string, use "%.2f" means round that float to 2 decimal places, but
// if you use "%v" means you just convert it into string directly (with float's initial value)
// Pro solution 1
func SeriesSum1(n int) string {
	var sum float64 = 0
	for i := 0; i <= n-1; i++ {
		sum += float64(1) / float64(1+(i*3)) //for ex n = 3, when looping in i = 2, so 1 / (1 + (2 * 3)) = 1 / 7
	}
	return fmt.Sprintf("%.2f", sum)
} //if n = 1, then do 1 looping 1 / (1 + (0 * 3)) = 1 / 1 = 0
// even if n = 0, then do 0 looping, so sum = 0 (it still work fine)
// the loop start from 0, so i (current) when n = 3 is 0, 1, 2
// Pro solution 2
func SeriesSum2(n int) string {
	sum := 0.0
	for nth := 1; nth <= n; nth++ {
		sum += 1.0 / (3.0*float64(nth) - 2.0) //for ex n = 3, when looping in nth = 3, so 1 / ((3 * 3) - 2) = 1 / 7
	}
	return fmt.Sprintf("%.2f", sum)
} //different from before the loop start from 1, so nth (current) when n = 3 is 1, 2, 3
// Pro solution 3
func SeriesSum3(n int) string {
	sum := 0.0
	for f := 1.0; n > 0; f += 3.0 {
		n--
		sum += 1.0 / f
	}
	return fmt.Sprintf("%.2f", sum)
} //same as my solution, but the loop is based from n (and n value will be decreased), he initialize the denominator
//as f in the for loop syntax instead (also do denominator +3 in for loop syntax)

// Codewars - Functional Addition
// Create a function add(n)/Add(n) which returns a function that always adds n to any number
// Note for Java: the return type and methods have not been provided to make it a bit more challenging.
// var addOne = Add(1)
// addOne(3) -> 4
func Add(n int) func(int) int { //Add takes an integer n and returns a function that adds n to its argument
	return func(m int) int {
		return n + m
	}
} //addOne := Add(1) //the test is doing this process first, n = 1, store that n value and return a function that
// addOne(3)  -> 4 //would calculate n + addOne argument later
// addFive := Add(5) //this kind of thing (funtion return another function) is called closure
// addFive(10) -> 15
// Pro solution 1
func Add1(x int) func(int) int {
	return func(n int) int { return x + n }
} //same as before, but we make the function result  in one line
// Pro solution 2
func Add2(num int) func(int) int {
	return func(arg int) int {
		return arg + num //clean naming, nice
	}
} //makes it easy to read
// Pro solution 3
func Add3(a int) func(int) int {
	f := func(b int) int {
		b = b + a
		return b
	}
	return f //create the function initialize first (the function not placed in one line after keyword return)
}

// Codewars - A Rule of Divisibility by 13
// A divisibility rule is a shorthand way of determining whether a given integer is divisible by a fixed divisor
// without performing the division, usually by examining its digits. When you divide the successive powers of 10 by
// 13 you get the following remainders of the integer divisions:
// 1, 10, 9, 12, 3, 4
// because:
// 10 ^ 0 ->  1 (mod 13)
// 10 ^ 1 -> 10 (mod 13)
// 10 ^ 2 ->  9 (mod 13)
// 10 ^ 3 -> 12 (mod 13)
// 10 ^ 4 ->  3 (mod 13)
// 10 ^ 5 ->  4 (mod 13)
// why we only do this untill 10 ^ 5? because if we keep going the result would be repeated, for divisor = 13 the
// pattern is 1, 10, 9, 12, 3, 4 then it would be repeat again if we do 10 ^ 6, 10, ^ 7, 10 ^ 8, 10 ^ 9, 10 ^ 10,
// 10 ^ 11 again, the result will be 1, 10, 9, 12, 3, 4 again (and continues so on), this pattern would be different
// based the divisor we're using, it this case. the rule is using 13.
// Then the whole pattern repeats. Hence the following method:
// Multiply
// - the right most digit of the number with the left most number in the sequence shown above,
// - the rsecond right most digit with the second left most digit of the number in the sequence.
// The cycle goes on and you sum all these products. Repeat this process until the sequence of sums is stationary.
// (stasioner = keadaan tetap, tidak bergerak, atau tidak berubah seiring waktu pada suatu sistem, objek, atau nilai)
// Example:
// What is the remainder when 1234567 is divided by 13?
// 7      6     5      4     3     2     1  (digits of 1234567 from the right)
// ×      ×     ×      ×     ×     ×     ×  (multiplication)
// 1     10     9     12     3     4     1  (the repeating sequence)
// Therefore following the method we get:
// 7×1 + 6×10 + 5×9 + 4×12 + 3×3 + 2×4 + 1×1 = 178
// We repeat the process with the number 178:
// 8x1 + 7x10 + 1x9 = 87
// and again with 87:
// 7x1 + 8x10 = 87
// From now on the sequence is stationary (we always get 87) and the remainder of 1234567 by 13 is the same as the
// remainder of 87 by 13 ( i.e 9).
// Task:
// Call thirt the function which processes this sequence of operations on an integer n (>=0). thirt will return the
// stationary number.
// thirt(1234567) calculates 178, then 87, then 87 and returns 87.
// thirt(321) calculates 48, 48 and returns 48
func Thirt(n int) int {
	var prev int
	for prev != n {
		prev = n //set n as preveseprevious calculation value (prev), then do the calculation for new value afterward
		sum := 0
		for i := 0; n > 0; i++ {
			lastDigit := n % 10
			sum += lastDigit * (int(math.Pow(10, float64(i))) % 13) //need to import "math" pakage
			n = n / 10                                              //remove last digit
		}
		n = sum //we treat n as a current calculation value
	}
	return n
} //return when the looping is over, means now n value will always be the same as previous value
// Pro solution 1
func Thirt1(n int) int {
	var t = []int{1, 10, 9, 12, 3, 4}
	var i, j, k int
	for ; n != k; n = j {
		for k, i, j = n, 0, 0; n > 0; i++ {
			j += (n % 10) * t[i%6] //access it with mod, makes it repeat when the index more than 5 (start at 6)
			n /= 10                //0 % 6 = 0 (access index 0), if 6 % 6 = 0 (access index 0 again, it's repeated)
		}
	}
	return n
} //hard code the remainders of the integer divisions as variable t
// Pro solution 2
func Thirt2(n int) int {
	return walk(n, 0, 1, n)
} //need more explanation later
func walk(n int, s int, r int, m int) int {
	if m == 0 && s == n {
		return s
	}
	if m == 0 {
		return walk(s, 0, 1, s)
	}
	return walk(n, s+r*(m%10), (r*10)%13, m/10)
} //need more explanation later
