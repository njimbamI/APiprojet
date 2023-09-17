pipeline {
    agent any

    environment {
        DATABASE_URL = 'mysql://root:@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4'
         LOCAL_DEPLOY_PATH = 'E:\\Nouveau dossier'
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
        // Étape de build (exemples) :
        sh 'npm install' // Si vous utilisez Node.js
        sh 'npm run build' // Si vous avez des fichiers JS à compiler

        // Copiez les fichiers de l'application dans le répertoire de déploiement local
        sh "cp -R * \"$LOCAL_DEPLOY_PATH\""
    }
        }
    }

    post {
    success {
        echo 'Le pipeline a réussi. Félicitations!'
        // Vous pouvez ajouter d'autres étapes post-déploiement ici en cas de succès
    }
    failure {
        echo 'Le pipeline a échoué. Vérifiez les logs pour plus d'informations.'
        // Vous pouvez ajouter d'autres étapes de gestion des échecs ici si nécessaire
    }
}
}
