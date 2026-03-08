<?php
class AdminController extends Controller {
    private $adminModel;
    private $productModel;
    private $categoryModel;
    private $orderModel;

    public function __construct() {
        $this->adminModel = $this->model('AdminModel');
        
        // Skip auth check for login method
        $url = $this->getUrl();
        $method = isset($url[1]) ? $url[1] : 'index';

        if (!isset($_SESSION['admin_id']) && $method !== 'login') {
            $this->redirect('admin/login');
        }

        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
        $this->orderModel = $this->model('OrderModel');
    }



    public function index() {
        $data = [
            'title' => 'Admin Dashboard',
            'orders' => $this->orderModel->getAllOrders(),
            'products' => $this->productModel->getAllProducts(),
            'categories' => $this->categoryModel->getAllCategories()
        ];

        $this->view('admin/index', $data);
    }

    // --- AUTHENTICATION ---
    public function login() {
        if (isset($_SESSION['admin_id'])) {
            $this->redirect('admin');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $loggedInAdmin = $this->adminModel->login($username, $password);

            if ($loggedInAdmin) {
                $_SESSION['admin_id'] = $loggedInAdmin->id;
                $_SESSION['admin_username'] = $loggedInAdmin->username;
                $_SESSION['admin_name'] = $loggedInAdmin->full_name;
                $this->redirect('admin');
            } else {
                $data = [
                    'title' => 'Admin Login',
                    'username' => $username,
                    'error' => 'Tài khoản hoặc mật khẩu không chính xác'
                ];
                $this->view('admin/login', $data);
            }
        } else {
            $data = [
                'title' => 'Admin Login',
                'username' => '',
                'error' => ''
            ];
            $this->view('admin/login', $data);
        }
    }

    public function logout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_name']);
        session_destroy();
        $this->redirect('admin/login');
    }

    // --- CATEGORIES ---
    public function categories() {
        $data = [
            'title' => 'Quản lý danh mục',
            'categories' => $this->categoryModel->getAllCategories()
        ];
        $this->view('admin/categories', $data);
    }
    
    // --- PRODUCTS ---
    public function products() {
        $data = [
            'title' => 'Quản lý sản phẩm',
            'products' => $this->productModel->getAllProducts()
        ];
        $this->view('admin/products', $data);
    }
    
    // --- ORDERS ---
    public function orders() {
        $data = [
            'title' => 'Quản lý Đơn hàng',
            'orders' => $this->orderModel->getAllOrders()
        ];
        $this->view('admin/orders', $data);
    }
    
    public function order_detail($id) {
        $order = $this->orderModel->getOrderById($id);
        if(!$order) $this->redirect('admin/orders');
        
        $items = $this->orderModel->getOrderItems($id);
        
        $data = [
            'title' => 'Chi tiết Đơn hàng #' . $id,
            'order' => $order,
            'items' => $items
        ];
        $this->view('admin/order_detail', $data);
    }

    public function order_update_status() {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $id = $_POST['order_id'];
             $status = $_POST['status'];
             $this->orderModel->updateOrderStatus($id, $status);
             $this->redirect('admin/order_detail/' . $id);
         }
    }
}
