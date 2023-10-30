package main

import "fmt"

func main() {
	if 7%2 == 0 {
		fmt.Println("7  is even ")
	} else {
		fmt.Println("7 is gold")
	}
	if 8%4 == 0 {
		fmt.Println("8 is  divisible  by 4")
	}
	if num := 9; num < 0 {
		fmt.Println("is  negati va")
	} else if num < 10 {
		fmt.Println("has 1  deigit ")
	} else {
		fmt.Println("has  multpi e  digiis ")
	}

}
