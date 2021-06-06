#!groovy

pipeline {
    agent any
    stages {
        stage('Test') {
            steps {
            //---------------------------Test_stage--------------------------------
                sh echo "This is test stage"
            }
        }
        stage('Deploy') {
            steps {
            //---------------------------Deploy_stage------------------------------
                sh echo "Deploy stage"
            }
        }
        
    }
    post {
        always {
            cleanWs()  
        }
    }
}
