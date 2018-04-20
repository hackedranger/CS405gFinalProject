<?php
/**
 * Created by PhpStorm.
 * User: ntea222
 * Date: 4/19/2018
 * Time: 3:34 PM
 */
require_once("connect.php");
            if(isset($_POST['name'])){
                $searchTerm = $_POST['name'];
                $recordPrep = $conn->prepare("SELECT * FROM bgho224.books, bgho224.authors, bgho224.book_keywords WHERE books.name LIKE '%{$searchTerm}%' AND books.ISBN = authors.ISBN AND books.ISBN = book_keywords.ISBN");
            }
            if(isset($_POST['author'])){
                $searchTerm = $_POST['author'];
                $recordPrep = $conn->prepare("SELECT * FROM bgho224.books, bgho224.authors, bgho224.book_keywords WHERE authors.author LIKE '%{$searchTerm}%' AND authors.ISBN = books.ISBN AND books.ISBN = book_keywords.ISBN");
            }
            if(isset($_POST['pubDate'])){
                $searchTerm = $_POST['pubDate'];
                $recordPrep = $conn->prepare("SELECT * FROM bgho224.books, bgho224.authors, bgho224.book_keywords WHERE books.pubDate LIKE '%{$searchTerm}%' AND books.ISBN = authors.ISBN AND books.ISBN = book_keywords.ISBN");
            }
            if(isset($_POST['subject'])){
                $searchTerm = $_POST['subject'];
                $recordPrep = $conn->prepare("SELECT * FROM bgho224.books, bgho224.authors, bgho224.book_keywords WHERE books.subject LIKE '%{$searchTerm}%' AND books.ISBN = authors.ISBN AND books.ISBN = book_keywords.ISBN");
            }
            if(isset($_POST['price'])){
                $searchTerm = $_POST['price'];
                $recordPrep = $conn->prepare("SELECT * FROM bgho224.books, bgho224.authors, bgho224.book_keywords WHERE books.price LIKE '%{$searchTerm}%' AND books.ISBN = authors.ISBN AND books.ISBN = book_keywords.ISBN");
            }
            if(isset($_POST['keyword'])){
                $searchTerm = $_POST['keyword'];
                $recordPrep = $conn->prepare("SELECT * FROM bgho224.books, bgho224.authors, bgho224.book_keywords WHERE book_keywords.KEYWORD LIKE '%{$searchTerm}%' AND book_keywords.ISBN = books.ISBN AND books.ISBN = authors.ISBN");
            }
            try{
                $recordPrep->execute();
            }
            catch(PDOException $recordPrepError){
                echo "Error: " . $recordPrepError->getMessage();
            }
            $records = $recordPrep->fetchAll();
            foreach($records as $r){
                $title = $r['name'];
                $publisher = $r['publisher'];
                $language = $r['language'];
                $pubDate = $r['pubDate'];
                $price = $r['price'];
                $quantity = $r['QUANTITY'];
                $subject = $r['subject'];
                $summary = $r['summary'];
                $author = $r['author'];
                $keyword = $r['KEYWORDS'];
            }
        ?>