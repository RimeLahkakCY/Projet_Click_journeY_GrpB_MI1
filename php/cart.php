{\rtf1\ansi\ansicpg1252\cocoartf2822
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0

\f0\fs24 \cf0 <?php\
require_once 'models/Cart.php';\
\
class CartController \{\
    private $db;\
    private $cart;\
\
    public function __construct($db, $user_id) \{\
        $this->db = $db;\
        $this->cart = new Cart($db, $user_id);\
    \}\
\
    public function addToCart() \{\
        if ($_SERVER['REQUEST_METHOD'] === 'POST') \{\
            $trip_id = $_POST['trip_id'] ?? null;\
            $options = $_POST['options'] ?? [];\
\
            if ($trip_id) \{\
                $this->cart->addTrip($trip_id, $options);\
                $_SESSION['message'] = 'Voyage ajout\'e9 au panier avec succ\'e8s!';\
            \}\
        \}\
       \
        header('Location: index.php?page=cart');\
        exit;\
    \}\
\
    public function updateCart() \{\
        if ($_SERVER['REQUEST_METHOD'] === 'POST') \{\
            if (isset($_POST['update_quantity'])) \{\
                foreach ($_POST['quantity'] as $item_id => $quantity) \{\
                    $this->cart->updateTripQuantity($item_id, (int)$quantity);\
                \}\
            \} elseif (isset($_POST['update_options'])) \{\
                $item_id = $_POST['item_id'] ?? null;\
                $options = $_POST['options'] ?? [];\
               \
                if ($item_id) \{\
                    $this->cart->updateTripOptions($item_id, $options);\
                \}\
            \} elseif (isset($_POST['remove_item'])) \{\
                $item_id = $_POST['item_id'] ?? null;\
               \
                if ($item_id) \{\
                    $this->cart->removeItem($item_id);\
                \}\
            \} elseif (isset($_POST['clear_cart'])) \{\
                $this->cart->clearCart();\
            \}\
           \
            $_SESSION['message'] = 'Panier mis \'e0 jour avec succ\'e8s!';\
        \}\
       \
        header('Location: index.php?page=cart');\
        exit;\
    \}\
\
    public function viewCart() \{\
        $items = $this->cart->getItems();\
        $total = $this->cart->getTotal();\
        $item_count = $this->cart->getItemCount();\
       \
        include 'views/cart.php';\
    \}\
\
    public function checkout() \{\
        $items = $this->cart->getItems();\
        $total = $this->cart->getTotal();\
       \
        if (empty($items)) \{\
            $_SESSION['error'] = 'Votre panier est vide!';\
            header('Location: index.php?page=cart');\
            exit;\
        \}\
       \
        include 'views/checkout.php';\
    \}\
\
    public function processOrder() \{\
        if ($_SERVER['REQUEST_METHOD'] === 'POST') \{\
            // Traiter le paiement et cr\'e9er la commande\
            // ...\
           \
            // Vider le panier apr\'e8s une commande r\'e9ussie\
            $this->cart->clearCart();\
           \
            $_SESSION['message'] = 'Votre commande a \'e9t\'e9 trait\'e9e avec succ\'e8s!';\
            header('Location: index.php?page=order_confirmation');\
            exit;\
        \}\
       \
        header('Location: index.php?page=checkout');\
        exit;\
    \}\
\}\
?>}