<?php


class PhpPassManagerDecryptorComponent extends CComponent {

    /**
     * @return void
     */
    public function init() {

    }

    /**
     * @param string $password
     * @param string $key
     * @param string $iv
     * @return string
     */
    public function decrypt($password, $key, $iv) {
        $encDescriptor = mcrypt_module_open(MCRYPT_RIJNDAEL_256, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($encDescriptor, $key, $iv);
        $decryptedPassword = mdecrypt_generic($encDescriptor, $password);
        mcrypt_generic_deinit($encDescriptor);
        mcrypt_module_close($encDescriptor);
        return trim($decryptedPassword);
    }

}