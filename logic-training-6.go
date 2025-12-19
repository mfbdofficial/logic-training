package main

import (
	"bytes"
	"fmt"
	"math"
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
