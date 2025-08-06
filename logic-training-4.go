package main

import (
	"math"
	"math/big"
	"sort"
	"strconv"
	"strings"
)

func main() {

}

// Codewars - Find the Middle Element
// As a part of this Kata, you need to create a function that when provided with a triplet, returns the index of the
// numerical element that lies between the other two elements. The input to the function will be an array of three
// distinct numbers (Haskell: a tuple). Foe example :
// [2, 3, 1] => 0 (2 is the number that fits between 1 and 3 and the index of 2 in the input array is 0)
// [5, 10, 14] => 1 (10 is the number that fits between 5 and 14 and the index of 10 in the input array is 1)
func Gimme(array [3]int) int {
	indexBetween := 0
	for i := 0; i < len(array); i++ {
		if i == 0 {
			if (array[i] < array[1] && array[i] > array[2]) || (array[i] < array[2] && array[i] > array[1]) {
				indexBetween = i
			}
		}
		if i == 1 {
			if (array[i] < array[0] && array[i] > array[2]) || (array[i] < array[2] && array[i] > array[0]) {
				indexBetween = i
			}
		}
		if i == 2 {
			if (array[i] < array[0] && array[i] > array[1]) || (array[i] < array[1] && array[i] > array[0]) {
				indexBetween = i
			}
		}
	}
	return indexBetween
} //basic way, compare it 1 by 1
// Pro solution 1
func Gimme1(array [3]int) int {
	left, middle, right := array[0], array[1], array[2]
	if (left > middle && left < right) || (left < middle && left > right) {
		return 0
	}
	if (middle > left && middle < right) || (middle < left && middle > right) {
		return 1
	}
	return 2
} //the concept is the same, but more simple and clean in returning process
// Pro solution 2
func Gimme2(array [3]int) int {
	arrayCopy := array
	arrSlice := arrayCopy[:]
	sort.Ints(arrSlice) //need to import "sort" package
	val := arrSlice[1]
	for i, v := range array {
		if v == val {
			return i
		}
	}
	return 0
} //sort the slice first, get the value we needed, then do for looping to do comparison

// Codewars - Moved in Squared Strings (I)
// You are given a string of n lines, each substring being n characters long: For example:
// s = "abcd\nefgh\nijkl\nmnop"
// We will study some transformations of this square of strings.
// Vertical mirror: vert_mirror (or vertMirror or vert-mirror)
// vert_mirror(s) => "dcba\nhgfe\nlkji\nponm"
// Horizontal mirror: hor_mirror (or horMirror or hor-mirror)
// hor_mirror(s) => "mnop\nijkl\nefgh\nabcd"
// or printed:
// vertical 	mirror   |horizontal	mirror
// abcd --> 	dcba     |abcd --> 		mnop
// efgh --> 	hgfe     |efgh --> 		ijkl
// ijkl --> 	lkji     |ijkl -->    	efgh
// mnop --> 	ponm     |mnop -->    	abcd
// Task : Write these two functions and high-order function oper(fct, s) where
// fct is the function of one variable f to apply to the string s (fct will be one of vertMirror, horMirror)
// Examples:
// s = "abcd\nefgh\nijkl\nmnop"
// oper(vert_mirror, s) => "dcba\nhgfe\nlkji\nponm"
// oper(hor_mirror, s) => "mnop\nijkl\nefgh\nabcd"
func VertMirror(s string) string {
	parts := strings.Split(s, "\n") //need to import "strings" package
	var partsReverse []string
	for i := 0; i < len(parts); i++ {
		current := parts[i]
		partReverse := ""
		for j := 0; j < len(current); j++ {
			partReverse = string(current[j]) + partReverse
		}
		partsReverse = append(partsReverse, partReverse)
	}
	return strings.Join(partsReverse, "\n") //need to import "strings" package
} //
func HorMirror(s string) string {
	parts := strings.Split(s, "\n")
	var partsOpposite []string
	for i := len(parts) - 1; i > -1; i-- {
		partsOpposite = append(partsOpposite, parts[i])
	}
	return strings.Join(partsOpposite, "\n")
}                               //
type FParam func(string) string //
func Oper(f FParam, x string) string {
	return f(x)
} //this is a function that receive other function as it's parameter (high-order function)
// Pro solution 1
func VertMirror1(s string) string {
	parts := strings.Split(s, "\n")
	for i, p := range parts { //looping for the slice range
		r := []rune(p)
		for j, k := 0, len(p)-1; j < k; j, k = j+1, k-1 { //how is this part work?
			r[j], r[k] = r[k], r[j]
		}
		parts[i] = string(r)
	}
	return strings.Join(parts, "\n")
} //need more research
func HorMirror1(s string) string {
	parts := strings.Split(s, "\n")
	for i, j := 0, len(parts)-1; i < j; i, j = i+1, j-1 { //how is this part work?
		parts[i], parts[j] = parts[j], parts[i]
	}
	return strings.Join(parts, "\n")
}                                //need more research
type FParam1 func(string) string //this part just the same
func Oper1(f FParam1, x string) string {
	return f(x)
}

