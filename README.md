# vitemonvol
Applicatiion Web de réservation de circuits de vol d'avion. 

### processus d'installation
#### Etape 1:
- Clonez ou téléchargez le projet
- Ouvrir un terminal, ce deplacer vers dans le repertoire du projet
- Executez les commandes ``composer require symfony/runtime``  et ``npm install`` pour installer les dependances necessaires au projet
- Executer la commande ``php bin/console doctrine:database:create`` afin de créer la base de données

#### Etape 2:
- Mettez à jours le schema de la base de données avec la commande ``php bin/console doctrine:migrations:migrate``

#### Etape 3:
- Executez le projet avec les commandes: ``symfony server:start`` ou ``php -S localhost:8000 -t public`` 
- Synchronisez le front end avec la commande :``npm run dev-server``

#### Outils
Pas necessaire pour executer le projet, mais utilse pour tester le dévéloppement de l'API et autres:
- Postman https://dl.pstmn.io/download/latest/win64

## Mise à jour démarrage de l'application

- Effacer la base de données ``php bin/console doctrine:database:drop --force``
- Effacer toutes les migrations (tous les fichier contenus dans le dossier migrations)
- Recreer la base de données ``php bin/console doctrine:database:create``
- Regenerer les migrations ``php bin/console make:migration``
- Charger les migration dans la base de données ``php bin/console doctrine:migrations:migrate``
- Charger le jeux de fausses données ``php bin/console doctrine:fixtures:load``
- Tester l'application ``symfony server:start``
