
# Brand Manager

 Symfony application for managing a list of brands and dynamically displaying top lists by country.

 ## Technologies used 
 1. PHP 8.2
 2. MYSQL 8.0
 3. Symfony 7.2
 4. Composer 2.8
 5. Symfony CLI 5.11
 6. Docker 28.0
 7. docker-compose 2.31

 ## Installation without docker 

1. Clone the project:
   ```bash
   git clone https://github.com/adjimi-lionelle/php-fullstack-assessment.git
   cd php-fullstack-assessment
   ```
2. Configure the
    ```bash
      cp .env.example .env
    ```
3. Install PHP dependencies
    ```bash
    cd ..
    composer install
     ```   
4. Modify the MYSQL connection line according to your local configuration
    ```bash
      DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app”
    ```      
5. Create the database
   ```bash
     php bin/console doctrine:database:create
   ```
6. Apply database migrations
    ```bash
      php bin/console doctrine:migrations:migrate
    ```
7. Load fixtures
    ```bash
      php bin/console doctrine:fixture:load
    ```    
8. Launch the application
    ```bash
      symfony server:start
      If an error occurs with the script.sh file, run
      cd docker
      chmod +x script.sh
    ```   
9. Access the application
    ```bash
      http://localhost:8080
    ```  

## Installation with docker    

1. Clone the project:
   ```bash
   git clone https://github.com/adjimi-lionelle/php-fullstack-assessment.git
   cd php-fullstack-assessment
   ```
2. Build and start the containers:
   ```bash
   docker-compose up -d --build
   ```
3. Access the application
    ```bash
      http://127.0.0.1:8085
    ```
4. Go to Phpmyadmin
    ```bash
      http://127.0.0.1:8081
    ```    
5. Stop the containers
    ```bash 
      docker-compose down
    ```
5. Access the app container
    ```bash 
      docker exec -it app bash
    ```    