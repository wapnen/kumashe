<?php

namespace App\Providers;

    use Illuminate\Support\ServiceProvider;
     use Storage;
    use Aws\S3\S3Client;
    use League\Flysystem\AwsS3v2\AwsS3Adapter;
    use League\Flysystem\Filesystem;

    class GoogleCloudStorageServiceProvider extends ServiceProvider {
     /**
    * Bootstrap the application services.
    *
     * @return void
     */
    public function boot()
    {
    Storage::extend('gcs', function( $app, $config )
     {
     $client = S3Client::factory(array(
     'key' => $config['gcs_key'],
     'secret' => $config['gcs_secret'],
     'base_url' => $config['gcs_base_url'],
    ));

    return new Filesystem(new AwsS3Adapter($client, $config['bucket']));
    });
    }
    /**
    * Register the application services.
    *
    * @return void
    */
    public function register()
    {
    //
    }

    }