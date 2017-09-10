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
<html>

<head>
    <title>MemeScream</title>

    <script type="text/javascript" src="./bower_components/mqttws/mqttws31.js"></script>
    <script type="text/javascript" src="./bower_components/moment/moment.js"></script>
    <script type="text/javascript" src="./bower_components/crypto-js/crypto-js.js"></script>
    <script type="text/javascript" src="./bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./bower_components/jquery-color/jquery.color.js"></script>
    <script type="text/javascript" src="./bower_components/aws-sdk/dist/aws-sdk.min.js"></script>

    <script type="text/javascript" src="./js/aws_config.js"></script>

    <script type="text/javascript" src="./js/aws_sigv4.js"></script>
    <script type="text/javascript" src="./js/aws_iot.js"></script>

    <script type="text/javascript" src="./js/connectAsThing.js"></script>
    <script type="text/javascript" src="./js/updateDom.js"></script>

    <style>
        .panelclass {
            margin: auto;
            width: 400px;
            height: 200px;
            font-family: "Courier New";
            font-size: 12pt;
            background-color: whitesmoke;
        }
        .tableclass {
            margin: auto;
            text-align: center;
        }
        .aboutclass {
            margin: auto;
            text-align: center;
            font-family: "Arial";
            font-size: 10pt;
            color: dimgray;
        }
        .table1 {
            border: 1px gray;
            table-layout: fixed;
        }
        .tdlabel {
            background-color: white;
            color: grey;
            font-family: "Arial";
            font-size: small;
            padding: 5px;
            border-top: 2px solid white;
        }
        .tdvalue {
            background-color: gainsboro;
            font-family: "Courier New";
            padding: 5px;
            border-top: 2px solid white;
        }
        .tdvaluesmall {
            background-color: gainsboro;
            color: black;
            word-wrap: break-word;
            font-size: 9pt;
            font-family: "Courier New";
            padding: 5px;
            border-top: 2px solid white;
        }
        .connected {
            color: green;
            font-weight: bold;
        }
        .disconnected {
            color: red;
            font-weight: bold;
        }
    </style>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="customFiles/css/bootstrap-social.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />

    <!--custom libraries -->
    <script src="customFiles/js/custom_shivansh.js"></script>
    <link rel="stylesheet" href="customFiles/css/custom_shivansh.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="customFiles/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="customFiles/css/custom_routine.css">

    <style>
        body {
            font-family: 'Oswald', sans-serif;
            background-color: #000
        }
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            color: black;
        }
    </style>

    <style>
        .img-class {
            position: absolute;
            left: 0;
            top: 0;
        }
        .top-caption {
            position: absolute;
            left: 20px;
            top: 0px;
            font-family: sans-serif;
            color: white;
            width: 100vw;
            text-align: left;
        }
        .bottom-caption {
            position: absolute;
            left: 20px;
            bottom: 0px;
            font-family: sans-serif;
            color: white;
            width: 100vw;
            text-align: left;
        }
    </style>
</head>

<body onLoad="console.log('body loaded');">

    <!-- Page Content -->

    <div class="container">

        <center>
            <img style="align:center;" src="customFiles/img/icon.png" width="800">
            <input type="text" name="searchtext" id="searchtext" placeholder="search random meme">
            <br>
            <button type="submit" class="btn btn-primary" name="action" value="submit" onclick="search();">Search</button>
        </center>

        <div class="row">
            <hr></hr>

            <div>
                <div class="col-md-6">
                    <img src="<?=$image?>" id="imgmeme" width="100%">
                    <h1 class="top-caption" id="toph1"></h1>
                    <h1 class="bottom-caption" id="bottomh1"></h1>
                </div>

                <div class="col-md-4" style="color: white">
                    <h3 style="align-items: center;color: white">MEME:</h3> This image is distributed by GIPHY!

                    <form action="" method="post">
                        <input type="text" name="imagetext" id="imagetext" placeholder="gif url">
                        <br>
                        <input type="text" name="toptext" id="toptext" placeholder="top text">
                        <br>
                        <input type="text" name="bottomtext" id="bottomtext" placeholder="bottom text">
                        <br>
                        <button type="submit" class="btn btn-primary" name="action" value="submit">Download</button>
                        <button type="submit" class="btn btn-primary" name="share" value="twitter">Share in Twitter</button>
                        <button type="submit" class="btn btn-primary" name="share" value="facebook">Share in Facebook</button>
                    </form>
                </div>
            </div>
        </div>

        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <br></br>
        <hr>

    </div>

    <div class="panelclass" id="panel">
        Welcome!
    </div>
    <div class="panelimgclass" id="panelimg">
        <img src="" />
    </div>

    <br />
    <div class="tableclass" id="table">

        <table class="table1">
            <tr>
                <td class="tdlabel">Status</td>
                <td class="tdvalue"><span id="MQTTstatus">STOPPED</span>
                </td>
            </tr>
            <tr>
                <td class="tdlabel">Identity Pool ID</td>
                <td class="tdvaluesmall"><span id="IdentityPoolId"></span>
                </td>
            </tr>
        </table>

        <table class="table1">
            <tr>
                <td class="tdlabel">Subscribe Topic</td>
                <td class="tdvaluesmall"><span id="SubscribeTopic"></span>
                </td>
            </tr>
            <tr>
                <td class="tdlabel">MQTT Endpoint</td>
                <td class="tdvaluesmall"><span id="mqttEndpoint"></span>
                </td>
            </tr>
        </table>
        <br />
        <hr />
        <input type="button" name="reloader" value="RELOAD PAGE" onClick="reloader()">

    </div>

    </div>
    <!-- /.container -->

</body>

</html>