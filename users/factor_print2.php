


<table id="financial-invoices-table" width="100%">
<tr>
<th>خریدار</th>
<th class="th-darker">نام : <?=$invoice_name." ".$invoice_family?></th>
<th> تاریخ :<?=$invoice_date?> </th>
<th class="th-darker">تلفن : <?=$invoice_tell?></th>
<th> فاکتور :  <?=$invoiceID?></th>
 
</tr>
<tr>
<td  colspan="16" valign="top">
<table width="100%" height="1000"><tr>
<td align="right" valign="top">سفارشات :</td>
<td width="90%" align="right" valign="top"><?
$b=1;
$order_of_offset=  "SELECT * FROM orders2 where factor=$invoiceID " ;
	
	
	if(!empty($invoiceID)){
			$sql_orders_of_offset= mysqli_query($connection, $order_of_offset);
						while($sql_offset = mysqli_fetch_array($sql_orders_of_offset)){
					$sql_offset_total_price = number_format($sql_offset['order_total_price']);
					$sql_offset_unit_price = number_format($sql_offset['order_unit_price']);
					$sql_order_type = $sql_offset['order_type'];
					$sql_order_total_price = $sql_offset['order_total_price'];
					$sql_order_submit_date = $sql_offset['order_submit_date'];
					$sql_order_submit_date = $sql_offset['order_submit_date'];						 					$sql_od_lot_quantity = $sql_offset['order_lot_quantity'];
					$sql_od_quantity = $sql_offset['order_quantity'];
					$sql_order_print_permission = $sql_offset['order_print_permission'];
					$sql_order_delivery_permission = $sql_offset['order_delivery_permission'];
					
					$permission = $sql_offset['order_delivery_permission'];
					$sql_order_last_status = $sql_offset['order_last_status'];
					
					
						if ($sql_order_last_status == '0') {
						$sql_order_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_order_last_status == '1') {
						$sql_order_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_order_last_status == '2') {
						$sql_order_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_order_last_status == '3') {
						$sql_order_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_order_last_status == '4') {
						$sql_order_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_order_last_status == '5') {
						$sql_order_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
						elseif ($sql_order_last_status == '6') {
						$sql_order_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}
					elseif ($sql_order_last_status == '7') {
						$sql_order_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					elseif ($sql_order_last_status == '8') {
						$sql_order_ls = 'تحویل مشتری';
						$od_ls_7 = 'selected';
					}
					
					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}
				 echo "<table style='display:inline'>";
					echo "<td>$b</td>";
				 $b+=1;
				 		if (!empty($sql_od_quantity)){$quantiti_text="- تیراژ: $sql_od_quantity";}
					 echo "<td $read_m>$sql_order_type $quantiti_text</td>";
					echo "</table>";
					
			 $quantiti_text="";
						 
		 
						}}
						
											
	if(!empty($invoiceID)){
					
					$sql_orders_of_banner= mysqli_query($connection, "SELECT * FROM orders1 where   order_make_number_perforating =$invoiceID");
					while($sql_banner = mysqli_fetch_array($sql_orders_of_banner)){
						
							$sql_banner_total_price = number_format($sql_banner['order_total_price']);
								$sql_banner_unit_price =number_format($sql_banner['order_unit_price']);
						$sql_order_submit_date = $sql_banner['order_submit_date'];						 								 						$sql_od_lot_quantity = $sql_banner['order_lot_quantity'];
					
					
						$sql_order_size = "بنر ".$sql_banner['order_width']."X".$sql_banner['order_height'];
							$sql_order_last_status = $sql_banner['order_last_status'];
						
						if ($sql_order_last_status == '0') {
						$sql_order_ls = 'در انتظار پرداخت فاکتور';
						$od_ls_0 = 'selected';
					}
					elseif ($sql_order_last_status == '1') {
						$sql_order_ls = 'در انتظار بررسی';
						$od_ls_1 = 'selected';
					}
					elseif ($sql_order_last_status == '2') {
						$sql_order_ls = 'پروسه چاپ';
						$od_ls_2 = 'selected';
					}
					elseif ($sql_order_last_status == '3') {
						$sql_order_ls = 'آماده تحویل';
						$od_ls_3 = 'selected';
					}
					elseif ($sql_order_last_status == '4') {
						$sql_order_ls = 'تحویل داده شده';
						$od_ls_4 = 'selected';
					}
					elseif ($sql_order_last_status == '5') {
						$sql_order_ls = 'تعلیق کار';
						$od_ls_5 = 'selected';
					}
						elseif ($sql_order_last_status == '6') {
						$sql_order_ls = 'کنسل شد';
						$od_ls_6 = 'selected';
					}
					elseif ($sql_order_last_status == '7') {
						$sql_order_ls = 'تحویل شرکت';
						$od_ls_7 = 'selected';
					}
					elseif ($sql_order_last_status == '8') {
						$sql_order_ls = 'تحویل مشتری';
						$od_ls_7 = 'selected';
					}
					
					else{
						$sql_od_ls = 'وضعیت تعلیق';
					}
						
					 
						echo "<table style='display:inline'>";
			 
					echo "<td>$b</td>";
					$b+=1;
					
					
					echo "<td  $read_m>$sql_order_size";
							 
				
				if (!empty($sql_od_make_format) || $sql_od_make_format_beat!='undefined' || !empty($sql_od_make_line)){ 
					echo"<br>
 خدمات اضافه: ";
				}
							if (!empty($sql_od_make_format)){ echo "<span class=\"order-detail-bg\">$sql_od_make_format   </span>".$sql_od_make_header_glue. ' عدد';} 	
							
							echo "<br>";
							 if ($sql_od_make_format_beat!='undefined'){echo $sql_od_make_format_beat; }
						echo "<br>
						
						$sql_od_make_line
						
						 تعداد : $sql_od_lot_quantity
					</td></tr>";
				
					
					 		
					 
					}} 
					
					echo "</table>";
					?></td></tr>
                    <tr>
                    <td  height="800" colspan="3"></td>
 
</tr>
</table>