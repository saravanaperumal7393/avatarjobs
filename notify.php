<?php
 include('connection.php');
session_start();


?>

<!doctype html>
<html lang="en">
    
<div class="icons">
                                <div class="notification">
                                    <a href="#">
                                        <div class="notBtn">
                                            <div class="number"></div>
                                            <i class="fa fa-bell"></i>
                                            <div class="box">
                                            <div id="notificationContainer">
    <!-- Existing notifications will be dynamically added here -->
                                            </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Function to fetch and update notifications
function fetchNotifications() {
    $.ajax({
        url: 'fetch_notifications.php',
        method: 'GET',
        success: function (data) {
            const notificationContainer = $('#notificationContainer');
            notificationContainer.html(data); // Update with new notifications
        },
        error: function (error) {
            console.error('Error fetching notifications:', error);
        }
    });
}

// Fetch notifications every few seconds (e.g., every 10 seconds)
// setInterval(fetchNotifications, 10000); // Adjust the interval as needed

</script>

</html>