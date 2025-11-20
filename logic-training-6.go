package main

import (
	"bytes"
	"fmt"
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
