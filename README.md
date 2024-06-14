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

<h3>III. Uruchamianie (przez localhost)</h3>
1. Zainstaluj XAMPP<br>
2. Skopiuj katalog ankieta do katalogu htdocs<br>
3. Skonfiguruj bazę danych(utwórz bazę danych ankieta i zaimportuj plik plik ankieta.sql)<br>
4. Przydziel uprawnienia do bazy danych zgodnie z danymi w pliku db_config.php (lub zmień dane w pliku na właściwe)<br>
5. Uruchom w XAMPP serwer Apache i bazę danych MySQL<br>
6. Wpisz w przeglądarce localhost/ankieta w celu przejścia do panelu logowania<br>
7. W celu przejścia do panelu rejestracji kliknij w odpowiedni link<br>

<br>

Pliki można również umieścić na wybranym serwerze.

<h3>IV. Działanie</h3>

<b>Rejestracja użytkownika:</b> Podanie danych -> Zatwierdzenie -> Przekierowanie do strony logowania<br><br>
<b>Użytkownik: Logowanie użytkownika:</b> Wpisanie danych -> Przejście do strony użytkownika -> Wypełnij ankietę <br><br>
<b>Administrator: Logowanie administratora:</b> Wpisanie danych -> Przejście do strony administratora<br><br>
<b>Administrator: Krok 1(Utworzenie ankiety):</b> Wybierz "Utwórz ankietę" -> Podaj dane -> Utwórz<br><br>
<b>Administrator: Krok 2(Dodawanie pytań):</b> Wybierz "Dodaj pytania" -> Podaj dane -> Dodaj<br><br>
<b>Administrator: Krok 3(Przyporządkowanie pytań):</b> Wybierz "Przyporządkowanie pytań" -> Wybierz nr ankiety -> Wybierz nr pytania -> Kliknij "Połącz"<br><br>
