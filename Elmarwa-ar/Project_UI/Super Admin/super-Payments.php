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
    <title>المدفوعات</title>
    <link rel="stylesheet" href="../css/Payments.css">
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
                                <a href="./super-Payments.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">المدفوعات</a>
                                <a href="./super-user-log.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">المستخدمين</a>
                                <a href="./History.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">سجل الحجوزات</a>
                                <a href="./Add user.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">اضافه مستخدم جديد</a>
                                <a href="./Add Item.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">اضافه غرفه جديده</a>
                                <a href="./Add type.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">اضافه نوع جديد</a>
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
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">المدفوعات</h1>
            </div>
        </header>
        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                <div class=" flex flex-wrap w-2/4">

                    <!-- <form class="space-y-6 flex flex-wrap p-3" action="./super-Payments-ser.php" method="POST">
                        <div class="px-3 py-1.5">
                            <label for="Search" class="flex text-sm font-medium text-gray-900">Search</label>
                            <div class="mt-2">
                                <input id="Search" name="input" type="Search" required class="font-bold block w-26 rounded-md border-2 px-4 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="px-3 py-1.5">
                            <button name="search" type="submit" class="flex w-20 justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Search</button>
                        </div>
                    </form> -->
                </div>
                <table class=" table table-striped table-hover table-bordered border-gray-400 ">
                    <?php
                    $id = $_GET['employId'];
                    $sqlp = "SELECT SUM(paid) AS total FROM appointment WHERE `employId` = '$id' AND check_in = CURRENT_DATE()";
                    $rxxx = mysqli_query($connect, $sqlp);
                    if (mysqli_num_rows($rxxx) > 0) {
                        while ($zxc = mysqli_fetch_assoc($rxxx)) {
                            $total = $zxc["total"]; ?>
                            <caption class="caption-bottom border-2 border-gray-400 transition ease-in-out delay-150 bg-gray-300 hover:bg-gray-400 duration-200">
                                <p class=" text-lg leading- font-bold text-center text-black p-1"> اجمالى المدفوعات [ <?php echo $total; ?> ]</p>
                        <?php }
                    } ?>
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">رقم الغرفه</p>
                                    </th>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">نوع الغرفه</p>
                                    </th>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">عدد الليالي</p>
                                    </th>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">المدفوع</p>
                                    </th>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">الباقي</p>
                                    </th>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">الموظف</p>
                                    </th>
                                    <th scope="col">
                                        <p class="text-lg leading- font-bold text-gray-900 text-center">طباعه</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                $sql = mysqli_query($connect, "SELECT * from `appointment` join rooms on rooms.id=appointment.roomID where `employId` = '$id' AND check_in = CURRENT_DATE() ");
                                while ($row = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['r_number']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['r_type']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['nights']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['paid']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['remind']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><?php echo $row['employname']; ?></p>
                                        </th>
                                        <th scope="col">
                                            <p class="text-lg leading- font-bold text-gray-900 text-center"><a href="./receipt.php?id=<?php echo $row['apid'];?>&uid=<?php echo $row['userId'];?>" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-lg font-medium text-green-700 ring-1 ring-inset ring-green-600/20">عرض</a></p>
                                        </th>
                                    </tr>
                            </tbody>
                        <?php } ?>
                </table>

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