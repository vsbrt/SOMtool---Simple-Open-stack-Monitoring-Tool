#!/usr/bin/perl

sub createtablei()
{
	$dbh = DBI->connect('DBI:mysql:mysql', $username ,$password);
	
	#create database
	$sql = "CREATE DATABASE IF NOT EXISTS $database";
	$query = $dbh->prepare($sql);
	$query->execute ();

	$dbh = DBI->connect("DBI:mysql:$database", $username ,$password);
	
	$sql="CREATE TABLE IF NOT EXISTS users (
						id MEDIUMINT NOT NULL AUTO_INCREMENT,
						username varchar(255),
						password varchar(255),
						PRIMARY KEY (id)
						) ;",
	$query = $dbh->prepare($sql);
	$query->execute ();
	
	$fetch = $dbh->prepare("SELECT COUNT(*) FROM users");
	$fetch->execute() or die $DBI::errstr;
	$row = $fetch->fetchrow_array();

	if($row == 0)
	{	
		$sth = $dbh->prepare("INSERT INTO users (username,password) values ('$user','$pass')");
		$sth->execute();
	}


@service = ("nova","neutron","glance","heat","keystone","cinder");

@nova = ("nova-api","nova-conductor","nova-cert","nova-scheduler","nova-objectstore","nova-novncproxy","nova-consoleauth");
@cinder = ("cinder-scheduler","cinder-api");
@neutron = ("neutron-metadata-agent","neutron-server","neutron-dhcp-agent","neutron-l3-agent","neutron-plugin-openvswitch-agent","neutron-rootwrap","neutron-ns-metadata-proxy");
@heat = ("heat-api-cfn","heat-engine","heat-api-cloudwatch","heat-api");
@glance = ("glance-registry","glance-api");
@keystone = ("keystone");


foreach(@service)
{
#services
	
	$sql="CREATE TABLE IF NOT EXISTS $_ (
						service varchar(255) ,
						uptime varchar(255),
						status varchar(255)
	 				    ) ;",
	$query = $dbh->prepare($sql);
	$query->execute ();
}

#Restart Table
$sql="CREATE TABLE IF NOT EXISTS restart(
						service varchar(255) ,
						request int(11),
	 					count int(255) NOT NULL
					) ;",
$sth = $dbh->prepare($sql);
$sth->execute ();

$fetch = $dbh->prepare("SELECT COUNT(*) FROM restart");
$fetch->execute() or die $DBI::errstr;
$row = $fetch->fetchrow_array();

if($row == 0)
{
	foreach $serv (@service)
	{
		$sth = $dbh->prepare("INSERT INTO restart (service) values ('$serv')");
		$sth->execute();
	}
}


#Checking for services
foreach $ser (@service)
{
$fetch = $dbh->prepare("SELECT COUNT(*) FROM $ser");
$fetch->execute() or die $DBI::errstr;
$rows = $fetch->fetchrow_array();

	if($rows == 0)
	{
		foreach $asd (@$ser)
		{
			#Inserting into Service Tables
			$query = $dbh->prepare("INSERT INTO $ser (service) values ('$asd')");
			$query->execute();
		}
	}
}

#CONNECTING TO THE DATABASE	
	$dbh = DBI->connect("DBI:mysql:$database", $username ,$password);
}

1;
