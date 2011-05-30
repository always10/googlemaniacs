  <?php
    require('GoogleMapAPI.class.php');
		
		if(isset($_POST['wybor'])){
			$wybor=$_POST['wybor'];
		}
		else
		{
			$wybor='Dolnoslaskie';
		}
		
		 $c = curl_init();
		 curl_setopt($c, CURLOPT_URL, 	'http://sigma.ug.edu.pl:14111/googlemaps/_design/Wojew/_view/'.$wybor);
		 curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		$page = curl_exec($c);
		curl_close($c);
		$page=json_decode($page);
		//var_dump($zap);
		$miasto[]='';
		foreach($page->rows as $klucz=>$wartosc)
		{
			$miasto[$klucz]=array("name"=>trim(substr($wartosc->key,0,-8)),"x"=>$wartosc->value[0],"y"=>$wartosc->value[1]);
		}
		
    $map = new GoogleMapAPI('map');

    $map->setAPIKey('ABQIAAAALQCTi7IHOGYUMlu0AopnjxSSs7dBRhheGZFHLRRTFpIecnW09BTs4VOC1kU_nR1tr_PCrtd1J5FzaQ');
    
     $map->setWidth('100%');
      $map->setHeight('100%');
     
      foreach($miasto as $klucz=>$wartosc)
      {	
		
				$map->addMarkerByCoords($wartosc["x"],$wartosc["y"],'<span class="jeden">'.$wartosc["name"].'</span>','Nazwa: '.$wartosc["name"].'<br />Województwo: '.$wybor,'Kliknij');
				
				
      }
  
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
					
							<form action="index.php" method="post"  name="form">
							<table align="center">
							<tr><th><span class="text">Województwa</span></th></tr>
							
							
								<tr><td><select onchange="javascript:document.form.submit();" name="wybor" >
						<?php
									
					$select=array(	"Wszystkie"=>'Wszystkie',
									"Dolnoslaskie"=>'Dolnoslaskie',
									"Kujawsko-Pomorskie"=>'Kujawsko-Pomorskie',
									"Lodzkie"=>'Łódzkie',
									"Dolnoslaskie"=>'Dolnośląskie',
									"Lubelskie"=>'Lubelskie',
									"Lubuskie"=>'Lubuskie',
									"Malopolskie"=>'Małopolskie',
									"Mazowieckie"=>'Mazowieckie',
									"Opolskie"=>'Opolskie',
									"Podkarpackie"=>'Podkarpackie',
									"Podlaskie"=>'Podlaskie',
									"Pomorskie"=>'Pomorskie',
									"Slaskie"=>'Śląskie',
									"Lubelskie"=>'Lubelskie',
									"Swietokrzyskie"=>'Świętokrzyskie',
									"Lubelskie"=>'Lubelskie',
									"Warminsko-Mazurskie"=>'Warmińsko-Mazurskie',
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
									<a href="index1.php">Odleglosci</a>
					</div>
						<div id="sidebar">
						<table>
						<tr><th><span class="text">Miejscowości</span></th><tr>
						<tr><th><span class="text"><?php echo $wybor;?></span></th><tr>
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
    
