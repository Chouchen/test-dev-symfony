
# Tests Web Développeur

## Résumé du test

Vous êtes développeur d'un blog et votre product owner vous demande de rajouter un système de commentaire sous les posts du blog.

## Installation

Cloner le repository, créer un user et une base de données et remplissez le `.env` en adéquation.

Puis, lancer les commandes suivantes : 

```shell
php bin/console doctrine:fixtures:load
```

Une fois le projet installé, vous pouvez effectuer le développement.

## Développement

### User story

En tant qu'utilisateur, je dois pouvoir avoir accès sous chaque post à un formulaire de soumissions de formulaire proposant :
* une adresse email (facultative)
* un pseudo (obligatoire)
* une note de 1 à 5 (obligatoire)
* un titre de commentaire (obligatoire)
* un contenu de commentaire (obligatoire)

Le formulaire doit être envoyé en AJAX qui, en retour, indique le succès ou l'erreur lors de la validation du commentaire.

La validation se fait sur :
* l'adresse email doit être une adresse email valide.
* Le pseudo doit être d'au moins un caractère
* la note est obligatoire et doit être 1, 2, 3, 4 ou 5
* Le titre doit comporter au moins 4 caractères
* Le contenu doit comporter au moins 100 caractères.

En tant qu'utilisateur, je dois pouvoir voir les commentaires du post sous le post. Tous les éléments du formulaire doivent être affichés (l'adresse email, si présente, doit être un lien mailto: sur le pseudo)

Aucune possibilité de modifier ou supprimer un commentaire.

Il n'y a pas de framework JS obligatoire ; choisissez le vôtre !

## Points bonus

S'il reste du temps, vous pouvez afficher en haut du post la moyenne des notes des commentaires ainsi que leur nombre.

Point ultra bonus, si l'esthétique est bonne.
