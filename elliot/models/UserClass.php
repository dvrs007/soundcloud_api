<?php
include_once 'Database.php';

class User 
{
	private $username, $accesstoken, $refreshtoken, $expiresin, $scope;

	function __construct($username, $accesstoken, $refreshtoken, $expiresin, $scope) 
	{
       $this->username = $username;
       $this->accesstoken = $accesstoken;
       $this->refreshtoken = $refreshtoken;
       $this->expiresin = $expiresin;
       $this->scope = $scope;
   	}

	public function insertUser()
	{
		$dbCon = Database::connectDB();

		$username = $this->username;
       	$accesstoken = $this->accesstoken;
       	$refreshtoken = $this->refreshtoken;
       	$expiresin = $this->expiresin;
       	$scope = $this->scope;

		$query =
            "INSERT INTO userinfo
                 (username, accesstoken, refreshtoken, expiresin, scope)
             VALUES
                 ('$username', '$accesstoken', '$refreshtoken', '$expiresin', '$scope')";

        $userInsert = $dbCon->exec($query);
        return $userInsert;

	}
}