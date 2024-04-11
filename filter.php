<?php
/*
    "databaseConfig.php" defines 4 PHP variables:
    $dbHost, $dbUser, $dbPassword, $dbDatabase.
*/
require_once "db_connection.php";
/*
    We use configure PDO to report erros by throwing exceptions.
    So all PDO operations are put into a try-catch block.
*/

if ($_SERVER["REQUEST_METHOD"]!="GET")
	{
	http_response_code(400);	//does not support other methods
	exit(0);			//stop
	} //end else


try	{
        /*
            Connect to MySQL and set error mode.
            For MySQL connection, the data source name string is in the format:

            mysql:host=xxx;dbname=yyy
        */
        $dataSourceName="mysql:host=$dbHost;dbname=$dbDatabase;";		//compose data source name as a string
        $pdo=new PDO($dataSourceName,$dbUser,$dbPassword);	        	//create PDO object
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	//tell PDO to report errors by exceptions
        /*
            Compose SQL query and execute it.

            If there is an error in the query, the result is a false.
            In this case, all subsequent operation to result will give an exception.

            If the query is successful, result will be a PDOStatement object.
        */
        $query="select * from recipes";		//compose SQL query as a string

	/*if there is an "id" parameter*/
	$id=$_GET["id"];	//get parameter id
	if (isSet($id))
		{
		$query=$query." where id='".$id."'";	//compose query with condition on id
		$result=$pdo->query($query);		//execute query
		if ($result->rowCount()==0)		//if row count is 0, no DVD is found with this ID
			{
			http_response_code(404);	//return status code 404
			exit(0);			//stop
			}
		//otherwise return the single object retrieved
		$dvd=$result->fetchObject();		//get 1st object
		header("Content-type: application/json");	//set content-type to JSON
		http_response_code(200);		//status code 200 for OK
		echo json_encode($dvd);			//return object as JSON
		$pdo=null;				//close connection by setting PDO reference to null
		exit(0);				//stop
		}

	/*otherwise continue to see if keyword parameter is sent*/
        $keyword=$_GET["keyword"];      //look for keyword parameter in GET request
        if (isSet($keyword))
            $query=$query." where recipes.title like '%".$keyword."%'"; //append filter to SQL query

        $result=$pdo->query($query);	//execute SQL query
        header("Content-type: application/json");  //set content-type to JSON
        http_response_code(200);        //OK for retrieval

        foreach ($result as $row)       //iterate through rows in result
		{
		$toReturn[]=$row;       //append to PHP array
		}
        echo json_encode($toReturn);      //return array as JSON-formatted string

        $pdo=null;	//Destroy PDO object by removing all references to it
			//This will close the connection to MySQL.
        } catch (PDOException $exception)
		{
		/*
		In case of any exception, use PDOException::getMessage()
		to get the error as a string and output it to the web page.
		*/
		http_response_code(500);
		echo "<div class='error'>".$exception->getMessage()."</div>";
		} //end then part for GET method
?>
