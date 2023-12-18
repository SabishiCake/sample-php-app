<?php
include_once("services/services.database.php");

class Users
{
    private $list = array();

    public function __construct()
    {
        $this->list = $this->getAllUserData();
    }

    public function getAllUserData()
    {
        $db = new Database();
        $conn = $db->getCon();
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";

        $resList = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($resList, $row);
            }
        }
        return $resList;
    }


    public function getUserData($id)
    {
        foreach ($this->list as $user) {
            if ($user["user_id"] == $id) {
                return $user;
            }
        }
    }


}
?>