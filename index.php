<?php // sett to the Folder, wich contains yout git repos

$verzeichnis_raw = '../';	// Folder wich contains your Repos
$refresh_interval = 300;		// Seconds to Refresh

?>
<!DOCTYPE html>
<html lang="de">
<head>

	<link href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABHNCSVQICAgIfAhk
iAAAAAlwSFlzAAAN1wAADdcBQiibeAAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3Nj
YXBlLm9yZ5vuPBoAAAFmSURBVGiB7ZkxbsIwFIY/00hcoiMXyGW4RJQbcAuLiUOx
dKzUnQ2mIGLcCVVAExw/O8aS/ymK5Oj7oth+z1HW2o6Ms0gNIE32ApVk8OZrU+1+
dqKXsP5cX3Wte9/xIoHT5cShOyjJM46Xo2R4/p9QEUidIpA6RSB1ikDqFIHUKQKp
UwRSpwikThFInaee+Hw9Y611GmysEQMYa+iM29GUUorlYnl/7/Fga/u9/Wj3bWVx
k5grCoWudd+smru39vQJNavG6Fr3CtFhQ9AMwcPAHHgniTF4GJnE7yDxCh5erEIp
JVzgwWEZTSHhCg+O+8CcElPgYcJGNofEVHiYuBPHlPCBB49SIoaELzx41kIhJSTw
ICjmQkhI4UFYjUokQsBDgHLaRyIUPATqB6ZIhISHgA2Ni0RoeAjckY1JxICHCC3l
fxKx4EH4m3UoN9B231ZANHiIJAB/Eo/XofPUE+eW7I9Vshf4BQJa06NotcSOAAAA
AElFTkSuQmCC" rel="icon" type="image/x-icon" />

	<meta http-equiv="Refresh" content="<?= $refresh_interval ?>">
  <meta charset=utf-8>
  <title>gitUp</title>
	<style>
		body {
			background: -moz-linear-gradient(top, #DDDDDD, #FFFFFF 90%) no-repeat;
	  	background: -webkit-gradient(linear, left top, left bottom, color-stop(0, #DDDDDD), color-stop(.90, #FFFFFF)) no-repeat;
		}
		#update_wrapper {
			margin:auto auto;
			width:90%;
			height: 90%;
			color: #000;
		}
		#update_wrapper h4 {
			width:100%;
			margin: 15px 14px;
			text-align:center;
		}
		#update_wrapper ul {
			list-style: none;
		}
		#update_content {
			background: #fff;
			border: 1px solid #000;
		}
		div.legend {
			padding: 5px 14px;
		}
		div.square {
			float: left;
			display: table;
			width: 16px;
			height: 16px;
			margin: 2px 5px 0 0;
		}
		div.circle {
			float: left;
			display: table;
			width: 16px;
			height: 16px;
			border-radius: 50%/50%;
			margin: 2px 5px 0 0;
		}
		div.hasup {
			background-color: #0a0;
		}
		div.noup {
			/* background-color: #a00; */
			background-color: #999;
		}
		.left {
			float: left;
		}
		.right {
			float:right;
		}
		.hasup,
		.green {
			color: #0a0;
		}
		.noup,
		.red {
			/* color: #a00; */
			color: #999;
		}
	</style>
</head>
<body>

<div id="update_wrapper">
	
	<h4>gitUp</h4>
	<div id="update_content">
	
		<ul>
<?php 

// http://stackoverflow.com/a/25109122/5208166
function checkForUpdate( $folder ) {
	return (bool) shell_exec( "[ $(git -C $folder rev-parse HEAD) = $(git -C $folder ls-remote $(git -C $folder rev-parse --abbrev-ref @{u} | \sed 's/\// /g') | cut -f1) ] && echo -n 0 || echo -n 1" );
} 

$verzeichnis_glob = glob($verzeichnis_raw . '*', GLOB_ONLYDIR );
$total = count($verzeichnis_glob);

foreach($verzeichnis_glob as $folder) {
	
	$lastCommit = shell_exec('git -C '.$folder.' log -1 --format="%cd"');
	$folderName = str_replace( $verzeichnis_raw, "", $folder);
//	$folderName = $folder;
	
	echo '<li><span>';
	
	if( checkForUpdate( $folder ) ) {
		// has updates
		echo '<span class="hasup">' . $lastCommit . ' | ' . $folderName . '</span>';
	} else {
		// has no updates
		echo '<span class="noup">' . $lastCommit . ' | ' . $folderName . '</span>';
	}
	
	echo '</li>';
	
}


?>

		</ul>
	</div>

	<div class="legend left green"><div class="circle hasup"></div>need to pull</div>
	<div class="legend left red"><div class="circle noup"></div>nothing changed</div>
	<div class="legend right"><?= implode( "/", array_slice( explode( '/', shell_exec('pwd') ), -3, 2 ) ) ?> | <?= $total ?></div>

</div>
</body>
</html>

