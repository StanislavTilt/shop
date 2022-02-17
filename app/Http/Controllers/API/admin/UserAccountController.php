<?php

namespace App\Http\Controllers\API\admin;

use App\Enums\UserTypesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\SearchUsersRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Resources\Admin\GetCurrentUserResource;
use App\Http\Resources\Admin\GetUsersListResource;
use App\Http\Resources\User\ProfileResource;
use App\Mail\PasswordRestored;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\PhoneChangeRequest;
use App\Models\RestoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserAccountController
 * @package App\Http\Controllers\Api\Admin
 */
class UserAccountController extends BaseApiController
{
    /**
     * UserAccountController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $users = User::all()
            ->load('orders.orderProduct');
        return GetUsersListResource::collection($users);
    }

    /**
     * @param SearchUsersRequest $request
     * @return mixed
     */
    public function searchUsers(SearchUsersRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');
        $users = User::orderBy($sortKey, $sortMethod);

        if(isset($request->id))
        {
            $users = $users->where('id', 'like' , '%'.$request->id.'%');
        }
        if(isset($request->name))
        {
            $users = $users->where('name', 'like' , '%'.$request->name.'%');
        }
        if(isset($request->phone))
        {
            $users = $users->where('phone', 'like' , '%'.$request->phone.'%');
        }
        if(isset($request->email))
        {
            $users = $users->where('email', 'like' , '%'.$request->email.'%');
        }

        return GetUsersListResource::collection($users->paginate(10));
    }

    /**
     * @param CreateUserRequest $request
     * @return void
     */
    public function create(CreateUserRequest $request)
    {
        $requestData = $request->validated();
        User::create($requestData);
    }

    /**
     * @param $userId
     * @return array
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        $orders = Order::where('user_id', $user->id)
            ->with('orderProduct')
            ->get();

        $user->orders_count = count($orders);
        $user->orders_sum_price = 0;

        foreach ($orders as $order) {
            foreach ($order->orderProduct as $product)
            {
                $user->orders_sum_price += $product->price * $product->quantity;
            }
        }

        $data = [
            'user' => $user,
            'orders' => Order::where('user_id', $user->id)
                ->with('orderProduct.product')
                ->paginate(5)
        ];

        return $data;
    }

    /**
     * @param UpdateUserRequest $request
     * @param $user_id
     * @return void
     */
    public function update(UpdateUserRequest $request, $user_id)
    {
        $requestData = $request->validated();
        $user = User::findOrFail($user_id);

        $user->update($requestData);
    }

    /**
     * @param $user_id
     */
    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $orderIds = $user->orders->pluck('id');
        Order::whereIn('id', $orderIds)->update(['user_id' => null]);

        Cart::where('user_id',$user->id)->delete();
        Address::where('user_id',$user->id)->delete();
        RestoreRequest::where('user_id',$user->id)->delete();
        PhoneChangeRequest::where('user_id',$user->id)->delete();
        $user->delete();
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function regeneratePassword($user_id)
    {
        $bytes = random_bytes(4);
        $password = bin2hex($bytes);


        $user = User::findOrFail($user_id);
        $user->update(['password' => Hash::make($password)]);

        Mail::to($user)->send(new PasswordRestored($password));

        return $this->getSuccessResponse(200);
    }
}
