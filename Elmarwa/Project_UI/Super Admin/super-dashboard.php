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
        <title>Dashboard</title>
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
                                <a href="./super-Dashboard.php" class="bg-gray-900 text-white rounded-md px-1 py-2 text-sm font-medium" aria-current="page">Dashboard</a>
                                <a href="./super-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Reservations</a>
                                <a href="./super-Payments.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Payments</a>
                                <a href="./super-user-log.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Users</a>
                                <a href="./History.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">History</a>
                                <a href="./Add user.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Add New User</a>
                                <a href="./Add Item.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Add New Room</a>
                                <a href="./Add type.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Add Room Type</a>
                                <a href="./Rooms.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Rooms</a>
                                <a href="./Reminds.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Reminds</a>
                            </div>
                            </div>
                        </div>
                        <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Log Out</a>
                    </nav>
                    <a href=" /Elmarwa-ar/admin-log/index.php" class=" float-end text-gray-500 hover:bg-gray-300 hover:text-black rounded-md px-1 py-2 text-sm font-medium">`AR`</a>
                    
                    <header class="bg-white shadow">
                        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
                        </div>
                    </header>
                    <main class="">
                <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                    <div class="bg-white">
                        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

                                <!-- total Check-In today -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM appointment Where check_in = CURRENT_DATE()");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300 lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Check_In.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Check-In today </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>

                                <!-- total Check-Out today -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM appointment Where check_out = CURRENT_DATE()");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Check-Out.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Check-Out today </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Available Single Rooms -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM rooms Where statue = 0 AND `type` = 'Single' ");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Single_Room.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Available Single Rooms </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Available Double Rooms -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM rooms Where statue = 0 AND `type` = 'Double' ");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Double_Room.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Available Double Rooms </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Available Triple Rooms -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM rooms Where statue = 0 AND `type` = 'Triple' ");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Triple_Room.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Available Triple Rooms </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Rapier Rooms -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM rooms Where statue = 3 ");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Room_Maintenance.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Rapier Rooms </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Not Cleaned Rooms -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM rooms Where statue = 2 ");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Not_Cleaned_Rooms.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Not Cleaned Rooms </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Online Employe  -->

                                <?php
                                $result = $connect->query(" SELECT COUNT(*) FROM employ Where employ_statue = 1 ");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300  lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Online_Employe.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> Online Employe  </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                                <!-- total Payment -->

                                <?php
                                $result = $connect->query("SELECT SUM(paid) FROM appointment WHERE check_in = CURRENT_DATE()");
                                ?>
                                <div class="group relative">
                                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-md bg-gray-200 transition-all  hover:bg-sky-300 lg:aspect-none lg:h-48 ">
                                        <p class="flex justify-center text-lg leading- font-bold text-center text-black p-1"><img src="./photo/Total_Payment.png" width="100"></p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> total Payment  </p>
                                        <p class=" text-lg leading- font-bold text-center text-black p-1"> [ <?php echo $count = $result->fetch_row()[0]; ?> ]</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </main>
        <?php
    } else if (strlen($_SESSION['login']) == 0) {
        echo "<script>alert('You Are Not Login');
              window.location.href = '/Elmarwa/admin-log/index.php';</script>";
    }
        ?>
    </body>

    </html>