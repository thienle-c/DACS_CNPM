<?php
class HomeController extends Controller {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function index() {
        // Fetch categories for navbar
        $categories = $this->categoryModel->getAllCategories();
        
        // Fetch featured products
        $featuredProducts = $this->productModel->getFeaturedProducts(10);
        
        // Fetch flash sale products
        $flashSaleProducts = $this->productModel->getFlashSaleProducts(6);
        
        // Fetch specific categories (e.g. phones = 1, laptops = 2)
        $phones = $this->productModel->getProductsByCategory(1, 5);
        $laptops = $this->productModel->getProductsByCategory(2, 4);

        $data = [
            'title' => 'TechZone - Chuyên trang điện máy',
            'categories' => $categories,
            'featured' => $featuredProducts,
            'flash_sale' => $flashSaleProducts,
            'phones' => $phones,
            'laptops' => $laptops
        ];

        // Ensure cart exists in session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $this->view('layouts/header', $data);
        $this->view('home/index', $data);
        $this->view('layouts/footer', $data);
    }
}
