  <?php
    require('GoogleMapAPI.class.php');
		
		if(isset($_POST['wybor'])){
			$wybor=$_POST['wybor'];
		}
		else
		{
			$wybor='Dolnoslaskie';
		}
		////
		 $c = curl_init();
		 curl_setopt($c, CURLOPT_URL, 	'http://153.19.5.12:14222/googlemaps/_design/odleglosc/_view/'.$wybor.'2');
		 curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		$page = curl_exec($c);
		curl_close($c);
		$page=json_decode($page);
		$naj=$page->rows[0]->value;
	    /////////
	    $c1 = curl_init();
		curl_setopt($c1, CURLOPT_URL, 	'http://153.19.5.12:14222/googlemaps/_design/odleglosc/_view/'.$wybor);
		curl_setopt($c1, CURLOPT_RETURNTRANSFER, 1);
		$page1 = curl_exec($c1);
		curl_close($c1);
		$page1=json_decode($page1);
		/////
		 $c2 = curl_init();
		 curl_setopt($c2, CURLOPT_URL, 	'http://153.19.5.12:14222/googlemaps/_design/Wojew/_view/'.$wybor);
		 curl_setopt($c2, CURLOPT_RETURNTRANSFER, 1);
		$page2 = curl_exec($c2);
		curl_close($c2);
		$page2=json_decode($page2);
	    
	    
		foreach($page1->rows as $klucz=>$wartosc)
		{
			if($wartosc->value == $naj)
			{
				$zap =$wartosc;
			}
		}
	    
	    
	    $miasto[]='';
		foreach($page2->rows as $klucz=>$wartosc)
		{	if(($wartosc->value[0] == $zap->key[0]) && ($wartosc->value[1] == $zap->key[1]))
				{
				$miasto[0]=array("name"=>trim(substr($wartosc->key,0,-8)),"x"=>$wartosc->value[0],"y"=>$wartosc->value[1]);
				}
			if(($wartosc->value[0] == $zap->key[2]) && ($wartosc->value[1] == $zap->key[3]))
				{
				$miasto[1]=array("name"=>trim(substr($wartosc->key,0,-8)),"x"=>$wartosc->value[0],"y"=>$wartosc->value[1]);
				}
				  
		
		}
	   
	  
	
		
    $map = new GoogleMapAPI('map');

    $map->setAPIKey('ABQIAAAALQCTi7IHOGYUMlu0AopnjxSSs7dBRhheGZFHLRRTFpIecnW09BTs4VOC1kU_nR1tr_PCrtd1J5FzaQ');
    
     $map->setWidth('100%');
      $map->setHeight('100%');
      
		
		$map->addMarkerByCoords($zap->key[0],$zap->key[1],'<span class="jeden">'.$miasto[0]["name"].'</span>','Nazwa: '.$miasto[0]["name"].'<br />Województwo: '.$wybor,'Kliknij');
		$map->addMarkerByCoords($zap->key[2],$zap->key[3],'<span class="jeden">'.$miasto[1]["name"].'</span>','Nazwa: '.$miasto[1]["name"].'<br />Województwo: '.$wybor,'Kliknij');
		$map->addPolyLineByCoords($zap->key[0],$zap->key[1],$zap->key[2],$zap->key[3],'red',5,120);
  
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
    <?php $map->printHeaderJS(); ?>
    <?php $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>
    </head>
    <body onload="onLoad()">
    <div id="glowna">
		<div id="wybor">
					<div id="box">
					
							<form action="index1.php" method="post"  name="form">
							<table align="center">
							<tr><th><span class="text">Województwa</span></th></tr>
							
							
								<tr><td><select onchange="javascript:document.form.submit();" name="wybor" >
						<?php
									
					$select=array(	
									"Dolnoslaskie"=>'Dolnoslaskie',
									"Kujawsko-Pomorskie"=>'Kujawsko-Pomorskie',
									"Lodzkie"=>'£ódzkie',
									"Dolnoslaskie"=>'Dolno¶l±skie',
									"Lubelskie"=>'Lubelskie',
									"Lubuskie"=>'Lubuskie',
									"Malopolskie"=>'Ma³opolskie',
									"Mazowieckie"=>'Mazowieckie',
									"Opolskie"=>'Opolskie',
									"Podkarpackie"=>'Podkarpackie',
									"Podlaskie"=>'Podlaskie',
									"Pomorskie"=>'Pomorskie',
									"Slaskie"=>'¦l±skie',
									"Lubelskie"=>'Lubelskie',
									"Swietokrzyskie"=>'¦wiêtokrzyskie',
									"Lubelskie"=>'Lubelskie',
									"Warminsko-Mazurskie"=>'Warmiñsko-Mazurskie',
									"Wielkopolskie"=>'Wielkopolskie',
									"Zachodniopomorskie"=>'Zachodnio-pomorskie');
						foreach($select as $key=>$nazwa)
						{	
							echo '<option value="'.$key.'"'.($wybor==$key ? ' selected="selected"': '').'>'.$nazwa.'</option>';
						
						}
						?>
									</select></td></tr>
									</table>
									</form>
									<a href="index.php">Miejscowo¶ci</a>
					</div>
						<div id="sidebar">
						<table>
						<tr><th><span class="text">Miejscowo¶ci</span></th><tr>
						<tr><th><span class="text"><?php echo $wybor;?></span></th><tr>
						<tr><td>
						Odleg³o¶æ: <?php echo round($zap->value,2);?> km
						</td></tr>
						<tr><td>
						<?php $map->printSidebar(); ?>
						</td></tr>
						</table>
						</div>
		</div>
		<div id="mapa">
		<?php $map->printMap(); ?>
	</div>
	</div>	
    </body>
    </html>
    
