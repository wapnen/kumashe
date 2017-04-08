<?php
	/**
 * Dumps the contents of the environment variable GOOGLE_CREDENTIALS_BASE64 to
 * a file.
 *
 */
		$credentials = getenv('GOOGLE_CREDENTIAL_BASE64');
        $fpath = getenv('GOOGLE_CLOUD_KEY_FILE');
        if ($credentials !== false && $fpath !== false) {
            file_put_contents($fpath,base64_decode($credentials));
            
        }