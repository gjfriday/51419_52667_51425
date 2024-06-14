Łukasz Piastka 51419<br>
Arkadiusz Twarogowski 51425<br>
Grzegorz Piątkowski 52667

<h1>Aplikacja do tworzenia ankiet.</h1>

<h3>I. Wprowadzenie</h3>
Aplikacja służy do tworzenia prostych ankiet i zbierania odpowiedzi od użytkowników. Została ona napisana w Php (oraz HTML, CSS i javascript) i wykorzystuje bazę danych MySQL do przechowywania informacji o użytkownikach oraz ankietach. 

<h3>II. Wymagania funkcjonalne</h3>
* użytkownik ma możliwość rejestracji poprzez formularz rejestracyjny<br>
* użytkownik ma możliwość logowania za pomocą e-mail i hasła<br>
* użytkownik ma możliwość wypełniania ankiet<br>
* administrator ma możliwość tworzenia ankiet (jednokrotnego wyboru)<br>
* administrator ma możliwość tworzenia pytań i dodawania ich do ankiet<br>
* administrator ma wgląd do podsumowań ankiet<br>
* ankiety przechowywane są w bazie danych<br>

<h3>III. Uruchamianie (poprzez localhost)</h3>
1. Zainstaluj XAMPP<br>
2. Skopiuj katalog ankieta do katalogu htdocs<br>
3. Skonfiguruj bazę danych(utwórz bazę danych ankieta i zaimportuj plik plik ankieta.sql)<br>
4. Uruchom w XAMPP serwer Apache i bazę danych MySQL<br>
5. Wpisz w przeglądarce localhost/ankieta w celu przejścia do panelu logowania<br>
6. W celu przejścia do panelu rejestracji kliknij w odpowiedni link

Pliki można również umieścić na wybranym serwerze.

<h3>IV. Działanie</h3>

<b>Rejestracja użytkownika:</b> Podanie danych -> Zatwierdzenie -> Przekierowanie do strony logowania<br>
Logowanie użytkownika: Wpisanie danych -> Przejście do strony użytkownika -> 
