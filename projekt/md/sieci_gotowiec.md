# Sieci rozproszone

2. CIDR pozwala na:
  
* c) eliminuje podział na tradycyjne klasy adresowe
* d) agregacje routingu

3. Uogólniony network prefix oznacza:
* d) liczbę bitów w adresie IP przeznaczonych na zdefiniowanie sieci

4. Które z adresów IP należą do puli adresów prywatnych zgodnie z RFC1918?
* a)10/8
* c)192.168/16

5. W połączeniu NAT, gdy pakiet jest wysyłany:
* a) następuje zastąpienie adresu wewnętrznego lokalnego na adres wewn. globalny
* c) następuje zastąpienie adresu wewn. na adres zewn. globalny

6. W trakcie translacji PAT konieczna jest zmiana następujących pól w diagramie IP:
* b) Source address
* c) IO checksum

7. W trakcie translacji PAT obowiązuje zasada, że:
* b) Najpierw wykorzystywane są dostępne porty dla pierwszego adresu a potem dostępne
porty dla kolejnego adresu

8. W trakcie translacji PAT zawsze konieczna jest zmiana następujących pól w
segmencie TCP
* a) Source port
* d) TCP Checksum

9. Wykorzystanie techniki NAT w połączeniach TCP w celu sterowania obciążeniami
polega na:
* b) reprezentacji grupy serwerów pod jednym adresem wirtualnym
* c) utworzeniu grupy rotacyjnej

10. Nowe elementy w datagramie IPv6 w stosunku do v4 to:
* b) Flow label

11. Do nagłówków rozszerzonych w datagramie IPv6 należą:
* a) Routing Header
* b) Upper-Layer Header
* c) Fragment Header

12. W ramach adresów IPv6 typu unicast można wyróżnić adresy:
* a) global
* b) site local
* c) one to nearest

14. Zakres przefixów w adresach IPv6 typu link-local to:
* b) FE80::/1015. Do protokołów routingu IGP zalicza się protokoły:
* a) RIP
* b) OSPF
* c) EIGRP

16. Które stwierdzenia o protokole RIP są nieprawdziwe:
* d) wspiera VLSM
17. Do różnic pomiędzy protokołem RIP a RIPv2 można zaliczyć:
* a) możliwość autoryzacji
* c) wsparcie dla masek sieciowych

18. Założenia zimnego startu w algorytmie Bellmana-Forda to:
* a) Posiadanie wiedzy na temat kosztu każdego obsługiwanego łącza/sieci

18. Algorytm odbierania w protokole RIP zakłada, że jeżeli dana sieć o której nadeszła
informacja nie znajduje się w tablicy routingu, to:
* a) pole „interfece” w tablicy routingu ustawiane jest na wartość numeru interfejsu, na który
nadesłano wektor „odległości”
* b) nowy wektor odległości jest wysyłane do wszystkich sąsiadów

19. Do różnic pomiędzy protokołami OSPF a RIP można zaliczyć:
* a) wsparcie dla VLSM
* b) brak ograniczenia co do ilości hopów
* d) uwzględnienie przepustowości łączy

20. Które ze stwierdzeń o koszcie połączeń w protokole OSPF jest prawdziwe?
* a) jest wyliczany dla każdego pojedynczego łącza
* c) jest odwrotnie proporcjonalny do przepustowości łącza

21. Danej organizacji przydzielono pulę adresową 140.25.220.0/26. Organizacja
zdecydowała się zastosować plan adresowy wykorzystując VLSM zgodnie ze schematem
przedstawionym na rysunku poniżej.
A. Określ osiem podsieci w #6-14 (140.25.220/23)140.25.220.64/26
140.25.220.128/26
140.25.220.192/26
140.25.221.0/26
140.25.221.64/26
140.25.221.128/26
140.25.221.192/26B. Podaj adresy hostów (trzy pierwsze i dwa ostatnie) jakie można przypisać
urządzeniom w podsieci Subnet #3 (140.25.96.0):
pierwszy: 140.25.96.1
drugi: 140.25.96.2
przedostatni: 140.25.127.253
ostatni: 140.25.127.254

22. Wypisz pierwsze dwa i ostatnie dwa indywidualne adresy sieciowe dla bloku IDR
195.24/13
pierwszy: 195.24.0.1
drugi: 195.24.0.2
przedostatni: 195.31.255.253
ostatni: 195.31.255.254

23. Jak można wyrazić całą klasę adresową B za pomocą pojedynczego bloku
bezklasowego CIDR?
128.0.0.0/2
Wyróżniamy dwie kategorie protokołów routingu:
1. Protokoły wewnętrznej bramy IGPs (ang. Interior Gateway Protocols):
 RIP
 IGRP
 EIGRP
 OSPF
 IS-IS (ang. Intermediate System-to-Intermediate System)
2. Protokoły zewnętrznej bramy EGPs (ang. Exterior Gateway Protocols):
 BGP (ang. Border Gateway Protocol).
W wersji protokołu RIPv2 wprowadzono następujące rozszerzenia:
1. Możliwość przenoszenia dodatkowych informacji o routingu pakietów.
2. Mechanizm uwierzytelniania zabezpieczający tablice routingu.
3. Obsługa techniki masek podsieci o zmiennej długości (VLSM).
Główne różnice miedzy protokołami RIPv2 i RIPng to:
 Informacje o routingu RIPng przenoszone są w pakietach IPv6
 Adresem źródłowym każdego komunikatu o trasach jest adres lokalny łącza
interfejsu, z którego wiadomość ta jest wysyłana
 Adresem docelowym wiadomości jest adres grupowy wszystkich routerów
RIPng
 Numer portu UDP wykorzystywany przy wysyłaniu i odbieraniu informacji o
routingu to 521
 W komunikatach wykorzystywane są 128-bitowe prefiksy
 Adresy następnego skoku używają 128 bitów zamiast 32 bitów (jak w IPv4).Elementami wspólnymi dla obu protokołów są:
 Wykorzystanie algorytmu Bellmana-Forda podczas wyboru najkrótszej ścieżki
do celu.
 Ograniczenia promienia działania protokołu do 15 skoków.
 Wykorzystania UDP do wysyłania informacji o routingu oraz okresowych
rozgłoszeń.
Protokół routingu według stanu łącza:
1. Szybko reaguje na zmiany w sieci.
2. Wysyła aktualizacje wyzwalane jedynie po wystąpieniu zmian w sieci.
3. Cyklicznie wysyła aktualizacje (tzw. odświeżanie stanu łącz* a).