// Codewars - The Highest Profit Wins
// Ben has a very simple idea to make some profit: he buys something and sells it again. Of course, this wouldn't
// give him any profit at all if he was simply to buy and sell it at the same price. Instead, he's going to buy it
// for the lowest possible price and sell it at the highest.
// Write a function that returns both the minimum and maximum number of the given list/array.
// [1,2,3,4,5] -> [1,5]
// [2334454,5] -> [5,2334454]
// [1] -> [1,1]
func MinMax(arr []int) [2]int {
	min := arr[0]
	max := arr[0]
	for i := 0; i < len(arr); i++ {
		if max < arr[i] {
			max = arr[i]
		} else if min > arr[i] {
			min = arr[i]
		}
	}
	return [2]int{min, max}
} // this is the manual way
// Pro solution 1
func MinMax1(arr []int) [2]int {
	sort.Ints(arr) //need to import "sort" package
	return [2]int{arr[0], arr[len(arr)-1]}
} //just sort the slice (array) ancending, and get the first and last element
// Pro solution 2
func MinMax2(arr []int) [2]int {
	min, max := arr[0], arr[0]
	for _, num := range arr {
		if num < min {
			min = num
		} else if num > max {
			max = num
		}
	}
	return [2]int{min, max}
}

// Codewars - Factorial
// Your task is to write function factorial
// 5 -> 120 (5 x 4 x 3 x 2 x 1)
func Factorial(n int) int {
	result := 1
	for i := n; i > 0; i-- {
		result = result * i
	}
	return result
} //just do looping and multiple every current valuse
// Pro solution 1
func Factorial1(n int) int {
	var result = 1
	for i := 1; i <= n; i++ {
		result *= i
	}
	return result
} //same, just do looping (but with more simple multiple syntax)
// Pro solution 2
func Factorial2(n int) int {
	if n < 2 {
		return 1
	}
	return n * Factorial2(n-1)
} //using recursive function method (function that called itself)

// Codewars - Simple Multiplication with 8 and 9
// multiplying a given number by eight (8) if it is an even number and by nine (9) otherwise.
func SimpleMultiplication(n int) int {
	if n%2 == 0 {
		return n * 8
	} else {
		return n * 9
	}
}

