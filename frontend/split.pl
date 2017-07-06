#!usr/bin/perl

sub split()
{
	@sptim = split('-',@_[0]);
	$splitlen = @sptim;

	if($splitlen == 1)
	{
		@sptim2 = split(':',$sptim[0]);
		$sptim2_len = @sptim2;
		
		if($sptim2_len == 3)
		{
			$hours = "$sptim2[0]\n";
			$minutes = "$sptim2[1]\n";
			$total = $hours + ($minutes / 60);
			return $total;
		}
		
		elsif($sptim2_len == 2)
		{
			$minutes = "$sptim2[0]\n";
			$total = ($minutes / 60);
			return $total;
		}
		
		else
		{
			return 0;
		}

	}

	if($splitlen == 2)
	{
		@sptim2 = split(':',$sptim[1]);
		$days = "$sptim[0]\n";
		$hours = "$sptim2[0]\n";
		$minutes = "$sptim2[1]\n";
		$total = (24 * $days) + $hours + ($minutes / 60);
		return $total;
	}
}

1;
