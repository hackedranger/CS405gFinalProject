<?php
	// Team 16 Bookstore (server.php)
	// Authors: Ben Holzhauer (PHP), Nicholas Early (SQL)
	// Class: CS 405G-001
	
        // Allow access to server
        header("Access-Control-Allow-Origin: *");

	// Set up database connection
	$conn = mysqli_connect("mysql.cs.uky.edu", "bgho224", "team16", "bgho224");	
        
	// Start user session if not active
        if (!$_SESSION)
	{
		session_start();
	}

        // Handle post requests
	if ($_POST)
        {
		// Check for user log in
		if (isset($_POST["loginForm"]))
		{
			$email = $_POST["email"];
			$password = $_POST["password"];

			$userResults = mysqli_query($conn, "SELECT uid, role FROM users WHERE email='{$email}' AND password='{$password}'");
                        if ($userResults)
                        {
                                $row = mysqli_fetch_row($userResults);
                                $_SESSION["uid"] = $row[0];
                                $_SESSION["role"] = $row[1];

                                mysqli_free_result($userResults);

                                echo "USER LOGGED IN";
			}
		}

                // Check for user sign up
                if (isset($_POST["signupForm"]))
                {
			$email = $_POST["email"];
			$password = $_POST["password"];
			$role = $_POST["role"];
			$fname = $_POST["fname"];
			
			$mname = "'" . $_POST["mname"] . "'";
			if (!$_POST["mname"])
			{
				$mname = "null";
			}

			$lname = $_POST["lname"];
			
			$age = $_POST["age"];
			if (!$age)
			{
				$age = "null";
			}			

			$gender = $_POST["gender"];

			$signupResults = mysqli_query($conn, "INSERT INTO users(email, password, role, fname, mname, lname, age, gender) VALUES ('{$email}', '{$password}', '{$role}', '{$fname}', {$mname}, '{$lname}', {$age}, '{$gender}')");
			if ($signupResults)
			{
				$uidResults = mysqli_query($conn, "SELECT MAX(uid) FROM users");
				if ($uidResults)
				{
					$row = mysqli_fetch_row($uidResults);
					$_SESSION["uid"] = $row[0];
                        		$_SESSION["role"] = $role;

					mysqli_free_result($uidResults);
				}
			
				echo "USER SIGNED UP";

				mysqli_free_result($signupResults);
			}
		}

                // Handle making searches
		if (isset($_POST["searchForm"]))
		{
			$term = $_POST["searchTerm"];
			$words = $_POST["searchWords"];
			
			if ($term == "b.price")
			{
				$searchResults = mysqli_query($conn, "SELECT b.isbn, b.name, a.author, b.publisher, b.pubDate, b.subject, b.price, b.quantity, k.keyword FROM books AS b, authors AS a, book_keywords AS k WHERE b.price <= {$words} AND b.isbn=a.isbn AND b.isbn=k.isbn");
			}
			else
			{
                        	$searchResults = mysqli_query($conn, "SELECT b.isbn, b.name, a.author, b.publisher, b.pubDate, b.subject, b.price, b.quantity, k.keyword FROM books AS b, authors AS a, book_keywords AS k WHERE {$term} LIKE '%{$words}%' AND b.isbn=a.isbn AND b.isbn=k.isbn");
			}

			if ($searchResults)
			{
				$books = [];
				while ($row = mysqli_fetch_row($searchResults))
				{
					$books[] = $row;
				}

				echo json_encode($books);
	
				mysqli_free_result($searchResults);
			}
                }

		// Check for list of book request
		if (isset($_POST["getBooks"]))
		{
			$bookResults = mysqli_query($conn, "SELECT b.name, a.author, b.isbn FROM books AS b, authors AS a WHERE b.isbn=a.isbn");
			if ($bookResults)
			{
				$books = [];
				while ($row = mysqli_fetch_row($bookResults))
				{
					$books[] = [$row[0], $row[1], $row[2]];
				}

				echo json_encode($books);

				mysqli_free_result($bookResults);
			}
		}
                
                // Handle making orders
                if (isset($_POST["orderForm"]))
		{
                        $uid = $_SESSION["uid"];
			$isbn = $_POST["book"];
			$ccNumber = $_POST["ccNumber"];
			$quantity = $_POST["quantity"];
			$billingAddr = $_POST["billingAddr"];
			$shippingAddr = $_POST["shippingAddr"];

			$priceResults = mysqli_query($conn, "SELECT price FROM books WHERE isbn={$isbn}");
			if ($priceResults)
			{
				$row = mysqli_fetch_row($priceResults);
				$cost = $row[0] * $quantity;
			
				mysqli_free_result($priceResult);
			
				$orderResults = mysqli_query($conn, "INSERT INTO orders (uid, isbn, ccNumber, cost, status, quantity, billingAddr, orderDate, shippingAddr) VALUES ({$uid}, {$isbn}, {$ccNumber}, {$cost}, 'Pending', {$quantity}, '{$billingAddr}', NOW(), '{$shippingAddr}')");
				if ($orderResults)
				{
					echo "ORDER PROCESSED";

					mysqli_free_result($orderResults);
				}
                	}
		}
                
                // Handle writing reviews
                if (isset($_POST["reviewForm"]))
		{
                        $uid = $_SESSION["uid"];
			$isbn = $_POST["book"];
			$rating = $_POST["rating"];
			$review = $_POST["review"];

			$reviewResults = mysqli_query($conn, "INSERT INTO reviews (uid, isbn, rating, review) VALUES ({$uid}, {$isbn}, {$rating}, '{$review}')");
			if ($reviewResults)
			{
				echo "REVIEW WRITTEN";
			
				mysqli_free_result($reviewResults);
			}
                }
                
                // Handle checking order history
                if (isset($_POST["history"]))
		{
                        $uid = $_SESSION["uid"];

                        $historyResults = mysqli_query($conn, "SELECT o.orderDate, o.isbn, b.name, a.author, o.quantity, o.cost, o.shippingAddr, o.status, o.ccNumber, o.billingAddr FROM orders AS o, books AS b, authors AS a WHERE o.uid={$uid} AND o.isbn=b.isbn AND b.isbn=a.isbn");
			if ($historyResults)
                        {
                                $history = [];
                                while ($row = mysqli_fetch_row($historyResults))
                                {
                                        $history[] = $row;
                                }

                                echo json_encode($history);

                                mysqli_free_result($historyResults);
                        }
                }
                
                // Handle management book adding
                if (isset($_POST["addBook"]))
                {
                        $isbn = $_POST["isbn"];
                        $name = $_POST["name"];
			$author = $_POST["author"];
			$publisher = $_POST["publisher"];
			$pubDate = $_POST["pubDate"];
			$subject = $_POST["subject"];
			
			$summary = "'" . $_POST["summary"] . "'";
			if (!$_POST["summary"])
                        {
                                $summary = "null";
                        }

			$price = $_POST["price"];
			$quantity = $_POST["quantity"];
		
                        $addBookResults = mysqli_query($conn, "INSERT INTO books (isbn, name, publisher, pubDate, subject, summary, price, quantity) VALUES ({$isbn}, '{$name}', '{$publisher}', '{$pubDate}', '{$subject}', {$summary}, {$price}, {$quantity})");
                        if ($addBookResults)
                        {
                                mysqli_free_result($addBookResults);

				$addAuthorResults = mysqli_query($conn, "INSERT INTO authors (author, isbn) VALUES ('{$author}', {$isbn})");
				if ($addAuthorResults)
				{
					echo "BOOK ADDED";

					mysqli_free_result($addAuthorResults);
				}
			}
                }

                // Handle management book updating
                if (isset($_POST["updateBook"]))
                {
                	$oldIsbn = $_POST["book"];

			$isbn = $_POST["isbn"];
			if ($isbn)
			{
				$isbn = "isbn=" . $isbn . ", ";
			}

			$name = $_POST["name"];
			if ($name)
			{
				$name = "name='" . $name . "', ";
			}

			$author = $_POST["author"];
			if ($author)
			{
				$author = "author='" . $author . "'";
			}

			$publisher = $_POST["publisher"];
			if ($publisher)
			{
				$publisher = "publisher='" . $publisher . "', ";
			}

                        $pubDate = $_POST["pubDate"];
			if ($pubDate)
			{
				$pubDate = "pubDate=" . $pubDate . ", ";
			}

                        $subject = $_POST["subject"];
			if ($subject)
			{
				$subject = "subject='" . $subject . "', ";
			}

			$summary = $_POST["summary"];
			if ($summary)
			{
				$summary = "summary='" . $summary . "', ";
			}

			$price = $_POST["price"];
			if ($price)
			{
				$price = "price=" . $price . ", ";
			}

			$quantity = $_POST["quantity"];
			if ($quantity)
			{
				$quantity = "quantity=" . $quantity . ", ";
			}

			$updateBookResults = mysqli_query($conn, "UPDATE books SET {$isbn}{$name}{$publisher}{$pubDate}{$subject}{$summary}{$price}{$quantity}language=null WHERE isbn={$oldIsbn}");
                	if ($updateBookResults)
			{
				echo "BOOK UPDATED";

				mysqli_free_result($updateBookResults);
			}

			if ($author)
			{
				$updateAuthorResults = mysqli_query($conn, "UPDATE authors SET {$isbn}{$author} WHERE isbn={$oldIsbn}");
				if ($updateAuthorResults)
				{
					echo "AUTHOR UPDATED";
	
					mysqli_free_result($updateAuthorResults);
				}
			}
		}

                // Handle management book deletion
                if (isset($_POST["deleteBook"]))
                {
                	$isbn = $_POST["book"];

			$deleteAuthorResults = mysqli_query($conn, "DELETE FROM authors WHERE isbn={$isbn}");
			if ($deleteAuthorResults)
			{
				mysqli_free_result($deleteAuthorResults);

				$deleteBookResults = mysqli_query($conn, "DELETE FROM books WHERE isbn={$isbn}");
                       		if ($deleteBookResults)
                       		{
					echo "BOOK DELETED";
					
					mysqli_free_result($deleteBookResults);
				}
				
			}
                }

                // Handle management keyword adding
                if (isset($_POST["addKeyword"]))
                {
                        $isbn = $_POST["book"];
                        $keyword = $_POST["keyword"];
			
			$addKeywordResults = mysqli_query($conn, "INSERT INTO book_keywords(isbn, keyword) VALUES ({$isbn}, '{$keyword}')");
                        if ($addKeywordResults)
                        {
				echo "KEYWORD ADDED";

                                mysqli_free_result($addKeywordResults);
                        }
                }

                // Handle management keyword updating
                if (isset($_POST["updateKeyword"]))
                {
                        $oldKeyword = $_POST["oldKeyword"];
			$newKeyword = $_POST["newKeyword"];

			$updateKeywordResults = mysqli_query($conn, "UPDATE book_keywords SET keyword='{$newKeyword}' WHERE keyword='{$oldKeyword}'");
			if ($updateKeywordResults)
			{
				echo "KEYWORD UPDATED";
		
				mysqli_free_result($updateKeywordResults);
			}
                }

                // Handle management keyword deletion
                if (isset($_POST["deleteKeyword"]))
                {
                        $keyword = $_POST["keyword"];

			$deleteKeywordResults = mysqli_query($conn, "DELETE FROM book_keywords WHERE keyword='{$keyword}'");
			if ($deleteKeywordResults)
			{
				echo "KEYWORD DELETED";

				mysqli_free_result($deleteKeywordResults);
			}
                }

                // Check if user logs out
                if (isset($_POST["logout"]))
                {
			echo "USER LOGGED OUT";

                        // End and destroy session
                        session_unset();
                        session_destroy();
                }
        }
	else
	{
		// Get UID and role of current user
		echo json_encode([$_SESSION["uid"], $_SESSION["role"]]);
	}

	// Close database connection
	$conn->close();
?>
