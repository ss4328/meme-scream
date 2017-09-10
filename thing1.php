<?
if ($_POST['action'] == "submit")
{
	$new = time().rand(100,999);
	exec('ffmpeg -i "'.$_POST['imagetext'].'" -vf drawtext="fontfile=/usr/share/fonts/default/Type1/n019003l.pfb:text="'.$_POST["toptext"].'": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:boxborderw=5: x=(w-text_w)/2: y=2" /home/greenlie/giphy.greenlie.org/images/'.$new.'.gif', $output);
	$new2 = time().rand(100,999);
	exec('ffmpeg -i /home/greenlie/giphy.greenlie.org/images/'.$new.'.gif -vf drawtext="fontfile=/usr/share/fonts/default/Type1/n019003l.pfb:text="'.$_POST["bottomtext"].'": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:boxborderw=5: x=(w-text_w)/2: y=(h-text_h)-2" /home/greenlie/giphy.greenlie.org/images/'.$new2.'.gif', $output);
	unlink('/home/greenlie/giphy.greenlie.org/images/'.$new.'.gif');
		
	header('location: http://www.memescream.net/download.php?file='.$new2);
}
if ($_POST['share'] == "twitter")
{
	$new = time().rand(100,999);
	exec('ffmpeg -i "'.$_POST['imagetext'].'" -vf drawtext="fontfile=/usr/share/fonts/default/Type1/n019003l.pfb:text="'.$_POST["toptext"].'": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:boxborderw=5: x=(w-text_w)/2: y=2" /home/greenlie/giphy.greenlie.org/images/'.$new.'.gif', $output);
	$new2 = time().rand(100,999);
	exec('ffmpeg -i /home/greenlie/giphy.greenlie.org/images/'.$new.'.gif -vf drawtext="fontfile=/usr/share/fonts/default/Type1/n019003l.pfb:text="'.$_POST["bottomtext"].'": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:boxborderw=5: x=(w-text_w)/2: y=(h-text_h)-2" /home/greenlie/giphy.greenlie.org/images/'.$new2.'.gif', $output);
	unlink('/home/greenlie/giphy.greenlie.org/images/'.$new.'.gif');
	
	$file = 'http://www.memescream.net/images/'.$new2.'.gif';
	
	header('location: http://twitter.com/share?text=MemeScream&url='.$file);
}
if ($_POST['share'] == "facebook")
{
	$new = time().rand(100,999);
	exec('ffmpeg -i "'.$_POST['imagetext'].'" -vf drawtext="fontfile=/usr/share/fonts/default/Type1/n019003l.pfb:text="'.$_POST["toptext"].'": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:boxborderw=5: x=(w-text_w)/2: y=2" /home/greenlie/giphy.greenlie.org/images/'.$new.'.gif', $output);
	$new2 = time().rand(100,999);
	exec('ffmpeg -i /home/greenlie/giphy.greenlie.org/images/'.$new.'.gif -vf drawtext="fontfile=/usr/share/fonts/default/Type1/n019003l.pfb:text="'.$_POST["bottomtext"].'": fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:boxborderw=5: x=(w-text_w)/2: y=(h-text_h)-2" /home/greenlie/giphy.greenlie.org/images/'.$new2.'.gif', $output);
	unlink('/home/greenlie/giphy.greenlie.org/images/'.$new.'.gif');
	
	$file = 'http://www.memescream.net/images/'.$new2.'.gif';
	
	header('location: https://www.facebook.com/sharer/sharer.php?u='.$file);
}
?>
<?php
$url = file_get_contents('http://api.giphy.com/v1/gifs/random?tag="spiderman"&api_key=0db4fdd98a4a49ccb3842eb47cb0d04a&limit=1');
$json = json_decode($url, true);
$gifid = $json['data']['id'];
$image = 'http://i.giphy.com/media/'.$gifid.'/giphy.gif';
?>