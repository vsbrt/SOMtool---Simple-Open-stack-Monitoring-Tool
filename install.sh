 #!/bin/bash 

#Installing pre-requisites
#sudo apt-get update
sudo apt-get -y install  apache2 mysql-server php5 php5-mysql libgd-graph-perl libapache2-mod-php5 cpanminus openssh-server
sudo cpan install DBI
sudo cpan install Net::OpenSSH

#Key pair for ssh
def1_path="/var/www/html"
def_path=$(pwd)
#echo $def_path 

#setting permissions and files
cd
sudo chmod -R 777 $def1_path
sudo rm -rf $def1_path/index.html
mkdir .ssh
cp -a $def_path/keys/. .ssh
#cp $def_path/keys/known_hosts .ssh
sudo mkdir /.ssh
sudo cp -a $def_path/keys/. /.ssh
#sudo cp $def_path/keys/known_hosts /.ssh
sudo chmod -R 0700 .ssh/*
sudo chmod -R 0700 /.ssh/*
cd $def_path

#copying source files
sudo cp -r frontend/ $def1_path
sudo cp -r db.conf $def1_path
cd
sudo chmod -R 777 $def1_path/frontend/
sudo chmod -R 777 $def1_path/db.conf

#running backend scripts

echo "Installation of tool completed succesfully!!!..."
echo "================================================"

echo "Now you can  use Run.sh for running the backend scripts directly"
echo "but dont worry We will run that for you for the first time ;)"

cd $def_path
./run.sh
