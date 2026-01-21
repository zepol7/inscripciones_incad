pipeline {
  agent any
  
  stages {
    stage('Checkout') {
      steps {
        echo 'Obteniendo código fuente desde GitHub...'
        checkout scm
      }
    }
    
    stage('SonarQube Analysis') {
      steps {
        echo 'Analizando código con SonarQube usando Docker...'
        script {
          // Obtener el token de SonarQube desde las credenciales de Jenkins
          withCredentials([string(credentialsId: 'sonarqube-token', variable: 'SONAR_TOKEN')]) {
            bat """
              docker run --rm ^
              -e SONAR_HOST_URL=http://host.docker.internal:9000 ^
              -e SONAR_TOKEN=%SONAR_TOKEN% ^
              -v %CD%:/usr/src ^
              sonarsource/sonar-scanner-cli ^
              -Dsonar.projectKey=inscripciones_incad ^
              -Dsonar.sources=. ^
              -Dsonar.exclusions=**/vendor/**,**/node_modules/**,**/.git/**
            """
          }
        }
      }
    }
    
    stage('Quality Gate') {
      steps {
        echo 'Verificando Quality Gate...'
        timeout(time: 2, unit: 'MINUTES') {
          script {
            // Esperar un poco para que SonarQube procese
            sleep 10
            
            withCredentials([string(credentialsId: 'sonarqube-token', variable: 'SONAR_TOKEN')]) {
              def response = bat(
                script: """
                  curl -u %SONAR_TOKEN%: ^
                  http://localhost:9000/api/qualitygates/project_status?projectKey=inscripciones_incad
                """,
                returnStdout: true
              ).trim()
              
              echo "Quality Gate Status: ${response}"
            }
          }
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
        echo 'Desplegando aplicación...'
        bat 'docker compose down --remove-orphans'
        bat 'docker compose up -d --build'
        bat 'docker ps'
      }
    }
  }
  
  post {
    success {
      echo '✅ Pipeline completado exitosamente!'
    }
    failure {
      echo '❌ Pipeline falló'
    }
  }
}
