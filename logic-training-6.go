package main

import (
	"bytes"
	"fmt"
	"math"
	"slices"
	"strconv"
	"strings"
)

func main() {

}

// Codewars - Scaling Squared Strings
// You are given a string of n lines, each substring being n characters long. For example:
// s = "abcd\nefgh\nijkl\nmnop"
// We will study the "horizontal" and the "vertical" scaling of this square of strings. A k-horizontal scaling of a
// string consists of replicating k times each character of the string (except '\n'). Example:
// 2-horizontal scaling of s: => "aabbccdd\neeffgghh\niijjkkll\nmmnnoopp"
// A v-vertical scaling of a string consists of replicating v times each part of the squared string. Example:
// 2-vertical scaling of s: => "abcd\nabcd\nefgh\nefgh\nijkl\nijkl\nmnop\nmnop"
// Function scale(strng, k, v) will perform a k-horizontal scaling and a v-vertical scaling. Example:
// a = "abcd\nefgh\nijkl\nmnop"
// scale(a, 2, 3) -> "aabbccdd\naabbccdd\naabbccdd\neeffgghh\neeffgghh\neeffgghh\niijjkkll\niijjkkll\niijjkkll\nmmnnoopp\nmmnnoopp\nmmnnoopp"
// abcd   ----->   aabbccdd
// efgh            aabbccdd
// ijkl            aabbccdd
// mnop            eeffgghh
//
//	eeffgghh
//	eeffgghh
//	iijjkkll
//	iijjkkll
//	iijjkkll
//	mmnnoopp
//	mmnnoopp
//	mmnnoopp
func Scale(s string, k, n int) string {
	if s == "" { //check if s is empty string
		return s
	}
	sSlice := strings.Split(s, "\n")   //["abc", "def", "ghi"]
	for index, value := range sSlice { //for do horizontal scaling operation
		current := strings.Split(value, "") //[["a", "b", "c"]]
		for index, value := range current {
			letter := ""
			for i := k; i > 0; i-- { //loop for every letter with k times
				letter += value
			}
			current[index] = letter //[["aa", "bb", "cc"]]
		}
		sSlice[index] = strings.Join(current, "")
	}
	sHorizontal := strings.Join(sSlice, "\n")
	sSliceHorizontal := strings.Split(sHorizontal, "\n") //["aabbcc", "ddeeff", "gghhii"]
	for index, value := range sSliceHorizontal {         //for do vertical scaling operation
		for j := n; j > 1; j-- { //loop for every line with n times
			sSliceHorizontal[index] += "\n" + value
		}
	}
	return strings.Join(sSliceHorizontal, "\n")
} //join all the result after horizontal and vertical scaling
// Pro solution 1
func Scale1(s string, k, n int) (result string) {
	subStr := strings.Split(s, "\n")
	for _, value := range subStr { //vertical scaling operation
		var hscale string
		for _, char := range value { //horizontal scaling operation
			hscale += strings.Repeat(string(char), k)
		}
		result += strings.Repeat(hscale+"\n", n)
	}
	return strings.TrimRight(result, "\n") //just do nested looping, when the outer layer is do repeat for every
} //line, and the inner layer do repeat for every letter
// Pro solution 2
func Scale2(input string, horizontal, vertical int) string {
	if input == "" {
		return input
	}
	var prepare []string = strings.Split(input, "\n")
	var constructor []string
	var result []string
	for _, stroke := range prepare {
		constructor = nil
		for _, character := range stroke { //do strings.Repeat for every letter (horizontal scaling)
			constructor = append(constructor, strings.Repeat(string(character), horizontal))
		}
		result = append(result, strings.Repeat(fmt.Sprint(strings.Join(constructor, "")+"\n"), vertical)) //need to
	} //import "fmt" package, in this part we do strings.Repeat for every line + "\n"
	return strings.TrimSuffix(strings.Join(result, ""), "\n") //there will be additional "\n" in the end, so we cut
} //it using string.TrimSuffix
// Pro solution 3
func Scale3(s string, k, n int) string {
	if len(s) == 0 {
		return s
	}
	words := strings.Split(s, "\n")
	ret := make([]string, 0, len(words)*n) //initialize a variable as a slice of string that have length multiple with n (pasce vertical scaling)
	var buf bytes.Buffer                   //do more research for this part
	for _, w := range words {
		buf.Grow(len(w) * k)
		for _, r := range w {
			buf.WriteString(strings.Repeat(string(r), k))
		}
		for i := 0; i < n; i++ {
			ret = append(ret, buf.String())
		}
		buf.Reset()
	}
	return strings.Join(ret, "\n")
} //not yet