// Codewars - Strong Number
// Strong number is a number with the sum of the factorial of its digits is equal to the number itself.
// For example, 145 is strong, because 1! + 4! + 5! = 1 + 24 + 120 = 145. Given a positive number, find if it
// is strong or not, and return either "STRONG!!!!" or "Not Strong !!".
// 123 -> "Not Strong !!" (123 is not a strong number, because 1! + 2! + 3! = 9 is not equal to 123)
// 145 -> "STRONG!!!!" (145 is a strong number, because 1! + 4! + 5! = 1 + 24 + 120 = 145)
func Strong(n int) string {
	nProcess := n
	slc := []int{}
	for nProcess > 0 {
		slc = append(slc, nProcess%10)
		nProcess = nProcess / 10
	} //if n = 123, now the slc = [3, 2, 1]
	slcOrdered := []int{}
	for i := len(slc); i > 0; i-- {
		slcOrdered = append(slcOrdered, slc[i-1])
	} //now if n = 123, the slcOrdered = [1, 2, 3]
	result := 0
	for i := 0; i < len(slcOrdered); i++ {
		current := slcOrdered[i]
		currentFactorial := 1
		for j := current; j > 0; j-- {
			currentFactorial *= j
		}
		result += currentFactorial
	}
	if n == result {
		return "STRONG!!!!"
	} else {
		return "Not Strong !!"
	}
} //make the n integer into slice of integer (digit), order the position, loop for every splice to do factorial, sum it
// Pro solution 1
func Strong1(n int) string {
	sum := 0
	for _, c := range strconv.Itoa(n) {
		i, _ := strconv.Atoi(string(c)) //need to import "strconv" package
		sum += Factorial(i)
	}
	if sum == n {
		return "STRONG!!!!"
	}
	return "Not Strong !!"
}
func FactorialForStrong1(n int) int {
	if n > 0 {
		return n * Factorial(n-1)
	}
	return 1
} //make separated factorial function, do looping based from range
// Pro solution 2
func Strong2(n int) string {
	t := map[int]int{0: 1, 1: 1, 2: 2, 3: 6, 4: 24, 5: 120, 6: 720, 7: 5040, 8: 40320, 9: 362880}
	res := 0
	for v := n; v > 0; v /= 10 {
		res += t[v%10] //the moment when the map is used
	}
	if res == n {
		return "STRONG!!!!"
	} else {
		return "Not Strong !!"
	}
} //do mapping for factorial from digit 1 untill 9, i use it when needed haha

// Codewars - Rotate for a Max
// Take a number: 56789. Rotate left, you get 67895.
// Keep the first digit in place and rotate left the other digits: 68957.
// Keep the first two digits in place and rotate the other ones: 68579.
// Keep the first three digits and rotate left the rest: 68597.
// Now it is over since keeping the first four it remains only one digit which rotated is itself.
// You have the following sequence of numbers:
// 56789 -> 67895 -> 68957 -> 68579 -> 68597
// and you must return the greatest: 68957.
func MaxRot(n int64) int64 {
	nInt := int(n)
	slc := []int{}
	for nInt > 0 {
		slc = append(slc, nInt%10)
		nInt = nInt / 10
	}
	slcOrdered := []int{}
	for i := len(slc); i > 0; i-- {
		slcOrdered = append(slcOrdered, slc[i-1])
	}
	max := int(n)
	for i := 0; i < len(slcOrdered); i++ {
		slcOrdered = append(slcOrdered, slcOrdered[i])
		slcOrdered = append(slcOrdered[:i], slcOrdered[i+1:]...)
		currentRotate := 0
		for _, digit := range slcOrdered {
			currentRotate = currentRotate*10 + digit
		}
		if max < currentRotate {
			max = currentRotate
		}
	}
	return int64(max)
} //explode the n first into array (then sort it), do step by step rotate (while comparing with max value)
// Pro solution 1
func MaxRot1(n int64) int64 {
	str := strconv.FormatInt(n, 10) //need to import "strconv" package, we change n into string
	max := n                        //make max variable with original number n for first
	for i := 0; i < len(str)-1; i++ {
		str = str[:i] + str[i+1:] + string(str[i]) //this is where the rotation begin str[:i] means take all the string before str[i] (str[i] not included)
		num, _ := strconv.ParseInt(str, 10, 64)    //convert string back to integer
		if max < num {
			max = num
		}
	}
	return max
} //talk more about that rotate, str[i+1:] means take all the string after str[i+1] (str[i+1] included)
// Pro solution 2
func MaxRot2(n int64) int64 {
	s, max := strconv.FormatInt(n, 10), n //need to import "strconv" package
	for i := 0; i < len(s); i++ {
		s = s[:i] + s[i:][1:] + s[i:][:1]
		v, _ := strconv.ParseInt(s, 10, 64)
		if max < v {
			max = v
		}
	}
	return max
} //need more research

