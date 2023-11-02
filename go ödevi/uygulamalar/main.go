package main

import (
	"fmt"
	"os"
	"time"
)

const maxLoginAttempts = 5
const logFile = "logs.txt"

type User struct {
	Username string
	Password string
}

func main() {
	users := []User{
		{"kullanici1", "sifre1"},
		{"kullanici2", "sifre2"},
		{"admin", "adminpass"},
	}

	loginAttempts := make(map[string]int)

	for {
		fmt.Print("Kullanıcı Adı: ")
		var username string
		fmt.Scanln(&username)
		fmt.Print("Şifre: ")
		var password string
		fmt.Scanln(&password)

		if isAdmin(username, password) {
			adminMenu()
			break
		}

		user, userIndex := findUser(users, username)
		if user != nil {
			if loginAttempts[username] >= maxLoginAttempts {
				fmt.Println("Çok fazla hatalı giriş denemesi yaptınız. Program sonlandırılıyor.")
				break
			}

			fmt.Printf("Giriş denemesi: %d/%d\n", loginAttempts[username]+1, maxLoginAttempts)

			if user.Password == password {
				loginAttempts[username] = 0
				logLogin(username, true)
				fmt.Println("Başarılı giriş!")
			} else {
				loginAttempts[username]++
				logLogin(username, false)
				fmt.Println("Hatalı giriş!")
			}
		} else {
			fmt.Println("Geçersiz kullanıcı adı. Tekrar deneyin.")
		}
	}
}