// Codewars - Deodorant Evaporator
// This program tests the life of an evaporator containing a gas. We know the content of the evaporator (content in
// ml), the percentage of foam or gas lost every day (evap_per_day) and the threshold (threshold) in percentage
// beyond which the evaporator is no longer useful. All numbers are strictly positive. The program reports the nth
// day (as an integer) on which the evaporator will be out of use.
// evaporator(10, 10, 5) -> 29
// Mathematical explanation :
// you have: content = 10 ml, evap_per_day = 10% lost per day, threshold = 5% of the original content
// the evaporator becomes “out of use” when the current content < 5% of the initial content.
// 5% of 10 ml = 0.5 ml, so the evaporator stops when the remaining content is < 0.5 ml.
// day-by-day explanation : each day, the content loses 10% (so it keeps 90%).
// let’s calculate the case manually:
//
//	Day 0: 10.000 ml
//	Day 1: 10 × 0.9 = 9.000
//	Day 2: 9 × 0.9 = 8.100
//	Day 3: 8.1 × 0.9 = 7.290
//	.....
//	continue until the amount < 0.5 ml
//
// the formula after n days: remaining = 10 × (0.9)^n
// we want: 10 × (0.9)^n < 0.5
// divide both sides by 10: (0.9)^n < 0.05
// now we solve using logs: n > ln(0.05) / ln(0.9)
// calculate: ln(0.05) ≈ -2.9957 and ln(0.9) ≈ -0.1053
// n > −2.9957 / −0.1053 ≈ 28.45
// Since days must be integers, we round up → 29 days.
func Evaporator(content float64, evapPerDay int, threshold int) int {
	eligbilityLimits := (content * float64(threshold)) / 100 //calculate limit when evaporator considered out of use
	dayCount := 0                                            //make a counter (as a days spent)
	for content > eligbilityLimits {                         //do looping as long as evaporator still useable
		content = content - (content*float64(evapPerDay))/100
		dayCount++
	}
	return dayCount
} //the logic is just decrease the evaporator's content day-by-day, and stop looping when it's out of use
// Pro solution 1
func Evaporator1(content float64, evapPerDay int, threshold int) int {
	base := 1.0 - float64(evapPerDay)/100.0 //calculate base evaporator's gas contained
	top := float64(threshold) / 100.0       //calculate limit when evaporator considered out of use
	N := math.Log(top) / math.Log(base)     //calculate it using log equation (need to import "math" package)
	return int(math.Ceil(N))
} //using math log equation
// Pro solution 2
func Evaporator2(_ float64, evapPerDay int, threshold int) int {
	return int(math.Ceil(math.Log(float64(threshold)/100) / math.Log(1-float64(evapPerDay)/100))) //need to import "math" package
} //same as pro solution 1, calculate it using log equation, but make it into 1 line