// Codewars - Powers of 2
// Complete the function that takes a non-negative integer n as input, and returns a list of all the powers
// of 2 with the exponent ranging from 0 to n (inclusive).
// n = 0 -> [1] because [2^0]
// n = 1 -> [1, 2] because [2^0, 2^1]
// n = 2 -> [1, 2, 4] because [2^0, 2^1, 2^2]
func PowersOfTwo(n int) []uint64 {
	list := []uint64{}
	for i := 0; i <= n; i++ {
		list = append(list, 1<<i) //what is this 1<<i mean? It's bit-shift (pergeseran angka binary)
	} //this bit-shift solution only work for the powers of 2
	return list
} //more explanation about bit-shift
// how to read binary number?
// 00001001 -> 2^3 + 2^0 = 8 + 1 = 9
// 01001100 -> 2^6 + 2^3 + 2^2 = 64 + 8 + 4 = 76
// the what is 1<<i work?
// 1<<0 -> shift 0 times for 1 in binary -> 00000001 -> 2^0 -> 1
// 1<<4 -> shift 4 times for 1 in binary -> 00010000 -> 2^4 -> 16
// My other solution
func PowersOfTwo0(n int) []uint64 {
	list := []uint64{}
	for i := 0; i <= n; i++ {
		list = append(list, uint64(math.Pow(2, float64(i)))) //need to import "math" package
	}
	return list
} //using built in function to di exponential
// Pro solution 1
func PowersOfTwo1(n int) (arr []uint64) {
	for i := 0; i <= n; i++ {
		arr = append(arr, 1<<i)
	}
	return
} //initialize the arr in the result type
// Pro solution 2
func PowersOfTwo2(n int) []uint64 {
	result := make([]uint64, n+1)
	result[0] = 1
	for i := 1; i <= n; i++ {
		result[i] = result[i-1] * 2
	}
	return result
} //do multiple 2 with the element before current for every loop

// Codewars - Wilson Primes
// Wilson primes satisfy this condition (P is a prime number)
// (P - 1)! + 1 divided by P * P
// So it would be ((P - 1)! + 1) / (P * P)
// This should give a whole number, where P! is the factorial of P
// Your task is to create a function that returns true if the given number is a Wilson prime and false otherwise.
// in this Wilson Prime, P is only maded by Prime number. What is Prime number itself?
// it's the number that greater than 1 & it must be divisible only by 1 and itself (not by any other number).
func AmIWilsonLogic(n int) bool {
	if n < 2 {
		return false
	}
	nMin1Factorial := 1
	for i := 1; i < n; i++ {
		nMin1Factorial *= i
	}
	result := (nMin1Factorial + 1) % (n * n)
	if result == 0 {
		return true
	} else {
		return false
	}
} //this is the base logic, it's actually correct but got error in go when the n is 563
// why? because we need to calculate (563-1)! which is 562!, the result is too large, tt overflows int or even int64,
// and your result becomes invalid, Go doesn't raise an error for int overflow — it silently gives the wrong result.
// so we need to use big.NewInt() to play with bigint data type, we need to "import math/big" first, we can't use *,
// +, %, etc. directly on *big.Int types. You must use methods like .Mul(), .Add(), .Mod(), etc., and also be careful
// with data types like int vs int64
func AmIWilson(n int) bool {
	if n < 2 {
		return false
	}
	nMin1Factorial := big.NewInt(1)
	for i := 1; i < n; i++ {
		nMin1Factorial.Mul(nMin1Factorial, big.NewInt(int64(i)))
	}
	numerator := nMin1Factorial.Add(nMin1Factorial, big.NewInt(1))
	denominator := big.NewInt(int64(n))
	denominator.Mul(denominator, big.NewInt(int64(n)))
	result := new(big.Int)
	result.Mod(numerator, denominator)
	if result.Cmp(big.NewInt(0)) == 0 {
		return true
	} else {
		return false
	}
} //same logic, but now we implement for bigint data type
// Pro solution 1
func AmIWilson1(n int) bool {
	return n == 5 || n == 13 || n == 563
} //just hardcode the Wilson Primes number
// Pro solution 2
func AmIWilson2(n int) bool {
	if n <= 1 {
		return false
	}
	factorial := big.NewInt(1)
	for i := 2; i < n; i++ {
		factorial.Mul(factorial, big.NewInt(int64(i)))
	}
	factorial.Add(factorial, big.NewInt(1))
	nBig := big.NewInt(int64(n))
	nSquared := new(big.Int).Mul(nBig, nBig)
	remainder := new(big.Int).Mod(factorial, nSquared)
	return remainder.Cmp(big.NewInt(0)) == 0
}

