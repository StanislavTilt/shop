<?php

use App\Http\Controllers\API\admin\ArchiveController;
use App\Http\Controllers\API\admin\BadWordsController;
use App\Http\Controllers\API\admin\ColorsController;
use App\Http\Controllers\API\admin\DeliveryCostForecastController;
use App\Http\Controllers\API\admin\LocationSettingsController;
use App\Http\Controllers\API\admin\MessageTemplateController;
use App\Http\Controllers\API\admin\OrderReportsController;
use App\Http\Controllers\API\admin\PromotionsController;
use App\Http\Controllers\API\admin\PushMessageController;
use App\Http\Controllers\API\admin\SeasonController;
use App\Http\Controllers\API\admin\ServerSettingsController;
use App\Http\Controllers\API\admin\StatisticsController;
use App\Http\Controllers\API\admin\StorefrontsController;
use App\Http\Controllers\API\admin\UserAccountController;
use App\Http\Controllers\API\admin\BrandController as AdminBrandController;
use App\Http\Controllers\API\admin\TagsController;
use App\Http\Controllers\API\Auth\AdminLoginController;
use App\Http\Controllers\API\Auth\RestorePasswordController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\Shipment\ShipmentController;
use App\Http\Controllers\API\SuperAdmin\AdminAccountController;
use App\Http\Controllers\API\User\CartController;
use App\Http\Controllers\API\User\OrderController;
use App\Http\Controllers\API\User\OrderReportController;
use App\Http\Controllers\SberbankWebHookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\PhoneVerificationController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\User\ProfileController;
use App\Http\Controllers\API\DocumentController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PromotionController;
use App\Http\Controllers\API\AttributeController;
use App\Http\Controllers\API\StorefrontController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'as' => 'auth.',
    'prefix' => 'auth'
], function () {
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('register', RegisterController::class);
    Route::post('verification/resend-code', [PhoneVerificationController::class, 'resend'])->middleware('throttle:5,1440');
    Route::post('verification/verify', [PhoneVerificationController::class, 'verify']);
    Route::post('verification/get-code', [PhoneVerificationController::class, 'getVerificationCode']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('refresh-token', [LoginController::class, 'refreshToken'])->middleware('auth:sanctum');

    Route::post('get-code', [PhoneVerificationController::class, 'getVerificationCode']);

    Route::post('restore-request',[RestorePasswordController::class,'requestRestore'])->name('restore-request');
    Route::post('restore',[RestorePasswordController::class,'restore'])->name('restore');
});

