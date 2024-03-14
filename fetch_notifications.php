<?php
include('connection.php');

$lastFetchTime = isset($_GET['lastFetchTime']) ? $_GET['lastFetchTime'] : 0;
$logname = $_GET['logname'];

$sql = "SELECT * FROM jobcreate WHERE cus_date > '$lastFetchTime' ORDER BY id DESC LIMIT 1";

$result = $db->query($sql);

$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = [
            'clientname' => $row['clientname'],
            'assigned_by' => $row['assigned_by']
        ];
    }
} else {
    $notifications[] = ['message' => 'No new notifications.'];
}

$db->close();

header('Content-Type: application/json');
echo json_encode($notifications);
echo json_encode($data);
?>
