<?php
include '../includes/conn.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);

//********************** Add tag **************************// 

if (!empty($data['tagName'])) {
    $tagName = $data['tagName'];

    // Check if the tagName already exists
    $checkQuery = "SELECT COUNT(*) as count FROM tags WHERE tagName = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $tagName);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $tagCount = $checkResult->fetch_assoc()['count'];

    if ($tagCount > 0) {
        return false;
    } else {
        $insert = "INSERT INTO tags (tagName) VALUES (?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("s", $tagName);
        $stmt->execute();
        $stmt->close();
        echo "Tag inserted successfully!";
    }
    exit;
}

//********************** Delete tag **************************// 

if (!empty($data['tagId'])) {
    $tagId =  $data['tagId'];

    $delete = "DELETE FROM tags WHERE tagId = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $tagId);
    $stmt->execute();
    $stmt->close();
}

//********************** Update tag **************************//

if (!empty($data['tagName2'])) {
    $tagId = $data['tagId3'];
    $tagName = $data['tagName2'];

    $checkQuery = "SELECT COUNT(*) as count FROM tags WHERE tagName = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $tagName);
    $stmt->execute();
    $result2 = $stmt->get_result();
    $tagCount2 = $result2->fetch_assoc()['count'];

    if ($tagCount2 > 0) {
        return false;
    } else {
        $update = "UPDATE tags SET tagName = ? WHERE tagId = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("si", $tagName, $tagId);
        $stmt->execute();
        $stmt->close();
        echo "Tag inserted successfully!";
    }
    exit;
}
?>

<?php
$select = "SELECT * FROM comments WHERE articleId = $articleId";
$result = mysqli_query($conn, $select);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $userSession = $row['userSession'];
        $commentContent = $row['commentContent'];
        $user = "SELECT * FROM users WHERE userId = $userSession";
        $result2 = mysqli_query($conn, $user);
        $row2 = mysqli_fetch_assoc($result2);
        $userName = $row2['userName'];
?>
        <div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4">
            <h1 class="text-gray-500"><i class='bx bx-user text-gray-500 text-xl rounded-xl border-gray-500'></i><?= $userName ?></h1>
            <p><?= $commentContent ?></p>
        </div>
    <?php }
} else { ?>
    <div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4 text-center">
        <p>No comments</p>
    </div>
<?php    } ?>