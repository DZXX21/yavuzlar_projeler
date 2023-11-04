package main

import (
	"fmt"
	"os"
	"strings"
	"time"
)

const maxLoginAttempts = 5
const logFile = "logs.txt"
const timeFormat = "2006-01-02 15:04:05"

type User struct {
	Username string
	Password string
}

var adminAccount = User{Username: "admin", Password: "adminpass"}

func main() {
	users := []User{
		{"kullanici1", "sifre1"},
		{"kullanici2", "sifre2"},
	}

	attemptCount := 0

	for {
		fmt.Print("Kullanıcı Adı: ")
		var username string
		fmt.Scanln(&username)

		username = strings.ToLower(username)

		fmt.Print("Şifre: ")
		var password string
		fmt.Scanln(&password)

		
		if username == adminAccount.Username {
			if password == adminAccount.Password {
				adminMenu()
				break 
			} else {
				attemptCount++
				fmt.Println("Hatalı şifre. Admin şifresini tekrar deneyin.")
				
				logLogin(username, false)
			
				if attemptCount >= maxLoginAttempts {
					fmt.Println("Çok fazla hatalı giriş denemesi yaptınız. Program sonlandırılıyor.")
					return
				}
				continue
			}
		}

	
		user, ok := findUser(users, username)
		if !ok || user.Password != password {
			attemptCount++
			logLogin(username, false)
			fmt.Printf("Geçersiz kullanıcı adı veya şifre. Giriş denemesi: %d/%d. Tekrar deneyin.\n", attemptCount, maxLoginAttempts)
		} else {
			fmt.Println("Başarılı giriş!")
			break 
		}

		
		if attemptCount >= maxLoginAttempts {
			fmt.Println("Çok fazla hatalı giriş denemesi yaptınız. Program sonlandırılıyor.")
			return
		}
	}
}

func adminMenu() {
	
	fmt.Println("\nAdmin menüsüne hoşgeldiniz.")
	
}



func findUser(users []User, username string) (*User, bool) {
	for i := range users {
		if strings.ToLower(users[i].Username) == username {
			return &users[i], true
		}
	}
	return nil, false
}

func logLogin(username string, success bool) {
	status := "Başarısız"
	if success {
		status = "Başarılı"
	}
	logEntry := fmt.Sprintf("Kullanıcı Adı: %s, Giriş Tarihi: %s, Giriş Durumu: %s\n",
		username, time.Now().Format(timeFormat), status)
	appendToFile(logFile, logEntry)
}

func viewLogs() {
	data, err := os.ReadFile(logFile)
	if err != nil {
		fmt.Printf("Log dosyası okunamıyor: %v\n", err)
		return
	}

	fmt.Println("Log Kayıtları:")
	fmt.Println(string(data))
}

func appendToFile(fileName, text string) {
	file, err := os.OpenFile(fileName, os.O_APPEND|os.O_CREATE|os.O_WRONLY, 0644)
	if err != nil {
		fmt.Printf("Log dosyasına erişim sağlanamıyor: %v\n", err)
		return
	}
	defer file.Close()

	if _, err = file.WriteString(text); err != nil {
		fmt.Printf("Log dosyasına yazılamıyor: %v\n", err)
	}
}
