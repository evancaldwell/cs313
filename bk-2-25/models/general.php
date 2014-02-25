<?php

// require $_SERVER['DOCUMENT_ROOT'].'/conn/connAdmin.php';
    
function add_record($fname, $lname, $email, $password, $rights) {
    // parameters are the feilds of the form that we want to insert into the db
    // pull in the database from the controller
    global $db;
    
    $db->beginTransaction();
    
    $flag = TRUE;
                
    try {
    
        // the sql query ready to be turned into a prepared statement using the values
        $query = 'INSERT INTO test
                    (client_first, client_last, client_email, client_password, client_rights)
                VALUES
                    (:fname, :lname, :email, :password, :rights)';
                    
        // use the prepared statement by binding/matching the feilds from the form - passed 
        // in via the parameters - to the values in our sql query
        $statement = $db->prepare($query);
        $statement->bindValue(':fname', $fname);
        $statement->bindValue(':lname', $lname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':rights', $rights);
        $statement->execute();
        $ID = $db->lastInsertId(); // get and return the last ID that was generated
        $statement->closeCursor();
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
            $query = 'INSERT INTO auth
                        (client_id, password)
                    VALUES
                        (:id, :password)';
                        
            // use the prepared statement by binding/matching the feilds from the form - passed 
            // in via the parameters - to the values in our sql query
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $ID);
            $statement->bindValue(':password', $password);
            $statement->execute();
            $ID = $db->lastInsertId(); // get and return the last ID that was generated
            $statement->closeCursor();
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
    
    $query = 'SELECT client_email FROM test WHERE client_email = :email';
    
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

function loginUsr($email, $password) {
    global $db;
    
    try {
        $sql = 'SELECT client_id, client_first, client_last, client_email, client_rights, password
            FROM test INNER JOIN auth ON test.client_id = auth.client_id
            WHERE client_email = :email AND password = :password';
            // could also use "AND test.client_id = auth.client_id in place of the INNER JOIN
            
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute;
        $usrInfo = $stmt->fetchAll();
        $stmt = closeCursor;
        return $usrInfo;
    } catch (Exception $e) {
        // handle exception
    }
}

function insertSurveyResult($result) {
    global $db;

    try {
        // the sql query ready to be turned into a prepared statement using the values
        $query = 'INSERT INTO class_survey
                    (name, email, major, app, comments)
                VALUES
                    (:name, :email, :major, :app, :comments)';
                    
        // use the prepared statement by binding/matching the feilds from the form - passed 
        // in via the parameters - to the values in our sql query
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $result[name]);
        $statement->bindValue(':email', $result[email]);
        $statement->bindValue(':major', $result[major]);
        $statement->bindValue(':app', $result[app]);
        $statement->bindValue(':comments', $result[comments]);
        $statement->execute();
        $ID = $db->lastInsertId(); // get and return the last ID that was generated
        $statement->closeCursor();
        return $ID;
    } catch(Exception $e) {
        return "there was a problem adding the survey result to the db";
    }
}
function getSurveyResults() {
    global $db;
    
    try {
        $sql = 'SELECT * FROM class_survey ORDER BY name';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $surveyResults = $stmt->fetchAll();
        $stmt->closeCursor;
        return $surveyResults;
    } catch(PDOException $e) {
        return 0;
    }
}

?>