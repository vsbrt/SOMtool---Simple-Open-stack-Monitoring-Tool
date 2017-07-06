#!usr/bin/perl
use Net::OpenSSH;
use DBI;

# PERL DBI CONNECT (RENAMED HANDLE)
#require "db.conf";
#$dbh = DBI->connect('DBI:mysql:Oceans11', $username ,$password);

sub status()
{
#status
@nova_status = ("nova-api","nova-conductor","nova-cert","nova-scheduler","nova-objectstore","nova-novncproxy","nova-consoleauth");
@cinder_status = ("cinder-scheduler","cinder-api");
@neutron_status = ("neutron-metadata-agent","neutron-server","neutron-dhcp-agent","neutron-l3-agent","neutron-plugin-openvswitch-agent","neutron-rootwrap","neutron-ns-metadata-proxy");
@heat_status = ("heat-api-cfn","heat-engine","heat-api-cloudwatch","heat-api");

#uptime
@nova_up = ("nova-api","nova-conductor","nova-cert","nova-scheduler","nova-objectstor","nova-novncproxy","nova-consoleaut");
@cinder_up = ("cinder-schedule","cinder-api");
@neutron_up = ("neutron-metadat","neutron-server","neutron-dhcp-ag","neutron-l3-agen","neutron-openvsw","neutron-rootwra","neutron-ns-meta");
@heat_up = ("heat-api-cfn","heat-engine","heat-api-cloudw","heat-api");


@glance = ("glance-registry","glance-api");
@keystone = ("keystone");


$i;

#Nova And Neutron
for($i = 0; $i < 7; $i++)
{
#Nova
	$command = "service " .$nova_status[$i] . " status | awk '{print \$2}'";
	$status = $ssh->capture2($command);
	$command2="ps -eo comm,etime | grep " .$nova_up[$i]. " | head -1 | awk '{print \$2}'";
	$time = $ssh->capture2($command2);
	$fetch = $dbh->prepare("UPDATE nova SET status = '$status', uptime = '$time' WHERE service = '$nova_status[$i]'");
	$fetch->execute();
	$fetch->finish();

#Neutron
	$command = "service " .$neutron_status[$i] . " status | awk '{print \$2}'";
	$status = $ssh->capture2($command);
	$command2="ps -eo comm,etime | grep " .$neutron_up[$i]. " | head -1 | awk '{print \$2}'";
	$time = $ssh->capture2($command2);
	$fetch = $dbh->prepare("UPDATE neutron SET status = '$status', uptime = '$time' WHERE service = '$neutron_status[$i]'");
	$fetch->execute();
	$fetch->finish();
}



#Cinder
for($i = 0; $i < 2; $i++)
{
	$command = "service " .$cinder_status[$i] . " status | awk '{print \$2}'";
	$status = $ssh->capture2($command);
	$command2="ps -eo comm,etime | grep " .$cinder_up[$i]. " | head -1 | awk '{print \$2}'";
	$time = $ssh->capture2($command2);
	$fetch = $dbh->prepare("UPDATE cinder SET status = '$status', uptime = '$time' WHERE service = '$cinder_status[$i]'");
	$fetch->execute();
	$fetch->finish();
}

#Heat
for($i = 0; $i < 4; $i++)
{
	$command = "service " .$heat_status[$i] . " status | awk '{print \$2}'";
	$status = $ssh->capture2($command);
	$command2="ps -eo comm,etime | grep " .$heat_up[$i]. " | head -1 | awk '{print \$2}'";
	$time = $ssh->capture2($command2);
	$fetch = $dbh->prepare("UPDATE heat SET status = '$status', uptime = '$time' WHERE service = '$heat_status[$i]'");
	$fetch->execute();
	$fetch->finish();
}


#Keystone
foreach(@keystone)
{
	$command = "service " . $_ . " status | awk '{print \$2}'";
	$status = $ssh->capture2($command);
	$command2="ps -eo comm,etime | grep " .$_. " | head -1 | awk '{print \$2}'";
	$time = $ssh->capture2($command2);
	$fetch = $dbh->prepare("UPDATE keystone SET status = '$status', uptime = '$time' WHERE service = '$_'");
	$fetch->execute();
}


#Glance
foreach(@glance)
{
	$command = "service " . $_ . " status | awk '{print \$2}'";
	$status = $ssh->capture2($command);
	$command2="ps -eo comm,etime | grep " .$_. " | head -1 | awk '{print \$2}'";
	$time = $ssh->capture2($command2);
	$fetch = $dbh->prepare("UPDATE glance SET status = '$status', uptime = '$time' WHERE service = '$_'");
	$fetch->execute();
}

}

1;
