<?php

class CryptoClass
{
    protected $IV;
    protected $encryptionMethod;
    protected $secret;

    function __construct($blockSize = null)
    {
//        $this->secret = "!crgDieM@1453!crgDieM@1453";
        $this->secret = "@kargO141!@kargO141!";
        $this->IV = substr($this->secret, 0, 16);
        $this->encryptionMethod = "AES-256-CBC";
    }

    public function encryption($data)
    {
        if ($data) {
            return openssl_encrypt($data, $this->encryptionMethod, $this->secret, 0, $this->IV);
        } else {
            return 'Invlid params!';
        }
    }

    public function decryption($data)
    {
        if ($data) {
            return openssl_decrypt($data, $this->encryptionMethod, $this->secret, 0, $this->IV);
        } else {
            return 'Invlid params!';
        }
    }

}
