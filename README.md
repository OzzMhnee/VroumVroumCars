Créer une application symfony répondant aux critères suivants :

Une voiture a un nom (ex : Megan II), une année de mise sur le marché, un nombre de portes. On précisera si elle est électrique ou non (dans le cadre de cette application on partira du principe que nous vivons dans un monde alternatif où les voitures hybrides n'existent pas (lol)). 
Une marque a un nom, une date de création et un ensemble de voitures créées.
On peut Ajouter, consulter ou supprimer chacun des objets créés.
On peut afficher la liste des Marques, la listes des Voitures.
Depuis la page du détail d'une marque on y verra l'ensemble des voitures de celles ci. On aura aussi un onglet voiture thermique et un autre voiture électrique.

# VroumVroumCars

VroumVroumCars est une application Symfony permettant de gérer un catalogue de voitures et de marques automobiles, avec une interface moderne et intuitive.

## Fonctionnalités principales

- **Gestion des voitures**
  - Une voiture possède :
    - Un nom
    - Une année de mise sur le marché
    - Un nombre de portes
    - Un type d'énergie : électrique ou thermique (dans ce projet, il n’existe pas d’hybrides)
    - Une image
    - Une marque associée

- **Gestion des marques**
  - Une marque possède :
    - Un nom
    - Une date de création
    - Un logo
    - Un ensemble de voitures associées

- **Opérations CRUD**
  - Ajouter, consulter, modifier ou supprimer une marque ou une voiture

- **Affichage des listes**
  - Liste des marques (avec logo, date de création, actions)
  - Liste des voitures (avec image, marque, nombre de portes, énergie, actions)

- **Détail d’une marque**
  - Affichage de toutes les voitures de la marque sous forme de cards
  - Onglets pour filtrer :
    - Toutes les voitures
    - Voitures électriques
    - Voitures thermiques

- **Navigation**
  - Dropdown dynamique pour naviguer entre marques et voitures
  - Dropdown de gestion des données pour voir liste des marques, voitures et ajouter marque/voiture
