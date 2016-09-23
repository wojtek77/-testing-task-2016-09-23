## Zend1 - zadanie testowe

#### Treœæ zadania

Zadanie polega na tym, aby napisaæ skrypt z wykorzystaniem Zend Framework 1, który po³¹czy wyniki z dwóch ankiet w jedn¹ ankietê. 
W za³¹czeni masz schemat bazy danych, na którym bêdziesz operowa³. Jest to zadanie z ¿ycia wziête. Dwa miesi¹ce temu sam to pisa³em, bo Twój poprzednik kompletnie na tym poleg³. 

Za³o¿enia:

1. Masz dwie identyczne ankiety co do liczby pytañ, typów pytañ i liczby odpowiedzi w ka¿dym pytaniu. Nie musisz tego sprawdzaæ ani walidowaæ. Nie o to w zadaniu chodzi
2. Tworzysz trzeci¹ ankietê jako kopiê jedne z tych dwóch ankiet wejœciowych. 
3. Kopiujesz (nie przenosisz) wyniki z pierwszej a potem drugiej ankiety

W rezultacie nasz klient je¿eli ma dwie takie same ankiety, ale jedn¹ po polsku a drug¹ po angielsku dysponuje wynikami zbiorczymi dla ca³oœci. 

Opis tabelek

1. ankieta - to chyba samo siê t³umaczy. Najwa¿niejsze s¹ kolumny ilosc_wypelnien o ilosc_wypelnien_cache, które s¹ agregatami przechowuj¹cymi liczbê zebranych wywiadów. Domyœlasz siê co z tym trzeba zrobiæ ;)
2. strona - ka¿da ankieta ma strony. Na stronie znajduj¹ siê pytania. Mo¿e byæ ich 0 lub nieskoñczonoœæ. 
3. pytanie - ka¿de pytanie musi siê znajdowaæ na jednej i tylko jednej stronie. Ka¿de pytanie ma swój numer i order. To dwie ró¿ne kolumny bo order jest unikalny w skali ankiety a numer jest pusty je¿eli pytanie nie jest pytaniem tylko blokiem tekstowym bez mo¿liwoœci odpowiedzi
4. log - ka¿dy wiersz w tej tabeli pojawia siê przy rozpoczêciu wype³niania ankiety. To wszystkie meta dane o fakcie wype³niania ankiety przez respondenta. Na pewno nazwy niektórych z kolumn przybli¿¹ Ci istotê tej tabelki
5. wynik - ka¿dy wiersz w tej tabeli to odpowiedŸ na jedno z pytañ. Czyli je¿eli ankieta ma 10 pytañ i trafi siê jeden respondent, który wype³ni ankietê od pocz¹tku do koñca to w tabelce log pojawi siê 1 rekord a w tabelce wynik pojawi siê 10 rekordów.

Ca³a zabawa polega na tym, ¿eby sprytnie i bez niepotrzebnego obci¹¿ania bazy skopiowaæ te wyniki i po podmieniaæ Foreign Keys, tak aby zachowaæ potrzebne relacje pomiêdzy rekordami. Wykorzystaj obiekt Zend_Db_Select do wyci¹gania danych i Zend_Db_Adapter do insertu danych. Np. https://www.dropbox.com/s/fgc6twl5qn15efs/Zrzut%20ekranu%202016-09-14%2007.32.38.png?dl=0 i  https://www.dropbox.com/s/capddejmvk39fkc/Zrzut%20ekranu%202016-09-14%2007.33.25.png?dl=0

Poni¿ej masz listê kluczy obcych o które powinieneœ siê troszczyæ. Ca³¹ resztê mo¿na skopiowaæ na pa³ê. 

Ankieta: id - Primary Key

Strona: id - PK, id_ankieta - FK do Ankieta

Pytanie: id - PK, id_strona - FK, id_ankieta - FK

Log: id - PK, id_ankieta - FK, id_storna - FK, Olewasz: id_respondent, id_log, id_log_org

Wynik: id - PK, id_pytanie - FK, id_ankieta - FK, id_log - FK



#### Instalacja

- git clone https://github.com/wojtek77/testing-task-2016-09-23.git
- cd testing-task-2016-09-23
- composer install
- trzeba zaimportowaæ do bazy "ankietka_beta" plik "sql/ankietka_beta.sql"