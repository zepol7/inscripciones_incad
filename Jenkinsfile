pipeline {
  agent any
  
  stages {
    stage('Checkout') {
      steps {
        echo '📥 Descargando código desde GitHub...'
        checkout scm
      }
    }
    
    stage('SonarQube Analysis') {
      steps {
        echo '🔍 Ejecutando análisis de SonarQube...'
        script {
          withCredentials([string(credentialsId: 'sonarqube-token', variable: 'SONAR_TOKEN')]) {
            bat """
              docker run --rm ^
              --network host ^
              -e SONAR_HOST_URL=http://localhost:9000 ^
              -e SONAR_TOKEN=%SONAR_TOKEN% ^
              -v "%CD%":/usr/src ^
              sonarsource/sonar-scanner-cli:latest ^
              -Dsonar.projectKey=inscripciones_incad ^
              -Dsonar.projectName="Inscripciones INCAD" ^
              -Dsonar.sources=. ^
              -Dsonar.exclusions=**/vendor/**,**/node_modules/**,**/.git/**,**/tests/**
            """
          }
        }
        echo '✅ Análisis de SonarQube completado'
        echo '📊 Ver resultados en: http://localhost:9000/dashboard?id=inscripciones_incad'
      }
    }
    
    stage('Docker Build') {
      steps {
        echo '🐳 Construyendo imagen Docker...'
        bat 'docker version'
        bat "docker build -t inscripciones_incad:%BUILD_NUMBER% ."
        echo "✅ Imagen creada: inscripciones_incad:%BUILD_NUMBER%"
      }
    }
    
    stage('Deploy') {
      steps {
        echo '🚀 Desplegando aplicación...'
        bat 'docker compose down --remove-orphans'
        bat 'docker compose up -d --build'
        bat 'docker ps'
        echo '✅ Aplicación desplegada exitosamente'
      }
    }
  }
  
  post {
    success {
      echo '✅ ¡Pipeline ejecutado exitosamente!'
      echo '📊 Revisa SonarQube: http://localhost:9000/dashboard?id=inscripciones_incad'
    }
    failure {
      echo '❌ El pipeline falló. Revisa los logs arriba.'
    }
    always {
      echo '🧹 Pipeline finalizado'
    }
  }
}
