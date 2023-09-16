pipeline {
    agent any

    environment {
        DATABASE_URL = 'mysql://root:@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4'
    }

    stages {
        stage('Checkout') {
            steps {
                checkout([$class: 'GitSCM', 
                    branches: [[name: 'main']], 
                    doGenerateSubmoduleConfigurations: false, 
                    extensions: [], 
                    submoduleCfg: [], 
                    userRemoteConfigs: [[url: 'https://github.com/njimbamI/APiprojet.git']]
                ])
            }
        }

        stage('Install Dependencies') {
            steps {
                sh 'composer install'
            }
        }

        stage('Run Tests') {
            steps {
                sh 'php bin/phpunit'
            }
        }

        stage('Database Migration') {
            steps {
                sh 'php bin/console doctrine:migrations:migrate --no-interaction'
            }
        }

        stage('Build and Deploy') {
            steps {
                // Préparation de l'application Symfony pour la production
                sh 'php bin/console cache:clear --env=prod'
            }
        }
    }

    post {
        success {
            // Vous pouvez ajouter des étapes post-déploiement ici en cas de succès
        }
        failure {
            // Vous pouvez ajouter des étapes de gestion des échecs ici si nécessaire
        }
    }
}
