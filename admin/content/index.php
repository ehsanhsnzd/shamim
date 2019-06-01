<? include("../function/db.php");?>
<?
if(!isset($_SESSION['entry_admin'])){redirect("../auth/");}
?>
<? include("../inc/begin.php");?>

<h1>Photo Video Store Script: version 13.08</h1>

<?
$current_month=date("n");
$current_year=date("Y");
$month_step=6;

$sales_year_credits=array();
$sales_year_subscription=array();
$sales_month_credits=array();
$sales_month_subscription=array();

$sales_year_credits[$current_year]=0;
$sales_year_subscription[$current_year]=0;

for($i=$month_step;$i>=0;$i--)
{
	$j=$current_month-$i;
	if($j<=0)
	{
		$j=12+$current_month-$i;
	}
	$sales_month_credits[$j-1]=0;
	$sales_month_subscription[$j-1]=0;
}

if($global_settings["credits"]==1)
{
	//Credits
	$sql="select total,data from credits_list where total>0 and approved=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600);
	$rs->open($sql);
	while(!$rs->eof)
	{
		foreach ($sales_month_credits as $key => $value) 
		{
			if($key==date("n",$rs->row["data"]))
			{
				$sales_month_credits[$key]+=$rs->row["total"];
			}
		}
		if($current_year==date("Y",$rs->row["data"]))
		{
			$sales_year_credits[$current_year]+=$rs->row["total"];
		}
		$rs->movenext();
	}
}
else
{
	//Orders
	$sql="select total,data from orders where status=1 and data>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600);
	$rs->open($sql);
	while(!$rs->eof)
	{
		foreach ($sales_month_credits as $key => $value) 
		{
			if($key==date("n",$rs->row["data"]))
			{
				$sales_month_credits[$key]+=$rs->row["total"];
			}
		}
		if($current_year==date("Y",$rs->row["data"]))
		{
			$sales_year_credits[$current_year]+=$rs->row["total"];
		}
		$rs->movenext();
	}
}

if($global_settings["subscription"]==1)
{
	//Subscription
	$sql="select total,data1 from subscription_list where approved=1 and data1>".(mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"))-365*24*3600);
	$rs->open($sql);
	while(!$rs->eof)
	{
		foreach ($sales_month_subscription as $key => $value) 
		{
			if($key==date("n",$rs->row["data1"]))
			{
				$sales_month_subscription[$key]+=$rs->row["total"];
			}
		}
		if($current_year==date("Y",$rs->row["data1"]))
		{
			$sales_year_subscription[$current_year]+=$rs->row["total"];
		}
		$rs->movenext();
	}
}
?>


<script type="text/javascript" src="../plugins/visualize/js/excanvas.js"></script>
<script type="text/javascript" src="../plugins/visualize/js/visualize.jQuery.js"></script>
<script>
$(function(){
$('#chart').visualize({type: 'bar', height: '200px', width: '600px',colors:['#68a071','#3488b4']});
});
</script>
<link rel="stylesheet" type="text/css" href="../plugins/visualize/css/visualize.css" media="screen" />

<div style="margin:30px" class="graphic_home">
<table id="chart" style="display:none">
	<caption><?=word_lang("sales")?></caption>
	<thead>
		<tr>
			<td></td>
			<?
			foreach ($sales_month_credits as $key => $value) 
			{
				?>
				<th scope="col"><?=$m_month[$key]?></th>
				<?
			}
			?>
			<th scope="col"><?=$current_year?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">
			<?
			if($global_settings["credits"]==1)
			{
			 	echo(word_lang("credits"));
			}
			else
			{
				echo(word_lang("orders"));
			}
			?>
			</th>
			<?
			foreach ($sales_month_credits as $key => $value) 
			{
				?>
				<td><?=$value?></td>
				<?
			}
			?>
			<td><?=$sales_year_credits[$current_year]?></td>
		</tr>	
		<?
		if($global_settings["subscription"]==1)
		{
			?>
			<tr>
				<th scope="row"><?=word_lang("subscription")?></th>
				<?
				foreach ($sales_month_subscription as $key => $value) 
				{
					?>
					<td><?=$value?></td>
					<?
				}
				?>
				<td><?=$sales_year_subscription[$current_year]?></td>
			</tr>
			<?
		}
		?>
	</tbody>
</table>	
</div>








<script type="text/javascript" language="JavaScript" src="../../members/JsHttpRequest.js"></script>
<script type="text/javascript" language="JavaScript">
function doLoad(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('status'+value).innerHTML =req.responseText;

        }
    }
    req.open(null, '../orders/status.php', true);
    req.send( {'form': document.getElementById("f"+value) } );
}

