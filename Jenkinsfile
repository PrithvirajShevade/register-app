pipeline {
    agent { label 'prithvi-agent' }
    tools {
        jdk 'java17'
        maven 'Maven1'
    }

    stages{
        stage("Cleanup Workspace"){
                steps {
                cleanWs()
                }
        }

        stage("Checkout from SCM"){
                steps {
                    git branch: 'main', credentialsId: 'github', url: 'https://github.com/PrithvirajShevade/register-app'
                }
        }

        stage("Build Application"){
            steps {
                sh "mvn clean package"
            }

       }

       stage("Test Application"){
           steps {
                 sh "mvn test"
           }
       }

        stage("SonarQube Analysis"){
            steps {
	            script {
		            withSonarQubeEnv(credentialsId: 'jenkins-sonarqube-token') { 
                    sh "mvn sonar:sonar"
		            }
	            }	
           }
       }
   }
}
