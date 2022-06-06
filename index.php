<?php
    $API_SITE_DRINKS_URL = 'https://www.thecocktaildb.com/drink/';

    include('./config.php');

    function get_cocktails_from_api($keyword){
        $api_url = "https://www.thecocktaildb.com/api/json/v1/1/search.php?s=" . $keyword;
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $chRes = curl_exec($ch);
        curl_close($ch);
        $resp = json_decode($chRes, true);
        if(count($resp) > 0){
            return $resp;
        }
        return [];
    };

    function get_cocktails_from_db($keyword){
        global $conn;
        $k = '%' . $keyword . '%';
        $stmt = $conn->prepare("SELECT * FROM `cocktails` WHERE `name` LIKE ?");
        $stmt->bind_param("s", $k);
        
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

    function store_image($image_url, $id, $name){
        $content = file_get_contents($image_url);
        $image_name = $name . $id . '.jpg';
        $image_path = "images/" . $image_name;
        $fp = fopen($image_path, "w");
        fwrite($fp, $content);
        fclose($fp);

        if(file_exists($image_path)){
            return $image_path;
        }
        return false;
    }

    function store_cocktails_in_db($arr){
        global $conn;

        $drinksArr = $arr['drinks'];
        foreach($drinksArr as $drink){
            $image_path = store_image($drink['strDrinkThumb'], $drink['idDrink'], $drink['strDrink']);
            if($image_path){
                $dataToStore = [
                    'api_id' => $drink['idDrink'],
                    'name' => $drink['strDrink'],
                    'desc' => $drink['strInstructions'], 
                    'image_path' => $drink['strDrinkThumb']
                ];

                $stmt = $conn->prepare("INSERT INTO `cocktails` ( `name`, `desc`, `image_path`, `api_id` ) VALUES ( ?, ?, ?, ? );");
                $stmt->bind_param(
                    "ssss",
                    $dataToStore['name'],
                    $dataToStore['desc'],
                    $dataToStore['image_path'],
                    $dataToStore['api_id']
                );
                $stmt->execute();
                $stmt->close();
            } else {
                return false;
            }
        }

        return true;
    }

    function get_cocktails($keyword){
        $res = get_cocktails_from_db($keyword);
        
        if($res){
            return $res;
        } else {
            $apiRes = get_cocktails_from_api($keyword);
            if($apiRes && count($apiRes) > 0){
                if(!store_cocktails_in_db($apiRes)){
                    return [];
                }


                $res = get_cocktails_from_db($keyword);
                
                if(!$res){
                    return [];
                }

                return $res;
            }
        }

        return [];
    }

    $conn = connect_db();
    $res = [];
    if(isset($_GET['cocktail_name']) && strlen($_GET['cocktail_name']) > 0){
        $cocktail_name = $_GET['cocktail_name'];
        $res = get_cocktails($cocktail_name);
    }
?>

<?php include('./layout/header.php'); ?>



    

    <div class="rounded-lg shadow-spread-lg w-full max-w-screen-lg p-10 mx-auto">
        <h1 class="text-xl text-center font-bold">Search For The Cocktails</h1>

        <hr class="my-5 w-full max-w-[500px] mx-auto">

        <form action="./" method="GET" class="w-full max-w-[500px] mx-auto">
            <div class="mb-5">
                <label class="mb-3 block" for="">Cocktail's Name</label>
                <input
                    type="text"
                    name="cocktail_name"
                    value="<?=$_GET['cocktail_name'] ?? ''?>"
                    placeholder="Cocktail's Name"
                    class="
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        border-2 block w-full
                        rounded-none rounded-md
                        sm:text-sm border-gray-300 p-2

                    "
                >
            </div>

            <div>
                <button
                    type="submit"
                    class="inline-flex justify-center
                    py-2 px-4 border border-transparent
                    shadow-sm text-sm font-medium
                    rounded-md text-white bg-indigo-600
                    hover:bg-indigo-700 focus:outline-none
                    focus:ring-2 focus:ring-offset-2
                    focus:ring-indigo-500"
                >Search</button>
            </div>
        </form>
    </div>

    <?php if($res && count($res) > 0): ?>
        <div class="rounded-lg shadow-spread-lg w-full max-w-screen-lg p-10 mt-4 mx-auto">
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