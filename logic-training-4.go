package main

import (
	"sort"
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
