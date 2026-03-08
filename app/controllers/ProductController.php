<?php
class ProductController extends Controller {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    // List all products
    public function index() {
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();

        $data = [
            'title' => 'Tất cả sản phẩm',
            'products' => $products,
            'categories' => $categories,
            'current_category' => null
        ];

        $this->view('layouts/header', $data);
        $this->view('product/index', $data);
        $this->view('layouts/footer', $data);
    }

    // List products by category slug
    public function category($slug) {
        $category = $this->categoryModel->getCategoryBySlug($slug);
        
        if (!$category) {
            $this->redirect('product');
        }

        $products = $this->productModel->getProductsByCategory($category->id);
        $categories = $this->categoryModel->getAllCategories();

        $data = [
            'title' => $category->name . ' chính hãng, giá tốt',
            'products' => $products,
            'categories' => $categories,
            'current_category' => $category
        ];

        $this->view('layouts/header', $data);
        $this->view('product/index', $data);
        $this->view('layouts/footer', $data);
    }

    // Show single product detail by ID
    public function detail($id) {
        $product = $this->productModel->getProductById($id);
        
        if (!$product) {
            $this->redirect('product');
        }

        // Fetch related products from same category
        $related = $this->productModel->getProductsByCategory($product->category_id, 4);
        $categories = $this->categoryModel->getAllCategories();

        $data = [
            'title' => $product->name . ' - ' . SITENAME,
            'product' => $product,
            'related' => $related,
            'categories' => $categories
        ];

        $this->view('layouts/header', $data);
        $this->view('product/detail', $data);
        $this->view('layouts/footer', $data);
    }
    
    // Search Products
    public function search() {
        $keyword = isset($_GET['q']) ? htmlspecialchars(trim($_GET['q'])) : '';
        
        if(empty($keyword)) {
            $this->redirect('');
        }
        
        $products = $this->productModel->searchProducts($keyword);
        $categories = $this->categoryModel->getAllCategories();
        
        $data = [
            'title' => 'Tìm kiếm: ' . $keyword,
            'keyword' => $keyword,
            'products' => $products,
            'categories' => $categories,
            'current_category' => null
        ];
        
        $this->view('layouts/header', $data);
        $this->view('product/index', $data);
        $this->view('layouts/footer', $data);
    }
}
