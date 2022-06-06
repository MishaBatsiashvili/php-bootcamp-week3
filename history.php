<?php
$API_SITE_DRINKS_URL = 'https://www.thecocktaildb.com/drink/';

include('./config.php');

function get_all_history(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `cocktails`");
    $stmt->execute();
    $result = $stmt->get_result();

    $resArr = [];

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($resArr, [
                'id' => $row['id'],
                'name' => $row['name'],
                'desc' => $row['desc'],
                'image_path' => $row['image_path'],
                'api_id' => $row['api_id']
            ]);
        }
    }

    $stmt->close();
    return $resArr;
}

$conn = connect_db();
$res = [];
$res = get_all_history();

?>

<?php include('./layout/header.php'); ?>
<!-- <div class="rounded-lg shadow-spread-lg w-full max-w-screen-lg p-10 mx-auto">
    
</div> -->

<?php if($res && count($res) > 0): ?>
    <div class="rounded-lg shadow-spread-lg w-full max-w-screen-lg p-10 mt-4 mx-auto">
        
        <div class="px-10 pb-14">
            <h1 class="text-xl text-center font-bold">History</h1>
        </div>

        <ul role="list" class="-my-6 divide-y divide-gray-400">
            <?php foreach($res as $item): ?>
                <?php
                    $dashedName = implode('-', explode(' ', $item['name']));
                    $link = $API_SITE_DRINKS_URL . $item['api_id'] . '-' . $dashedName;
                ?>
            <li class="py-6">
                <a href="<?=$link?>" class="flex flex-wrap sm:flex-nowrap" target="blank">
                    <div class="h-full w-full block sm:h-24 sm:w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img
                            src="<?=$item['image_path']?>"
                            class="h-full w-full object-cover object-center"
                        >
                    </div>

                    <div class="pt-4 sm:pt-0 sm:pl-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <h3>
                                <?=$item['name']?>
                            </h3>
                        </div>
                        <p class="mt-1 text-sm text-gray-500"><?=$item['desc']?></p>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
            
    </div>
<?php endif; ?>

<?php include('./layout/footer.php'); ?>