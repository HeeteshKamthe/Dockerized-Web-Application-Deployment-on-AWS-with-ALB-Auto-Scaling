# Dockerized Web Application Deployment on AWS with ALB & Auto Scaling

---

## Project Overview:
 In this project I demonstrated the deployment of a simple web application using Docker containers on AWS EC2, integrated with an Application Load Balancer (ALB) and Auto Scaling Group (ASG) for high availability, scalability, and cost optimization.
 
 The objective of this project is to simulate a real-world DevOps deployment workflow including containerization, cloud deployment, scaling, and troubleshooting.

---

## Architecture Overview:
 ```
 PHP-Nginx-app
 |
 |--app
 |   |
 |   |-index.html
 |   |-submit.html
 |   
 |--nginx
 |   |
 |   |-default.conf
 |
 |--mysql
 |   |
 |   |-init.sql
 |
 |--Dockerfile
 |--docker-compose.yml
 |--.env

 ```

---