function doLoad2(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('cstatus'+value).innerHTML =req.responseText;

        }
    }
    req.open(null, '../orders/credits_status.php', true);
    req.send( {'form': document.getElementById("cf"+value) } );
}

function doLoad3(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('sstatus'+value).innerHTML =req.responseText;

        }
    }
    req.open(null, '../orders/subscription_status.php', true);
    req.send( {'form': document.getElementById("sf"+value) } );
}



function doLoad4(value) {
    var req = new JsHttpRequest();
    // Code automatically called on load finishing.
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('shipping'+value).innerHTML =req.responseText;

        }
    }
    req.open(null, '../orders/shipping.php', true);
    req.send( {'id': value} );
}
</script>



    <div class="tabbable">
    	<ul class="nav nav-tabs" style="margin:20px 6px 10px 6px">
    		<li class="active"><a href="#tab1" data-toggle="tab"><?=word_lang("catalog")?></a></li>
    		<li><a href="#tab2" data-toggle="tab"><?=word_lang("customers")?></a></li>
    		<?if(isset($_SESSION["rights"]["orders_orders"])){?>
    			<li><a href="#tab3" data-toggle="tab"><?=word_lang("orders")?></a></li>
    			<li><a href="#tab4" data-toggle="tab"><?=word_lang("new orders")?></a></li>
    		<?}?>
    		<?if($site_credits==true and isset($_SESSION["rights"]["orders_credits"])){?>
    			<li><a href="#tab5" data-toggle="tab"><?=word_lang("credits")?></a></li>
    			<li><a href="#tab6" data-toggle="tab"><?=word_lang("new credits")?></a></li>
    		<?}?>
    		<?if($site_subscription==true and isset($_SESSION["rights"]["orders_subscription"])){?>
    			<li><a href="#tab7" data-toggle="tab"><?=word_lang("subscription")?></a></li>
    			<li><a href="#tab8" data-toggle="tab"><?=word_lang("new subscriptions")?></a></li>
    		<?}?>
   		</ul>
    	<div class="tab-content">
    		<div class="tab-pane active" id="tab1">
   			 	<?include("catalog.php");?>
    		</div>
    		<div class="tab-pane" id="tab2">
    			<?include("customers.php");?>
    		</div>
    		<?if(isset($_SESSION["rights"]["orders_orders"])){?>
    			<div class="tab-pane" id="tab3">
    				<?include("orders.php");?>
    			</div>
    			<div class="tab-pane" id="tab4">
    				<?include("orders_new.php");?>
    			</div>
    		<?}?>
    		<?if($site_credits==true and isset($_SESSION["rights"]["orders_credits"])){?>
    			<div class="tab-pane" id="tab5">
    				<?include("credits.php");?>
    		 	</div>
    		 	<div class="tab-pane" id="tab6">
    				<?include("credits_new.php");?>
    			</div>
    		<?}?>
    		<?if($site_subscription==true and isset($_SESSION["rights"]["orders_subscription"])){?>
    			<div class="tab-pane" id="tab7">
    				<?include("subscription.php");?>
    			</div>
    		 	<div class="tab-pane" id="tab8">
    				<?include("subscription_new.php");?>
    			</div>
    		<?}?>
    	</div>
    </div>





<? include("../inc/end.php");?>