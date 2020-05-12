<?php

class Cifrar{

	/*======================================
	=            FUNCION CIFRAR            =
	======================================*/
	
	static public function encrypt($data) {

		$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
		$encryption_key = base64_decode($key);
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
		return base64_encode($encrypted . '::' . $iv);

	}

	/*=====  End of FUNCION CIFRAR  ======*/

	/*=========================================
	=            FUNCION DESCIFRAR            =
	=========================================*/
	
	function decrypt($data) {

		$key = 'qkwjdiw239&&jdafweihbrhnan&^%$ggdnawhd4njshjwuuO';
		$encryption_key = base64_decode($key);
		list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);

	}

	/*=====  End of FUNCION DESCIFRAR  ======*/
	
}