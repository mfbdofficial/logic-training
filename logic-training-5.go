package main

import (
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
