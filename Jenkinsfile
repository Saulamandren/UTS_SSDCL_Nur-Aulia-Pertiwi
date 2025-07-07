pipeline {
    agent any
    environment {
        CI_ENV = "testing"
        PHP_VERSION = "8.1"
    }
    stages {
        stage('Checkout') {
            steps {
                cleanWs()
                git branch: 'main', url: 'https://github.com/Saulamandren/UTS_SSDCL_Nur-Aulia-Pertiwi.git'
            }
        }
        stage('Install Dependencies') {
            steps {
                bat 'composer install'
            }
        }
        stage('Static Code Analysis (SAST)') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    // Kembali ke perintah sederhana
                    bat 'sonar-scanner'
                }
            }
        }
        stage('Unit Test') {
            steps {
                // Path untuk Windows
                bat 'vendor\\bin\\phpunit tests'
            }
        }
    }
    post {
        always {
            echo 'Pipeline finished.'
        }
        success {
            echo 'Pipeline berhasil'
        }
        failure {
            echo 'Build gagal. Periksa log untuk detail.'
        }
    }
}
