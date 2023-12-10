<?php
include '../includes/conn.php';
session_start();
$userId = $_SESSION['userId'];
$data = json_decode(file_get_contents("php://input"), true);

//********************** Add comment **************************// 

if (!empty($data['commentContent'])) {
    $commentContent = htmlspecialchars($data['commentContent']);
    $sesstionId = $data['sesstionId'];
    $articleId = $data['articleId'];

    $insert = "INSERT INTO comments (commentContent,userSession,articleId) VALUES (?,?,?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("sii", $commentContent, $sesstionId, $articleId);
    $stmt->execute();
    $stmt->close();
    echo "Comment sent successfully!";
    exit;
}
//********************** Update comment **************************//

if (!empty($data['newComment'])) {
    $commentContent = htmlspecialchars($data['newComment']);
    $commentId = $data['commentId2'];

    $update = "UPDATE comments SET commentContent = ? WHERE commentId = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("si", $commentContent, $commentId);
    $stmt->execute();
    $stmt->close();
    echo "Comment updated successfully!";
    exit;
}

//********************** Delete comment **************************// 

if (!empty($data['commentId'])) {
    $commentId =  $data['commentId'];

    $delete = "UPDATE comments SET isDeleted = 1 WHERE commentId = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    $stmt->close();
    echo "Comment deleted successfully!";
    exit;
}

if (!empty($data['commentId2'])) {
    $commentId =  $data['commentId2'];

    $delete = "UPDATE comments SET isDeleted = 0 WHERE commentId = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    $stmt->close();
    echo "Comment reverted successfully!";
    exit;
}

//********************** View comments **************************//


if (!empty($data['articleId2'])) {
    $articleId = $data['articleId2'];
    $select = "SELECT * FROM comments WHERE articleId = $articleId";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $articleId = $row['articleId'];
            $commentId = $row['commentId'];
            $userSession = $row['userSession'];
            $commentContent = htmlspecialchars_decode($row['commentContent']);
            $isDeleted = $row['isDeleted'];
            $user = "SELECT * FROM users WHERE userId = $userSession";
            $result2 = mysqli_query($conn, $user);
            $row2 = mysqli_fetch_assoc($result2);
            $userName = $row2['userName'];
            if (($isDeleted == 1 && $userId == $userSession) || isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) {
                echo '
                <div id="comment' . $commentId . '" class="flex flex-col w-full shadow-lg border-t-2 p-2 pl-4 bg-red-500/30">
                    <div class="flex w-full justify-between">
                        <h1 id="user' . $commentId . '" class="text-gray-500"><i class="bx bx-user text-gray-500 text-xl border-gray-500"></i>' . $userName . '</h1>
                        ';
                if ($userId == $userSession) {
                    echo '
                            <div>
                                <p onclick="undoDelete(' . $commentId . ',' . $articleId . ')" class="cursor-pointer underline text-gray-500">Undo</p>
                            </div>';
                } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) {
                    echo '
                            <div>
                                <p onclick="undoDelete(' . $commentId . ',' . $articleId . ')" class="cursor-pointer underline text-gray-500">Undo</p>
                            </div>';
                }
                echo '</div>
                    <p id="p' . $commentId . '">[Deleted comment]</p>
                </div>';
            } else {
                echo '
                <div id="comment' . $commentId . '" class="flex flex-col w-full shadow-lg border-t-2 p-2 pl-4">
                    <div class="flex w-full justify-between">
                        <h1 id="user' . $commentId . '" class="text-gray-500"><i class="bx bx-user text-gray-500 text-xl border-gray-500"></i>' . $userName . '</h1>
                        ';
                if ($userId == $userSession) {
                    echo '<div>
                            <i onclick="editComment(' . $commentId . ',' . $articleId . ');" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                            <i onclick="deleteComment(' . $commentId . ',' . $articleId . ')" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                          </div>';
                } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) {
                    echo '
                            <div>
                                <i onclick="editComment(' . $commentId . ',' . $articleId . ');" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                                <i onclick="deleteComment(' . $commentId . ',' . $articleId . ')" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                            </div>';
                }
                echo '</div>
                    <p id="p' . $commentId . '">' . $commentContent . '</p>
                </div>';
            }
        }
    } else {
        echo '<div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4 text-center">
            <p>No comments</p>
        </div>';
    }
}
