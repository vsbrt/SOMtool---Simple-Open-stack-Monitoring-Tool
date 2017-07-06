#/usr/bin/perl
use DBI;
use Cwd;

require "dbpath.pl";
require "$realpath";
require "sshcon.pl";
require "createtablei.pl";
require "status.pl";
require "restart.pl";

createtablei();
sshcon();

while(1)
{
	print "Running...\n";
	status();
	restart();

	sleep(5);
}
