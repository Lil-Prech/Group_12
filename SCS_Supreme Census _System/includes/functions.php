<?php
function getUserData($phone, $passwordss) {
    include('database/db_connection.php');
    
    $get_user_data_query = $db->prepare("SELECT * FROM users WHERE phone_number = :phone AND passwordss = :passwordss");
    $get_user_data_query->bindParam(':phone', $phone);
    $get_user_data_query->bindParam(':passwordss', $passwordss);

    $result = $get_user_data_query->execute();

    if ($result) {
        $user_data = $result->fetchArray(SQLITE3_ASSOC);
        return $user_data; // Return fetched user data
    } else {
        return false; // Return false if user not found
    }
}

function getChildData($parentId) {
    include('database/db_connection.php');

    $get_child_data_query = $db->prepare("SELECT * FROM children WHERE parent_id = :parent_id");
    $get_child_data_query->bindParam(':parent_id', $parentId);

    $result = $get_child_data_query->execute();
 
    if ($result) {
        $children_data = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $children_data[] = $row;
        }
        return $children_data;
    } else {
        return false;
    }
}
?>
