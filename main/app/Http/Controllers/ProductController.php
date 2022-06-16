<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLiked;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function like($id, Request $request)
    {
        $response = Http::get('http://admin-admin-1/api/user');
        $user = $response->json();

        try {
            $product_user = ProductUser::create([
                'user_id' => $user['id'],
                'product_id' => $id
            ]);

            ProductLiked::dispatch($product_user->toArray())->onQueue('admin_queue');

            return response(
                [
                    'message' => 'Success'
                ],
                Response::HTTP_ACCEPTED
            );
        } catch (\Throwable $th) {
            return response(
                [
                    'message' => 'You Already Liked This Product'
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
