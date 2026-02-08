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
 |   |-submit.php
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

- Initially I setup the application on AWS EC2(Ubuntu) by manually installing all the required services like Nginx, PHP, PHP-FPM and MysSQL.

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
 <p align="center"> <img src="images/launched an instance.png" alt="launched an instance" width="800"/> </p>

 * ssh into ec2 instance:
 <p align="center"> <img src="images/ssh .jpg" alt="ssh into ec2 instance" width="800"/> </p>

 * Installed Required Services:
 <p align="center"> <img src="images/installing services.jpg" alt="installing services" width="800"/> </p>

 * Setup the inbound rules of Security Group of EC2 :
 <p align="center"> <img src="images/setting inbound rules of sg.png" alt="setting inbound rules of sg" width="800"/> </p> 

* Put the Source Code files in `/var/www/html` folder:
 <p align="center"> <img src="html directory.jpg" alt="setting inbound rules of sg" width="800"/> </p> 

* Check the working of Deployed App on Browser:
 <p align="center"> <img src="images/form page.jpg" alt="Registration form page" width="800"/> </p> 
 <p align="center"> <img src="images/new record created manually.jpg" alt="new record created manually" width="800"/> </p> 

* Check Database connectivity on EC2 by checking MySQL database records:
 <p align="center"> <img src="images/mysql database check.jpg" alt="mysql database check" width="800"/> </p> 

---

## 2. Docker Implementation

Containerized the application for portability and consistent deployment.

### Tasks Performed
- Installed and Enabled Docker & Docker Compose on server.
- If using same EC2 instance as I used, ensure that the running services like Nginx and MySQL are stopped to avoid the port conflicts while using Docker Containers.
- Created Dockerfile for PHP application.
- Configured Nginx as web server.
- Used MySQL official Docker image.
- Created docker-compose.yml for multi-container setup.

### Containers Used
- nginx
- php-fpm
- mysql

### Port Exposure
- HTTP Port: 80

### Auto Start Configuration
Containers configured with:
```json
restart: always
```
This ensures containers automatically start after instance reboot.

### Benefits
- Environment consistency
- Easy deployment
- Service isolation

---

## 3. AWS EC2 Deployment:

Deploy containerized application on AWS.

### Steps Performed:
1. Launched EC2 instance
   - Instance Type: t2.micro / t3.micro (Free Tier eligible)
   - OS: Ubuntu Server
2. Installed Docker and Docker Compose
3. Copied project files to EC2
4. Started containers:

docker compose up -d


5. Verified application locally:

curl localhost


---

## 4. Application Access

Application accessed using:

- EC2 Public IP
- Elastic IP (recommended)

Example:

http://<EC2-Public-IP>


---

## 5. Load Balancer & Auto Scaling

### Application Load Balancer (ALB)
- Internet-facing ALB created
- Listener configured on port 80
- Target group created with EC2 instances
- Health check path set to:
```
/
```

### Auto Scaling Group (ASG)
- Launch Template created using AMI
- Minimum instances: 1
- Desired instances: 2
- Maximum instances: 3

### Scaling Policy
- Target tracking scaling policy
- Metric: Average CPU Utilization
- Target CPU Utilization: 50%

When CPU usage exceeds threshold, new instance launches automatically.

### Screenshots:

* Create AMI from Dockerized App Instance:
 <p align="center"> <img src="images/creating AMI.jpg" alt="creating AMI" width="800"/> </p> 
 <p align="center"> <img src="images/AMI created.jpg" alt="AMI created" width="800"/> </p> 

 *Create Target Group for ALB:
 <p align="center"> <img src="images/create target group 1.jpg" alt="creating Target Group" width="800"/> </p>
 <p align="center"> <img src="images/create target group 2.jpg" alt="creating Target Group" width="800"/> </p>
 <p align="center"> <img src="images/created target group .jpg" alt="creating Target Group" width="800"/> </p> 

* Create Application Load Balancer (ALB):
 <p align="center"> <img src="images/creating LB 1.jpg" alt="creating LB" width="800"/> </p>
 <p align="center"> <img src="images/creating LB 2.jpg" alt="creating LB" width="800"/> </p>
 <p align="center"> <img src="images/creating LB 3.jpg" alt="creating LB" width="800"/> </p>
 <p align="center"> <img src="images/LB created.jpg" alt="created LB" width="800"/> </p>

* Verifying ALB DNS Working:
<p align="center"> <img src="images/ALB DNS working.jpg" alt="creating LB" width="800"/> </p>


---

## 6. Cost Optimization:

- Used AWS free-tier eligible instances to keep the deployment cost low during development and testing.

- Allocated only the required system resources to avoid unnecessary usage and reduce overall infrastructure cost.

- Implemented Auto Scaling, which automatically adjusts resources based on application demand, preventing over-provisioning when traffic is low.

- Used Docker containers to run the application efficiently, helping reduce infrastructure overhead and simplify deployment.

- Secured the database by not exposing the MySQL port to the public internet, allowing access only from the application server for better security.

- If you want, I can also make this sound more like a DevOps engineer explanation in an interview (more conversational) or a formal documentation version.

---

## 7. Troubleshooting:

### Issue 1 — Application Not Accessible
**Cause:** Security group blocking HTTP traffic  
**Solution:** Allowed inbound port 80.

---

### Issue 2 — Container Running but Port Not Reachable
**Cause:** Incorrect port mapping or Nginx configuration. 
**Solution:** Corrected Docker port mapping and updated Nginx configuration to properly route traffic.

---

### Issue 3 — MySQL Access Denied
**Cause:** Database environment variables were not passed correctly to the container. 
**Solution:** Configured environment variables using a .env file and verified values inside the running container.

---

### Issue 4 — ALB Health Check Failure
**Cause:** Incorrect health check path or application not running  
**Solution:** Updated the health check path to / and ensured containers automatically start on system reboot.

---

### Issue 5 — Port 3306 Already in Use
**Cause:** Host MySQL service running  
**Solution:** Stopped the host MySQL service or removed external port exposure from the container.
