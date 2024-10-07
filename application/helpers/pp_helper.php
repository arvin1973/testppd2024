<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_encrypt_text'))
{
    function get_encrypt_text(){
        $crypt_text = "dfuzzy";
        return $crypt_text;
    }
}

//===============================================================================================
//Encrypt text
//===============================================================================================
if (!function_exists('encrypt_text'))
{
    function encrypt_text($text){

        $crypt_text = get_encrypt_text();

        if (!$text && $text != "0") return false;
        if (!$crypt_text) return false;

        $key_val = key_value($crypt_text);
        $estr = "";

        for ($i=0; $i<strlen($text); $i++) {
            $chr = ord(substr($text, $i, 1));
            $chr = $chr + $key_val[1];
            $chr = $chr * $key_val[2];
            (double)microtime()*1000000;
            $rstr = chr(rand(97, 122));
            $estr .= "$rstr$chr";
        }

        return $estr;
    }
}

//===============================================================================================
//Decrypt text
//===============================================================================================
if (!function_exists('decrypt_text'))
{
    function decrypt_text($text){
        
        $crypt_text = get_encrypt_text();

        if (!$text && $text != "0") return false;
        if (!$crypt_text) return false;

        $key_val = key_value($crypt_text);
        $estr = "";
        $tmp = "";

        for ($i=0; $i<strlen($text); $i++) {
            if ( ord(substr($text, $i, 1)) > 96 && ord(substr($text, $i, 1)) < 123 ) {
                if ($tmp != "") {
                    $tmp = $tmp / $key_val[2];
                    $tmp = $tmp - $key_val[1];
                    $estr .= chr($tmp);
                    $tmp = "";
                }
            }
            else {
                $tmp .= substr($text, $i, 1);
            }
        }

        $tmp = $tmp / $key_val[2];
        $tmp = $tmp - $key_val[1];
        $estr .= chr($tmp);

        return $estr;
    }
}

//===============================================================================================
//For encryption-decrypt key value
//===============================================================================================

if (!function_exists('key_value'))
{
    function key_value($crypt_text){
        $key_val = "";
        $key_val[1] = "0";
        $key_val[2] = "0";
        for ($i=1; $i<strlen($crypt_text); $i++) {
            $cur_char = ord(substr($crypt_text, $i, 1));
            $key_val[1] = $key_val[1] + $cur_char;
            $key_val[2] = strlen($crypt_text);
        }
        return $key_val;
    }
}

//===============================================================================================
//author    : ilham
//date      : 8-2-2017
//purpose   : clean special characters from a string
//===============================================================================================

if (!function_exists('clean_string'))
{
    function clean_string($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}

//===============================================================================================
//author    : ilham
//date      : 23-1-2020
//purpose   : decrypt encrypted string
//===============================================================================================


if (!function_exists('decrypt_base64'))
{
    function decrypt_base64($id) {
        $_id=   base64_decode($id);
        $out=   openssl_decrypt($_id,"AES-128-ECB",ENCRYPT_PASS);
        return $out; 
    }
}