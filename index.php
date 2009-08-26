<?
$q='';
$d=$_SERVER['DOCUMENT_ROOT'].'/book/';
if(isset($_POST['name']))
{
	$dir=$d.$_POST['name'];
	$src=$dir.'/0.htm';
	if(!file_exists($dir))
	{
		if(isset($_FILES['bookfile']))
		{
			mkdir($dir);
			if(move_uploaded_file($_FILES['bookfile']['tmp_name'],$src))
			{
				$q.='<span class="ok">File uploaded.</span><br>';
				$q.='<span class="ok">Moving file to ['.$_POST['name'].'] directory.</span><br>';
				//$q.='<span class="ok">Starting split operation.</span><br>';
				$a=file_get_contents($src);
/*				while(substr(...))
				{
					
				}*/
				$q.='<span class="ok"><a href="/book/'.$_POST['name'].'/0.htm">Link to a <b>full</b> book version</a></span><br>';
			}
			else
			{
				$q.='<span class="error">File uploaded correctly!</span>';
				rmdir($dir);
			}
		}
		else
			$q.='<span class="error">File have not specified!</span>';
	}
	else
		$q.='<span class="error">Folder already exists!</span>';
}
?>
<html>
<head>
<title>Web Book Reader</title>
<style>
body,table{
	background-color:#dddddd;
	font-family: Tahoma, Verdana, Arial;
	font-size: 14px;
}
input{
	font-family: Courier New;
	font-size:12px;
}
.error{
	color:red;
}
.ok{
	color:green;
}
.comment{
	font-size:10px;
}
</style>
</head>
<body>
<?=$q?>

<br><br>

Upload book here!<br/>
<table border="0" style="border:2px solid #aaa"><tr><td>
<form action="" method="post" enctype="multipart/form-data">

book file:<br/>
<input name="bookfile" type="file"/><br/><br/>

page size:<br/>
<input name="pagesize" type="text" value="10240" size="6"/><br/><br/>

book name:<br>
<input name="name" type="text" value="<?=rand(1000,9999)?>"/><br/>
<span class="comment">Book name<br/> to access it by.</span>
<br/><br/>
<input type="submit" value="Расчленить"/>
</form>
</td></tr></table>
</body></html>
