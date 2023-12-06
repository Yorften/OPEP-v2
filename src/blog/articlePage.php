<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../includes/head.html"); ?>
    <title>Document</title>
</head>

<body>
    <?php include("../includes/nav_blog.php"); ?>
    <h1 class="text-center text-lg m-5">Our Blog</h1>
    <div class="flex justify-between">
        <div class="w-full m-6">
            <p class=" bg-white ">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Voluptatem
                repellendus
                dolorem
                distinctio
                maiores
                quam nulla, eum sunt quo sapiente perferendis qui suscipit consectetur veritatis. Eligendi cupiditate
                sequi delectus consequatur provident. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam
                totam dolorem, vero iste, tenetur quibusdam vitae voluptatem ipsam blanditiis saepe quae! Aut
                voluptatibus quam error delectus quas! Unde, doloribus repellat.</p>
        </div>

        <aside class="flex justify-end w-full p-6 rounded-lg ">
            <nav class="w-96 flex justify-center">
                <div class=" bg-white shadow-lg shadow-gray-300 m-7 p-4  align-middle w-11/12 rounded-lg">
                    <h3 class="flex justify-between text-white-50"> <a href="./articles.php">Title</a> <span
                            class=" text-xl cursor-pointer hover:text-green-300 "><i
                                class='bx bx-bookmark w-6'></i></span>
                    </h3>
                </div>
            </nav>
        </aside>
    </div>

    <div class="flex w-full bg-white">
        <div class="py-10">
            <textarea placeholder="Add your comment..."
                class="p-2 focus:outline-1 focus:outline-blue-500 font-bold border-[0.1px] resize-none h-[120px] border-[#9EA5B1] rounded-md w-[60vw]"></textarea>
            <div class="flex justify-end">
                <button
                    class="text-sm font-semibold absolute bg-[#4F46E5] w-fit text-white py-2 rounded px-3">Post</button>
            </div>
        </div>
    </div>
    </div>
    <?php include("../includes/footer_blog.html"); ?>
</body>

</html>