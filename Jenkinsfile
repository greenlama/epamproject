#!groovy

pipeline {
    agent any
    stages {
        stage('Test') {
            steps {
            //---------------------------Test_stage--------------------------------
                sh 'echo "This is test stage"'
            }
        }
        stage('Deploy') {
            steps {
            //---------------------------Deploy_stage------------------------------
                sh 'echo "Deploy stage"'
                sh 'cat $AWS_KUBECONFIG | base64 -d > ~/.kube/config'
                sh 'cat ~/.kube/config'
            }
        }
        
    }
    post {
        always {
            cleanWs()  
        }
    }
}
