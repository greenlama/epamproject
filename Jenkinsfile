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
            steps {
            //---------------------------Deploy_stage------------------------------
                sh '''
                    echo "Deploy stage"
                    pwd
                    echo $AWS_KUBECONFIG
                    cat $AWS_KUBECONFIG | base64 -d > ./config
                    cat ./config
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
