package main

import "fmt"

var arr_1 [1]int                  // burada [] kullnarak   kaç deger yeri olsun diye bir atam yapıyoruz
var arr_2 = [5]int{1, 2, 3, 4, 5} //burada degerlelr veridk

func main() {
	arr_3 := make([]int, 3)

	fmt.Println(arr_1, arr_2, arr_3)

	arr_3[1] = 2

	fmt.Println("arr_1:%d \n", len(arr_1))
	fmt.Println("arr_2:%d \n", len(arr_3))
}
