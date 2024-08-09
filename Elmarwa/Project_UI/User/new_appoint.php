<?php
session_start();
ini_set("display_errors", 0);
if (strlen($_SESSION['login']) !== 0) {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(" connection failed " . $conn->connect_error);
}

if (isset($_POST['Save'])) {
    $type = $_POST['type'];
    $number = $_POST['number'];
    $in = $_POST['in'];
    $out = $_POST['out'];
    $night = $_POST['night'];
    $remind = $_POST['remind'];
    $Payed = $_POST['Payed'];
    $price = $_POST['price'];

    $c1_n = $_POST['c1_n'];
    $c1_ph = $_POST['c1_ph'];
    $c1_id = $_POST['c1_id'];

    $c2_n = $_POST['c2_n'];
    $c2_ph = $_POST['c2_ph'];
    $c2_id = $_POST['c2_id'];

    $c3_n = $_POST['c3_n'];
    $c3_ph = $_POST['c3_ph'];
    $c3_id = $_POST['c3_id'];

    $comment = $_POST['comment'];

    $employid = $_SESSION['id'];
    $employname = $_SESSION['username'];

    $statue = 1;

    $query = mysqli_query(
        $conn,
        "INSERT into appointment( r_type , roomID , check_in , check_out , nights , paid , client_name , client_phone , client_id , commnet , employname , employId , remind , Price , apstatue) 
                        values( '$type' , '$number' , '$in' , '$out' , '$night' , '$Payed' ,  CONCAT('$c1_n', ' |-| ', '$c2_n', ' |-| ', '$c3_n'),  CONCAT('$c1_ph', ' |-| ', '$c2_ph', ' |-| ', '$c3_ph'),  CONCAT('$c1_id', ' |-| ', '$c2_id', ' |-| ', '$c3_id'), '$comment' , '$employname' , '$employid' , '$remind' , '$price' , '$statue')"
    );
    if ($query) {
        echo "<script>alert('Appointment Done');</script>";
    }

    // #####################################################################################################################################################

    $sql = "SELECT * FROM appointment where roomID = '$number' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $room_id = $row["roomID"];
            $sqlInsert = "UPDATE rooms SET statue = 1 WHERE id = '$number' ";
            $conn->query($sqlInsert);
        }
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="./photo/l-gh.png">
    <script>
        function getdoctor(val) {
            $.ajax({
                type: "POST",
                url: "get_room.php",
                data: 'typeid=' + val,
                success: function(data) {
                    $("#number").html(data);
                }
            });
        }   
    </script>

    <script>
        function getfee(val) {
            $.ajax({
                type: "POST",
                url: "get_room.php",
                data: 'room=' + val,
                success: function(data) {
                    $("#price").html(data);
                }
            });
        }
    </script>

        <script>


            $(document).ready(function() {
        $('#in, #out').on('input', function() {
            var startDate = new Date($('#in').val());
            var endDate = new Date($('#out').val());
            var dateDifference = (endDate - startDate) / (1000 * 60 * 60 * 24);
            $('#night').val(dateDifference);
        });
    });
        </script> 

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const priceInput = document.getElementById("price");
        const paidAmountInput = document.getElementById("Payed");
        const remainingInput = document.getElementById("remind");
        const nightInput = document.getElementById("night");
        priceInput.addEventListener("input", calculateRemaining);
        paidAmountInput.addEventListener("input", calculateRemaining);
        function calculateRemaining() {
            const price = parseFloat(priceInput.value) || 0;
            const paidAmount = parseFloat(paidAmountInput.value) || 0;
            const night = parseFloat(nightInput.value) || 0;
            const remaining = (price*night) - paidAmount;
            remainingInput.value = remaining; 
        }
    });
    </script>

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
                                <a href="./new_appoint.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">New Appointment</a>
                                <a href="./super-Reservations.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Reservations</a>
                                <a href="./History.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">History</a>
                                <a href="./Rooms.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Rooms</a>
                                <a href="./Reminds.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-1 py-2 text-sm font-medium">Reminds</a>
                            </div>
                        </div>
                    </div>
                    <a href="./logout.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Log Out</a>
                    <!-- <a href=" /Elmarwa-ar/admin-log/index.php" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">AR</a> -->
        </nav>
                    <a href=" /Elmarwa-ar/admin-log/index.php" class=" float-end text-gray-500 hover:bg-gray-300 hover:text-black rounded-md px-1 py-2 text-sm font-medium">`AR`</a>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">New Appointment</h1>
            </div>
        </header>
        <main class="">
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form method="post">
                    <div class="space-y-12">

                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="mt-10 grid grid-cols-3 gap-x-6 gap-y-8 sm:grid-cols-6">

                                <div class="sm:col-span-2">
                                    <div class="mt-2.5">
                                        <label for="type" class="block text-sm font-semibold leading-6 text-gray-900">Room Type</label>
                                        <div class="mt-2">
                                            <select id="type" name="type" onChange="getdoctor(this.value);" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option>Select Type</option>
                                                <?php $ret = mysqli_query($conn, "SELECT * from r_type");
                                                while ($row = mysqli_fetch_array($ret)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['type']); ?>">
                                                        <?php echo htmlentities($row['type']); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <div class="mt-2.5">
                                        <label for="number" class="block text-sm font-semibold leading-6 text-gray-900">Room Number</label>
                                        <div class="mt-2">
                                            <select id="number" name="number" onChange="getfee(this.value);" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option>Select Room</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="sm:col-span-2">
                                    <div class="mt-2.5">
                                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">price</label>
                                        <select readonly name="price" id="price" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </select>
                                    </div>
                                </div>

                            <!-- <div hidden class="sm:col-span-2">
                                    <div class="mt-2.5">
                                        <label for="apid" class="block text-sm font-medium leading-6 text-gray-900">apid</label>
                                        <select value ="" name="apid" id="apid" class="block w-full rounded-md border-2 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </select>
                                    </div>
                                </div> -->

                            </div>
                        </div>

                        <div class="border-b border-gray-900/10 pb-12">
                            <div class="mt-10 grid grid-cols-3 gap-x-6 gap-y-8 sm:grid-cols-6">



                                
                                <div class="sm:col-span-3">
                                    <label for="in" class="block text-sm font-medium leading-6 text-gray-900">Check In</label>
                                    <div class="mt-2">
                                        <input type="Date" value="<?php echo date('Y-m-d'); ?>" name="in" id="in" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                        </div>
                        
                        <div class="sm:col-span-3">
                            <label for="out" class="block text-sm font-medium leading-6 text-gray-900">Check Out</label>
                            <div class="mt-2">
                                <input type="Date" value="<?php echo date('Y-m-d'); ?>" name="out" id="out" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="night" class="block text-sm font-medium leading-6 text-gray-900">night</label>
                            <div class="mt-2.5">
                                <input type="text" name="night" id="night" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                                    <label for="Payed" class="block text-sm font-medium leading-6 text-gray-900">Payed</label>
                                    <div class="mt-2">
                                        <input type="text" name="Payed" id="Payed" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                        </div>

                        <div class="sm:col-span-2">
                                    <label for="remind" class="block text-sm font-medium leading-6 text-gray-900">Remind</label>
                                    <div class="mt-2">
                                        <input readonly type="text" name="remind" id="remind" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                        </div>

                                                            </div>
                        </div>


                                                <div class="border-b border-gray-900/10 pb-12">
                            <div class="mt-10 grid grid-cols-3 gap-x-6 gap-y-8 sm:grid-cols-6">


                                <div class="sm:col-span-2">
                                    <label for="c1_n" class="block text-sm font-medium leading-6 text-gray-900">Client 1</label>
                                    <div class="mt-2">
                                        <input type="text" name="c1_n" id="c1_n" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c1_ph" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                                    <div class="mt-2">
                                        <input type="text" name="c1_ph" id="c1_ph" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c1_id" class="block text-sm font-medium leading-6 text-gray-900">ID</label>
                                    <div class="mt-2">
                                        <input type="text" name="c1_id" id="c1_id" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c2_n" class="block text-sm font-medium leading-6 text-gray-900">Client 2</label>
                                    <div class="mt-2">
                                        <input type="text" name="c2_n" id="c2_n" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c2_ph" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                                    <div class="mt-2">
                                        <input type="text" name="c2_ph" id="c2_ph" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c2_id" class="block text-sm font-medium leading-6 text-gray-900">ID</label>
                                    <div class="mt-2">
                                        <input type="text" name="c2_id" id="c2_id" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c3_n" class="block text-sm font-medium leading-6 text-gray-900">Client 3</label>
                                    <div class="mt-2">
                                        <input type="text" name="c3_n" id="c3_n" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c3_ph" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                                    <div class="mt-2">
                                        <input type="text" name="c3_ph" id="c3_ph" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="c3_id" class="block text-sm font-medium leading-6 text-gray-900">ID</label>
                                    <div class="mt-2">
                                        <input type="text" name="c3_id" id="c3_id" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                                            </div>
                        </div>

                                <div class="col-span-full">
                                    <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">Comment</label>
                                    <div class="mt-2">
                                        <textarea placeholder="Add A Comment" id="comment" name="comment" rows="3" class="font-bold p-7 block w-full rounded-md border-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-500 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                </div>
                    </div>
            </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6 m-6">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
        <button type="submit" name="Save" class="  rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
    </form>
    </div>
    </main>
    <?php
    // } else if (strlen($_SESSION['login']) == 0) {
    //     echo "<script>alert('You Are Not Login');
    //               window.location.href = '/zeyad/Final_Project/admin-log/index.php';</script>";
    // }
    ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>x  
    
</body>
        <?php
    } else if (strlen($_SESSION['login']) == 0) {
        echo "<script>alert('You Are Not Login');
              window.location.href = '/Elmarwa/admin-log/index.php';</script>";
    }
        ?>
</html>