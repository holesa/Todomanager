https://clickup.com/

Features - General
------



Features - Nepravidlne tasky - ToDo
------
* Pridat koment k tasku
* Určiť prioritu tasku
* Pridať projekt tasku
* Vsetko sa da filtrovat a davat do poradia


Features - Pravidelne tasky 
------
* Pridanie tasku na dnes so vsetkymi info ...
* Stop Watch
- spusti stopky
- pauzni stopky
- vypni stopky a uloz do databazy
* Pravidelne tasky po ukonceni CASOVACA ulozit do DB a vlozit do tabulky
* Rozne filtrovania analyz 




Databaza Vseobecne
------------
Users
 id
 username
 password


Databaza Nepravidelnych taskov
------------
Tasks
 id
 task_name 
 due_date
 finished
 priority
 comments 
 user_id (FK)
 project  (FK)

Projects
 id
 project_name
 tasks (FK)
 user_id (FK)


 Comments
  id
  task_id (FK)
  comment
  date---


 Databaza Pravidelnych taskov
----------------
Reporting
 id
 activity_name
 date
 hours
 technology








---------------------






Idealne spojit - Managmentsky tool pre produktivitu 1 osoby (neskor mozno teamov)
-----
1. Task managment (Ako Trello)
2. Zapisnik dennych aktivit + reporting dat (Ako vylepsene sheets)
3. Planovac (S kalendarom)
4. Stopky