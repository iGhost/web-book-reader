<?
$q='';
//$d='/home/localhost/www/book/';
//$d='/var/www/book/';
$d=$_SERVER['DOCUMENT_ROOT'].'/book/';
/*echo '<pre>';
print_r($_FILES);
echo '</pre>';*/
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
				$q.='<span class="ok">Файл загружен.</span><br>';
				$q.='<span class="ok">Размещаем файл в директорию ['.$_POST['name'].']</span><br>';
				//$q.='<span class="ok">Начинаем расчленение.</span><br>';
				$a=file_get_contents($src);
/*				while(substr(...))
				{
					
				}*/
				$q.='<span class="ok"><a href="/book/'.$_POST['name'].'/0.htm">Ссылка на <b>полную</b> книгу</a></span><br>';
			}
			else
			{
				$q.='<span class="error">Файл не загружен!</span>';
				rmdir($dir);
			}
		}
		else
			$q.='<span class="error">Файл не указан!</span>';
	}
	else
		$q.='<span class="error">Папка с таким именем уже имеется!</span>';
}


?>
<html>
<head>
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

Залей книгу тут!<br/>
<table border=0 style="border:2px solid #aaa"><tr><td>
<form action="" method="post" enctype="multipart/form-data">

файл:<br/>
<input name="bookfile" type="file"/><br/><br/>

размер страницы:<br/>
<input name="pagesize" type="text" value="10240" size="6"/><br/><br/>

название:<br>
<input name="name" type="text" value="<?=rand(1000,9999)?>"/><br/>
<span class="comment">Навание книги<br/> по которому к нему будет<br/> идти обращение.<br/> (латинскими буквами)</span>
<br/><br/>
<input type="submit" value="Расчленить"/>
</form>
</td></tr></table>
</body></html>