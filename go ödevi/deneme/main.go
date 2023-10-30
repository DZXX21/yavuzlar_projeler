package main

import (
	"fmt"
	"net"
	"os"
	"os/signal"
	"time"
)

func main() {
	var i int

	fmt.Print("Bir sayı girin: ")
	_, err := fmt.Scan(&i)
	if err != nil {
		fmt.Println("Geçersiz giriş!")
		return
	}

	if i == 1 {
		var ip string
		fmt.Print("IP adresini girin: ")
		fmt.Scan(&ip)

		scanOpenPorts(ip)
	} else if i == 21 {
		var address string
		fmt.Print("Ping atılacak IP adresini girin: ")
		fmt.Scan(&address)

		pingLoop(address)
	} else {
		fmt.Println("Geçersiz seçenek!")
	}
}

func pingLoop(address string) {
	interrupt := make(chan os.Signal, 1)
	signal.Notify(interrupt, os.Interrupt)

	for {
		select {
		case <-interrupt:
			fmt.Println("Ping döngüsü kapatıldı.")
			return
		default:
			reply, err := pingHost(address)
			if err != nil {
				fmt.Printf("Ping hatası: %v\n", err)
			} else {
				fmt.Printf("Ping cevabı: %s\n", reply)
			}
			time.Sleep(time.Second * 5) // 5 saniye bekleyin
		}
	}
}

func pingHost(address string) (string, error) {
	conn, err := net.DialTimeout("ip4:icmp", address, time.Second*5)
	if err != nil {
		return "", err
	}
	defer conn.Close()

	msg := []byte{8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0}

	// ICMP checksum hesaplaması
	checksum := checkSum(msg)
	msg[2] = byte(checksum >> 8)
	msg[3] = byte(checksum)

	_, err = conn.Write(msg)
	if err != nil {
		return "", err
	}

	recv := make([]byte, 1500)
	n, err := conn.Read(recv)
	if err != nil {
		return "", err
	}

	reply := string(recv[:n])
	return reply, nil
}

func checkSum(msg []byte) uint16 {
	sum := 0
	for i := 0; i < len(msg)-1; i += 2 {
		sum += int(msg[i])*256 + int(msg[i+1])
	}
	sum = (sum >> 16) + (sum & 0xffff)
	sum += (sum >> 16)
	return uint16(^sum)
}

func scanOpenPorts(ip string) {
	fmt.Printf("Açık portları taramak için başlıyor: %s\n", ip)

	for port := 1; port <= 65535; port++ {
		target := fmt.Sprintf("%s:%d", ip, port)
		conn, err := net.DialTimeout("tcp", target, time.Second*2)
		if err == nil {
			fmt.Printf("Açık Port: %d\n", port)
			conn.Close()
		}
	}

	fmt.Println("Port taraması tamamlandı.")
}
