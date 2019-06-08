<?php require ("header.php");?>
<?php include ("sidebar.php");?>

	<section id="user-panel-sheet">

<?php

require ('../config.php');
$connection = mysqli_connect($server_name, $db_username, $db_password);
if(!$connection){
    die("<span class=\"login-alert\">مشکلی در اتصال به پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
}
mysqli_select_db($connection, $db_name) or die("<span class=\"login-alert\">مشکلی در انتخاب پایگاه داده پیش آمد لطفا چند لحظه دیگر دوباره بررسی کنید و در صورت مشکل با مدیر سیستم در میان بگذارید.</span>");
mysqli_query($connection, "SET NAMES 'utf8'");
mysqli_query($connection, "SET CHARACTER SET 'utf8'");
mysqli_query($connection, "SET character_set_connection = 'utf8'");

$username_value = $_SESSION['print_username'];


if (isset($_POST['submit'])) {
	if(isset($_POST['order-number-input']) && $_POST['order-number-input'] != ''
	&& isset($_POST['order-reciver-name-input']) && $_POST['order-reciver-name-input'] != ''
	&& isset($_POST['order-recive-adress-input']) && $_POST['order-recive-adress-input'] != ''){

		$username_value = $_SESSION['print_username'];

		$delivery_username = $username_value;
		$delivery_orders_number = implode(', ', $_POST['order-number-input']);
		$delivery_adress = $_POST['order-recive-adress-input'];
		$delivery_receiver_name = $_POST['order-reciver-name-input'];

		$delivery_request_date =  jdate('Y-n-j H:i:s');
		$delivery_status = '0';





		$sql_order = "INSERT INTO delivery (username, orders_number, delivery_adress, receiver_name, request_date, status) VALUES ('$delivery_username', '$delivery_orders_number', '$delivery_adress', '$delivery_receiver_name', '$delivery_request_date', '$delivery_status')";

		mysqli_query($connection, "SET NAMES 'utf8'");
		mysqli_query($connection, "SET CHARACTER SET 'utf8'");
		mysqli_query($connection, "SET character_set_connection = 'utf8'");

		if ($connection->query($sql_order) === TRUE) {
			echo "درخواست ارسال مرسوله با موفقیت ثبت شد.";
		}
		else{
			echo "مشکلی در ثبت درخواست شما به وجود آمد. لطفا مجددا اقدام نمایید و در صورت تکرار مشکل از طریق تلفن مشکل را با ما در میان بگذارید. با تشکر.";
		}
	}
	else {
		echo "
		<span class=\"login-alert\" style='margin-top: 15px'>
		به دلیل ناقص پر شدن فیلد ها پروسه ثبت درخواست با مشکل مواجه شد. حداقل باید روی یکی از سفارشات بزنید تا انتخاب شود. با تشکر.
		</span><br/><br/><br/><br/><br/>";
	}
}


?>

	<h2 class="user-panel-sheet-h2">درخواست ارسال مرسوله سفارش های آماده تحویل</h2>
		<p class="delivery-page-p">توجه: کاربر گرامی، لطفا فرم زیر را جهت ارسال مرسوله ی سفارش های تکمیل شده تان به دقت پر کرده و ارسال فرمایید. در بخش شماره سفارش ها، شماره سفارش هایی را که می خواهید ارسال شوند، را وارد نمایید. توجه داشته باشید که شماره ها را با علامت - یا ، از هم جدا نمایید. (مشاهده شماره سفارش ها). نکته ی مهم دیگر انکه لطفا فقط شماره ی سفارش هایی را وارد نمایید که وضعیت آن ها در حالت آماده تحویل قرار دارد. بدیهی است سفارشاتی که وضعیت آنها در حالت آماده ی تحویل قرار ندارند غیر قابل ارسال بوده و درخواست ارسال شما نتیجه ای در پی نخواهد داشت.<br/>
		نحوه ی ارسال: با توجه به آدرس شما، و اینکه آیا در شهر تبریز هستید یا نه، ارسال به یکی از روش های پیک موتوری، باربری و یا تیپاکس انجام خواهد گرفت که در هر سه حالت هزینه ی آن را شما هنگام تحویل مرسوله پرداخت خواهید نمود. توجه داشته باشید در صورتی که با روش باربری ارسال گردد شما باید با مراجعه به باربری مذکور مرسوله ی خود را تحویل بگیرید و مرسوله به درب ادرس نوشته شده ارسال نخواهد شد.</p>


		<?php

		echo "<form name=\"delivery-request-form\" id=\"delivery-request-form\" action=\"delivery-request.php\" method=\"post\">";
			echo "<label for=\"order-number-input\">سفارش هایی را که می خواهید ارسال شوند انتخاب کنید:</label><br/>";
//			echo "<input type=\"text\" name=\"order-number-input\" id=\"order-number-input\" placeholder=\"مثلا 12345-54321-12453\"><br/>";
            ?><select name="order-number-input[]" id="order-input" style="width:420px; height: 150px;"  multiple="multiple" tabindex="1">
            <?
            $sql_select="select * from orders1 where order_last_status=7 and order_user='$username_value'";
            $orders=mysqli_query($connection,$sql_select);
			while($order=mysqli_fetch_array($orders)){?>
            <option value="<?=$order['order_invoice_code']?>"><?=$order['order_invoice_code']?></option>
            <? }?>
            <?
            $sql_select="SELECT * FROM orders2  WHERE order_last_status=7 and order_user='$username_value'";
            $orders=mysqli_query($connection,$sql_select);
            while($order=mysqli_fetch_array($orders)){?>
            <option value="<?=$order['order_invoice_code']?>"><?=$order['order_invoice_code']?></option>
            <? } ?>
            <?
            $sql_select="select * from orders3 where order_last_status=7 and order_user='$username_value'";
            $orders=mysqli_query($connection,$sql_select);
            while($order=mysqli_fetch_array($orders)){?>
                <option value="<?=$order['order_invoice_code']?>"><?=$order['order_invoice_code']?></option>
            <? } ?>
			</select><br/>
           <input type="button" id="select_all" name="select_all" value="انتخاب همه"><br/>
            <?
            echo "<label for=\"order-reciver-name-input\">نام گیرنده مرسوله به طور کامل و دقیق:</label><br/>";
			echo "<input type=\"text\" value='".$_SESSION["people_login"]."--".$_SESSION["people_name"]." ".$_SESSION["people_last_name"]."' name=\"order-reciver-name-input\" id=\"order-reciver-name-input\" placeholder=\"مثلا محمد محمد زاده\"><br/>";
			echo "<label for=\"order-recive-adress-input\">آدرس دقیق محل تحویل:</label><br/>";
			echo "<textarea name=\"order-recive-adress-input\" id=\"order-recive-adress-input\" placeholder=\"مثلا تبریز، ولیعصر، شهریار، کوچه گلها، پلاک 12\"></textarea><br/>";
			echo "<input type=\"submit\" name=\"submit\" value=\"ثبت درخواست ارسال\">";
		echo "</form>";

		?>

	</section>
<script>
    $('#select_all').click(function() {
        $('#order-input option').prop('selected', true);
    });
</script>
<?php include ("footer.php");?>
