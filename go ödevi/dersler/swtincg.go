package main

import (
	"fmt"
	"time"
)

func main() {
	i := 3
	fmt.Println("write,", i, "as")
	switch i {
	case 1:
		fmt.Println("one")
	case 2:
		fmt.Println("two")
	case 3:
		fmt.Println("threeex")
	}
	switch time.Now().Weekday() {
	case time.Saturday, time.Sunday:
		fmt.Println("ıl s the   weee kend ")
	default:
		fmt.Println("ıl s q weekday")
	}

}
