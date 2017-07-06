SOMtool - Simple Open stack Monitoring Tool
==========================================

Introduction:
-------------
The tool facilitates the monitoring of various Openstack services deployed on the nodes in the 
Openstack environment. This tool can monitor the status of the OpenStack services, It also provides
and simple intuitive web based drilled down GUI to restart services, measure historical data on uptime
Accessibility of services and detects periodicity of failures through a RESTful interface.

Requirements:
-------------
The following packages are used for development of this tool. They will be automatically installed while executing "install.sh". 
apache2,mysql-server,php5,php5-mysql,libapache2-mod-php5,cpanminus,openssh-server.

following cpan perl modules will also be installed automatically
DBI,Net::OpenSSH.

Getting Started:
----------------
1. Before proceeding to installation, please change the login credentials in "db.conf" file.

2. If the Apache server is configured in a different directory other than var/www/html/
the change the default working directory assigned to the variable "def1_path" to the custom 
path in which the Apache server is configured

Installation:
-------------
*To automatically install the tool along with all the pre-requisites, Just run the "install.sh".using the following command from your tool directory
	./install.sh

*To just Run the backed ("Pre-requisites need to be already installed") use "run.sh". using the following command from your tool directory
	./run.sh" 

*To open the web GUI, just open the following link:
	https://localhost/frontend/index.php

Troubleshooting:
----------------
*If SSH connection fails to establish, 
-please check for the SSH keys and valid permissions.
-verify if Net::OpenSSH perl module is installed correctly.

*Failed to create database,
-please check for the credentials in "db.conf" file.
-verify if DBI perl module is installed correctly.

*failed to open the web GUI,
-verify the port on which the apache2 server is configured.
-grant the required permissions to the frontend files.

FAQ
---
Q: Will this tool work on both i386 and amd64 platforms?
A: Yes, this tool is independent of the system architecture but 
currently supports linux based platforms. Development for other
platforms will be provided in the future.

Q: I don't want my frontend files to be in "/var/www/html/" directory, 
what to do?
A: Please change the directory assigned to the variable 
"$def1_path". 