// Codewars - Mumbling
// "abcd" -> "A-Bb-Ccc-Dddd"
// "RqaEzty" -> "R-Qq-Aaa-Eeee-Zzzzz-Tttttt-Yyyyyyy"
// "cwAt" -> "C-Ww-Aaa-Tttt"
func Accum(s string) string {
	group := []string{}
	for i := 0; i < len(s); i++ {
		current := ""
		for j := 0; j < i+1; j++ {
			if j == 0 {
				current = current + strings.ToUpper(string(s[i])) //need to import "strings" package
			} else {
				current = current + strings.ToLower(string(s[i])) //need to import "strings" package
			}
		}
		group = append(group, current)
	}
	return strings.Join(group, "-") //need to import "strings" package
} //create loop for insert to slice of string,and create loop again inside it to determine the "Xxxx" shape element
// Pro solution 1
func Accum1(s string) string {
	parts := make([]string, len(s))
	for i := 0; i < len(s); i++ {
		parts[i] = strings.ToUpper(string(s[i])) + strings.Repeat(strings.ToLower(string(s[i])), i)
	}
	return strings.Join(parts, "-") //need to import "strings" package
} //strings.Repeat(s, count) returns a new string consisting of count copies of the string s concatenated together.
// for example strings.Repeat("a", 5) will return "aaaaa"
// Pro solution 2
func Accum2(s string) string {
	words := make([]string, len(s))
	for i, c := range s { //loops through each character c in string s, while also getting the index i, c is a rune (Go's version of a Unicode character)
		words[i] = strings.Title(strings.Repeat(strings.ToLower(string(c)), i+1)) //string(c) is to converts rune `c` to a string
	} //strings.Repeat(..., i+1), use `i+1` instead of `i` because on the first character (i = 0), you still want it to appear once.
	return strings.Join(words, "-")
} //btw strings.Title(...) before is to capitalizes the first letter of the string, the rest stay lowercase.

// Codewars - Remove First and Last Character
// Your goal is to write a function that removes the first and last characters of a string. You're given one
// parameter, the original string. Your function should handle strings of any length ≥ 2 characters. For strings
// with exactly 2 characters, return an empty string.
func RemoveChar(word string) string {
	word = word[:len(word)-1] //slice the string from the beginning up to the second-to-last character (one before the last character included)
	word = word[1:]           //create a new string starting from the second character (index 1)
	return word
} //get rid the last character, then get rid the first character
// Pro solution 1
func RemoveChar1(word string) string {
	return word[1 : len(word)-1]
} //just do both process at the same time, slice the string from index 1 (second character) into second-to-last
// Pro solution 2
func RemoveChar2(word string) string {
	var newWord = []rune(word)
	return string(newWord[1 : len(newWord)-1])
} //the proper way of Go, a simple return word[1:len(word)-1] will not work as expected for non-ASCII strings.
// this shows a proper understanding of strings and runes in Go
// Pro solution 3
func RemoveChar3(word string) string {
	var str string
	for i := 1; i < len(word)-1; i++ {
		str += string(word[i])
	}
	return str
} //manual looping way

