package main

const sabit_1 = "deger 1" //tek deger varsa bu yöntemi kullanıyoruz

const ( // birden fazla const var ise () kullanarak bu yöntemi kullanıyoruz

	sabit_2 = "degeer 2"
	sabit_3 = "deger 3"
	sabit_4 = "deger 4"
)

const (
	sabit_5 = iota // eğer bizim degerlerimiz sıralı artıyorsa bu yöntemi kullanıyoruz  2,3,45 gibi
	sabit_6
	sabit_7
)

func main() {

	println(sabit_1, sabit_2, sabit_3, sabit_4, sabit_5, sabit_6, sabit_7)
}
