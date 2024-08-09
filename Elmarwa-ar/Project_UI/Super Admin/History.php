<?php
session_start();
ini_set("display_errors", 0);
if (strlen($_SESSION['login']) !== 0) {
$connect = new mysqli("localhost", "root", "", "hms");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سجل الحجوزات</title>
    <link rel="stylesheet" href="../css/med record.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./photo/logo.png">
</head>

<body>
    <div class="min-h-full">
    <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="./Reservations.php.php"><img class="h-13 w-16" src="./photo/logo.png"></a>
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="./super-Dashboard.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">لوحه التحكم</a>
                                <a href="./super-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">الحجوزات</a>
                                <a href="./super-Payments.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">المدفوعات</a>
                                <a href="./super-user-log.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">المستخدمين</a>
                                <a href="./History.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">سجل الحجوزات</a>
                                <a href="./Add user.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">اضافه مسستخدم جديد</a>
                                <a href="./Add Item.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">اضافه غرفه جديده</a>
                                <a href="./Add type.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">اضافه نوع غرفه </a>
                                <a href="./Rooms.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">الغرف</a>
                                <a href="./Reminds.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">البواقي</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">تسجيل خروج</a>
                </div>
            </div>
        </nav>
                    <a href=" /Elmarwa/admin-log/index.php" class=" float-end text-gray-500 hover:bg-gray-300 hover:text-black rounded-md px-1 py-2 text-sm font-medium">`EN`</a>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">سجل الحجوزات</h1>
            </div>
        </header>

        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                <div class="flex flex-wrap w-full">

                    <form class="space-y-6 flex flex-wrap p-3" action="./History-ser.php" method="POST">
                        <div class="px-3 py-1.5">
                            <label for="Search" class="flex text-sm font-medium text-gray-900">بحث</label>
                            <div class="mt-2">
                                <input id="Search" name="input" type="Search" required class="font-bold block w-26 rounded-md border-2 px-4 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="px-3 py-1.5">
                            <button name="search1" type="submit" class="flex w-20 justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">بحث</button>
                        </div>
                    </form>

                        <form class="space-y-12 flex flex-wrap p-3" action="./History-ser-date.php" method="POST">
                        <div class="px-3 py-1.5">
                            <div class="mt-2">
                                <label for="Search" class="flex text-sm font-medium text-gray-900">من</label>
                                <input id="Search" name="input2" type="date" required class="font-bold block w-26 rounded-md border-2 px-4 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <label for="Search" class="flex text-sm font-medium text-gray-900">الى</label>
                                <input id="Search" name="input3" type="date" required class="font-bold block w-26 rounded-md border-2 px-4 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="px-3 py-1.5">
                            <button name="search2" type="submit" class="flex w-20 justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">بحث</button>
                        </div>
                    </form>

                </div>
                <table id="zxc" class=" w-full table table-striped table-hover table-bordered border-gray-400">
                <thead>
                        <tr>
                        <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">اسم النزيل</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">رقم الهاتف</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">الرقم القومي</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">تاريخ الدخول</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">تاريخ الخروج</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">ملاحظات</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">طباعه </p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">باستخدام</p>
                            </th>
                            <th scope="col">
                                <p class="text-lg leading- font-bold text-gray-900 text-center">انهاء الحجز</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php
                        $sql = mysqli_query($connect, "SELECT * from appointment join rooms on rooms.id=appointment.roomID ORDER BY apid DESC LIMIT 30");
                        while ($row = mysqli_fetch_array($sql)) {
                            ?>
                            <tr>
                            <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['client_name']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['client_phone']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['client_id']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['check_in']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['check_out']; ?></p>
                                </th>
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">
                                        <details>
                                                <summary>Comment</summary>
                                                <p><?php echo $row['commnet']; ?></p>
                                    </details>
                                </p>
                                </th>
                                <th scope="col">
                                    <form method="get">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center"><a href="./receipt.php?id=<?php echo $row['apid']; ?>" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-green-700 ring-1 ring-inset ring-green-600/20">عرض</a></p>
                                    </form>
                                </th> 
                                <th scope="col">
                                    <p class="text-lg leading- font-bold text-gray-900 text-center">
                                        <?php echo $row['employname']; ?>
                                    </p>
                                </th>
                                                                <?php
                                                                if (isset($_GET['cancel'])) {
                                                                    mysqli_query($connect, "UPDATE rooms set statue ='0' where id = " . $_GET['id'] . "");
                                                                    echo "<script>window.location.href = './History.php';</script>";
                                                                }

                                                                ?>
                                                                <?php
                                if (isset($_GET['cancel'])) {
                                    mysqli_query($connect, "UPDATE appointment set apstatue ='0' where apid = " . $_GET['id'] . "");
                                    mysqli_query($connect, "UPDATE rooms set statue ='2' where id = " . $_GET['rid'] . "");
                                    echo "<script>window.location.href = './History.php';</script>" ;
                                }
                                ?>

                                <th scope="col">
                                        <?php if (($row['apstatue'] == 1) && ($row['remind'] == 0)) { ?>
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"> 
                                        <a href="./History.php?id=<?php echo $row['apid']; ?>&rid=<?php echo $row['id']; ?>&cancel=update" onClick="return confirm('Are You Sure You Want To End This Reservation ?');" class=" text-lg inline-flex items-center rounded-md bg-green-50  px-2 py-1 font-medium text-red-700 ring-1 ring-inset ring-red-600/20"> انهاء </a>
                                            </p>
                                        <?php } else if (($row['apstatue'] == 1) && ($row['remind'] != 0)) { ?>
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">
                                        <a href="./Reminds.php" class=" text-lg inline-flex items-center rounded-md bg-green-50  px-2 py-1 font-medium text-red-700 ring-1 ring-inset ring-red-600/20"> دفع الباقي </a>
                                        </p>
                                        <?php } else if (($row['apstatue'] == 0)) { ?>
                                            <p class="text-lg leading- font-bold text-gray-900 text-center">
                                            <button class=" text-lg inline-flex items-center rounded-md bg-green-50  px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20"> تم الانهاء </button>
                                            </p>
                                </th>
                            </tr>
                    </tbody>
                <?php }
                        } ?>
                </table>

                

                <button class=" text-lg inline-flex items-center rounded-md bg-green-50  px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20" onclick="printTable()">طباعه</button>
<script>
    function printTable() {
        // Hide input fields and forms
        var forms = document.querySelectorAll("form, input[type='search'], input[type='date'], button");
        for (var i = 0; i < forms.length; i++) {
            forms[i].style.display = "none";
        }

  window.onbeforeprint = function() {
        const table = document.getElementById('zxc');
        for (let i = 5; i < table.rows[0].cells.length; i++) {
            table.rows[0].cells[i].style.display = 'none'; // Hide headers
            for (let j = 0; j < table.rows.length; j++) {
                table.rows[j].cells[i].style.display = 'none'; // Hide data cells
            }
        }
    };

        // Print the table
        window.print();

        // Restore visibility after printing (optional)
        for (var i = 0; i < forms.length; i++) {
            forms[i].style.display = "block";
        }
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName("th, td");
            for (var j = 0; j < cells.length; j++) {
                cells[j].style.display = "table-cell";
            }
        }
    }
</script>



            </div>
        </main>
</body>
        <?php
    } else if (strlen($_SESSION['login']) == 0) {
        echo "<script>alert('انت غير مُسجل دخول سجل دخول الان');
              window.location.href = '/Elmarwa-ar/admin-log/index.php';</script>";
    }
        ?>
</html>