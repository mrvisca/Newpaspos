<?php
    // Include the SDK using the Composer autoloader
    date_default_timezone_set('Asia/Jakarta');
    require 'vendor/autoload.php';

    $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'endpoint' => 'https://cdn-pp.pasglobalteknologi.com.us-east-1.cloudhost.id',
            'use_path_style_endpoint' => true,
            'credentials' => [
                    'key'    => 'FLJKAY2ZCZY1Y1BFBRB0',
                    'secret' => 'QG7SwQxo2cSA3amBatjbvpeSnjbcp87SFVUeUgWV',
                ],
    ]);

    $bucket = "cdn-pp.pasglobalteknologi.com";
    $path = "testimage/visca.png";
    $file = fopen($path,'r');
    $ext =explode(".", $path);
    $filename = time().'.'.$ext[1];
    // Send a PutObject request and get the result object.
    $s3->putObject([
        'Bucket' => $bucket,
        'Key'    => $filename,
        'Body'   => $file,
        'ACL'    => 'public-read',
    ]);
                            
    // Download the contents of the object.
    // $retrive = $s3->getObject([
    //      'Bucket' => 'testbucket',
    //      'Key'    => 'testkey',
    //      'SaveAs' => 'testkey_local'
    // ]);
    $plainUrl = $s3->getObjectUrl($bucket, $filename);
    // Print the body of the result by indexing into the result object.
    // echo $retrive['Body'];
    echo $plainUrl .'\n';
?>