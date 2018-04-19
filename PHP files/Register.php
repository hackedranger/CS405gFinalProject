<?php
/**
 * Created by PhpStorm.
 * User: ntea222
 * Date: 4/19/2018
 * Time: 2:27 PM
 */
require_once("connect.php");
?>
<!-- Team 16 Bookstore (signup.html) -->
<!-- Author: Ben Holzhauer -->
<!-- Class: CS 405G-001 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Team 16 Bookstore - Sign Up</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/main.css">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="scripts/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="scripts/main.js"></script>
</head>

<body>
    <div id="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand">Team 16 Bookstore</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li id="loginNav" class="nav-item">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/">Log In</a>
                    </li>
                    <li id="signupNav" class="nav-item">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/signup">Sign Up</a>
                    </li>
                    <li id="logoutNav" class="nav-item" style="display: none">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/">Log Out</a>
                    </li>
                </ul>
                <ul id="features" class="navbar-nav ml-auto" style="display: none">
                    <li class="nav-item">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/search">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/order">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/review">Review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/history">History</a>
                    </li>
                    <li id="manageNav" class="nav-item" style="display: none">
                        <a class="nav-link" href="/~bgho224/CS405G/web-app/manage">Manage</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="signup" class="container mt-4 pb-4">
            <h3>Sign Up</h3>
            <br>
            <form method="POST" action="RegisterProcess.php">
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength=50 placeholder="YOUR EMAIL" required>
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" class="form-control" id="password" name="password" maxlength=50 placeholder="YOUR PASSWORD" required>
                </div>
                <div class="form-group">
                    <label for="role">Role*</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="customer">Customer</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <label for="fname">First Name*</label>
                    <input type="text" class="form-control" id="fname" name="fname" maxlength=30 placeholder="YOUR FIRST NAME" required>
                </div>
                <div class="form-group">
                    <label for="mname">Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" maxlength=30 placeholder="YOUR MIDDLE NAME">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name*</label>
                    <input type="text" class="form-control" id="lname" name="lname" maxlength=30 placeholder="YOUR LAST NAME" required>
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" placeholder="YOUR AGE">
                </div>
                <div class="form-group">
                    <label for="gender">Gender*</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option>Choose not to specify</option>
                    </select>
                </div>
                <input type="hidden" name="signupForm">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            <br>
            <p>Already have an account?
                <a href="/~bgho224/CS405G/web-app/">Log In</a>
            </p>
        </div>
    </div>
</body>

</html>