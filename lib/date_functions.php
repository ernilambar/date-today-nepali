<?php

	function convertToNepali($date)
	{
		$date['year']=getNepaliNumber($date['year']);
		$date['month_name']=getMahina($date['month']);
		$date['month']=getNepaliNumber($date['month']);
		$date['day']=getBaar($date['num_day']);
		$date['date']=getNepaliNumber($date['date']);				
		return $date;
	}
	//////////////
	function getNepaliNumber($num)
	{
		$str=array();
		$numarr=str_split($num);
		if(count($numarr)==1) array_unshift($numarr,'0');
		$number=array('०','१','२','३','४','५','६','७','८','९');			
		for($i=0;$i<count($numarr);$i++)
		{
			$str[$i]=$number[$numarr[$i]];
		}
		return  implode('',$str);
	}
	////////////////
	function getMahina($num)
	{
		$bar=array('बैशाख','जेठ','असार','साउन','भदौ','असोज','कार्तिक','मङि्सर','पुष','माघ','फागुन','चैत');			
		$ret=$bar[$num-1];
		return  $ret;
	}
	//////////////
	function getBaar($num)
	{
		$bar=array('आइतबार','सोमबार','मङ्गलबार','बुधबार','बिहिबार','शुक्रबार','शनिबार');			
		$ret=$bar[$num-1];
		return  ($ret);
	}
	///////////////////////
	function array_trim_nil($a) 
	{
		$j = 0;
		for ($i = 0; $i < count($a); $i++) {
			if (strlen($a[$i]) > 2 ) {
				$b[$j++] = $a[$i];
			}
		}
		return $b;
	}
	//
?>