## Zend1 - zadanie testowe

#### Tre�� zadania

Zadanie polega na tym, aby napisa� skrypt z wykorzystaniem Zend Framework 1, kt�ry po��czy wyniki z dw�ch ankiet w jedn� ankiet�. 
W za��czeni masz schemat bazy danych, na kt�rym b�dziesz operowa�. Jest to zadanie z �ycia wzi�te. Dwa miesi�ce temu sam to pisa�em, bo Tw�j poprzednik kompletnie na tym poleg�. 

Za�o�enia:

1. Masz dwie identyczne ankiety co do liczby pyta�, typ�w pyta� i liczby odpowiedzi w ka�dym pytaniu. Nie musisz tego sprawdza� ani walidowa�. Nie o to w zadaniu chodzi
2. Tworzysz trzeci� ankiet� jako kopi� jedne z tych dw�ch ankiet wej�ciowych. 
3. Kopiujesz (nie przenosisz) wyniki z pierwszej a potem drugiej ankiety

W rezultacie nasz klient je�eli ma dwie takie same ankiety, ale jedn� po polsku a drug� po angielsku dysponuje wynikami zbiorczymi dla ca�o�ci. 

Opis tabelek

1. ankieta - to chyba samo si� t�umaczy. Najwa�niejsze s� kolumny ilosc_wypelnien o ilosc_wypelnien_cache, kt�re s� agregatami przechowuj�cymi liczb� zebranych wywiad�w. Domy�lasz si� co z tym trzeba zrobi� ;)
2. strona - ka�da ankieta ma strony. Na stronie znajduj� si� pytania. Mo�e by� ich 0 lub niesko�czono��. 
3. pytanie - ka�de pytanie musi si� znajdowa� na jednej i tylko jednej stronie. Ka�de pytanie ma sw�j numer i order. To dwie r�ne kolumny bo order jest unikalny w skali ankiety a numer jest pusty je�eli pytanie nie jest pytaniem tylko blokiem tekstowym bez mo�liwo�ci odpowiedzi
4. log - ka�dy wiersz w tej tabeli pojawia si� przy rozpocz�ciu wype�niania ankiety. To wszystkie meta dane o fakcie wype�niania ankiety przez respondenta. Na pewno nazwy niekt�rych z kolumn przybli�� Ci istot� tej tabelki
5. wynik - ka�dy wiersz w tej tabeli to odpowied� na jedno z pyta�. Czyli je�eli ankieta ma 10 pyta� i trafi si� jeden respondent, kt�ry wype�ni ankiet� od pocz�tku do ko�ca to w tabelce log pojawi si� 1 rekord a w tabelce wynik pojawi si� 10 rekord�w.

Ca�a zabawa polega na tym, �eby sprytnie i bez niepotrzebnego obci��ania bazy skopiowa� te wyniki i po podmienia� Foreign Keys, tak aby zachowa� potrzebne relacje pomi�dzy rekordami. Wykorzystaj obiekt Zend_Db_Select do wyci�gania danych i Zend_Db_Adapter do insertu danych. Np. https://www.dropbox.com/s/fgc6twl5qn15efs/Zrzut%20ekranu%202016-09-14%2007.32.38.png?dl=0 i  https://www.dropbox.com/s/capddejmvk39fkc/Zrzut%20ekranu%202016-09-14%2007.33.25.png?dl=0

Poni�ej masz list� kluczy obcych o kt�re powiniene� si� troszczy�. Ca�� reszt� mo�na skopiowa� na pa��. 

Ankieta: id - Primary Key

Strona: id - PK, id_ankieta - FK do Ankieta

Pytanie: id - PK, id_strona - FK, id_ankieta - FK

Log: id - PK, id_ankieta - FK, id_storna - FK, Olewasz: id_respondent, id_log, id_log_org

Wynik: id - PK, id_pytanie - FK, id_ankieta - FK, id_log - FK



#### Instalacja

- git clone https://github.com/wojtek77/testing-task-2016-09-23.git
- cd testing-task-2016-09-23
- composer install
- trzeba zaimportowa� do bazy "ankietka_beta" plik "sql/ankietka_beta.sql"