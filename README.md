# Biblios

Biblios est une application de gestion de bibliothèque développée avec **Laravel** et **React**.

## Fonctionnalités

- **Authentification utilisateur** :
  - Connexion/inscription.
  - Gestion des rôles (admin/utilisateur).

- **Gestion des livres** :
  - Recherche par titre ou auteur.
  - Réservation des livres disponibles.
  - Affichage des livres empruntés par un utilisateur.

- **Administration** (pour les administrateurs uniquement) :
  - Ajout, modification et suppression de livres.

- **Gestion des favoris** :
  - Ajouter des livres en favoris.
  - Afficher une liste des favoris.

## Technologies utilisées

- **Backend** : Laravel
- **Frontend** : React + Inertia.js
- **Base de données** : MySQL
- **Design** : Tailwind CSS

## Installation

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/sonia3004/Biblios.git
   cd Biblios

2. Installez les dépendances PHP :

composer install

3. Installez les dépendances JavaScript :

npm install

4. Configurez le fichier .env :

    Copiez le fichier .env.example :

    cp .env.example .env

    Configurez les informations de connexion à la base de données.

5. Générez une clé d'application :

php artisan key:generate

6. Lancez les migrations pour créer les tables :

php artisan migrate

7. Lancez le serveur de développement :

php artisan serve

8. Accédez à l'application à l'adresse http://127.0.0.1:8000.

Compilez les assets :

    npm run dev

9. Tests

Pour exécuter les tests unitaires et fonctionnels :

php artisan test

Contribution

Les contributions sont les bienvenues ! Ouvrez une issue ou soumettez une pull request.