Route::group([
    'as' => 'admin-login.',
    'prefix' => 'admin-login'
], function () {
    Route::post('login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('refresh-token', [AdminLoginController::class, 'refreshToken'])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:sanctum','admin.plus']
], function(){
    Route::group(['prefix' => 'category'], function (){
        Route::post('create', [\App\Http\Controllers\API\admin\CategoryController::class, 'create']);
        Route::get('show/{category_id}', [\App\Http\Controllers\API\admin\CategoryController::class, 'show']);
        Route::post('update/{category_id}', [\App\Http\Controllers\API\admin\CategoryController::class, 'update']);
        Route::delete('destroy/{category_id}', [\App\Http\Controllers\API\admin\CategoryController::class, 'destroy']);
        Route::get('get-all', [\App\Http\Controllers\API\admin\CategoryController::class, 'getAll']);
    });

    Route::group(['prefix' => 'location-settings'], function (){
        Route::get('get-locations', [LocationSettingsController::class, 'getLocations']);
        Route::get('/', [LocationSettingsController::class, 'index']);
        Route::get('/{locationSetting:id}', [LocationSettingsController::class, 'show']);
        Route::post('update', [LocationSettingsController::class, 'update']);
    });

    Route::group(['prefix' => 'server-settings'], function (){
        Route::get('get-all', [ServerSettingsController::class, 'getAllSettings']);
        Route::group(['prefix' => 'update'], function (){
            Route::post('conversion-commission', [ServerSettingsController::class, 'updateConversionCommission']);
        });
    });


    Route::group(['prefix' => 'users'], function (){
        Route::get('get-all',[UserAccountController::class, 'index']);
        Route::post('search-users',[UserAccountController::class, 'searchUsers']);
        Route::post('create',[UserAccountController::class, 'create']);
        Route::post('update/{user_id}',[UserAccountController::class, 'update']);
        Route::delete('destroy/{user_id}',[UserAccountController::class, 'destroy']);
        Route::get('show/{user_id}',[UserAccountController::class, 'show']);
        Route::get('regenerate-password/{user_id}',[UserAccountController::class, 'regeneratePassword']);
    });

    Route::get('statistics', StatisticsController::class);

    Route::group(['prefix' => 'products'], function (){
        Route::post('create',[\App\Http\Controllers\API\admin\ProductController::class, 'create']);
        Route::get('get-tags',[\App\Http\Controllers\API\admin\ProductController::class, 'getAllTags']);
        Route::get('get-attributes',[\App\Http\Controllers\API\admin\ProductController::class, 'getAllAttributes']);
        Route::get('get-seasons',[SeasonController::class, 'index']);
        Route::post('search-products',[\App\Http\Controllers\API\admin\ProductController::class, 'searchProducts']);
        Route::get('show/{product_id}',[\App\Http\Controllers\API\admin\ProductController::class, 'show']);
        Route::put('/{product:id}',[\App\Http\Controllers\API\admin\ProductController::class, 'update']);
        Route::delete('/{product:id}',[\App\Http\Controllers\API\admin\ProductController::class, 'delete']);
        Route::get('data-for-product',[\App\Http\Controllers\API\admin\ProductController::class, 'getDataForProduct']);
        Route::post('count-price',[\App\Http\Controllers\API\admin\ProductController::class, 'getCalculatedPrice']);
    });

    Route::group(['as' => 'vendors.','prefix' => 'vendors'], function (){
        Route::get('/{vendor:id}',[\App\Http\Controllers\API\admin\VendorController::class, 'show'])->name('show');
        Route::put('/{vendor:id}',[\App\Http\Controllers\API\admin\VendorController::class, 'update'])->name('update');
        Route::post('/',[\App\Http\Controllers\API\admin\VendorController::class, 'create'])->name('create');
        Route::post('/search',[\App\Http\Controllers\API\admin\VendorController::class, 'search'])->name('search');
    });

    Route::group(['as' => 'push-message.','prefix' => 'push-message'], function (){
        Route::get('get-types',[PushMessageController::class, 'getTypes'])->name('get-types');
        Route::post('send-push',[PushMessageController::class, 'sendPush'])->name('send-push');
    });

    Route::group(['as' => 'colors.','prefix' => 'colors'], function (){
        Route::post('/',[ColorsController::class, 'create'])->name('create');
        Route::post('/search',[ColorsController::class, 'search'])->name('search');
        Route::get('/{color:id}',[ColorsController::class, 'show'])->name('show');
        Route::put('/{color:id}',[ColorsController::class, 'update'])->name('update');
    });

    Route::group(['as' => 'brands.', 'prefix' => 'brands'], function (){
        Route::get('/{brand:id}',[AdminBrandController::class, 'show'])->name('show');
        Route::put('/{brand:id}',[AdminBrandController::class, 'update'])->name('update');
        Route::post('/',[AdminBrandController::class, 'create'])->name('create');
        Route::post('/search',[AdminBrandController::class, 'search'])->name('search');
    });

    Route::group(['as' => 'tags.','prefix' => 'tags'], function (){
        Route::get('/{tag:id}',[TagsController::class, 'show'])->name('show');
        Route::put('/{tag:id}',[TagsController::class, 'update'])->name('update');
        Route::delete('/{tag:id}',[TagsController::class, 'destroy'])->name('destroy');
        Route::post('/',[TagsController::class, 'create'])->name('create');
        Route::post('/search',[TagsController::class, 'search'])->name('search');
    });

    Route::group(['as' => 'promotions.','prefix' => 'promotions'], function (){
        Route::get('/{promotion:id}',[PromotionsController::class, 'show'])->name('show');
        Route::put('/{promotion:id}',[PromotionsController::class, 'update'])->name('update');
        Route::delete('/{promotion:id}',[PromotionsController::class, 'destroy'])->name('destroy');
        Route::post('/',[PromotionsController::class, 'create'])->name('create');
        Route::get('/',[PromotionsController::class, 'index'])->name('index');
        Route::post('/search',[PromotionsController::class, 'search'])->name('search');
    });


    Route::group(['prefix' => 'archive'], function (){
        Route::get('get-all',[ArchiveController::class, 'getAllArchiveProducts']);
        Route::post('return-to-store',[ArchiveController::class, 'returnToStore']);
        Route::post('destroy/{product_id}',[ArchiveController::class, 'destroy']);
    });

    Route::group(['prefix' => 'storefronts'], function (){
        Route::get('get-all',[StorefrontsController::class, 'index']);
        Route::post('create',[StorefrontsController::class, 'create']);
        Route::get('show/{id}',[StorefrontsController::class, 'show']);
        Route::post('update/{id}',[StorefrontsController::class, 'update']);
        Route::delete('destroy/{id}',[StorefrontsController::class, 'destroy']);
    });

    Route::group(['prefix' => 'order-reports'], function (){
        Route::get('get-all',[OrderReportsController::class, 'index']);
        Route::post('search',[OrderReportsController::class, 'search']);
        Route::get('show/{report_id}',[OrderReportsController::class, 'show']);
        Route::put('change-status/{report_id}',[OrderReportsController::class, 'changeStatus']);
        Route::get('get-statuses',[OrderReportsController::class, 'getStatuses']);
    });


    Route::group(['prefix' => 'orders'], function (){
        Route::get('get-all',[\App\Http\Controllers\API\admin\OrderController::class, 'index']);
        Route::get('show/{order_id}',[\App\Http\Controllers\API\admin\OrderController::class, 'show']);
        Route::post('delete-product-from-order',[\App\Http\Controllers\API\admin\OrderController::class, 'deleteProductFromOrder']);
        Route::post('update-status',[\App\Http\Controllers\API\admin\OrderController::class, 'update']);
        Route::get('export-order-info/{order_id}',[\App\Http\Controllers\API\admin\OrderController::class, 'getInfoInFile']);
        Route::post('search-orders',[\App\Http\Controllers\API\admin\OrderController::class, 'searchOrders']);
        Route::get('get-statuses',[\App\Http\Controllers\API\admin\OrderController::class, 'getOrderStatuses']);
    });

    Route::group(['prefix' => 'bad-words'], function (){
        Route::post('create',[BadWordsController::class, 'create']);
        Route::get('get-all',[BadWordsController::class, 'index']);
        Route::get('show/{bad_word_id}',[BadWordsController::class, 'show']);
        Route::put('update/{bad_word_id}',[BadWordsController::class, 'update']);
        Route::delete('delete/{bad_word_id}',[BadWordsController::class, 'delete']);
    });

    Route::group(['prefix' => 'delivery-cost-forecast'], function (){
        Route::post('create',[DeliveryCostForecastController::class, 'create']);
        Route::get('get-all',[DeliveryCostForecastController::class, 'index']);
        Route::get('show/{bad_word_id}',[DeliveryCostForecastController::class, 'show']);
        Route::put('update/{bad_word_id}',[DeliveryCostForecastController::class, 'update']);
        Route::delete('delete/{bad_word_id}',[DeliveryCostForecastController::class, 'delete']);
    });


    Route::group(['prefix' => 'message-templates'], function (){
        Route::get('get-all',[MessageTemplateController::class, 'index']);
        Route::put('update/{message_template:key}',[MessageTemplateController::class, 'update']);
    });
});