// Codewars - A Rule of Divisibility by 7
// A number m of the form 10x + y is divisible by 7 if and only if x − 2y is divisible by 7.
// In other words, subtract twice the last digit from the number formed by the remaining digits.
// Continue to do this until a number known to be divisible by 7 is obtained; you can stop when this
// number has at most 2 digits because you are supposed to know if a number of at most 2 digits is
// divisible by 7 or not. The original number is divisible by 7 if and only if the last number
// obtained using this procedure is divisible by 7.
// Examples:
//  1. m = 371 -> 37 − (2×1) -> 37 − 2 = 35 ; thus, since 35 is divisible by 7, 371 is divisible by 7,
//     the number of steps to get the result is 1.
//  2. m = 1603 -> 160 - (2 x 3) -> 154 -> 15 - 8 = 7 and 7 is divisible by 7.
//  3. m = 372 -> 37 − (2×2) -> 37 − 4 = 33 ; thus, since 33 is not divisible by 7, 372 is not
//     divisible by 7.
//  4. m = 477557101->47755708->4775554->477547->47740->4774->469->28 and 28 is divisible by 7, so is
//  477557101. The number of steps is 7.
//
// Task:
// Your task is to return to the function seven(m) (m integer >= 0) an array (or a pair, depending on
// the language) of numbers, the first being the last number m with at most 2 digits obtained by your
// function (this last m will be divisible or not by 7), the second one being the number of steps to
// get the result. Return on the stack [last-number-m-with-at-most-2-digits, number-of-steps].
// Unit test examples :
// seven(371) should return [35, 1]
// seven(1603) should return [7, 2]
// seven(477557101) should return [28, 7]
func Seven(n int64) []int {
	nString := strconv.Itoa(int(n)) //need to import "strconv" package, change number n into string
	//nString := strconv.FormatInt(n, 10) //convert string with base 10 (decimal)
	step := 0
	for len(nString) > 2 { //do loop based from the string length
		step += 1 //counter up step
		y := n % 10
		n = (n / 10) - (2 * y) //create the new number n value with the mathematical operation
		nString = strconv.Itoa(int(n))
	}
	return []int{int(n), step} //return slice of int {current_number_when_2_digits, number_of_step}
} //so we change number to string, do loop based from it's length, use counter and update n with the math operation
// Pro solution 1
func Seven1(n int64) []int {
	r := 0                                //r as a step
	for ; n >= 100; n = n/10 - 2*(n%10) { //loop if n >= 100 (number reach 100 value), of course got 3 digits
		r += 1
	}
	return []int{int(n), r} //return slice of int {current_number_when_2_digits, number_of_step}
} //we do calculation and update the n also make it as a loop at the same time in one line
// Pro solution 2
func Seven2(n int64) []int { //just do n >= 100 in loop, not change it into string
	i := 0
	for n >= 100 {
		n = n/10 - 2*(n%10) //do math calculation in one line makes it more clean
		i++
	}
	return []int{int(n), i}
} //same as my solution but more efficient

// Codewars - Drying Potatoes
// John bought potatoes: their weight is 100 kilograms. Potatoes contain water and dry matter. The water content is
// 99 percent of the total weight. He thinks they are too wet and puts them in an oven - at low temperature - for
// them to lose some water. At the output the water content is only 98%. What is the total weight in kilograms (water
// content plus dry matter) coming out of the oven? He finds 50 kilograms and he thinks he made a mistake: "So much
// weight lost for such a small change in water content!" Can you help him?
// Write function potatoes with p0 (initial percent of water), w0 (initial weight), p1 (final percent of water)
// potatoes() should return the final weight coming out of the oven w1 truncated as an int.
// Example: potatoes(99, 100, 98) --> 50, potatoes(82, 127, 80) --> 114
// Math analyze step by step for example 1:
//  1. Calculate dry matter: if water is 99%, then dry matter is 1%
//     dry matter = 1% of 100 kg = 1 kg (that 1 kg of dry matter stays constant forever)
//  2. After drying: water = 98%, dry matter = 2% (that same 1 kg dry matter is now 2% of the total weight)
//  3. Calculate final weight: 1 kg = 2% of total weight
//     total weight = (1 / 2%) x 100% = 50 kg
//
// Math analyze step by step for example 2:
//  1. Calculate dry matter: if water is 82%, then dry matter is 100% - 82% = 18%
//     dry matter = 18% of 127 kg = 22,86 kg (that 22,6 kg of dry matter stays constant forever)
//  2. After drying: water = 80%, dry matter = 20% (that same 22,86 kg dry matter is now 20% of the total weight)
//  3. Calculate final weight: 22,86 kg = 20% of total weight
//     total weight = (22,86 / 20%) x 100% = 114,3 kg
func Potatoes(p0, w0, p1 int) int {
	dryMatter := 100 - float64(p0)
	dryMatterWeight := dryMatter * float64(w0) / 100 //always do the multiply process first
	finalDryMatter := 100 - float64(p1)
	w1 := dryMatterWeight * 100 / finalDryMatter //always do the multiply process first
	return int(w1)
} //just do the calculation step by step like the math analyze
// Pro solution 1
func Potatoes1(p0, w0, p1 int) int {
	return w0 * 100 * (100 - p0) / (100 - p1) / 100
} //do it straight as a return
// Pro solution 2
func Potatoes2(p0, w0, p1 int) int {
	return w0 * (100 - p0) / (100 - p1)
} //same as before, do it straight in return but simple, cause there's "* 100" and "/ 100", just delete that part
// Pro solution 3
func Potatoes3(p0, w0, p1 int) int {
	const percent = 100
	return int(float64(w0) * (float64(percent-p0) / float64(percent-p1)))
} //same but still playing with the float64 data type
// Pro solution 4
func Potatoes4(p0, w0, p1 int) int {
	return (100 - p0) * w0 / (100 - p1)
} //same as before, but we just change the order of multiply (math process)

