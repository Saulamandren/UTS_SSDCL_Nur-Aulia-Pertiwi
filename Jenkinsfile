pipeline {
    agent any
    
    // Menambahkan definisi tool yang akan digunakan
    tools {
        // Pastikan nama 'SonarScanner-latest' sama persis
        // dengan nama yang Anda buat di Global Tool Configuration
        sonarScanner 'SonarScanner'
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
                    // Menggunakan variabel SCANNER_HOME yang disediakan oleh 'tools'
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
