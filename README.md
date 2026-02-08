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
 <p align="center"> <img src="images/launched an instance.jpg" alt="terraform output" width="800"/> </p>