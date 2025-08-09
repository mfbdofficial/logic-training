package main

import (
	"slices"
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
		strng = string(strng[len(strng) - 1]) + strng
		strng = strng[:len(strng) - 1]
		if !slices.Contains(arr, strng) {
			return false
		}
	}
	return true
} //do looping to rotate the string, check if that string contained in the array, once found it isn't, return false
//My other solution
func ContainAllRots0strng string, arr []string) bool {
	state := false
	for i := 0; i < len(strng); i++ {
		strng = string(strng[len(strng) - 1]) + strng
		strng = strng[:len(strng) - 1]
		state = false
		for _, value := range arr {
			if value == strng {
				state = true;
			}
		}
		if !state {
			return false
		}
	}
	return true
} //do looping to rotate the string, then looping the array to check one of element same as the string, 
//return false immediately if no element found that same as the current string in every rotation
//Pro solution 1
func ContainAllRots1(strng string, arr []string) bool {
  	rotations := make(map[string]struct{}) //part 1
  	for i := range strng { //part 2
    	rotations[strng[i:] + strng[:i]] = struct{}{} //struct{} is a type declaration: it means a struct with no 
  	} //fields, this type takes zero memory, struct{}{} is a value of that type: just like int(5) creates an int, struct{}{} creates a value of an empty struct.
  	for _, v := range arr { //part 3
    	delete(rotations, v)
  	}
  	return len(rotations) == 0 //part 4
}
//part 1
//- map[string]struct{}: A set-like map — where keys are strings, and values are empty structs (making a map and define that map will have string as the keys and empty struct as the values)
//- struct{}: Takes up 0 bytes (efficient).
//- this line creates an empty map to hold all rotations of the input string.
//part 2
//- let’s say strng = "abc". This loop will generate all circular rotations:
//		i = 0: "abc"[0:] + "abc"[:0] → "abc" + "" = "abc"
//		i = 1: "abc"[1:] + "abc"[:1] → "bc" + "a" = "bca"
//		i = 2: "abc"[2:] + "abc"[:2] → "c" + "ab" = "cab"
//- each of these is added to the rotations map:
//		rotations["abc"] = struct{}{}
//		rotations["bca"] = struct{}{}
//		rotations["cab"] = struct{}{}
//part 3
//- iterates over each string v in the arr slice.
//- delete(rotations, v) will remove it if it exists in the map.
//- after this loop, any rotation that was found in arr will be removed from the map.
//part 4
//- if the map is now empty, that means: All possible rotations were found in arr
//- if any rotation wasn't found in arr, it would still exist in the map, so the length would be > 0.
//Pro solution 2
func ContainAllRots2(strng string, arr []string) bool { 
    counter := 0
    master := []string{}
    for i,_ := range strng{
        master = append(master,strng[i:] + strng[:i])
    }
    for _,j := range master{
        for _,k := range arr{
            if j == k{
                counter ++
                break
            }
        }
    }
    return len(strng) == counter
} //counter up for every match between each element of arr to each string rotation, all amount of string rotation 
//generally would be same as the string length, so we compare the counter with the string's length
//Pro solution 3
func ContainAllRots3(strng string, arr []string) bool { 
  	if len(arr) == 0 { return true }
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