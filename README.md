# adrec-tp-symfony

1/ Git sera de la partie... Une fois encore ! Vous devrez cloner le projet :

*git clone https://github.com/TyTy-cf/adrec-tp-symfony.git*

Puis, créer une nouvelle branche à partir de la master, sur laquelle vous devrez créer votre projet Symfony.

La branche devra se nommer : tp-1-votre_prenom

Une fois le projet créer, lancer un serveur PHP afin de tester que tout fonctionne !
<br>
<br>
/2 Maintenant, vous allez intégrer Webpack avec Yarn et ajouter Bootstrap au projet.
Il faudra utiliser un fichier qui regroupera tout les scss (styles.scss) et un fichier qui regroupera le Javascript (script.js), ils seront... probablement à créer ?
On gardera une logique au niveau de l'organisation des dossiers, séparés entre les *styles et les scripts*.

Définir un background-color, du body, spécifique pour l'application, et vérifier qu'il est bien actif.

(Modifier le base.html.twig pour mettre... ce que vous voulez afin d'avoir un rendu !)

Modifier aussi le base.html.twig pour intégrer un footer et un header, et bien sûr importer respectivement les fichiers de styles et scripts dans le base.html.twig.

Vous remplirez le header et le footer avec... ce qui vous passe par la tête ? Etonnez moi, utilisez Bootstrap pour faire un menu ou autre, lâchez-vous :)
<br>
<br>
3/ Une fois que la structure de l'application est en place, on peut attaquer le vif du sujet :

Vous devrez me créer les entités relatives à la base de données music-shop, vu en cours de SQL.

Rappel de celles-ci :
- Album :
> name : string (255) not null<br>
> published_year : integer nullable<br>
> price : float not null

- Artiste :
> name : string (255) not null<br>
> nationality : string nullable<br>
> beginning_year : integer nullable

- Genre :
> name : string (255) not null

- Song :
> name : string (255) not null<br>
> duration : string (6) not null<br>
> price : float not null

Bien entendu, je veux le fichier de migration permettant de créer la base de données relative à ces entités. La base de données à utiliser sera nommée : *music-shop-symfo*

Pas besoin de tester les entités pour le moment, on le fera avec le CRUD... à venir ! Le fichier de migration me suffira pour valider les entités.
<br>
<br>
4/ Et bien.. il est temps de créer le CRUD pour chaque entité.

Je veux que les vues soient "jolies", c'est à dire ne pas me laisser celles par défaut.
<br>
<br>
/5 Les finalisations...
C'est bien, mais les vues ne sont pas reliées réellement entre elles là, je veux un menu Admin (sans restriction d'accès) dans lequel je peux accèder au CRUD de chaque entité, et revenir sur la page admin classique.

Je veux que par défaut lorsque l'on arrive sur le site, on voit la liste de tous les albums.

Et, car il faut bien que vous en fassiez, je veux une requête DQL qui permette de récupérer les artistes par nationality
<br>
<br>
6/ Finalisation²

Vous êtes libre, faites ce que vous voulez sur le "site", au niveazu graphisme, cheminement des routes etc.
C'est du bonus !
<br>
(Si vous vous sentez chaud, incluez fontawsome à Webpack pour mettre des icônes sur les boutons ;) Mais pour ça je vous invite à chercher !)

Theau:
    Mailer
    Service
    Securité (démo) ou Filter et function twig


Exercices :
    - Envoyer un mail à chaque fois qu'un pays est créé
