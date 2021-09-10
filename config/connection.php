<?php

/**
 * Connect to database
 *
 * @return mysqli
 */
function connect_db()
{
    $connect = mysqli_connect('localhost', 'root', '', 'impressgift_db');
    if (mysqli_connect_errno()) {
        echo "Connect to db failed!";
        die();
    }

    return $connect;
}

/**
 * Close connect to db
 *
 * @param mysqli $connect mysqli object
 * @return void
 */
function close_db_connect($connect)
{
    mysqli_close($connect);
}