Route::group([
    'as' => 'super-admin.',
    'prefix' => 'super-admin',
    'middleware' => 'super.admin'
], function () {
    Route::group(['prefix' => 'admin-account'], function (){
        Route::post('create', [AdminAccountController::class, 'createAdmin'])->middleware('auth:sanctum');
        Route::get('show/{user_id}', [AdminAccountController::class, 'show'])->middleware('auth:sanctum');
        Route::put('update/{user_id}', [AdminAccountController::class, 'update'])->middleware('auth:sanctum');
        Route::get('regenerate-password/{user_id}', [AdminAccountController::class, 'regeneratePassword'])->middleware('auth:sanctum');
        Route::delete('delete/{user_id}', [AdminAccountController::class, 'destroy'])->middleware('auth:sanctum');
        Route::get('get-all', [AdminAccountController::class, 'getAllAdmins'])->middleware('auth:sanctum');
        Route::get('get-admin-roles', [AdminAccountController::class, 'getAdminRoles'])->middleware('auth:sanctum');
        Route::post('search-admins', [AdminAccountController::class, 'searchAdmins'])->middleware('auth:sanctum');
    });

});

Route::group([
    'as' => 'user.',
    'prefix' => 'user',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [ProfileController::class, 'getUserInfo'])->name('getInfo');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::put('address', [ProfileController::class, 'updateAddress'])->name('updateAddress');
    Route::post('avatar', [ProfileController::class, 'uploadAvatar'])->name('uploadAvatar');
    Route::post('request-change-phone', [ProfileController::class, 'requestChangePhone'])->name('request-change-phone');
    Route::post('validate-change-phone', [ProfileController::class, 'validateChangePhone'])->name('validate-change-phone');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('delete-account-request', [ProfileController::class, 'requestDestroy'])->name('delete-account-request');
    Route::post('validate-delete-account', [ProfileController::class, 'validateDestroy'])->name('validate-delete-account');



    Route::group([
        'as' => 'cart.',
        'prefix' => 'cart'
    ], function () {
        Route::get('/', [CartController::class, 'index'])->name('cart');
        Route::group([
            'as' => 'products.',
            'prefix' => 'products'
        ], function () {
            Route::post('/', [CartController::class, 'addProduct'])->name('add');
            Route::put('{cartProduct}', [CartController::class, 'updateCartProduct'])->name('update');
            Route::delete('{cartProduct}', [CartController::class, 'removeCartProduct'])->name('remove');
        });
    });

    Route::group([
        'prefix' => 'shipment',
        'middleware' => 'auth:sanctum'
    ], function (){
        Route::get('get-delivery-points', [ShipmentController::class, 'getDeliveryPoints'])->name('get-delivery-points');
    });

    Route::apiResource('/orders', OrderController::class);
    Route::group([
        'prefix' => 'orders/report',
        'middleware' => 'auth:sanctum'
    ], function (){
        Route::post('/', [OrderReportController::class, 'store']);
        Route::get('/get-properties', [OrderReportController::class, 'getMessagesToStoreOrderReport']);
    });
});