// Codewars - What Dominates Your Array?
// A zero-indexed array arr consisting of n integers is given. The dominator of array arr is the value that occurs
// in more than half of the elements of arr. For example, consider array arr such that arr = [3,4,3,2,3,1,3,3]. The
// dominator of arr is 3 because it occurs in 5 out of 8 elements of arr and 5 is more than a half of 8. Write a
// function dominator(arr) that, given a zero-indexed array arr consisting of n integers, returns the dominator of
// arr. The function should return −1 if array does not have a dominator. All values in arr will be >=0.
func Dominator(a []int) int {
	halfLimit := len(a) / 2
	var numDone []int
	for i := 0; i < len(a); i++ {
		current := a[i]
		counter := 0
		if !slices.Contains(numDone, current) { //need to import "slices" package
			for j := 0; j < len(a); j++ {
				if current == a[j] {
					counter++
				}
			}
			numDone = append(numDone, current)
		}
		if counter > halfLimit {
			return current
		}
	}
	return -1
} //first solution doesn't work because Codewars doesn't support "slices" package
// My other solution 1
func Dominator0(a []int) int {
	halfLimit := len(a) / 2
	var numDone []int
	for i := 0; i < len(a); i++ {
		current := a[i]
		counter := 0
		if !contains0(numDone, current) {
			for j := 0; j < len(a); j++ {
				if current == a[j] {
					counter++
				}
			}
			numDone = append(numDone, current)
		}
		if counter > halfLimit {
			return current
		}
	}
	return -1
}
func contains0(arr []int, val int) bool {
	for _, v := range arr {
		if v == val {
			return true
		}
	}
	return false
} //same as before, but we use another function manually to change the "slices" package
// My other solution 2
func Dominator00(a []int) int {
	if len(a) == 0 {
		return -1
	}
	candidate := a[0] //phase 1, find candidate (using Boyer-Moore algorithm)
	count := 1
	for i := 1; i < len(a); i++ {
		if a[i] == candidate {
			count++ //increase count when we see the same number
		} else {
			count-- //decrease count when we see a different number
		}
		if count == 0 { //when count reaches 0, we abandon the current candidate and choose a new one
			candidate = a[i]
			count = 1
		}
	}
	occurrences := 0      //phase 2, verify candidate
	for _, v := range a { //make sure the candidate we get is really the majority (more than the half), by count it
		if v == candidate { //using for loop
			occurrences++
		}
	}
	if occurrences > len(a)/2 { //then compare it with the half size based from slice's length divide by 2
		return candidate
	}
	return -1
} //filter every empty array, find majority candidate using Boyer-Moore algorith, then verify the cannditate > half
// more about Boyer-Moore algorithm:
// - A dominator appears more than half
// - Pair every dominator value with a different value → dominator still survives
// so the process we do is:
// - Increase count when we see the same number
// - Decrease count when we see a different number
// - When count reaches 0, we abandon the current candidate and choose a new one
// why this always works (simple proof)
// - Dominator count > n/2
// - All non-dominator elements combined < n/2
// - Pairing cancels one dominator with one non-dominator
// - Dominator cannot be fully canceled
// - It must remain as final candidate
// mental model: “Every different number cancels one vote of the current candidate; only a true majority can survive.”
// Pro solution 1
func Dominator1(a []int) int {
	counts := make(map[int]int)
	for _, val := range a {
		counts[val]++
		if counts[val] > len(a)/2 {
			return val
		}
	}
	return -1
} //using map, need more research
// Pro solution 2
func Dominator2(a []int) int {
	m := make(map[int]int)
	for _, val := range a {
		m[val] += 1
	}
	for ele, count := range m {
		if count > len(a)/2 {
			return ele
		}
	}
	return -1
} //also using map, need more research

