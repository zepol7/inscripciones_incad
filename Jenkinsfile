pipeline {
  agent any
  
  environment {
    SONAR_SCANNER_HOME = tool 'SonarScanner'
  }
  
  stages {
    stage('Checkout') {
      steps {
        echo 'Obteniendo código fuente desde GitHub...'
        checkout scm
      }
    }
    
    stage('SonarQube Analysis') {
      steps {
        echo 'Iniciando análisis de código con SonarQube...'
        script {
          withSonarQubeEnv('SonarQube') {
            bat """
              ${SONAR_SCANNER_HOME}/bin/sonar-scanner.bat ^
              -Dsonar.projectKey=inscripciones_incad ^
              -Dsonar.sources=. ^
              -Dsonar.host.url=http://localhost:9000 ^
              -Dsonar.exclusions=**/vendor/**,**/node_modules/**
            """
          }
        }
      }
    }
    
    stage('Quality Gate') {
      steps {
        echo 'Esperando resultado del Quality Gate...'
        timeout(time: 5, unit: 'MINUTES') {
          waitForQualityGate abortPipeline: true
        }
      }
    }
    
    stage('Docker Build') {
      steps {
        echo 'Construyendo imagen Docker...'
        bat 'docker version'
        bat "docker build -t inscripciones_incad:${BUILD_NUMBER} ."
      }
    }
    
    stage('Deploy (Docker Compose)') {
      steps {
        echo 'Desplegando aplicación con Docker Compose...'
        bat 'docker compose down --remove-orphans'
        bat 'docker compose up -d --build'
        bat 'docker ps'
      }
    }
  }
  
  post {
    success {
      echo '¡Pipeline ejecutado exitosamente! ✅'
    }
    failure {
      echo 'Pipeline falló ❌'
    }
    always {
      echo 'Limpiando workspace...'
      cleanWs()
    }
  }
}