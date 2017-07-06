#!/usr/bin/perl

use DBI;
use GD::Graph::bars;
use GD::Graph::Data;

require 'dbpath.pl';
require $realpath;
require 'split.pl';


$j=0;
(@a,@b);
$dbh=DBI->connect("DBI:mysql:$database;host=$hostname",$username,$password);


$stn=$dbh->prepare("SELECT service,uptime FROM glance");
  $stn->execute()||die("error");
 

while(@array=$stn->fetchrow_array())
{
($a[$j],$b[$j])=@array;
$b[$j] = &split($b[$j]);
$j++;
}
$data = GD::Graph::Data->new([                       
    ["$a[0]","$a[1]"],
   [$b[0],$b[1]],
]) or die GD::Graph::Data->error;
 
 
$graph = GD::Graph::bars->new;
 
$graph->set( 
    x_label         => 'Services',
    y_label         => 'uptime',
    y_tick_number   => 20,
    y_label_skip    => 3,
    x_labels_vertical => 1, 
    bar_spacing => 20,
    axislabelclr => 'black',
    fgclr => 'black',
    dclrs => ['green'],
    transparent     => 0,
    title           => 'Glance Services Uptime' 
   
) or die $graph->error;
 
$graph->plot($data) or die $graph->error; 
 
$file = './graphs/glance.png'; 
open($out, '>', $file) or die "Cannot open '$file' for write: $!";
binmode $out;
print $out $graph->gd->png;
close $out;

1;
