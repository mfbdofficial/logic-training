package main

import (
	"sort"
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
