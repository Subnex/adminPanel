<?php

    session_start();
    $uid='';
    if (!isset($_SESSION["username"]))
    {
        $url = "./Home.php";
        header("Location: $url");
    }
    if (isset($_GET['uid'])) {
        $uid = $_GET['uid'];
        //echo "catCode=: " . htmlspecialchars($catCode);
    }
    session_set_cookie_params(0);

    include('./header.php');
    require_once __DIR__ . '/Model/userDetailCls';
    //require_once __DIR__ . '/Model/Member.php';
     $userDtl = new userDetailCls();
    

    $userRec = $userDtl->getUserDetails($uid);
    $user =$userRec[0];
    //print_r($user);
    // Fetch user data
   /* $userId = 1; // Example user ID, replace with dynamic value as needed
    $userQuery = $pdo->prepare("SELECT * FROM users WHERE id = :userId");
    $userQuery->execute(['userId' => $userId]);
    $user = $userQuery->fetch(PDO::FETCH_ASSOC);*/

    // Fetch related products
    /*$productQuery = $pdo->prepare("SELECT * FROM products WHERE user_id = :userId");
    $productQuery->execute(['userId' => $userId]);
    $products = $productQuery->fetchAll(PDO::FETCH_ASSOC);*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .profile-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-details {
            flex: 1;
        }
        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            width: calc(33.333% - 20px);
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .product-card h4 {
            margin: 10px 0;
        }
        .DetailDivCls
        {
            height: 155px;
            width: 100%;
            background-color: #fff;
            border: 1px solid #f2eeee;
            border-radius: 5px;
            margin-top: 10px;
            float: left;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        }
        .innerHeadDiv2
        {
            height: 35px;
            width: 100%;
            /* background-color: #337ab7; */
            color: #1373ac;
            padding-left: 1%;
            font-size: 22px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            border-bottom: 1px solid orange; 
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="uploads/<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
        <div class="profile-details">
            <h2><?php echo htmlspecialchars($user['name']); ?></h2>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
       
    </div>
    </div>
    <div class="DetailDivCls">
        <div class="innerHeadDiv2"><h4>Listed products</h4></div>
        
        <div class="products-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <h4><?php echo htmlspecialchars($product['product_name']); ?></h4>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <div class="DetailDivCls">
        <div class="innerHeadDiv2"><h4>Opted products</h4></div>
        
        <div class="products-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <h4><?php echo htmlspecialchars($product['product_name']); ?></h4>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <div class="DetailDivCls">
        <div class="innerHeadDiv2"><h4>My Deals</h4></div>
        
        <div class="products-container">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <h4><?php echo htmlspecialchars($product['product_name']); ?></h4>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
        
       

   
</body>
</html>
