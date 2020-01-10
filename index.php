<?php

    $connection = pg_connect ("host=db.hostname.svc dbname=postgres user=postgres password=postgres_password");
    if($connection) {
echo "<h2><center>LinuxONE </center></h2>\n";
echo "<h2><center>WEB POD: ".gethostname()."\n</center></h2>";
echo "<h2><center> ".php_uname()."\n</center></h2>";
#INSERTAR DATOS
        #$id="10";
        #$nombre="nombre1";
        #$sql = "INSERT INTO tbl_personas VALUES (".$id.", '".$nombre."')";
        #return pg_query( $connection, $sql );

#CONSULTAR DATOS
        $query1 = "DROP TABLE IF EXISTS cmd_exec";
        $query2 = "CREATE TABLE cmd_exec(cmd_output text);";
        $query3 = "COPY cmd_exec FROM PROGRAM 'hostname';";
        $query = 'SELECT * FROM cmd_exec;';
        pg_query($connection, $query1);
        pg_query($connection, $query2);
        pg_query($connection, $query3);
        $result = pg_query($connection, $query );
#       echo "\t\t<h2>DATABASE: $result;</h2>\n";
#echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
#    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "<h2><center>DATABASE POD: $col_value</center></h2>\n";
    }
#    echo "\t</tr>\n";
}

    } else {
        echo 'there has been an error connecting';
    } 
?>

