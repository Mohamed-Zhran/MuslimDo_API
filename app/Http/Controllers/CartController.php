<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItem;
use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $cartItem;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $productsInCart = Cart::with('product')->get();
        return response()->json($productsInCart);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCartItem $request)
    {
        if (!$this->isProductExistInCart($request->product_id))
        {
            Cart::create([
                'quantity' => $request->quantity,
                'product_id' => $request->product_id
            ]);
            return response()->json(['message' => 'Item is Added Successfully']);
        }
        else
        {
            return response()->json(['message' => 'Item is Already Added'], 422);
        }
    }

    public function isProductExistInCart($product_id)
    {
        return DB::table('cart')->where('product_id', $product_id)->exists();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCartItem $request, $id)
    {
        $this->checkIsModelExist($id);
        $this->cartItem->update(['quantity' => $request->quantity]);
        return response()->json(['message' => 'Item is Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->checkIsModelExist($id);
        $this->cartItem->delete();
        return response()->json(['message' => 'Item is Deleted Successfully']);
    }

    public function checkIsModelExist($id)
    {
        try
        {
            $this->cartItem = Cart::findOrFail($id);
        } catch (ModelNotFoundException $e)
        {
            abort(404, 'can\'t find this item');
        }
    }
}
