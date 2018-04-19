// Team 16 Bookstore (main.js)
// Author: Ben Holzhauer
// Class: CS 405G-001

window.onload = function () {

    // Get session data from server to check if user is logged in
    $.get("server.php", function (data) {
        // Check if user is logged in
        if (data) {
            // Check if user is manager
            if (data == "manager") {
                // Show manager options in navigation bar and on main page
                $("#manageNav").show();
                $("#manageLink").show();
            }
            else {
                // Redirect to home if trying to use manager options as customer
                if (window.location.href.indexOf("manage") >= 0) {
                    window.location.href = "index.html";
                }
            }

	    $("#features").show(); // Show user options in navigation bar
            $("#login").hide(); // Hide log in content from main page
            $("#choices").show(); // Show user options on main page
            $("#loginNav").hide(); // Hide log in link
            $("#signupNav").hide(); // Hide sign up link
            $("#logoutNav").show(); // Show log out link

            // Redirect to home if trying to sign up when already logged in
            if (window.location.href.indexOf("signup") >= 0) {
                window.location.href = "index.html";
            }
        }
        else {
            // Redirect to home if trying to use options when logged out
            if (window.location.href.indexOf("search") >= 0
                || window.location.href.indexOf("order") >= 0
                || window.location.href.indexOf("review") >= 0
                || window.location.href.indexOf("history") >= 0
                || window.location.href.indexOf("manage") >= 0) {
                window.location.href = "index.html";
            }
        }
    });

    // Check for log in form submissions
    $("#login form").submit(function () {
        // Redirect to home while still sending data to server
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function () {
                window.location.href = "index.html";
            }
        });
        return false;
    });

    // Check for sign up form submissions
    $("#signup form").submit(function () {
        // Redirect to home while still sending data to server
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function () {
                window.location.href = "index.html";
            }
        });
        return false;
    });

    // Check for search form submissions
    $("#search form").submit(function (e) {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function (response) {
                console.log(response);

                // Show results table
                $("#results").show();

                // Highlight search term in results table
                var searchTerm = "#" + $(this).find("option:selected").val();
                $("#results " + searchTerm).addClass("text-primary");

                // Disable new submissions and changing search term
                $(this).find(":submit").prop("disabled", true);
                $("#search form select").prop("disabled", true);
            }
        });
        return false;
    });

    // Sort search results on request
    $("#results").tablesorter(); // Utilize JQuery plugin
    $("#results th").click(function () {
        // Sort table by clicked column
        $("#sort").remove();
        $(this).prepend("<span id='sort'>></span>");
    });

    // Check for order form submissions
    $("#order form").submit(function () {
        // Show success message and disable new submissions
        $("#success").show();
        $(this).find(":submit").prop("disabled", true);
    });

    // Check for review form submissions
    $("#review form").submit(function () {
        // Show success message and disable new submissions
        $("#success").show();
        $(this).find(":submit").prop("disabled", true);
    });

    // Check if user checks history
    $("#historyNav a").click(function () {
        // Request history from server
        $.post("server.php", { history: true });
    });

    // Check if manage task is selected
    $("#manage select[name=task]").click(function () {
        // Show corresponding form and hide all others
        var form = "#" + $(this).find("option:selected").val();
        $(form).show();
        $("#manage form").not(form).hide();
    });

    // Check for manage form submissions
    $("#manage form").submit(function () {
        // Show success message, disable new submissions, and disable changing task
        $("#success").show();
        $(this).find(":submit").prop("disabled", true);
        $("#manage select[name=task]").prop("disabled", true);
    });

    // Check if user logs out
    $("#logoutNav a").click(function () {
        // Tell server to end session for user logging out
        $.post("server.php", { logout: true });
    });
}
