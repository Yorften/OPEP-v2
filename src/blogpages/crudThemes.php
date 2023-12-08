<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['administrator_name']) || isset($_SESSION['admin_name'])) {

    $data = json_decode(file_get_contents("php://input"), true);

    //********************** Add theme **************************// 

    if (!empty($data['themeName'])) {
        $themeName = $data['themeName'];
        $themeTagsId = $data['checkedValues'];

        // Check if the theme name already exists
        $checkQuery = "SELECT COUNT(*) as count FROM themes WHERE themeName = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $themeName);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $tagCount = $checkResult->fetch_assoc()['count'];

        if ($tagCount > 0) {
            return false;
        } else {
            $insert = "INSERT INTO themes (themeName) VALUES (?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("s", $themeName);
            $stmt->execute();
            $themeId = $stmt->insert_id;
            foreach ($themeTagsId as $tag) {
                $insert = "INSERT INTO tags_themes (themeId,tagId) VALUES (?,?)";
                $stmt = $conn->prepare($insert);
                $stmt->bind_param("ii", $themeId, $tag);
                $stmt->execute();
            }
            $stmt->close();
            echo "Tag inserted successfully!";
        }
        exit;
    }

    //********************** Delete theme **************************// 

    if (!empty($data['themeId'])) {
        $themeId =  $data['themeId'];
        $delete = "DELETE FROM themes WHERE themeId = ?";
        $stmt = $conn->prepare($delete);
        $stmt->bind_param("i", $themeId);
        $stmt->execute();
        $stmt->close();
    }

    //********************** Update theme **************************//

    if (!empty($data['themeName2'])) {
        $themeId = $data['themeId2'];
        $themeName = $data['themeName2'];
        $themeTagsId = $data['checkedValues2'];

        $update = "UPDATE themes SET themeName = ? WHERE themeId = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("si", $themeName, $themeId);
        $stmt->execute();
        $stmt->close();
        // delete all tags of theme to re-ensert new ones
        $delete = "DELETE FROM tags_themes WHERE themeId = ?";
        $stmt = $conn->prepare($delete);
        $stmt->bind_param("i", $themeId);
        $stmt->execute();
        $stmt->close();
        // insert new tags if not same tags again
        foreach ($themeTagsId as $tag) {
            $insert = "INSERT INTO tags_themes (themeId,tagId) VALUES (?,?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("ii", $themeId, $tag);
            $stmt->execute();
        }
        $stmt->close();
        echo "Tag inserted successfully!";
        exit;
    }




    $records = $conn->query("SELECT * FROM themes");
    $rows = $records->num_rows;

    $start = 0;
    $rows_per_page = 3;
    if (isset($_GET['page'])) {
        $page = $_GET['page'] - 1;
        $start = $page * $rows_per_page;
    }
    $select = "SELECT * FROM themes LIMIT ?,?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("ii", $start, $rows_per_page);
    $stmt->execute();
    $result = $stmt->get_result();
    $pages = ceil($rows / $rows_per_page);



    if ($rows > 0) {

        echo ' 
            <table class="table-fixed w-full ">
            <thead class="border">
                <tr class="border-2">
                    <th class="w-1/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Theme Id</th>
                    <th class="w-5/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Title</th>
                    <th class="w-4/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Tags</th>
                    <th class="w-2/12 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">';

        while ($row = mysqli_fetch_assoc($result)) {
            $themeId = htmlspecialchars($row['themeId']);
            $themeName = htmlspecialchars($row['themeName']);


            echo "
            <tr>
            <td class='px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base'>$themeId</td>
            <td class='px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base'>$themeName</td>
            <td id='tags$themeId' class='flex flex-wrap items-center justify-center px-4 py-2 text-center border-b-2 border-[#A3A3A3] text-xs md:text-base'>";
            $select = "SELECT * FROM tags_themes JOIN tags on tags_themes.tagId = tags.tagId WHERE themeId = ?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("i", $themeId);
            $stmt->execute();
            $result3 = $stmt->get_result();
            while ($row3 = mysqli_fetch_assoc($result3)) {
                $tagName = $row3['tagName'];
                $tagId = $row3['tagId'];
                echo "<span class='p-1 border-2 rounded-xl select-none border-amber-600 text-amber-600 mr-2' value='$tagId'>$tagName</span>";
            }
            echo "
            </td>
            <td class='px-1 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base'>
                <button id='showdetails' onclick=\"showThemeDetails('$themeName',$themeId)\" class='px-2 rounded-md bg-amber-500'> Modify </button>
                <button onclick='deleteTheme($themeId)' class='px-2 rounded-md bg-red-500'> Delete </button>
            </td>
        </tr>
            ";
        }
    } else {


        echo '
           <div class="w-full h-[100vh] flex items-center justify-center">
                <p>No themes in database</p>
            </div>';
    }
    echo
    '</tbody>
        </table>';




    echo '
        <div>
            <div class="pl-6">';

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    echo "Showing " . $page . "of " . $pages . "
            </div>
            <div class='flex flex-row justify-center items-center gap-3'>
    
                <a href='?page=1'>First</a>";
    if (isset($_GET['page']) && $_GET['page'] > 1) {

        echo '<a href="?page=' . ($page - 1) . '">Previous</a>';
    } else {
        echo '<a class="cursor-pointer">Previous</a>';
    }


    for ($i = 1; $i <= $pages; $i++) {

        echo '<a href="?page=' . $i . '" class="">' . $i . '</a>';
    }

    if (!isset($_GET['page'])) {
        if ($pages == 1) {

            echo '<a class="cursor-pointer">Next</a>';
        } else {
            echo '<a href="?page=2">Next</a>';
        }
    } elseif ($_GET['page'] >= $pages) {
        echo '<a class="cursor-pointer">Next</a>';
    } else {
        echo '<a href="?page=' . ($page + 1) . '">Next</a>';
    }

    echo '
        <a href="?page=' . $pages . '">Last</a>
        </div>
    </div>';
} else echo "You don't have permission";
