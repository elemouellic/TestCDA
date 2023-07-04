# Test Exercice CDA
Exercice de candidature à la formation CDA du Greta


## Comment procéder : 

J'ai utilisé Xampp pour créer ce projet.
Avant de cloner le projet, assurez-vous de créer une base de données appelée "testcda" dans PHPMyAdmin.

Ensuite, vérifier les informations dans la classe Dbconnector, par défaut, les variables sont initialisées comme tel, modifiez-les au besoin.

```sh
    $dsn = "mysql:dbname=testcda;host=localhost;port=3306;charset=utf8";
    $user = "root" ;
    $pwd = "";
```

Ensuite trois possibilités:

1. Importer le dump vide de la base SQL où les tables sont crées mais où les valeurs sont à incorporées via le front

2. Importer le dump peuplé de la base SQL pour afficher directemen,t le résultat de l'exercices

3. Exécuter le script http://localhost/testcda/class/seed.php

## Contact

Pour toute question concernant l'installation du projet vous pouvez me contacter par mail:

```
emmanuel.lm@gmail.com
```
