<?include("../admin/function/db.php");?>
<?include("JsHttpRequest.php");?>
<?
$JsHttpRequest =new JsHttpRequest($mtg);

$search=result($_REQUEST["search"]);

if($search!="")
{
	$mass_types=array();
	if($site_photo){$mass_types["photo"]=1;}
	if($site_video){$mass_types["video"]=1;}
	if($site_audio){$mass_types["audio"]=1;}
	if($site_vector){$mass_types["vector"]=1;}
	
	$sch=explode(" ",trim(result($search)));
	
	$com2="";
	if(count($sch)>0)
	{
		$com2.="(";
		for($i=0;$i<count($sch);$i++)
		{
			if($i!=0){$com2.=" and ";}
			$com2.=" (b.title rlike '[[:<:]]".$sch[$i]."[[:>:]]' or b.description rlike '[[:<:]]".$sch[$i]."[[:>:]]' or b.keywords rlike '[[:<:]]".$sch[$i]."[[:>:]]') ";
			
			//$com2.=" (UCASE(b.title) rlike UCASE('[[:<:]]".$sch[$i]."[[:>:]]') or UCASE(b.description) rlike UCASE('[[:<:]]".$sch[$i]."[[:>:]]') or UCASE(b.keywords) rlike UCASE('[[:<:]]".$sch[$i]."[[:>:]]')) ";
		}
		$com2.=")";
	}
	
	$sql_mass=array();

	$sql_password_protected=get_password_protected();

	$sql_mass["photo"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle from structure a,photos b where b.published=1 and a.id=b.id_parent  and ".$com2.$sql_password_protected;

	$sql_mass["video"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle from structure a,videos b where b.published=1 and a.id=b.id_parent and ".$com2.$sql_password_protected;

	$sql_mass["audio"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle from structure a,audio b where b.published=1 and a.id=b.id_parent and ".$com2.$sql_password_protected;

	$sql_mass["vector"]="select a.id,a.id_parent as idp,a.module_table,b.id_parent,b.title as atitle from structure a,vector b where b.published=1 and a.id=b.id_parent  and ".$com2.$sql_password_protected;
	
	$xx=0;
	$sql="";
	foreach ($mass_types as $key => $value)
	{
		if($value==1)
		{
			if($xx!=0){$sql.=" union ";}
			$sql.="(".$sql_mass[$key].")";
			$xx++;
		}
	}
	
	$sql.=" order by atitle limit 0,8";
	
	$rs->open($sql);
	while(!$rs->eof)
	{
		echo("<div class='instant_search_result' onClick=\"search_go('".$rs->row["atitle"]."')\">");
		
		$title="";

		$titles = array();
		preg_match_all("|(.*)(".$search.")(.*)|Uis",$rs->row["atitle"], $titles);
		if(isset($titles[1][0]))
		{
			$title=$titles[1][0];
		}
		if(isset($titles[2][0]))
		{
			$title="<span>".$titles[2][0]."</span>";
		}
		if(isset($titles[3][0]))
		{
			$title=$titles[3][0];
		}
		
		if($title=="")
		{
			$title=$rs->row["atitle"];
		}
		echo($title);

		echo("</div>");
		$rs->movenext();
	}
}
?>