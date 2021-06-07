#!groovy

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
