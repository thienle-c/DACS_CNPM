<?php
class CartController extends Controller {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();
        
        $data = [
            'title' => 'Giỏ hàng của bạn',
            'categories' => $categories,
            'cart' => $_SESSION['cart']
        ];

        $this->view('layouts/header', $data);
        $this->view('cart/index', $data);
        $this->view('layouts/footer', $data);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            $product = $this->productModel->getProductById($productId);
            
            if ($product) {
                // Check if already in cart
                $found = false;
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] == $productId) {
                        $item['quantity'] += $quantity;
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $_SESSION['cart'][] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'sale_price' => $product->sale_price,
                        'image' => $product->image,
                        'quantity' => $quantity
                    ];
                }
                
                $_SESSION['message'] = 'Đã thêm ' . $product->name . ' vào giỏ hàng!';
                $_SESSION['msg_type'] = 'success';
            }
            
            // Redirect based on button pressed
            if (isset($_POST['action']) && $_POST['action'] == 'buy') {
                $this->redirect('checkout');
            } else {
                $this->redirect('cart');
            }
        }
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            if ($quantity > 0) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] == $productId) {
                        $item['quantity'] = $quantity;
                        break;
                    }
                }
            } else {
                // Remove item if quantity is 0
                $this->remove($productId);
            }
            
            $this->redirect('cart');
        }
    }
    
    public function remove($id = null) {
        if ($id) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $id) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
            // Re-index array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            $_SESSION['message'] = 'Đã xóa sản phẩm khỏi giỏ hàng!';
            $_SESSION['msg_type'] = 'success';
        }
        $this->redirect('cart');
    }
}
