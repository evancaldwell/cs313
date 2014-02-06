<?php
require_once $_SERVER['DOCUMENT_ROOT']."/app/models/conn_admin.php";
    
function add_user($email, $password, $fname, $lname, $phone, $addr1, $addr2, $city, $state, $zip) {
    // parameters are the feilds of the form that we want to insert into the db
    // pull in the database from the controller
    global $db;
    
    $db->beginTransaction();
    
    $flag = TRUE;
                
    try {
        echo "hit the users try in users model <br>";
        // the sql query ready to be turned into a prepared statement using the values
        $sql = 'INSERT INTO users
                    (email, f_name, l_name, phone, addr1, addr2, city, state, zip)
                VALUES
                    (:email, :fname, :lname, :phone, :addr1, :addr2, :city, :state, :zip)';
                    
        // use the prepared statement by binding/matching the feilds from the form - passed 
        // in via the parameters - to the values in our sql query
        $stmt = $db->prepare($sql);
        echo "prepared<br>";
        $stmt->bindValue(':email', $email);
        echo "bind email<br>";
        $stmt->bindValue(':fname', $fname);
        echo "bind fname<br>";
        $stmt->bindValue(':lname', $lname);
        echo "bind lname<br>";
        $stmt->bindValue(':phone', $phone);
        echo "bind phone<br>";
        $stmt->bindValue(':addr1', $addr1);
        echo "bind addr1<br>";
        $stmt->bindValue(':addr2', $addr2);
        echo "bind addr2<br>";
        $stmt->bindValue(':city', $city);
        echo "bind city<br>";
        $stmt->bindValue(':state', $state);
        echo "bind state<br>";
        $stmt->bindValue(':zip', $zip);
        echo "bind zip<br>";
        $stmt->execute();
        echo "executed<br>";
        $insertId = $db->lastInsertId(); // get and return the last ID that was generated
        $stmt->closeCursor();
    } catch (PDOException $e) {
        // $error_message = $e->getMessage();
        // display_db_error($error_message);
        return 0;
    }
    
    if($insertId < 1) {
        $flag = FALSE;
    }
    
    if($flag) {
        try {
            echo "hit the auth try in users model <br>";
            // the sql query ready to be turned into a prepared statement using the values
            $sql = 'INSERT INTO auth
                        (id, password)
                    VALUES
                        (:id, :password)';
                        
            // use the prepared statement by binding/matching the feilds from the form - passed 
            // in via the parameters - to the values in our sql query
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $insertId);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $insertId = $db->lastInsertId(); // get and return the last ID that was generated
            $stmt->closeCursor();
        } catch (PDOException $e) {
            # $error_message = $e->getMessage();
            # display_db_error($error_message);
            $flag = FALSE;
        }
    }
    
    if($insertId < 1) {
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
    
    $query = 'SELECT email FROM users WHERE email = :email';
    
    $stmnt = $db->prepare($query);
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

function loginUser($email, $password) {
    global $db;
    
    try {
        $sql = 'SELECT id, f_name, l_name, email, password
            FROM users INNER JOIN auth ON users.id = auth.id
            WHERE email = :email AND password = :password';
            // could also use "AND test.id = auth.id in place of the INNER JOIN
            
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute;
        $userInfo = $stmt->fetchAll();
        $stmt = closeCursor;
        return $userInfo;
    } catch (Exception $e) {
        // handle exception
    }
}

function getUsers($userId) {
    global $db;
    if($userId > 0) {
        try {
            $sql = 'SELECT * FROM users WHERE id = :userId ORDER BY id DESC';
                
            $stmt = $db->prepare($sql);    
            $stmt->bindValue(':userId', $userId); 	
            $stmt->execute();
            $userList = $stmt->fetchAll();
            $stmt = closeCursor;
            return $userList;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    } else {
        try {
            $sql = 'SELECT * FROM users ORDER BY id DESC';
                
            $stmt = $db->prepare($sql);    
            $stmt->execute();
            $userList = $stmt->fetchAll();
            $stmt = closeCursor;
            return $userList;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    }
}

function updateUser($userId, $userFirst, $userLast, $userEmail, $userPhone, $userAddr1, $userAddr2, $userCity, $userState, $userZip) {
    global $db;
    
    $sql = 'UPDATE users SET f_name=:fname, l_name=:lname, email=:email, phone=:phone, 
        addr1=:addr1, addr2=:addr2, city=:city, state=:state, zip=:zip
            WHERE id = :userId';

    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':fname', $userFirst);
        $stmt->bindValue(':lname', $userLast);
        $stmt->bindValue(':email', $userEmail);
        $stmt->bindValue(':phone', $userPhone);
        $stmt->bindValue(':addr1', $userAddr1);
        $stmt->bindValue(':addr2', $userAddr2);
        $stmt->bindValue(':city', $userCity);
        $stmt->bindValue(':state', $userState);
        $stmt->bindValue(':zip', $userZip);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt -> closeCursor();
        return $result;
    } catch (Exception $e) {
        echo 'Error updating client in database';
    }
}

function activateUser($userId, $action) {
    global $db;
    
    if($action == 'deactivateUser') {
        $sql = 'UPDATE users SET active=0 WHERE id = :userId';
    } else if($action == 'activateUser') {
        $sql = 'UPDATE users SET active=1 WHERE id = :userId';
    }
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
    } catch (Exception $e) {
        echo 'Error deactivating user.';
    }
}

?>