// Codewars - Char Code Calculation
// Given a string, turn each character into its ASCII character code and join them together to create a number -
// let's call this number total1:
// 'ABC' --> 'A' = 65, 'B' = 66, 'C' = 67 --> 656667
// Then replace any incidence of the number 7 with the number 1, and call this number 'total2':
// total1 = 656667 -> total2 = 656661
// Then return the difference between the sum of the digits in total1 and total2:
// (6 + 5 + 6 + 6 + 6 + 7) - (6 + 5 + 6 + 6 + 6 + 1) = 6
func Calc(s string) int {
	sArr := strings.Split(s, "")
	sArrASCII := make([]string, 0, len(s))
	for _, letter := range sArr {
		sArrASCII = append(sArrASCII, strconv.Itoa(int(letter[0]))) //need to import "strconv" package
	}
	sArrTotal1 := strings.Split(strings.Join(sArrASCII, ""), "") //need to import "strings" package
	sArrTotal2 := make([]string, 0, len(sArrTotal1))
	for _, number := range sArrTotal1 {
		if number == "7" {
			number = "1"
		}
		sArrTotal2 = append(sArrTotal2, number)
	}
	total1 := 0
	for _, sNumber := range sArrTotal1 {
		number, err := strconv.Atoi(sNumber)
		if err != nil {
			return 0
		}
		total1 = total1 + number
	}
	total2 := 0
	for _, sNumber := range sArrTotal2 {
		number, err := strconv.Atoi(sNumber)
		if err != nil {
			return 0
		}
		total2 = total2 + number
	}
	return total1 - total2
} //manual way -> split string, change itu ASCII, split ASCII, create a second data (rules 7 into 1), sum the total
// of each, then just do subtraction operation
// Pro solution 1
func Calc1(s string) int {
	n := 0
	for _, c := range s {
		if (c / 10) == 7 {
			n++ //checking for the last digit number
		}
		if (c % 10) == 7 { //everytime there's 7, then do counter up (cause that's the place where making the result
			n++ //will be different, other number just gonna kill each other into 0)
		}
	}
	return 6 * n //n (that we do counter up is how much we found the digit that need to be changed from 7 to 1)
} //6 is the different value will be counted (7 - 1 = 6)
// all number that not 7 will gone anyway, so just make a counter up everytime  there's 7
// Pro solution 2
func Calc2(s string) int {
	str := ""
	for _, val := range s { //when we loop over a string using for _, val := range s, the variable val is not a
		//string; it is a rune (an alias for int32). A rune represents the Unicode code point of the character.
		str += fmt.Sprintf("%d", val) //fmt.Sprintf to format a string according to a format specifier and return
	} //the resulting string, rather than printing it to standard output like fmt.Printf, so we create a joined
	//string of a converted string (rune) value
	return strings.Count(str, "7") * 6 //count how much we found string "7" and multiple it with 6 like before
} //this is the standard format for fmt.Sprintf :
// - %s = the value as a string
// - %d = the value as a decimal integer
// - %.2f = a floating-point number with two decimal places
// - %v = the value in its default format
// - %+v = for structs, includes field names
// - %T = the type of the value
// - %p = the pointer address in hexadecimal
// Pro solution 3
func Calc3(s string) int {
	diff := 0
	for _, d := range s {
		ds := strconv.Itoa(int(d))         //convert the string (rune) into string number
		diff += 6 * strings.Count(ds, "7") //check if that string number is "7", we'll get 1 multiple by 6 and do sum
	} //we do that for every loop, so strings.Count will give us only 1 or 0
	return diff
} //the concept is the same, but we do string convert, and sum in every loop

// Codewars - Ordered Count of Characters
// Count the number of occurrences of each character and return it as a (list of tuples) in order of appearance. For
// empty output return (an empty list). Consult the solution set-up for the exact data structure implementation
// depending on your language.
func OrderedCount(text string) []Tuple {

}
