<?php
include("../includes/conn.php");
session_start();

if (isset($_SESSION['administrator_name']) || isset($_SESSION['admin_name'])) {

    $data = json_decode(file_get_contents("php://input"), true);

    //********************** Add tag **************************// 

    if (!empty($data['tagName'])) {
        $tagName =  $data['tagName'];

        $insert = "INSERT INTO tags (tagName) VALUES (?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("s", $tagName);
        $stmt->execute();
        $stmt->close();
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

        $stmt->close();
    }

    //********************** Update tag **************************//

    if (!empty($data['tagId2'])) {
        $tagId =  $data['tagId2'];

        $select = "SELECT * FROM tags WHERE tagId = ?";
        $stmt = $conn->prepare($select);
        $stmt->bind_param("i", $tagId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
        exit;
    }

    if (!empty($data['tagName2'])) {
        $tagId = $data['tagId3'];
        $tagName = $data['tagName2'];

        $update = "UPDATE tags SET tagName = ? WHERE tagId = ?";
        $stmt = $conn->prepare($update);
        $stmt->bind_param("si", $tagName, $tagId);
        $stmt->execute();
        $stmt->close();
        exit;
    }

 
        $records = $conn->query("SELECT * FROM tags");
        $rows = $records->num_rows;
    
        $start = 0;
        $rows_per_page = 8;
        if (isset($_GET['page'])) {
            $page = $_GET['page'] - 1;
            $start = $page * $rows_per_page;
        }
        $select = "SELECT * FROM tags LIMIT ?,?";
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
                                        <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Tag Id</th>
                                        <th class="w-3/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Name</th>
                                        <th class="w-1/5 px-4 py-2 border-2 border-[#A3A3A3] text-xs md:text-base">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">';
    
            while ($row = mysqli_fetch_assoc($result)) {
                $name = htmlspecialchars($row['tagName']);
                $id = htmlspecialchars($row['tagId']);
    
    
                echo "
                            <tr>
                                <td class='px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base'>$id</td>
                                <td class='px-4 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base'>$name</td>
                                <td class='px-1 py-2 border-2 text-center border-[#A3A3A3] text-xs md:text-base'>
                                    <button onclick='showTagDetails($id)' class='px-2 rounded-md bg-amber-500'> Modify </button>
                                    <button onclick='deleteTag($id)' class='px-2 rounded-md bg-red-500'> Delete </button>
                                </td>
                            </tr>";
            }
        } else {
    
    
            echo '
           <div class="w-full h-[100vh] flex items-center justify-center">
                <p>No tags in database</p>
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
