<?php

/*
 * PHP mcrypt - Class to provide 2 way encryption of data
 */

class Crypt {
    //Encrypts a string
    public function encrypt($text) {
		$encrypt_url = strtr(
                    base64_encode($text),
                    array(
                        // '+' => '.',
                        '=' => '-',
                        '/' => '~',
						'G' => 'gxf1'
                    )
                );
				
		return $encrypt_url;
    }

    //Decrypts a string
    public function decrypt($text) {		
		$decoded_string = strtr(
                    $text,
                    array(
                        // '.' => '+',
                        '-' => '=',
                        '~' => '/',
						'gxf1' => 'G'
                    )
		);
		return base64_decode($decoded_string);
    }

}


?>