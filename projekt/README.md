## Użytkownicy:

|e-mail|password|
|---:|:---|
|mushkaborys@gmail.com|1|
|t4@g.c|Test4|
|admin@admin.com|admin|

#### Aby przynieść projekt potrzebno:

Wykonać polecenie z folderu *projekt* dla tego żeby można było zobaczyć treść w postach:

```terminal
git clone https://github.com/erusev/parsedown.git
```

### Access dla postów:

|access|liczba|
|:---|:---|
|read and write|6|
|read|4|
|write|2|
|NULL|1|

Dostęp składa się z dwuch liczb:

* 1 - dostęp dla użytkownika który stworzył ten post,
* 2 - dostęp dla innych użytkowników nie licząc admina.

> Np.:
>
> 44, 42, 41, 46
>
> 24, 22, 21, 26
>
> 14, 12, 11, 16
>
> 64, 62, 61, 66
