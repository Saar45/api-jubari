# API Jubari - Documentation

## Introduction

Bienvenue dans l'API Jubari, une application développée avec le framework PHP **CodeIgniter 4**. Cette API permet de gérer les employés, les services, les congés, les messages, et bien plus encore. Elle est conçue pour être rapide, sécurisée et facile à utiliser.

## Prérequis

Pour exécuter cette API, vous devez disposer des éléments suivants :

- **PHP** version 8.1 ou supérieure.
- Extensions PHP nécessaires :
  - [intl](http://php.net/manual/en/intl.requirements.php)
  - [mbstring](http://php.net/manual/en/mbstring.installation.php)
  - [json](http://php.net/manual/en/json.installation.php) (activée par défaut)
  - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) (si vous utilisez MySQL)
  - [libcurl](http://php.net/manual/en/curl.requirements.php) (si vous utilisez la bibliothèque HTTP\CURLRequest)
- Serveur web (Apache, Nginx, etc.) configuré pour pointer vers le dossier `public`.

## Installation

1. **Cloner le dépôt :**
   ```bash
   git clone <url-du-dépôt>
   cd Api-jubari
   ```

2. **Installer les dépendances avec Composer :**
   ```bash
   composer install
   ```

3. **Configurer l'environnement :**
   - Copier le fichier `env` en `.env` :
     ```bash
     cp env .env
     ```
   - Modifier les paramètres dans le fichier `.env` :
     - `app.baseURL` : URL de base de l'application.
     - Paramètres de la base de données (`database.default.hostname`, `database.default.database`, etc.).

4. **Configurer le serveur web :**
   - Assurez-vous que votre serveur web pointe vers le dossier `public` pour des raisons de sécurité.

5. **Lancer le serveur de développement :**
   ```bash
   php spark serve
   ```
   L'API sera accessible à l'adresse (Endpoint) suivante : `https://siomende.fr/sarr/jubari-api/`.

## Fonctionnalités

### Gestion des Services
- **Lister tous les services :** `GET /services`
- **Obtenir un service par ID :** `GET /services/{id}`
- **Créer un nouveau service :** `POST /services`
- **Mettre à jour un service :** `PUT /services`
- **Supprimer un service :** `DELETE /services`

### Gestion des Employés
- **Lister tous les employés :** `GET /employes`
- **Obtenir un employé par ID :** `GET /employes/{id}`
- **Rechercher des employés par nom :** `GET /employes/search/{nom}`
- **Créer ou mettre à jour un employé :** `POST /employes` ou `PUT /employes`
- **Supprimer un employé :** `DELETE /employes`

### Gestion des Congés
- **Lister tous les congés :** `GET /conges`
- **Obtenir un congé par ID :** `GET /conges/{id}`
- **Créer un nouveau congé :** `POST /conges`
- **Mettre à jour un congé :** `PUT /conges`
- **Supprimer un congé :** `DELETE /conges`

### Gestion des Messages
- **Lister tous les messages :** `GET /messages`
- **Obtenir un message par ID :** `GET /messages/{id}`
- **Créer un nouveau message :** `POST /messages`
- **Mettre à jour un message :** `PUT /messages`
- **Supprimer un message :** `DELETE /messages`

### Statistiques et Rapports
- **Obtenir le nombre d'employés en congé actuellement :** `GET /stats/employes-on-leave`
- **Obtenir les statistiques des congés :** `GET /stats/conges`
- **Obtenir les statistiques des congés d'un employé :** `GET /stats/employes/{id}/conges`

## Sécurité

### Authentification JWT
L'API utilise un système d'authentification basé sur **JWT (JSON Web Tokens)**. Les routes protégées nécessitent un jeton valide dans l'en-tête `Authorization`.

- **Exemple d'en-tête :**
  ```
  Authorization: Bearer <votre_token_jwt>
  ```

### CORS
Le filtre **CORS** est activé pour permettre les requêtes provenant de différents domaines. Vous pouvez configurer les règles dans le fichier `.env` ou directement dans le filtre.

## Configuration


- **Base URL :**
  ```
  app.baseURL = 'https://siomende.fr/sarr/jubari-api/'
  ```


## Contribution

Les contributions sont les bienvenues ! Si vous trouvez un bug ou souhaitez proposer une amélioration, veuillez ouvrir une **issue** ou soumettre une **pull request**.

## Support

Pour toute question ou problème, veuillez contacter l'équipe de développement ou consulter la documentation officielle de CodeIgniter 4 : [https://codeigniter.com/user_guide/](https://codeigniter.com/user_guide/).

## Licence

Ce projet est sous licence MIT. Consultez le fichier `LICENSE` pour plus d'informations.
