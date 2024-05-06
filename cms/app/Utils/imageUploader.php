<?php

namespace App\Utils;
use Aws\S3\S3Client;
use Aws\CloudFront\CloudFrontClient;

class imageUploader
{
    public static function upload($model,$image,$folder,$type="none",$path="web_data"){
        if($type !== "none" && $type !== "")
            $imageFileName = sprintf(
              "%d_%s.%s",$model->id,$type,$image->getClientOriginalExtension());
        else
            $imageFileName = sprintf("%d.%s",$model->id,$image->getClientOriginalExtension());

        $destino_ftp= sprintf("%s/%s/%s", config('app.path_archive'), $folder, $model->id);
        @chmod($destino_ftp , 0755);
        if (!file_exists($destino_ftp)) {
            mkdir($destino_ftp, 0777, TRUE);
        }
        $file_path = sprintf("%s/%s", $destino_ftp, $imageFileName);
        if (file_exists($file_path)) {
            @unlink($file_path);
        }
        move_uploaded_file($image, $file_path);
        $path =  sprintf("%s/%s/%s", $folder , $model->id  , $imageFileName);

        return $path;
    }

    public static function no_file_upload_s3($file_name,$path_server,$destino_ftp,$create_invalidation=false){
        $amazon_bucket  = config('app.bucket');
        $amazon_keyname = config('app.keyname');
        $amazon_secret  = config('app.secret');
        $amazon_region  = config('app.region');
        $amazon_distributionid = config("app.distribution");
        $client = CloudFrontClient::factory(array(
            'credentials' => array(
                'key' => $amazon_keyname,
                'secret' => $amazon_secret,
                'token' => ''
            ),
            'region' =>$amazon_region,
            'version' => 'latest',
        ));

        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => $amazon_region,
            'credentials' => array(
                'key' => $amazon_keyname,
                'secret'  => $amazon_secret,
            )
        ]);
        $s3->putObject([
            'Bucket' => $amazon_bucket,
            'Key'    => $destino_ftp,
            'SourceFile'   => $path_server,
            'ACL'    => 'public-read',
        ]);
        if($create_invalidation){
            $result = $client->createInvalidation([
            'DistributionId' => $amazon_distributionid,
              'InvalidationBatch' => [
                  'CallerReference' => 'Invalidate for ' . date('Y-m-d-H-i-s') . $file_name,
                  'Paths' => [
                      'Quantity' => 1,
                     'Items' => [sprintf("/%s",$destino_ftp)],
                  ],
              ],
          ]);
        }

    }


    public static function upload_s3($model,$image,$folder,$type="none",$path="",$required_invalidation=true){
        $amazon_bucket  = config('app.bucket');
        $amazon_keyname = config('app.keyname');
        $amazon_secret  = config('app.secret');
        $amazon_region  = config('app.region');
        $amazon_distributionid = config('app.distribution');
        if($type !== "none" && $type !== "")
           $imageFileName = sprintf("%d_%s.%s",$model->id,$type,$image->getClientOriginalExtension());
        else
           $imageFileName = sprintf("%d.%s",$model->id,$image->getClientOriginalExtension());

        $client = CloudFrontClient::factory(array(
           'credentials' => array(
               'key' => $amazon_keyname,
               'secret' => $amazon_secret,
               'token' => ''
           ),
           'region' =>$amazon_region,
           'version' => 'latest',
        ));

        $s3 = new S3Client([
           'version' => 'latest',
           'region'  => $amazon_region,
           'credentials' => array(
               'key' => $amazon_keyname,
               'secret'  => $amazon_secret,
           )
        ]);
        if($path!=""){
          $destino_ftp = sprintf("%s/%s/%s/%s",$path,$folder,$model->id,$imageFileName);
        }else{
          $destino_ftp = sprintf("%s/%s/%s",$folder,$model->id,$imageFileName);
        }

        $s3->putObject([
           'Bucket' => $amazon_bucket,
           'Key'    => $destino_ftp,
           'SourceFile'   => $image,
           'ACL'    => 'public-read',
        ]);
        if($required_invalidation){
          $result = $client->createInvalidation([
             'DistributionId' => $amazon_distributionid,
             'InvalidationBatch' => [
                 'CallerReference' => 'Invalidate for ' . date('Y-m-d-H-i-s').time(). sprintf("%s/%s/%s",$folder,$model->id,$imageFileName),
                 'Paths' => [
                     'Quantity' => 1,
                     'Items' => [sprintf("/%s",$destino_ftp)],
                 ],
             ],
          ]);
        }

        return sprintf("%s/%s/%s",$folder,$model->id,$imageFileName);
    }
}
