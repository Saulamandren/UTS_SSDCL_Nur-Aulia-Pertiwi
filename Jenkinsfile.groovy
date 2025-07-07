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
                git branch: 'main', url: 'https://github.com/Saulamandren/UTS_SSDCI_Nur-Aulia-Pertiwi.git'
            }
        }
        stage('Install Dependencies') {
            steps {
                // Menggunakan 'bat' untuk Windows
                bat 'composer install'
            }
        }
        stage('Static Code Analysis (SAST)') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    // Menggunakan 'bat' untuk Windows
                    bat 'sonar-scanner'
                }
            }
        }
        stage('Unit Test') {
            steps {
                // Menggunakan 'bat' untuk Windows
                bat 'vendor\\bin\\phpunit tests' // Gunakan backslash (\) untuk path di Windows
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