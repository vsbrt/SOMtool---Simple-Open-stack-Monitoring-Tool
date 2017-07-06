#!/usr/bin/perl
use Net::OpenSSH;

sub sshcon()
{
	$key_path = "$HOME/.ssh/open";
	
	$ssh = Net::OpenSSH->new($host, master_opts => [-o => "StrictHostKeyChecking=no"], key_path => $key_path, passphrase => $passphrase);
	$ssh->error and
		die "Couldn't establish SSH connection: ". $ssh->error;
}

1;
