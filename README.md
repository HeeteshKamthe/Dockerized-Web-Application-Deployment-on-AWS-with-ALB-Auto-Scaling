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

 * Installed and Started Required Services:
 <p align="center"> <img src="images/installing services.jpg" alt="installing services" width="800"/> </p>

 * Setup the inbound rules of Security Group of EC2 :
 <p align="center"> <img src="images/setting inbound rules of sg.png" alt="setting inbound rules of sg" width="800"/> </p> 

* Put the Source Code files in `/var/www/html` folder:
 <p align="center"> <img src="images/html directory.jpg" alt="setting HTML directory " width="800"/> </p>

* Make Changes in Nginx configuration file `default.conf` to pass .php pages request using PHP-FPM socket: 

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
```bash
docker compose up -d --build
```

5. Verified application locally:
```bash
curl localhost
```

### Screenshots:
* Docker Compose Builds 3 Containers(Nginx, PHP-FPM, MySQL):
<p align="center"> <img src="images/docker compose build.jpg" alt="Docker compose build" width="800"/> </p>

* Docker Container restarts after rebooting:
<p align="center"> <img src="images/docker containers restarts after rebooting.jpg" alt="docker restart" width="800"/> </p>

---

## 4. Application Access

Application accessed using:

- EC2 Public IP
- Elastic IP (recommended)

Example:

http://`<EC2-Public-IP>`

### Screenshots:
* Accessing the Dockerized app using EC2 Public IP:
<p align="center"> <img src="images/form page using docker.jpg" alt="Access dockerized app" width="800"/> </p>
<p align="center"> <img src="images/new record created using docker.jpg" alt="Access dockerized app" width="800"/> </p>

* Checking the MySQL container Connectivity by ensuring records are entered in database:
<p align="center"> <img src="images/mysql container database check.jpg" alt="check mysql container" width="800"/> </p>
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

### Auto Scaling Testing (CPU Load Simulation)

- To verify Auto Scaling functionality, CPU load was artificially generated using the **stress** tool.

Installation:
```bash
sudo apt install stress -y
```

CPU load generation:
```bash
stress --cpu 2 --timeout 300
```

- This increased CPU utilization above the configured threshold, triggering Auto Scaling to launch additional EC2 instances automatically.


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

* Verify ALB DNS Working on Browser:
<p align="center"> <img src="images/ALB DNS working.jpg" alt="creating LB" width="800"/> </p>

* Create Launch Template for Auto Scaling Group:
<p align="center"> <img src="images/creating LT.jpg" alt="creating LT" width="800"/> </p>
<p align="center"> <img src="images/created LT.jpg" alt="created LT" width="800"/> </p>

* Create Auto Scaling Group:
<p align="center"> <img src="images/Creating ASG 1.jpg" alt="creating ASG" width="800"/> </p>
<p align="center"> <img src="images/Creating asg 2.png" alt="creating ASG" width="800"/> </p>
<p align="center"> <img src="images/Creating asg 3.png" alt="creating ASG" width="800"/> </p>
<p align="center"> <img src="images/creating asg 4.png" alt="creating ASG" width="800"/> </p>
<p align="center"> <img src="images/Creating ASG 5.jpg" alt="creating ASG" width="800"/> </p>
<p align="center"> <img src="images/created asg.jpg" alt="created ASG" width="800"/> </p>

* Ensure Desired Instances are Created:
<p align="center"> <img src="images/desired asg instances created.jpg" alt="Desired instances Created" width="800"/> </p>

* Using Stress Tool to verify Auto Scaling functionality: 
<p align="center"> <img src="images/using stress to create load on 1 ec2.jpg" alt="Stress tool" width="800"/> </p>

* See the CloudWatch CPU Utilization Graph Exceeding 50% limit:
<p align="center"> <img src="images/cloudwatch cpu limit graph.png" alt="CPU Utilization Check" width="800"/> </p>

* New Instance launched to fullfill Max limit of ASG:
<p align="center"> <img src="images/max limit reached.jpg" alt="CPU Utilization Check" width="800"/> </p>

---

## 6. Cost Optimization:

- Used AWS free-tier eligible instances to keep the deployment cost low during development and testing.

- Allocated only the required system resources to avoid unnecessary usage and reduce overall infrastructure cost.

- Implemented Auto Scaling, which automatically adjusts resources based on application demand, preventing over-provisioning when traffic is low.

- Used Docker containers to run the application efficiently, helping reduce infrastructure overhead and simplify deployment.

- Secured the database by not exposing the MySQL port to the public internet, allowing access only from the application server for better security.

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
