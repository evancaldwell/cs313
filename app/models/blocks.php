<?php

function add_block($fname, $lname, $email, $password, $rights) {
    // parameters are the feilds of the form that we want to insert into the db
    // pull in the database from the controller
    global $db;
    
    $db->beginTransaction();
    
    $flag = TRUE;
                
    try {
    
        // the sql query ready to be turned into a prepared statement using the values
        $query = 'INSERT INTO blocks
                    (user_id, chapter_id, block)
                VALUES
                    (:userId, :chapterId, :block)';
                    
        // use the prepared statement by binding/matching the feilds from the form - passed 
        // in via the parameters - to the values in our sql query
        $statement = $db->prepare($query);
        $statement->bindValue(':userId', $userId);
        $statement->bindValue(':chapterId', $chapterId);
        $statement->bindValue(':block', $block);
        $statement->execute();
        $insertId = $db->lastInsertId(); // get and return the last ID that was generated
        $statement->closeCursor();
    } catch (PDOException $e) {
        # $error_message = $e->getMessage();
        # display_db_error($error_message);
        return 0;
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

?>