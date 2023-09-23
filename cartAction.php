<?php
  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }

  if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];    
    $allow = $_SESSION['userallow']; 
    $_SESSION['orderid'] = "";
    $_SESSION['totalprice'] = "";
  }else{
    $user="";
    $allow="";
    $_SESSION['orderid'] = "";
    $_SESSION['totalprice'] = "";
  }

  if($user==""){
    header("Location: login.php"); 
    exit();
  }

  
?>

<?php
// initialize shopping cart class
//include 'Cart.php';
require_once 'lib/ShoppingCart.php';
$shoppingCart = new ShoppingCart();
//$cart = new Cart;
$member_id = $_SESSION['sessCustomerID'];
// include database configuration file
include 'dbConfig.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){

    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['code'])){  
        $productResult = $shoppingCart->getProductByCode($_GET["code"]);
        //print_r($productResult[0]["id"]);
        $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $member_id);
        //print_r($cartResult);die;
        if (! empty($cartResult)) {
            // Update cart item quantity in database
            $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
            $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
        } else {
            // Add to cart table
            $shoppingCart->addToCart($productResult[0]["id"], 1, $member_id);
        }
        //break;
        // $productID = $_REQUEST['id'];
        // // get product details
        // $query = $db->query("SELECT * FROM products WHERE id = ".$productID);
        // $row = $query->fetch_assoc();
        // $fprice=$row['price'];
        
        // if($_SESSION['discount']!=0){
        //   if($productID == '7')
        //     $fprice = $fprice - ($_SESSION['discount']*$fprice)/100;
        // }
        
        // $itemData = array(
        //     'id' => $row['id'],
        //     'name' => $row['name'],
        //     'price' => $fprice,
        //     'qty' => 1
        // );
        
        //$insertItem = $cart->insert($itemData);
        $redirectLoc = 'viewCart.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        // Delete single entry from the cart
        $shoppingCart->deleteCartItem($_GET["id"]);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'empty'){
        $shoppingCart->emptyCart($member_id);
    }elseif($_REQUEST['action'] == 'placeOrder' && !empty($_SESSION['sessCustomerID'])){  
        // insert order details into database
        $cartTotal = $shoppingCart->getMemberCartTotal($member_id);
        $tax = 18;
        $total_price = $cartTotal[0]['total_price'];
        //Convert our percentage value into a decimal.
        if(isset($_REQUEST['coupon_discount'])){
            $total_price = $total_price - $_REQUEST['coupon_discount'];
        }    
        $percentInDecimal = $tax / 100;
        $finalTax = $percentInDecimal * $total_price;
        //echo $finalTax;die;
        $total_price = $total_price + $finalTax;
        
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$total_price."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $shoppingCart->getMemberCartItem($member_id);
            //$cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['quantity']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
               // $cart->destroy();
               //$shoppingCart->emptyCart($member_id);
                $custId = $_SESSION['sessCustomerID'];

                $_SESSION['orderid'] = $orderID;
                $_SESSION['totalprice'] = $total_price;
                header("Location: TxnTest.php");
                //header("Location: orderSuccess");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}