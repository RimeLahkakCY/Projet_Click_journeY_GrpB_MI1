{\rtf1\ansi\ansicpg1252\cocoartf2821
\cocoatextscaling0\cocoaplatform0{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww11520\viewh8400\viewkind0
\pard\tx720\tx1440\tx2160\tx2880\tx3600\tx4320\tx5040\tx5760\tx6480\tx7200\tx7920\tx8640\pardirnatural\partightenfactor0

\f0\fs24 \cf0 <?php\
session_start();\
require_once 'config/database.php';\
require_once 'controllers/CartController.php';\
// Autres includes...\ 
\
// V\'e9rifier si l'utilisateur est connect\'e9\
$user_id = $_SESSION['user_id'] ?? null;\
$is_logged_in = !empty($user_id);\
\
// Si l'utilisateur n'est pas connect\'e9 et essaie d'acc\'e9der \'e0 une page prot\'e9g\'e9e\
$protected_pages = ['cart', 'checkout', 'add_to_cart', 'update_cart', 'process_order'];\
$page = $_GET['page'] ?? 'home';\
\
if (in_array($page, $protected_pages) && !$is_logged_in) \{\
    $_SESSION['error'] = 'Vous devez \'eatre connect\'e9 pour acc\'e9der \'e0 cette page.';\
    header('Location: index.php?page=login');\
    exit;\
\}\
\
// Initialiser le contr\'f4leur du panier si l'utilisateur est connect\'e9\
if ($is_logged_in) \{\
    $cartController = new CartController($db, $user_id);\
\}\
\
// Router\
switch ($page) \{\
    // Pages existantes...\
   \
    case 'cart':\
        $cartController->viewCart();\
        break;\
       \
    case 'add_to_cart':\
        $cartController->addToCart();\
        break;\
       \
    case 'update_cart':\
        $cartController->updateCart();\
        break;\
       \
    case 'checkout':\
        $cartController->checkout();\
        break;\
       \
    case 'process_order':\
        $cartController->processOrder();\
        break;\
       \
    // Autres pages...\
   \
    default:\
        // Page d'accueil ou 404\
        break;\
\}\
?>}
