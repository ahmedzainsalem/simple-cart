<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request; 
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Products\StoreProductsPostRequest;
use App\Http\Requests\Products\UpdateProductsPostRequest;

class ProductsController extends BaseController
{
   
    protected $categoryRepository;
    protected $productRepository;

    public function __construct( 
        CategoryContract $categoryRepository,
        ProductContract $productRepository
    )
    {
        $this->middleware('auth');
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->listProducts();

        $this->setPageTitle('Products', 'Products List');
        return view('products.index', compact('products'));
    }

    public function create()
    {
         
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Create Product');
        return view('products.create', compact('categories'));
    }

    public function store(StoreProductsPostRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('products.index', 'Product added successfully' ,'success',false, false);
    }

    public function edit(Product $product)
    { 
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Edit Product');
        return view('products.edit', compact('categories', 'product'));
    }

    public function update(UpdateProductsPostRequest $request,Product $product)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }
        return $this->responseRedirect('products.index', 'Product updated successfully' ,'success',false, false);
    }

     /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->productRepository->deleteProduct($id);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while deleting Product.', 'error', true, true);
        }
        return $this->responseRedirect('products.index', 'Product deleted successfully' ,'success',false, false);
    }
}
