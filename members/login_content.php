<?if(!defined("site_root")){exit();}?>
<div class="description-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <div id="login_content">
                    <table border="0" cellpadding="0" cellspacing="0" width="90%">
                        <tr valign="top">
                            <td style="width:50%">
                                <div class='login_header'><h2><?=word_lang("login")?></h2></div>
                                <form method='post' action='<?=site_root?>/members/check.php'>

                                    <div class="form_field">
                                        <span><?=word_lang("user")?>:</span>
                                        <input class='ibox' type='text' name='l' style='width:100px;'>
                                    </div>

                                    <div class="form_field">
                                        <span><?=word_lang("password")?>:</span>
                                        <input class='ibox' type='password' name='p' style='width:100px;'>
                                    </div>

                                    <div class="form_field">
                                        <input class='isubmit' type='submit' value="<?=word_lang("login")?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?=site_root?>/members/forgot.php'><?=word_lang("forgot password")?>?</a>
                                    </div>

                                </form>






                            </td>
                            <td style="padding-left:30px;width:50%">



                                <?if($site_guest and !$site_credits and $site=="checkout"){?>

                                    <script language="javascript">
                                        function check_guest_email()
                                        {
                                            email=document.getElementById('guest_email').value;
                                            if(email.match (/^[0-9a-zA-Z\-_\.]+@[0-9a-zA-Z\-_\.]+\.[a-zA-Z]+$/))
                                            {
                                                return true;
                                            }
                                            else
                                            {
                                                document.getElementById('guest_email').className = 'ibox_error';
                                                document.getElementById('error_email').innerHTML = '<?=word_lang("incorrect")?>';
                                                return false;
                                            }
                                        }

                                        function show_captcha()
                                        {
                                            $("#captcha_box").slideDown("slow");
                                        }
                                    </script>




                                    <div class='login_header' style="margin-top:30px"><h2><?=word_lang("login as guest")?></h2></div>

                                <?
                                if(isset($_GET["error"]))
                                {
                                    if($_GET["error"]=="email")
                                    {
                                        echo("<p><b>Error. The email is already in use</b></p>");
                                    }
                                    if($_GET["error"]=="captcha")
                                    {
                                        echo("<p><b>Error. Incorrect Captcha.</b></p>");
                                    }
                                }
                                ?>

                                    <form method='post' action='<?=site_root?>/members/check_guest.php' onSubmit="return check_guest_email();">

                                        <div class="form_field">
                                            <span><?=word_lang("e-mail")?>:</span>
                                            <input class='ibox' type='text' name='guest_email'  id='guest_email' style='width:150px;' onClick="show_captcha()" value="<?if(isset($_SESSION["guest_email"])){echo(result($_SESSION["guest_email"]));}?>"><div id="error_email" class="error"></div>
                                        </div>
                                        <div class="form_field" <?if(!isset($_GET["error"])){?>style="display:none"<?}?> id="captcha_box">
                                            <?
                                            //Show captcha
                                            require_once('../admin/function/recaptchalib.php');
                                            echo(show_captcha());
                                            ?>
                                        </div>

                                        <div class="form_field">
                                            <input class='isubmit' type='submit' value='<?=word_lang("OK")?>'>
                                        </div>

                                    </form>
                                <?}?>


                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="col-md-6">
                <div class="desc-title">
                    <h2>برای سفارش باید عضو سایت شوید</h2>

                    <div class='login_header' style="margin-top:30px"><h2><?=word_lang("sign up")?></h2></div>
                    <p>   چنانچه هنوز عضو نشده اید برای عضویت روی لینک زیر کلیک کنید.</p>

                    <div class="form_field">
                        <input class='isubmit' type='button' onClick="location.href='signup.php'" value="<?=word_lang("sign up")?>">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
