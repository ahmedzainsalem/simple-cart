<?php

namespace App\Repositories;

use App\Product;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\ProductContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class ProductRepository extends BaseRepository implements ProductContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Product|mixed
     */
    public function createProduct(array $params)
    {
        try {
            $collection = collect($params);

            $image = null; 
            $product_image = $params['image'];
              
            $product_image_new_name = time() . $product_image->getClientOriginalName();
            $product_image->move('uploads/products', $product_image_new_name);
            $image = 'uploads/products/' . $product_image_new_name;
            
            $merge = $collection->merge(compact('image'));

            $product = new Product($merge->all());

            $product->save();

            return $product;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProduct(array $params)
    {
        $product = $this->findProductById($params['id']);

        $collection = collect($params)->except('_token');
 
        if($collection->has('image') && $params['image'])
        {
        
            $product_image = $params['image'];

            $product_image_new_name = time() . $product_image->getClientOriginalName();

            $product_image->move('uploads/products', $product_image_new_name);

            $image = 'uploads/products/' . $product_image_new_name;

            unlink($product->image);

        }else{
            $image =$params['image_old'];
        }

        $merge = $collection->merge(compact('image'));

        $product->update($merge->all());

        return $product;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteProduct($id)
    {
        $product = $this->findProductById($id);

        if ($product->image != null) {
            unlink($product->image);
        }

        $product->delete();

        return $product;
    }
}
