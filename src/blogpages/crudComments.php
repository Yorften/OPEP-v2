<?php
include '../includes/conn.php';
session_start();
$userId = $_SESSION['userId'];
$data = json_decode(file_get_contents("php://input"), true);

//********************** Add tag **************************// 

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

//********************** Delete tag **************************// 

if (!empty($data['commentId'])) {
    $commentId =  $data['commentId'];

    $delete = "DELETE FROM comments WHERE commentId = ?";
    $stmt = $conn->prepare($delete);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    $stmt->close();
    echo "Comment deleted successfully!";
    exit;
}

//********************** Update tag **************************//

// if (!empty($data['tagName2'])) {
//     $tagId = $data['tagId3'];
//     $tagName = $data['tagName2'];

//     $checkQuery = "SELECT COUNT(*) as count FROM tags WHERE tagName = ?";
//     $stmt = $conn->prepare($checkQuery);
//     $stmt->bind_param("s", $tagName);
//     $stmt->execute();
//     $result2 = $stmt->get_result();
//     $tagCount2 = $result2->fetch_assoc()['count'];

//     if ($tagCount2 > 0) {
//         return false;
//     } else {
//         $update = "UPDATE tags SET tagName = ? WHERE tagId = ?";
//         $stmt = $conn->prepare($update);
//         $stmt->bind_param("si", $tagName, $tagId);
//         $stmt->execute();
//         $stmt->close();
//         echo "Tag inserted successfully!";
//     }
//     exit;
// }
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
            $user = "SELECT * FROM users WHERE userId = $userSession";
            $result2 = mysqli_query($conn, $user);
            $row2 = mysqli_fetch_assoc($result2);
            $userName = $row2['userName'];

            echo '
                <div class="flex flex-col w-full shadow-lg border-t-2 p-2 pl-4">
                    <div class="flex w-full justify-between">
                        <h1 class="text-gray-500"><i class="bx bx-user text-gray-500 text-xl border-gray-500"></i>' . $userName . '</h1>
                        ';
            if ($userId == $userSession) {
                echo '<div>
                            <i onclick="openpopup(' . $commentId . ',' . $articleId . ');" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                            <i onclick="deleteComment(' . $commentId . ')" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                          </div>';
            } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) {
                echo '
                            <div>
                                <i onclick="openpopup(' . $commentId . ',' . $articleId . ');" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                                <i onclick="deleteComment(' . $commentId . ',' . $articleId . ')" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                            </div>';
            }
            echo '</div>
                    <p>' . $commentContent . '</p>
                </div>';
        }
    } else {
        echo '<div class="flex flex-col w-full shadow-md rounded-lg border-t-2 p-2 pl-4 text-center">
            <p>No comments</p>
        </div>';
    }
}
