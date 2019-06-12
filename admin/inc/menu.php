<??>
<?

?>


<script language="javascript">
function fmenu(pname)
{
	sbm=new Array(
	<?
	for($i=0;$i<count($menu_admin);$i++)
	{
		if($i!=0){echo(",");}
		echo("'".$menu_admin[$i]."'");
	}
	?>
	);

	for(i=0;i<sbm.length;i++)
	{
		document.getElementById("sub_"+sbm[i]).style.display ='none';
		document.getElementById("menu_"+sbm[i]).className ='';
		document.cookie = "z_" + sbm[i] + "=" + escape (0) + ";path=/";
	}

	document.getElementById("sub_"+pname).style.display ='inline';
	document.getElementById("menu_"+pname).className ='activ';
	document.cookie = "z_" + pname + "=" + escape (1) + ";path=/";
}


<?
function box_status()
{
	global $menu_admin;

    $res="orders";
	for($i=0;$i<count($menu_admin);$i++)
	{
		if(isset($_COOKIE["z_".$menu_admin[$i]]) and (int)$_COOKIE["z_".$menu_admin[$i]]==1)
		{
			$res=$menu_admin[$i];
		}
	}
	return $res;
}

?>

function fmenu_default()
{
document.getElementById("sub_<?=box_status()?>").style.display ='inline';
document.getElementById("menu_<?=box_status()?>").className ='activ';
}
</script>


<?
for($i=0;$i<count($menu_admin);$i++)
{
	?>
	<ul id="sub_<?=$menu_admin[$i]?>">
		<?
		$flag_first=" class='first'";
		foreach ($submenu_admin as $key => $value)
		{
			if(preg_match("/^".$menu_admin[$i]."_/",$key) and isset($_SESSION["rights"][$key]))
			{
				?>
				<li<?=$flag_first?>><a href="<?=$submenu_admin_url[$key]?>"><?=$submenu_admin[$key]?></a></li>
				<?
				$flag_first="";
			}
		}
		?>
	</ul>
	<?
}
?>
<script languages="javascript">
fmenu_default();
</script>
