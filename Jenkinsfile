#!groovy

properties([disableConcurrentBuilds()])

pipeline {
  agent {
    kubernetes {
      yamlFile 'agent.yaml'
    }
  }
  environment {
    CREDENTIALS = 'epam-project-316707'
    PROJECT_ID = 'epam-project-316707'
    CLUSTER_NAME = 'c1'
    LOCATION = 'europe-north1-b'
  }
  options {
        buildDiscarder(logRotator(numToKeepStr: '20', artifactNumToKeepStr: '20'))
        timestamps()
  }
  stages {
    stage('Code test') {
      steps {
          script {
            container('sonar') {
              sh "sonar-scanner -Dsonar.projectKey=epam-project -Dsonar.sources=."
            }
          }
      }
    }
    stage('Image build') {
      steps {
          script {
            container('docker') {
              tag = env.TAG_NAME ?: env.BUILD_ID
              release = env.TAG_NAME ? true : false
              docker.withRegistry('https://eu.gcr.io', "gcr:${env.CREDENTIALS}") {
                def image = docker.build("epam-project-316707/cicd_app:${tag}")
                  image.push()
                  if(env.TAG_NAME) {
                        image.push('latest') 
                  }
              } 
            }
          }
      }
    }
    stage ('Deploy to DEV') {
     when { 
      branch 'dev'
     }
     steps {
       container('kubectl') {
          sh "sed -i 's/__TAG__/${tag}/g' manifest.yaml"
          step([
            $class: 'KubernetesEngineBuilder',
            projectId: env.PROJECT_ID,
            clusterName: env.CLUSTER_NAME,
            location: env.LOCATION,
            manifestPattern: 'manifest.yaml',
            namespace: 'pinkfloyd-dev',
            credentialsId: env.CREDENTIALS,
            verifyDeployments: true
          ])
        }
     }
    }
    stage ('Deploy to PROD') {
     when { 
      branch 'master'
     }
     steps {
       container('kubectl') {
          sh "sed -i 's/__TAG__/${tag}/g' manifest.yaml"
          step([
            $class: 'KubernetesEngineBuilder',
            projectId: env.PROJECT_ID,
            clusterName: env.CLUSTER_NAME,
            location: env.LOCATION,
            manifestPattern: 'manifest.yaml',
            namespace: 'pinkfloyd-prod',
            credentialsId: env.CREDENTIALS,
            verifyDeployments: true
          ])
        }
     }
    }
  }
  post {
    always {
      cleanWs()  
    }
    success {
      script {
        currentBuild.result = 'SUCCESS'
        office365ConnectorSend color: 'Green', message: 'Build was SUCCESSFUL', status: 'SUCCESS', webhookUrl: 'https://epam.webhook.office.com/webhookb2/d211fc57-12d0-45b0-8c41-7ec8c570edcf@b41b72d0-4e9f-4c26-8a69-f949f367c91d/JenkinsCI/00984a90d57e4af69e5a5e58e6df7bd0/2522bdb8-3e1c-4b8c-b575-516810e8d948'
      }   
    }
    failure {
      script {
        currentBuild.result = 'FAILURE'
        office365ConnectorSend color: 'Red', message: 'Build FAILED', status: 'FAILED', webhookUrl: 'https://epam.webhook.office.com/webhookb2/d211fc57-12d0-45b0-8c41-7ec8c570edcf@b41b72d0-4e9f-4c26-8a69-f949f367c91d/JenkinsCI/00984a90d57e4af69e5a5e58e6df7bd0/2522bdb8-3e1c-4b8c-b575-516810e8d948'
      }   
    }
  }
}
