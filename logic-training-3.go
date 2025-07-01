package main

import (
	"fmt"
	"regexp"
	"strconv"
	"strings"
	"unicode"
)

func main() {

}

// Codewars - Directions Reduction
// Once upon a time, on a way through the old wild mountainous west, a man was given directions to go from one point
// to another. The directions were "NORTH", "SOUTH", "WEST", "EAST". Clearly "NORTH" and "SOUTH" are opposite, "WEST" and "EAST" too.
// Going to one direction and coming back the opposite direction right away is a needless effort. Since this is the
// wild west, with dreadful weather and not much water, it's important to save yourself some energy, otherwise you might
// die of thirst!
// How I crossed a mountainous desert the smart way? The directions given to the man are, for example, the following (depending on the language):
// ["NORTH", "SOUTH", "SOUTH", "EAST", "WEST", "NORTH", "WEST"].
// You can immediately see that going "NORTH" and immediately "SOUTH" is not reasonable, better stay to the same place!
// So the task is to give to the man a simplified version of the plan. A better plan in this case is simply:
// ["WEST"]
// Other examples:
// In ["NORTH", "SOUTH", "EAST", "WEST"], the direction "NORTH" + "SOUTH" is going north and coming back right away.
// The path becomes ["EAST", "WEST"], now "EAST" and "WEST" annihilate each other, therefore, the final result is [] (nil in Clojure)
func DirReduc(arr []string) []string {
	var notYet bool = true
	oldPlan := make([]string, len(arr))
	copy(oldPlan, arr)
	var newPlan []string
	for notYet {
		newPlan = []string{}
		for i := 0; i < len(oldPlan); i++ {
			if (i + 1) < len(oldPlan) {
				current := strings.ToLower(oldPlan[i]) //don't forget to import "strings" package
				next := strings.ToLower(oldPlan[i+1])
				if current == "north" {
					if next == "south" {
						i++
					} else {
						newPlan = append(newPlan, oldPlan[i])
					}
				} else if current == "south" {
					if next == "north" {
						i++
					} else {
						newPlan = append(newPlan, oldPlan[i])
					}
				} else if current == "east" {
					if next == "west" {
						i++
					} else {
						newPlan = append(newPlan, oldPlan[i])
					}
				} else if current == "west" {
					if next == "east" {
						i++
					} else {
						newPlan = append(newPlan, oldPlan[i])
					}
				}
			} else {
				newPlan = append(newPlan, oldPlan[i])
			}
		}
		if strings.Join(oldPlan, ",") == strings.Join(newPlan, ",") {
			notYet = false
		} else {
			oldPlan = make([]string, len(newPlan))
			copy(oldPlan, newPlan)
		}
	}
	if len(newPlan) == 0 {
		return []string{}
	} else {
		return newPlan
	}
}

// Codewars - Surface Area and Volume of a Box
// Write a function that returns the total surface area and volume of a box. The given input will be three
// positive non-zero integers: width, height, and depth.
func GetSize(w, h, d int) [2]int {
	totalSurfaceArea := 2 * ((w * h) + (w * d) + (h * d))
	volume := w * h * d
	result := [2]int{totalSurfaceArea, volume} //make the slice first
	return result
} //just do equation, insert it into variable as a slice of int
// Pro solution 1
func GetSize1(w, h, d int) [2]int {
	area := (2 * (h * w)) + (2 * (h * d)) + (2 * (d * w))
	volume := w * h * d
	return [2]int{area, volume}
} //pass the slice directly in the return
// Pro solution 2
func GetSiz2(w, h, d int) [2]int {
	return [2]int{2 * (w*h + w*d + h*d), w * h * d}
} //pass the equation in the return

// Codewars - Simple Fun #176: Reverse Letter
// Given a string str, reverse it and omit all non-alphabetic characters. Input & output -> [input] string str & [output] a string. Example:
// For str = "krishan", the output should be "nahsirk".
// For str = "ultr53o?n", the output should be "nortlu".
func ReverseLetters(s string) string {
	var reverse string
	for i := len(s); i > 0; i-- {
		if unicode.IsLetter(rune(s[i-1])) { //need to import "unicode"
			reverse += string(s[i-1])
		}
	}
	return reverse
} //use rune data type to check it
// Pro solution 1
func ReverseLetters1(s string) string {
	arr := []rune{}
	for _, v := range s {
		if unicode.IsLetter(v) { //need to import "unicode"
			arr = append([]rune{v}, arr...)
		}
	}
	return string(arr)
} //using slice of rune type
// Pro solution 2
func ReverseLetters2(s string) string {
	var word string = ""
	for i := len(s) - 1; i >= 0; i-- {
		if (s[i] > 64 && s[i] < 91) || (s[i] > 96 && s[i] < 123) {
			word += string(s[i])
		}
	}
	return word
} //using byte of the string to check
// Pro solution 3
func ReverseLetters3(s string) string {
	re := regexp.MustCompile(`[^a-zA-Z]+`) //need to import "regexp"
	rns := []rune(s)
	for i, j := 0, len(s)-1; i < j; i, j = i+1, j-1 {
		rns[i], rns[j] = rns[j], rns[i]
	}
	return re.ReplaceAllString(string(rns), "")
} //using regex

// Codewars - Number of Decimal Digits
// Determine the total number of digits in the integer (n>=0) given as input to the function. For example,
// 9 is a single digit, 66 has 2 digits and 128685 has 6 digits. Be careful to avoid overflows/underflows.
// All inputs will be valid.
func Digits(n uint64) int {
	//nString := strconv.Itoa(n) //only if n is int (in this case, n is uint64)
	nString := strconv.FormatUint(n, 10) //need to import "strconv",
	return len(nString)
} //The second parameter for strconv.FormatUint(), for standard decimal representation, use 10. Use other bases like 2 for binary, 16 for hexadecimal, etc.//
// Pro solution 1
func Digits1(n uint64) int {
	return len(fmt.Sprintf("%d", n)) //need to import "fmt"
} //check the length of a string from fmt.Sprintf("%d", n)
// Pro solution 2
func Digits2(n uint64) (numDigits int) {
	for numDigits = 1; n > 9; numDigits++ {
		n /= 10
	}
	return
} //Keep doing the division with 10, means shift into right, and do counting
