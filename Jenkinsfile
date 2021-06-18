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

  stages {
    stage('Image build') {
      steps {
          script {
            container('docker') {
              sh 'printenv'
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
=======
pipeline {
    agent any
    environment {
        AWS_KUBECONFIG = credentials('AWS_KUBECONFIG')
    }
    stages {
        stage('Test') {
            steps {
            //---------------------------Test_stage--------------------------------
                sh 'echo "This is test stage"'
            }
        }
        stage('Deploy') {
            //agent { 
            //    docker { 
            //        image 'docker pull bitnami/kubectl'
            //        args '-u root:root'
            //    } 
          //  }
            steps {
            //---------------------------Deploy_stage------------------------------
                sh '''
                    echo $AWS_KUBECONFIG | base64 -d > ./aws_config
                    KUBECONFIG=./aws_config
                    kubectl get pods -n cicd
                '''
            }
        }
        
    }
    post {
        always {
            cleanWs()  
        }
    }
}