Route::group([
    'as' => 'products.',
    'prefix' => 'products',
], function () {
    Route::post('/', [ProductController::class, 'getAll'])->name('getAll');
    Route::get('after-date', [ProductController::class, 'getCreatedAfterDate']);
    Route::get('filter-data', [ProductController::class, 'getAvailableFilters'])->name('getAvailableFilters');
    Route::get('{id}', [ProductController::class, 'getProductById'])->name('getProductById');
});

Route::get('brands', [BrandController::class, 'getAll'])->name('brands.getAll');

Route::group([
    'as' => 'categories.',
    'prefix' => 'categories'
], function () {
    Route::get('/', [CategoryController::class, 'getAll'])->name('categories.getAll');
    Route::get('{id}', [CategoryController::class, 'getById'])->name('categories.getById');
});

Route::group([
    'as' => 'documents.',
    'prefix' => 'documents',
], function () {
    Route::get('/', [DocumentController::class, 'getAll'])->name('getAll');
    Route::get('{document}', [DocumentController::class, 'getBySlug'])->name('getBySlug');
});

Route::group([
    'as' => 'promotions.',
    'prefix' => 'promotions'
], function () {
    Route::get('/', [PromotionController::class, 'getAll'])->name('getAll');
    Route::get('{id}', [PromotionController::class, 'getById'])->name('getById');
});

Route::group([
    'as' => 'storefronts.',
    'prefix' => 'storefronts'
], function () {
    Route::get('/', [StorefrontController::class, 'getAll'])->name('getAll');
    Route::get('{id}', [StorefrontController::class, 'getById'])->name('getById');
});

Route::get('attributes', [AttributeController::class, 'getAll'])->name('attribute.getAll');

Route::get('search', SearchController::class);

Route::group([
    'as' => 'sber.',
    'prefix' => 'sber',
], function (){
   Route::get('callback', SberbankWebHookController::class)->name('callback');
});
