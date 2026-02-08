# Dockerized Web Application Deployment on AWS with ALB & Auto Scaling

---

## Project Overview:
 In this project I demonstrated the deployment of a simple web application using Docker containers on AWS EC2, integrated with an Application Load Balancer (ALB) and Auto Scaling Group (ASG) for high availability, scalability, and cost optimization.
 
 The objective of this project is to simulate a real-world DevOps deployment workflow including containerization, cloud deployment, scaling, and troubleshooting.

---

## Architecture Overview:
```
Users
↓
Application Load Balancer (ALB)
↓
Auto Scaling Group (EC2 Instances)
↓
Docker Containers
├── Nginx (Web Server)
├── PHP Backend
└── MySQL Database

```

---

## Application File Structure:
 ```
 PHP-Nginx-app/
 |
 |__app/
 |   |
 |   |-index.html
 |   |-submit.html
 |   
 |__nginx/
 |   |
 |   |-default.conf
 |
 |__mysql/
 |   |
 |   |-init.sql
 |
 |--Dockerfile
 |--docker-compose.yml
 |--.env

 ```

---

## 1. Application Setup:

Developed a simple frontend and backend application with database connectivity.

### Technologies Used:
- Frontend: HTML
- Backend: PHP
- Database: MySQL

### Features:
- Simple HTML registration form
- Backend processes user input
- Data stored in MySQL database
- Successful database connection established

### Steps:

- Initially I setup the application on AWS EC2(Ubuntu)  by manually installing all the required services like Nginx, PHP, PHP-FPM and MysSQL.

- used the AWS free tier t2.micro server for cost optimization.

- Developed the frontend using index.html and implemented backend functionality using submit.php.

- Deployed and tested the application locally to ensure proper functionality and successful browser execution. 

- also used .env configuration file to store the environment variables so that changes in database configuration can be done easily without making any changes in source code.

### Database Connection
Application connects to MySQL using environment variables stored in .env file:
```
DB_HOST
DB_USER
DB_PASSWORD
DB_DATABASE
MYSQL_PASSWORD

```
### Screenshots:
* Configurations for launching an AWS EC2 instance:
 <p align="center"> <img src="images/ec2 launch.jpg" alt="ec2 launch" width="800"/> </p>

* Launched an EC2 instance:
<<<<<<< HEAD
 <p align="center"> <img src="images/launched an instance.png" alt="launched an instance" width="800"/> </p>

 * ssh into ec2 instance:
 <p align="center"> <img src="images/ssh.jpg" alt="ssh into ec2 instance" width="800"/> </p>

 * Installed Required Services:
 <p align="center"> <img src="images/installing services.jpg" alt="installing services" width="800"/> </p>

 * Setup the inbound rules of Security Group of EC2 :
 <p align="center"> <img src="images/setting inbound rules of sg.png" alt="setting inbound rules of sg" width="800"/> </p> 

* Put the Source Code files in `/var/www/html` folder:
 <p align="center"> <img src="html directory.pngjpg" alt="setting inbound rules of sg" width="800"/> </p> 

* Check the working of Deployed App on Browser:
 <p align="center"> <img src="images/form page.jpg" alt="Registration form page" width="800"/> </p> 
 <p align="center"> <img src="images/new record created manually.jpg" alt="new record created manually" width="800"/> </p> 

* Check Database connectivity on EC2 by checking MySQL database records:
 <p align="center"> <img src="images/mysql database check.jpg" alt="mysql database check" width="800"/> </p> 

---

## 2. Docker Implementation

### Objective
Containerize the application for portability and consistent deployment.

### Tasks Performed
- Created Dockerfile for PHP application
- Configured Nginx as web server
- Used MySQL official Docker image
- Created docker-compose.yml for multi-container setup

### Containers Used
- nginx
- php-fpm
- mysql

### Port Exposure
- HTTP Port: 80

### Auto Start Configuration
Containers configured with:

=======
 <p align="center"> <img src="images/launched an instance.png" alt="terraform output" width="800"/> </p>
>>>>>>> 31fc0aca98450edbb633264e85af994e94efe98f
