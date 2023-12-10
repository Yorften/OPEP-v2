<?php
include '../includes/conn.php';
session_start();
$userId = $_SESSION['userId'];
$data = json_decode(file_get_contents("php://input"), true);

//********************** Update comment **************************//

if (!empty($data['articleId3'])) {
    $articleId = $data['articleId3'];
    $themeId = $data['themeId'];
    $tag = $data['tag'];
    $title = $data['title'];
    $content = htmlspecialchars($data['content']);
    $content = str_replace("\n", '&#10;', $content);
    if ($tag === 'NULL') {
        $tag = NULL;
    }
    if ($themeId === 'NULL') {
        $themeId = 0;
    }

    $update = "UPDATE articles SET articleTitle = ?, articleContent = ?, articleTag = ?, themeId = ?  WHERE articleId = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("sssii", $title, $content, $tag, $themeId, $articleId);
    $stmt->execute();
    $stmt->close();
    echo "Article updated successfully!";
    exit;
}

//********************** Get tags **************************//

if (!empty($data['themeId2'])) {
    $themeId = $data['themeId2'];

    $select = "SELECT * FROM tags_themes JOIN tags ON tags_themes.tagId = tags.tagId WHERE themeId = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("i", $themeId);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) { ?>
        <option value="NULL" selected>None</option>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $tagName = $row['tagName'];
        ?>
            <option value="<?= $tagName ?>"><?= $tagName ?></option>
        <?php } ?>
    <?php } else { ?>
        <option value="" disabled selected hidden>No tags available</option>
    <?php }
}
//********************** Cancle Edit **************************//

if (!empty($data['articleId2'])) {
    $articleId = $data['articleId2'];
    $select = "SELECT * FROM articles JOIN users ON articles.userId = users.userId WHERE articleId = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = mysqli_fetch_assoc($result);
    $articleTitle = $row['articleTitle'];
    $articleContent = $row['articleContent'];
    $articleContent = str_replace('&#10;', "<br>", $articleContent);
    $articleUser = $row['userId'];
    $articleTag = $row['articleTag'];
    $themeId = $row['themeId'];
    $authorName = $row['userName'];
    $authorId = $row['userId'];
    $isDeleted = $row['isDeleted'];
    ?>
    <input type="hidden" name="themeId" id="themeId" value="<?= $themeId ?>">
    <div class="flex flex-row w-full gap-4 items-end mt-8 pl-4">
        <h1 id="title" class="text-2xl md:text-3xl font-medium"><?= $articleTitle ?></h1>
        <p id="tag" class="text-sm p-1 rounded-xl border border-gray-500 text-gray-500"><?= $articleTag ?></p>
    </div>
    <div class="flex flex-col w-full shadow-xl rounded-xl border">
        <div class="w-full flex justify-between items-center">
            <p class="pl-8 py-4 font-medium text-lg text-gray-600">
                <?= $authorName ?>
            </p>
            <?php if ($userId == $authorId) { ?>
                <div class="p-2">
                    <i onclick="editArticle(<?= $articleId ?>)" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                    <i onclick="openPopup()" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                </div>
            <?php } else if (isset($_SESSION['admin_name']) || isset($_SESSION['administrator_name'])) { ?>
                <div class="p-2">
                    <i onclick="editArticle(<?= $articleId ?>)" class="bx bx-edit-alt text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                    <i onclick="openPopup()" class="bx bx-message-alt-x text-gray-500 text-xl border-gray-500 cursor-pointer"></i>
                </div>
            <?php } ?>
        </div>
        <p id="content" class="p-4 md:p-8 pt-0"><?= $articleContent ?></p>
    </div>
<?php
}

//********************** Edit Article **************************//

if (!empty($data['articleId'])) {
    $articleId = $data['articleId'];
    $themeId = $data['themeId'];
    $tag = $data['tag'];
    $title = $data['title'];
    $content = htmlspecialchars($data['content']);
?>
    <input type="text" name="title" id="title" placeholder="Title" class="p-1 w-full text-2xl font-medium shadow-lg border-t-2 rounded-lg mt-8" value="<?= $title ?>">
    <textarea name="content" id="content" cols="30" rows="17" placeholder="Article content" class="w-full shadow-md p-1 border-t-2 rounded-lg"><?= $content?></textarea>
    <div class="flex flex-col w-full justify-center items-center md:justify-between md:flex-row">
        <select onchange="fetchTags()" name="theme" id="theme" class="block leading-5 text-gray-700 bg-white border-2 rounded-md focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300 w-[70%] md:w-[40%] h-[40px] md:mr-4">
            <option value="NULL" selected>None</option>
            <?php
            $select = "SELECT * FROM themes WHERE themeDeleted = 0";
            $result = mysqli_query($conn, $select);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $themeName = $row['themeName'];
                    $themeId = $row['themeId']
            ?>
                    <option value="<?= $themeId ?>"><?= $themeName ?></option>
                <?php }
            } else { ?>
                <option value="" disabled selected hidden>No themes available</option>
            <?php }
            ?>
        </select>
        <select name="tag" id="tag" class="block leading-5 text-gray-700 bg-white border-2 rounded-md focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-300 w-[70%] md:w-[40%] h-[40px]">
            <option value="NULL" hidden selected>Select theme first</option>
        </select>
        <div class="w-full flex justify-center mt-4 gap-4 md:justify-end md:mt-0">
            <button onclick="applyNewArticle(<?= $articleId ?>)" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg ">Apply</button>
            <button onclick="cancelEditArticle(<?= $articleId ?>)" class="px-8 py-2 bg-gray-500 border border-gray-600 text-white font-semibold rounded-lg ">Cancel</button>
        </div>
    </div>
<?php }



?>