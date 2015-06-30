<?php
include_once 'Database.php';

class Refresh
{
	public function refreshUser($username)
	{
		$dbCon = Database::connectDB();
		$query = $dbCon->prepare("SELECT * FROM userinfo
                  WHERE username = '$username'
                  ORDER BY id DESC
                  LIMIT 1");
        $query->execute();
        $row = $query->fetch();

        return $row;
	}
}