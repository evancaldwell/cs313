<?php
require_once $_SERVER['DOCUMENT_ROOT']."/app/models/conn_admin.php";

function addBlock($userId, $chapterId, $block) {
    // parameters are the feilds of the form that we want to insert into the db
    // pull in the database from the controller
    global $db;
                
    try {
    
        // the sql query ready to be turned into a prepared statement using the values
        $query = 'INSERT INTO blocks
                    (user_id, chapter_id, block)
                VALUES
                    (:userId, :chapterId, :block)';
                    
        // use the prepared statement by binding/matching the feilds from the form - passed 
        // in via the parameters - to the values in our sql query
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':chapterId', $chapterId);
        $stmt->bindValue(':block', $block);
        $stmt->execute();
        $insertId = $db->lastInsertId(); // get and return the last ID that was generated
        $stmt->closeCursor();

        return $insertId;
    } catch (PDOException $e) {
        # $error_message = $e->getMessage();
        # display_db_error($error_message);
        return 0;
    }
}

function getProjects($userId) {
    global $db;
    if($userId > 0) {
        try {
            $query = 'SELECT id, title FROM projects
                      WHERE user_id = :userId';

            $stmt = $db->prepare($query);
            $stmt->bindValue(':userId', $userId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    } else {
        echo 'There is a problem with the user id.';
    }
}

function getChapters($userId) {
    global $db;
    if($userId > 0) {
        try {
            $query = 'SELECT c.id, c.chapter, c.title FROM chapters c 
                      INNER JOIN projects p ON p.id = c.project_id
                      WHERE p.user_id = :userId
                      ORDER BY c.id';

            $stmt = $db->prepare($query);
            $stmt->bindValue(':userId', $userId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    } else {
        echo 'There is a problem with the user id.';
    }
}

function getBlocks($userId, $chapterId) {
    global $db;
    if($userId > 0) {
        try {
            $query = 'SELECT * FROM blocks
                      WHERE user_id = :userId
                      AND chapter_id = :chapterId';

            $stmt = $db->prepare($query);
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':chapterId', $chapterId);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $stmt->closeCursor();
            return $result;
        } catch (Exception $e) {
            // handle exception
            echo 'there was some exception in the model';
        }
    } else {
        echo 'There is a problem with the user id.';
    }
}

?>