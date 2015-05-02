<?php

#Edit the database path (usually localhost, but check with your Webhost or server administrator if another
#database path is required), database name and database password in that order. Do not delete the quotes!

function db_connect()
{
   $result = @mysql_pconnect('localhost', 'username', 'password');
   if (!$result)
      return false;
   if (!@mysql_select_db('db_name'))
      return false;

   return $result;
}
?>
