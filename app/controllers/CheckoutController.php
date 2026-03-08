<?php
class CheckoutController extends Controller {
    private $orderModel;

    public function __construct() {
        // Only check if cart is empty for non-success methods
        $url = $this->getUrl();
        $method = isset($url[1]) ? $url[1] : 'index';
        
        if ($method != 'success' && empty($_SESSION['cart'])) {
            $this->redirect('cart');
        }
        $this->orderModel = $this->model('OrderModel');
    }

    public function index() {
        $data = [
            'title' => 'Thanh toán đơn hàng',
            'cart' => $_SESSION['cart']
        ];

        $this->view('layouts/header', $data);
        $this->view('checkout/index', $data);
        $this->view('layouts/footer', $data);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Calculate total price from session
            $total_price = 0;
            foreach ($_SESSION['cart'] as $item) {
                $price = $item['sale_price'] ?: $item['price'];
                $total_price += $price * $item['quantity'];
            }
            
            $data = [
                'customer_name' => htmlspecialchars(trim($_POST['customer_name'])),
                'phone' => htmlspecialchars(trim($_POST['phone'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'note' => htmlspecialchars(trim($_POST['note'])),
                'total_price' => $total_price
            ];

            // Validate simple data
            if (empty($data['customer_name']) || empty($data['phone']) || empty($data['address'])) {
                $_SESSION['message'] = 'Vui lòng điền đầy đủ thông tin bắt buộc.';
                $_SESSION['msg_type'] = 'danger';
                $this->redirect('checkout');
            }

            // Create Order
            $orderId = $this->orderModel->createOrder($data, $_SESSION['cart']);

            if ($orderId) {
                // Clear cart
                unset($_SESSION['cart']);
                
                // Redirect to success page
                $_SESSION['last_order_id'] = $orderId;
                $this->redirect('checkout/success');
            } else {
                $_SESSION['message'] = 'Đã có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại sau.';
                $_SESSION['msg_type'] = 'danger';
                $this->redirect('checkout');
            }
        } else {
            $this->redirect('checkout');
        }
    }
    
    public function success() {
        if (!isset($_SESSION['last_order_id'])) {
            $this->redirect('');
        }
        
        $data = [
            'title' => 'Đặt hàng thành công',
            'order_id' => $_SESSION['last_order_id']
        ];
        
        $this->view('layouts/header', $data);
        $this->view('checkout/success', $data);
        $this->view('layouts/footer', $data);
    }
}
