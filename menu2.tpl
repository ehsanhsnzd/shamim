<center>
<a href="?service=<?=$_GET['service']?>&quantity=1th&type=big" <? if ($_GET['type']=='big'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?> ><br>
بزرگ<br />
3X1</a> 
<a href="?service=<?=$_GET['service']?>&quantity=1th&type=normal" <? if ($_GET['type']=='normal'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?> ><br>
متوسط<br />3X0.80
</a>
<a href="?service=<?=$_GET['service']?>&quantity=1th&type=small" <? if ($_GET['type']=='small'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?>><br>
کوچک<br />
2X1</a>

<a href="?service=<?=$_GET['service']?>&quantity=1th&type=stand" <? if ($_GET['type']=='stand'){echo "id='type-order-print-active'"; }else{ echo "id='type-order-print'";}?>><br>
استند<br />
2X0.90</a>
</center>
 