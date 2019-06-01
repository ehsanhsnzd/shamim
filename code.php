<html>
<head></head>
<body>
<?php

	
                class encrypt {
                    /********* Encode *********/
                    public static function encode($pure_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))), utf8_encode(trim($pure_string)), MCRYPT_MODE_ECB, $iv);
                        return base64_encode($encrypted_string);
                    }

                    /********** Decode ************ */
                    public static function decode($encrypted_string, $encryption_key) {
                        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
                        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
                        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, md5(base64_encode(trim($encryption_key))),base64_decode(trim($encrypted_string)), MCRYPT_MODE_ECB, $iv);
                        return $decrypted_string;
                    }
                }


                $coded = encrypt::decode('viwWxPZx/Tg=', 'GZvazK@(0D!_hoho12%32');
                echo $coded;




?>


</body>
</html>