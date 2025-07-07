pipeline {
    agent any
    
    tools {
        // PASTIKAN NAMA DI SINI SAMA PERSIS DENGAN YANG ANDA SALIN DARI LANGKAH 1
        hudson.plugins.sonar.SonarRunnerInstallation 'SonarScanner'
    }

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
                    // Perintah ini sekarang akan menggunakan path lengkap dari tool yang diinstal
                    bat '"%SCANNER_HOME%/bin/sonar-scanner.bat"'
                }
            }
        }
        stage('Unit Test') {
            steps {
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
