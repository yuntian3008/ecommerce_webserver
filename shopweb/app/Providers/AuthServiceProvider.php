<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Order::class => OrderPolicy::class,
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan([


            '*' => 'Tất cả các quyền (*)',

            // administratorManagement
            'read-scopes' => 'Đọc tất cả quyền có sẵn',
            'grant-permissions' => 'Quản lí quyền của quản trị viên',

            'create-administrators' => 'Tạo tài khoản quản trị viên',
            'read-administrators' => 'Xem thông tin quản trị viên',
            'update-administrators' => 'Sửa thông tin / cấp lại mật khẩu quản trị viên',
            'block-administrators' => 'Khóa/mở tài khoản quản trị viên',

            // userManagement
            'read-users' => 'Xem thông tin khách hàng',
            'block-users' => 'Khóa/mở tài khoản khách hàng',


            // productManagement
            'product-management' => 'Quản lý thông tin / hình ảnh sản phẩm',

            // categoryManagement
            'category-management' => 'Quản lý thông tin danh mục',

            // orderManagement
            'read-orders' => 'Xem thông tin / trạng thái đơn hàng',

            'read-order-items' => 'Xem chi tiết của đơn hàng',

            'cancel-orders' => 'Hủy đơn hàng',
            'approve-orders' => 'Nhận đơn hàng',
            'package-orders' => 'Đóng gói đơn hàng',
            'ship-orders' => 'Giao hàng',
            'to-complete-orders' => 'Hoàn thành đơn'
        ]);
        //
    }
}
