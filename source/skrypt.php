<?php
$web = file_get_contents('http://pl.wikipedia.org/wiki/Miasta_w_Polsce');
$web = mb_convert_encoding($web,'HTML-ENTITIES','UTF-8');
$dom = new domDocument;
$dom->preserveWhiteSpace = false;
@$dom->loadHTML($web);
$nodes = $dom->getElementsByTagName('a');
for ($i = 0; $i < $nodes->length;$i++)
{
	print $nodes->item($i)->nodeValue;
	print "\r\n";
}
?>
