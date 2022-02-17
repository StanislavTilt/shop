<?php

namespace App\Http\Controllers\API\SuperAdmin;

use App\Enums\UserTypesEnum;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\SuperAdmin\MakeAdminRequest;
use App\Http\Requests\SuperAdmin\SearchAdminsRequest;
use App\Http\Requests\SuperAdmin\UpdateAdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Mail\PasswordRestored;
use App\Models\Admin;
use App\Models\AdminProduct;
use App\Models\User;
use App\Services\FileUpload;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class AdminAccountController
 * @package App\Http\Controllers\Api\SuperAdmin
 */
class AdminAccountController extends BaseApiController
{
    /**
     * @var FileUpload
     */
    protected $fileUploadService;

    /**
     * AdminAccountController constructor.
     * @param FileUpload $fileUpload
     */
    public function __construct(FileUpload $fileUpload)
    {
        parent::__construct();
        $this->fileUploadService = $fileUpload;
        $this->fileUploadService->baseFolder = 'admin_avatars';
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllAdmins()
    {
        $adminList = Admin::all();
        return AdminResource::collection($adminList);
    }

    /**
     * @param SearchAdminsRequest $request
     * @return mixed
     */
    public function searchAdmins(SearchAdminsRequest $request)
    {
        $sortKey = $request->get('sort_key', 'id');
        $sortMethod = $request->get('sort_method', 'asc');

        $admins = Admin::orderBy($sortKey, $sortMethod);

        if(isset($request->id))
        {
            $admins = $admins->where('id', 'like' , '%'.$request->id.'%');
        }
        if(isset($request->name))
        {
            $admins = $admins->where('name', 'like' , '%'.$request->name.'%');
        }
        if(isset($request->phone))
        {
            $admins = $admins->where('phone', 'like' , '%'.$request->phone.'%');
        }
        if(isset($request->email))
        {
            $admins = $admins->where('email', 'like' , '%'.$request->email.'%');
        }

        return $admins->paginate(10);
    }

    /**
     * @param MakeAdminRequest $request
     * @return void
     */
    public function createAdmin(MakeAdminRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = Hash::make($request->password);
        if(isset($request->avatar))
        {
            $requestData['avatar'] = $this->fileUploadService->save($request->file('avatar'), 'save');
        }

        Admin::create($requestData);
    }

    /**
     * @param $userId
     * @return array
     */
    public function show($userId)
    {
        $user = Admin::findOrFail($userId);

        $adminProducts = AdminProduct::where('admin_id', $user->id)
            ->with('product.options')
            ->paginate(5);
        $data = [
            'admin' => $user,
            'admin_products' => $adminProducts
        ];

        return $data;//AdminResource::make($user->load('products.product'));
    }

    /**
     * @param UpdateAdminRequest $request
     * @param $userId
     * @return void
     */
    public function update(UpdateAdminRequest $request, $userId)
    {
        $requestData = $request->validated();
        $user = Admin::findOrFail($userId);

        if(isset($request->avatar))
        {
            $requestData['avatar'] = $this->fileUploadService->save($request->file('avatar'), 'update', $user->avatar);
        }

        $user->update($requestData);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function regeneratePassword($userId)
    {
        $bytes = random_bytes(4);
        $password = bin2hex($bytes);


        $user = Admin::findOrFail($userId);
        $user->update(['password' => Hash::make($password)]);

        Mail::to($user)->send(new PasswordRestored($password));

        return $this->getSuccessResponse();
//        return (new AdminResource($user))->additional([
//            'password' => $password
//        ]);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($userId)
    {
        $user = Admin::findOrFail($userId);
        $user->delete();
        return $this->getSuccessResponse();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAdminRoles()
    {
        return $this->getResponse(UserTypesEnum::ADMIN_ROLES);
    }

}