// Codewars - Speed Control
// In John's car the GPS records every s seconds the distance travelled from an origin (distances are measured in an
// arbitrary but consistent unit). For ex, below is part of a record with s = 15 (s is interval second for every recorded) :
// x = [0.0, 0.19, 0.5, 0.75, 1.0, 1.25, 1.5, 1.75, 2.0, 2.25]
// The sections are:
// 0.0-0.19, 0.19-0.5, 0.5-0.75, 0.75-1.0, 1.0-1.25, 1.25-1.50, 1.5-1.75, 1.75-2.0, 2.0-2.25
// With floats it can happen that results depends on the operations order. To calculate hourly speed you can use:
// (3600 * delta_distance) / s.
// Calculate John's average hourly speed on every section: [45.6, 74.4, 60.0, 60.0, 60.0, 60.0, 60.0, 60.0, 60.0]
// Given s and x the task is to return as an integer the *floor* of the maximum average speed per hour obtained on
// the sections of x. If x length is less than or equal to 1 return 0 since the car didn't move.
// Example: With the above data your function gps(s, x) should return 74
func Gps(s int, x []float64) int {
	if len(x) < 2 { //filter for only one distance data, that means John isn't moving, so average speed is 0
		return 0
	}
	distances := []float64{}
	for i := 0; i < len(x)-1; i++ {
		distances = append(distances, x[i+1]-x[i])
	}
	averageSpeeds := []float64{}
	for _, distance := range distances {
		averageSpeeds = append(averageSpeeds, 3600*distance/float64(s))
	}
	maxSpeed := averageSpeeds[0]
	for i := 1; i < len(averageSpeeds); i++ {
		if maxSpeed < averageSpeeds[i] {
			maxSpeed = averageSpeeds[i]
		}
	}
	return int(math.Floor(maxSpeed)) //need to import "math" package
} //check fo stationary object, calculate slice of distances (looping method), calculate slice of average speed
// (foreach method), then find the max average speed by compare every element of slice (of average speeds)
// Pro solution 1
func Gps1(s int, segments []float64) int {
	var maxSpeed float64
	for index := 1; index < len(segments); index++ { //looping start from second element (index = 1)
		startSegment, endSegment := segments[index-1], segments[index] //init new variable startSegment & endSegment
		kmPerHour := 3600.0 * (endSegment - startSegment) / float64(s) //get current speed per-hour
		maxSpeed = math.Max(maxSpeed, kmPerHour)                       //compare it to every current speed per-hour
	}
	return int(maxSpeed) //return the max speed per-hour as an int
} //very simple with just do one looping and calculate it all to get current speed per-hour
// Pro solution 2
func Gps2(s int, x []float64) int {
	var maxSpeed = 0.0
	for i := 0; i < len(x)-1; i++ {
		deltaDistance := x[i+1] - x[i]
		avSpeed := (3600 * deltaDistance) / float64(s)
		if maxSpeed < avSpeed {
			maxSpeed = avSpeed
		}
	}
	return int(maxSpeed)
} //almost the same like before but looping start from first element (index = 0), and make index + 1 as endSegment
// but we calculate deltaDistance directly
// Pro solution 3
func Gps3(s int, x []float64) int {
	max := 0.0
	for i := 1; i < len(x); i++ {
		if av := x[i] - x[i-1]; av > max { //we can initialize also calculate a variable, then compare it in the same line in Go
			max = av
		}
	}
	return int(max * 3600 / float64(s))
} //ind max value of distance first, then calculate average speed per-hour in the end

// Codewars - Shortest Word
// Simple, given a string of words, return the length of the shortest word(s).
// String will never be empty and you do not need to account for different data types.
func FindShort(s string) int {
	words := strings.Split(s, " ") //need to import "strings" package
	min := len(words[0])
	for i := 1; i < len(words); i++ {
		if min > len(words[i]) {
			min = len(words[i])
		}
	}
	return min
} //split the string, compare the min length one by one with looping
// Pro solution 1
func FindShort1(s string) int {
	shortest := len(s)
	for _, word := range strings.Split(s, " ") {
		if len(word) < shortest {
			shortest = len(word)
		}
	}
	return shortest
} //same, but using range for do the looping
// Pro solution 2
func FindShort2(s string) int {
	var t int
	for i, s := range strings.Fields(s) {
		if len(s) < t || i == 0 {
			t = len(s)
		}
	}
	return t
} //set the min value (t) for the first time if i === 0 when doing comparison at the same time
// Pro solution 3
func FindShort3(s string) int {
	ss := strings.Split(s, " ")
	sort.Slice(ss, func(i, j int) bool { //need to import "sort" package
		return len(ss[i]) < len(ss[j])
	})
	return len(ss[0])
} //sort.Slice(slice, less func(i, j int) bool) is a function from Go's sort package. It sorts a slice based on the
//logic you give it in the less function. Then this anonymous function
//func(i, j int) bool {
//	return len(ss[i]) < len(ss[j])
//}
//defines the sorting logic:
//- It compares the lengths of two words in the ss slice.
//- It returns true if the word at index i is shorter than the word at index j.
//So: 👉 The sort puts shorter words first and longer words later.
//basically we just give the sort.Slice() to handle the sort by comparing 2 words with it's each len without know
//how the algorithms work, we're telling Go You're telling Go: “Hey, I don’t care how you sort this — just make sure
//each element i comes before j if the length of word i is less than the length of word j.”
//Go's sort.Slice uses the introsort algorithm, which is a hybrid of: quicksort, heapsort, insertion sort
//It chooses the most efficient one based on the data size and structure. You don’t need to implement the algorithm
//you just supply the comparison logic.
