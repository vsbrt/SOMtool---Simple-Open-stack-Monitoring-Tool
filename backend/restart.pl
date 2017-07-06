#!/usr/bin/perl

sub restart()
{
@service = ("nova","neutron","glance","heat","keystone","cinder");

foreach $ser (@service)
{
	$fetch = $dbh->prepare("SELECT request FROM restart WHERE service = '$ser'");
	$fetch->execute() or die $DBI::errstr;
	$row = $fetch->fetchrow_array();

	if($row == 1)
	{
		if($ser eq 'cinder')
		{
			cinder();
			$query = $dbh->prepare("UPDATE restart SET request = '0' WHERE service = 'cinder'");
			$query->execute();
			
			#counting Number of Restarts
			$query = $dbh->prepare("UPDATE restart SET count = count + 1 WHERE service = '$ser'");
			$query->execute();
		}

		if($ser eq 'nova')
		{
			nova();
			$query = $dbh->prepare("UPDATE restart SET request = '0' WHERE service = 'nova'");
			$query->execute();
			
			#counting Number of Restarts
			$query = $dbh->prepare("UPDATE restart SET count = count + 1 WHERE service = '$ser'");
			$query->execute();
		}

		if($ser eq 'neutron')
		{
			neutron();
			$query = $dbh->prepare("UPDATE restart SET request = '0' WHERE service = 'neutron'");
			$query->execute();
			
			#counting Number of Restarts
			$query = $dbh->prepare("UPDATE restart SET count = count + 1 WHERE service = '$ser'");
			$query->execute();
		}

		if($ser eq 'heat')
		{
			heat();
			$query = $dbh->prepare("UPDATE restart SET request = '0' WHERE service = 'heat'");
			$query->execute();
			
			#counting Number of Restarts
			$query = $dbh->prepare("UPDATE restart SET count = count + 1 WHERE service = '$ser'");
			$query->execute();
		}

		if($ser eq 'keystone')
		{
			keystone();
			$query = $dbh->prepare("UPDATE restart SET request = '0' WHERE service = 'keystone'");
			$query->execute();
			
			#counting Number of Restarts
			$query = $dbh->prepare("UPDATE restart SET count = count + 1 WHERE service = '$ser'");
			$query->execute();
		}

		if($ser eq 'glance')
		{
			glance();
			$query = $dbh->prepare("UPDATE restart SET request = '0' WHERE service = 'glance'");
			$query->execute();
			
			#counting Number of Restarts
			$query = $dbh->prepare("UPDATE restart SET count = count + 1 WHERE service = '$ser'");
			$query->execute();
		}

	}

}

sub nova()
{
	$restart = $ssh->capture2("
 service nova-api restart;
 service nova-cert restart;
 service nova-conductor restart;
 service nova-scheduler restart;
 service nova-objectstore restart;
 service nova-consoleauth restart;
 service nova-novncproxy restart;
 service nova-objectstore restart; ") and print "NOVA SERVICE restartED";
}

sub glance()
{
	$restart = $ssh->capture2("
 service glance-registry restart;
 service glance-api restart;") and print "GLANCE SERVICE restartED";
}

sub cinder()
{
	$restart = $ssh->capture2("
 service cinder-scheduler restart;
 service cinder-api restart;") and print "CINDER SERVICE restartED";
}

sub neutron()
{
	$restart = $ssh->capture2("
 service neutron-metadata-agent restart;
 service neutron-server restart;
 service neutron-dhcp-agent restart;
 service neutron-l3-agent restart;
 service neutron-plugin-openvswitch-agent restart;
 service neutron-rootwrap restart;
 service neutron-ns-metadata-proxy restart;") and print "NEUTRON SERVICE restartED";
}

sub heat()
{
	$restart = $ssh->capture2("
 service heat-api-cfn restart;
 service heat-engine restart;
 service heat-api-cloudwatch restart;
 service heat-api restart;")  and print "HEAT SERVICE restartED";
}

sub keystone()
{
	$restart = $ssh->capture2("
 service keystone restart") and print "KEYSTONE SERVICE restartED";
}

}

1;
