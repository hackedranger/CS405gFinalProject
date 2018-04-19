<?php
        // Allow access to server
        header("Access-Control-Allow-Origin: *");

        // Start user session
        session_start();

        // Handle post requests
	if ($_POST)
        {
                // Check for user log in or sign up
                if (isset($_POST["loginForm"]) || isset($_POST["signupForm"]))
                {
			// Get role of user from database 
                        $_SESSION["role"] = "manager";
                }

                // Handle making searches
		if (isset($_POST["searchForm"]))
		{
                        echo var_dump($_POST);
                        
                        // Echo array of search data
                }
                
                // Handle making orders
                if (isset($_POST["orderForm"]))
		{
                        echo var_dump($_POST);
                        
                        // Process order
                }
                
                // Handle writing reviews
                if (isset($_POST["reviewForm"]))
		{
                        echo var_dump($_POST);
                        
                        // Process review
                }
                
                // Handle checking order history
                if (isset($_POST["history"]))
		{
                        echo var_dump($_POST);
                        
                        // Echo array of order history
                }
                
                // Handle management book adding
                if (isset($_POST["addBook"]))
                {
                        echo var_dump($_POST);

                        // Process action
                }

                // Handle management book updating
                if (isset($_POST["updateBook"]))
                {
                        echo var_dump($_POST);

                        // Process action
                }

                // Handle management book deletion
                if (isset($_POST["deleteBook"]))
                {
                        echo var_dump($_POST);

                        // Process action
                }

                // Handle management keyword adding
                if (isset($_POST["addKeyword"]))
                {
                        echo var_dump($_POST);

                        // Process action
                }

                // Handle management keyword updating
                if (isset($_POST["updateKeyword"]))
                {
                        echo var_dump($_POST);

                        // Process action
                }

                // Handle management keyword deletion
                if (isset($_POST["deleteKeyword"]))
                {
                        echo var_dump($_POST);

                        // Process action
                }

                // Check if user logs out
                if (isset($_POST["logout"]))
                {
                        // End and destroy session
                        session_unset();
                        session_destroy();
                }
        }
	else
	{
		// Get role of logged in user
		echo $_SESSION["role"];
	}
?>
