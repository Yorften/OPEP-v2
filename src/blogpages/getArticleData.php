<?php
include("../includes/conn.php");
session_start();

if (isset($_GET["idTh"])) {
    $output = "";

    $idTheme = $_GET["idTh"];
    echo $output = $idTheme;

    $queryTheme = "SELECT * FROM Articles WHERE themeId = ?";
    $params = array($idTheme);

    if (isset($_GET["search"])) {
        $search = $_GET["search"] . '%';
        $queryTheme .= " AND articleTitle LIKE ?";
        $params[] = $search;
    }

    $themeStm = $conn->prepare($queryTheme);

    if ($themeStm) {

        $types = str_repeat('s', count($params));
        $themeStm->bind_param($types, ...$params);


        $themeStm->execute();
        $result = $themeStm->get_result();

        if ($result->num_rows > 0) {
            while ($results = $result->fetch_assoc()) {
                $articleId = $results['articleId'];
                $articleTitle = $results['articleTitle'];
                $articleContent = $results['articleContent'];
                $userId = $results['userId'];
                // get first 30 words from article
                $words = explode(' ', $articleContent);
                $articleDesc = implode(' ', array_slice($words, 0, 30));

                $output .= '
                <div class=" bg-white shadow-lg shadow-gray-300 m-4 p-4 rounded-lg">

                <a href="articlePage.php?article=' . $articleId . '" class="flex justify-between text-white-50 font-medium hover:text-gray-500">' . $articleTitle . '</a>
                <p class="text-gray-800 m-2">' . $articleDesc . '...<span><a href="articlePage.php?article=' . $articleId . '"><span class="hover:text-gray-500 font-medium">Read more</span></a></span></p>
                <div class="flex justify-between m-1">
                    <small class="text-gray-500 flex items-center">
                        <i class="bx bx-user text-black text-xl rounded-xl border-black"></i>
                        <p>Poted By' . $userName . '</p>
                    </small>
                </div>
            </div>
                ';
            }
            echo $output;
        } else {
            echo $output .= "not found";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
