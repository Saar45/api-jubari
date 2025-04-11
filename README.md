# API Jubari - Documentation

## Introduction

Bienvenue dans l'API Jubari, une application développée avec le framework PHP **CodeIgniter 4**. Cette API permet de gérer les employés, les services, les congés, les messages, et bien plus encore. Elle est conçue pour être rapide, sécurisée et facile à utiliser.

### Endpoint principal

L'API est accessible à l'adresse suivante :  
`https://siomende.fr/sarr/jubari-api/`

## Fonctionnalités

### Gestion des Services
- **Lister tous les services :** `GET /services`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/services
    ```

- **Obtenir un service par ID :** `GET /services/{id}`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/services/1
    ```

- **Créer un nouveau service :** `POST /services`
  - **Exemple de requête :**
    ```bash
    curl -X POST https://siomende.fr/sarr/jubari-api/services \
    -H "Content-Type: application/json" \
    -d '{"description": "Service Informatique"}'
    ```

- **Mettre à jour un service :** `PUT /services`
  - **Exemple de requête :**
    ```bash
    curl -X PUT https://siomende.fr/sarr/jubari-api/services \
    -H "Content-Type: application/json" \
    -d '{"id": 1, "description": "Service RH", "chef_id": 2}'
    ```

- **Supprimer un service :** `DELETE /services`
  - **Exemple de requête :**
    ```bash
    curl -X DELETE https://siomende.fr/sarr/jubari-api/services \
    -H "Content-Type: application/json" \
    -d '{"id": 1}'
    ```

### Gestion des Employés
- **Lister tous les employés :** `GET /employes`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/employes
    ```

- **Obtenir un employé par ID :** `GET /employes/{id}`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/employes/1
    ```

- **Rechercher des employés par nom :** `GET /employes/search/{nom}`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/employes/search/Dupont
    ```

- **Créer ou mettre à jour un employé :** `POST /employes` ou `PUT /employes`
  - **Exemple de requête :**
    ```bash
    curl -X POST https://siomende.fr/sarr/jubari-api/employes \
    -H "Content-Type: application/json" \
    -d '{"nom": "Dupont", "prenom": "Jean", "email": "jean.dupont@example.com", "service_id": 1}'
    ```

- **Supprimer un employé :** `DELETE /employes`
  - **Exemple de requête :**
    ```bash
    curl -X DELETE https://siomende.fr/sarr/jubari-api/employes \
    -H "Content-Type: application/json" \
    -d '{"id": 1}'
    ```

### Gestion des Congés
- **Lister tous les congés :** `GET /conges`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/conges
    ```

- **Obtenir un congé par ID :** `GET /conges/{id}`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/conges/1
    ```

- **Créer un nouveau congé :** `POST /conges`
  - **Exemple de requête :**
    ```bash
    curl -X POST https://siomende.fr/sarr/jubari-api/conges \
    -H "Content-Type: application/json" \
    -d '{"dateD": "2023-10-01", "dateF": "2023-10-15", "description": "Vacances", "paye": true, "idE": 1}'
    ```

- **Mettre à jour un congé :** `PUT /conges`
  - **Exemple de requête :**
    ```bash
    curl -X PUT https://siomende.fr/sarr/jubari-api/conges \
    -H "Content-Type: application/json" \
    -d '{"id": 1, "dateD": "2023-10-01", "dateF": "2023-10-20", "description": "Vacances prolongées"}'
    ```

- **Supprimer un congé :** `DELETE /conges`
  - **Exemple de requête :**
    ```bash
    curl -X DELETE https://siomende.fr/sarr/jubari-api/conges \
    -H "Content-Type: application/json" \
    -d '{"id": 1}'
    ```

### Gestion des Messages
- **Lister tous les messages :** `GET /messages`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/messages
    ```

- **Obtenir un message par ID :** `GET /messages/{id}`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/messages/1
    ```

- **Créer un nouveau message :** `POST /messages`
  - **Exemple de requête :**
    ```bash
    curl -X POST https://siomende.fr/sarr/jubari-api/messages \
    -H "Content-Type: application/json" \
    -d '{"date": "2023-10-01", "description": "Problème technique", "idE": 1}'
    ```

- **Mettre à jour un message :** `PUT /messages`
  - **Exemple de requête :**
    ```bash
    curl -X PUT https://siomende.fr/sarr/jubari-api/messages \
    -H "Content-Type: application/json" \
    -d '{"id": 1, "date": "2023-10-02", "description": "Problème résolu"}'
    ```

- **Supprimer un message :** `DELETE /messages`
  - **Exemple de requête :**
    ```bash
    curl -X DELETE https://siomende.fr/sarr/jubari-api/messages \
    -H "Content-Type: application/json" \
    -d '{"id": 1}'
    ```

### Statistiques et Rapports
- **Obtenir le nombre d'employés en congé actuellement :** `GET /stats/employes-on-leave`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/stats/employes-on-leave
    ```

- **Obtenir les statistiques des congés :** `GET /stats/conges`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/stats/conges
    ```

- **Obtenir les statistiques des congés d'un employé :** `GET /stats/employes/{id}/conges`
  - **Exemple de requête :**
    ```bash
    curl -X GET https://siomende.fr/sarr/jubari-api/stats/employes/1/conges
    ```

## Sécurité

### Authentification JWT
L'API utilise un système d'authentification basé sur **JWT (JSON Web Tokens)**. Les routes protégées nécessitent un jeton valide dans l'en-tête `Authorization`.

- **Exemple d'en-tête :**
  ```
  Authorization: Bearer <votre_token_jwt>
  ```

### CORS
Le filtre **CORS** est activé pour permettre les requêtes provenant de différents domaines. Vous pouvez configurer les règles dans le fichier `.env` ou directement dans le filtre.

## Contribution

Les contributions sont les bienvenues ! Si vous trouvez un bug ou souhaitez proposer une amélioration, veuillez ouvrir une **issue** ou soumettre une **pull request**.

## Support

Pour toute question ou problème, veuillez contacter l'équipe de développement ou consulter la documentation officielle de CodeIgniter 4 : [https://codeigniter.com/user_guide/](https://codeigniter.com/user_guide/).

## Licence

Ce projet est sous licence MIT. Consultez le fichier `LICENSE` pour plus d'informations.
