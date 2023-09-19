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
                sh 'composer install --ignore-platform-req=ext-xml'
            }
        }
        stage('Database Migration') {
            steps {
                sh 'php bin/console doctrine:migrations:migrate --no-interaction'
            }
        }

        stage('Build Docker Image') {
            steps {
                // Build de l'image Docker de votre application Symfony
                sh 'docker build -t mon_app_symfony .'
            }
        }

        stage('Deploy with Docker') {
            steps {
                // Déployez l'image Docker sur un conteneur
                sh 'docker run -d --name mon_app_container -p 80:80 mon_app_symfony'
            }
        }
    }
}
