<?php

require("../conn/connAdmin.php");
    
function add_usr($email, $password, $fname, $lname, $phone, $addr1, $addr2, $city, $state, $zip, $rights) {
    // parameters are the feilds of the form that we want to insert into the db
    // pull in the database from the controller
    global $db;
    
    $db->beginTransaction();
    
    $flag = TRUE;
                
    try {
    
        // the sql query ready to be turned into a prepared statement using the values
        $sql = 'INSERT INTO usrs
                    (usr_first, usr_last, usr_email, usr_phone, usr_addr1, usr_addr2, usr_city, usr_state, usr_zip, usr_rights)
                VALUES
                    (:fname, :lname, :email, :phone, :addr1, :addr2, :city, :state, :zip, :rights)';
                    
        // use the prepared statement by binding/matching the feilds from the form - passed 
        // in via the parameters - to the values in our sql query
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':fname', $fname);
        $stmt->bindValue(':lname', $lname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':addr1', $addr1);
        $stmt->bindValue(':addr2', $addr2);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':state', $state);
        $stmt->bindValue(':zip', $zip);
        $stmt->bindValue(':rights', $rights);
        $stmt->execute();
        $ID = $db->lastInsertId(); // get and return the last ID that was generated
        $stmt->closeCursor();
    } catch (PDOException $e) {
        # $error_message = $e->getMessage();
        # display_db_error($error_message);
        return 0;
    }
    
    if($ID < 1) {
        $flag = FALSE;
    }
    
    if($flag) {
        try {
            // the sql query ready to be turned into a prepared statement using the values
            $sql = 'INSERT INTO auth
                        (usr_id, password)
                    VALUES
                        (:id, :password)';
                        
            // use the prepared statement by binding/matching the feilds from the form - passed 
            // in via the parameters - to the values in our sql query
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $ID);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $ID = $db->lastInsertId(); // get and return the last ID that was generated
            $stmt->closeCursor();
        } catch (PDOException $e) {
            # $error_message = $e->getMessage();
            # display_db_error($error_message);
            $flag = FALSE;
        }
    }
    
    if($ID < 1) {
        $flag = FALSE;
    }
    
    if($flag) {
        $db->commit();
        return 1;
    } else {
        $db->rollback();
        return 0;
    }
}

function getEmail($email) {
    // pull in the database from the controller
    global $db;
    
    $sql = 'SELECT usr_email FROM usrs WHERE usr_email = :email';
    
    $stmnt = $db->prepare($sql);
    $stmnt->bindValue(':email', $email);
    $stmnt->execute();
    $result = $stmnt->fetch();
    $stmnt->closeCursor();
    
    if (!empty($result)) {
        return 'You are already registered, please log in.';
    } else {
        return 'not a member';
    }
}

function loginUsr($email, $password) {
    global $db;
    
    try {
        $sql = 'SELECT usrs.usr_id, usr_first, usr_last, usr_email, usr_rights, usr_active, password
            FROM usrs INNER JOIN auth ON usrs.usr_id = auth.usr_id
            WHERE usr_email = :email AND password = :password';
            // could also use "AND usrs.usr_id = auth.usr_id in place of the INNER JOIN
            
        $stmt = $db->prepare($sql);    
        $stmt->bindValue(':email', $email);	
        $stmt->bindValue(':password', $password);	
        $stmt->execute();
        $usrInfo = $stmt->fetchAll();
        $stmt = closeCursor;
        return $usrInfo;
    } catch (Exception $e) {
        // handle exception
        echo 'there was some exception in the model';
    }
}

function getUsrs($usrId) {
    global $db;
    if($usrId > 0) {
        try {
            $sql = 'SELECT * FROM usrs WHERE usr_id = :usrId ORDER BY usr_id DESC';
                
            $stmt = $db->prepare($sql);    
            $stmt->bindValue(':usrId', $usrId); 	
            $stmt->execute();
            $usrList = $stmt->fetchAll();
            $stmt = closeCursor;
            return $usrList;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    } else {
        try {
            $sql = 'SELECT * FROM usrs ORDER BY usr_id DESC';
                
            $stmt = $db->prepare($sql);    
            $stmt->execute();
            $usrList = $stmt->fetchAll();
            $stmt = closeCursor;
            return $usrList;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    }
}

function updateUsr($usrId, $usrFirst, $usrLast, $usrEmail, $usrPhone, $usrRights, $usrAddr1, $usrAddr2, $usrCity, $usrState, $usrZip) {
    global $db;
    
    $sql = 'UPDATE usrs SET usr_first=:first, usr_last=:last, usr_email=:email, usr_phone=:phone, usr_rights=:rights, 
        usr_addr1=:addr1, usr_addr2=:addr2, usr_city=:city, usr_state=:state, usr_zip=:zip
            WHERE usr_id = :usrId';

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first', $usrFirst);
        $stmt->bindValue(':last', $usrLast);
        $stmt->bindValue(':email', $usrEmail);
        $stmt->bindValue(':phone', $usrPhone);
        $stmt->bindValue(':rights', $usrRights);
        $stmt->bindValue(':addr1', $usrAddr1);
        $stmt->bindValue(':addr2', $usrAddr2);
        $stmt->bindValue(':city', $usrCity);
        $stmt->bindValue(':state', $usrState);
        $stmt->bindValue(':zip', $usrZip);
        $stmt->bindValue(':usrId', $usrId);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt -> closeCursor();
        return $result;
    } catch (Exception $e) {
        echo 'Error updating client in database';
    }
}

function activateUsr($usrId, $action) {
    global $db;
    
    if($action == 'deactivateUsr') {
        $sql = 'UPDATE usrs SET usr_active=0 WHERE usr_id = :usrId';
    } else if($action == 'activateUsr') {
        $sql = 'UPDATE usrs SET usr_active=1 WHERE usr_id = :usrId';
    }
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':usrId', $usrId);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
    } catch (Exception $e) {
        echo 'Error deactivating user.';
    }
}

?>