#!/usr/bin/perl
use Cwd;

#Getting the path of db.conf
$pwd = cwd();
@split = split("/",$pwd);
pop(@split);
push(@split,"db.conf");
$realpath = join("/",@split);
