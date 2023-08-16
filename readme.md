# Krea-Tout-Eure-Blog-Symfony

Blog "Kréa Tout Eure" est un blog réaliser pour l'assiocation Kréa Tout'Eure.

## Outils et technologies utilisées

- Symfony 6.1
- Liip Imagine 
- Mailer
- CORS
- API Rest

## Installation

Pour installer et lancer votre projet, suivez les étapes suivantes :

1. Clonez le dépôt git sur votre ordinateur : `git clone git@github.com:MaximeTheneau/Krea-Tout-Eure-Blog-Symfony-.git`
2. Installez les dépendances du projet en exécutant la commande `composer install` dans le répertoire du projet
3. Créez la base de données en exécutant la commande `php bin/console doctrine:database:create`
4. Exécutez les migrations en exécutant la commande `php bin/console doctrine:migrations:migrate`
3. Lancez le projet en exécutant la commande `php -S 0.0.0.0:8000 -t public`
4. Ouvrez votre navigateur et accédez à l'adresse `http://localhost:8000` pour accéder à votre projet
