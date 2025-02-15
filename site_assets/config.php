<?php
//include('../site_assets/vendor/autoload.php');
//require '../site_assets/vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;
// Load the .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables
$rdsHost = $_ENV['RDS_HOST'];
$rdsPort = $_ENV['RDS_PORT'];
$rdsDatabase = $_ENV['RDS_DBNAME'];
$rdsUsername = $_ENV['RDS_USERNAME'];
$rdsPassword = $_ENV['RDS_PASSWORD'];


//s3 cred

$s3BucketName = $_ENV['AWS_BUCKETNAME'];
$s3FolderName = $_ENV['AWS_FOLDERNAME'];
$s3AccessKey = $_ENV['AWS_ACCESS_KEY_ID'];
$s3SecretKey = $_ENV['AWS_SECRET_ACCESS_KEY'];
$s3Region = $_ENV['AWS_REGION'];

?>
