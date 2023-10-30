package main

import "fmt"

func main() {
	sayi1 := 21
	sayi2 := 23
	toplam := sayi1 + sayi2
	fmt.Println("Toplam:", toplam)

	deger1 := 1
	deger2 := 2

	cikarma := deger1 - deger2
	fmt.Println("cıkarma", cikarma)

	if deger1 == deger2 {
		fmt.Println("sa")
	} else if deger1 != deger2 {
		fmt.Println("esit degil")
	} else {
		fmt.Println("hata")
	}

}
