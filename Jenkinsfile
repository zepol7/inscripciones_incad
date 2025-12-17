pipeline {
  agent any

  stages {
    stage('Checkout') {
      steps {
        checkout scm
      }
    }

    stage('Docker build') {
      steps {
        bat 'docker version'
        bat 'docker build -t inscripciones_incad:%BUILD_NUMBER% .'
      }
    }

    stage('Deploy (docker compose)') {
      steps {
        bat 'docker compose down --remove-orphans'
        bat 'docker compose up -d --build'
        bat 'docker ps'
      }
    }
  }
}
