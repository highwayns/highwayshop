<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('merchantadmin')->group(function () {

        Route::get('/', 'Highwayns\MerchantAdmin\Http\Controllers\Controller@redirectToLogin');

        // Login Routes
        Route::get('/login', 'Highwayns\Merchant\Http\Controllers\SessionController@create')->defaults('_config', [
            'view' => 'merchantadmin::users.sessions.create'
        ])->name('merchantadmin.session.create');

        //login post route to admin auth controller
        Route::post('/login', 'Highwayns\Merchant\Http\Controllers\SessionController@store')->defaults('_config', [
            'redirect' => 'merchantadmin.dashboard.index'
        ])->name('merchantadmin.session.store');

        // Forget Password Routes
        Route::get('/forget-password', 'Highwayns\Merchant\Http\Controllers\ForgetPasswordController@create')->defaults('_config', [
            'view' => 'merchantadmin::users.forget-password.create'
        ])->name('merchantadmin.forget-password.create');

        Route::post('/forget-password', 'Highwayns\Merchant\Http\Controllers\ForgetPasswordController@store')->name('merchantadmin.forget-password.store');

        // Reset Password Routes
        Route::get('/reset-password/{token}', 'Highwayns\Merchant\Http\Controllers\ResetPasswordController@create')->defaults('_config', [
            'view' => 'merchantadmin::users.reset-password.create'
        ])->name('merchantadmin.reset-password.create');

        Route::post('/reset-password', 'Highwayns\Merchant\Http\Controllers\ResetPasswordController@store')->defaults('_config', [
            'redirect' => 'merchantadmin.dashboard.index'
        ])->name('merchantadmin.reset-password.store');


        // Admin Routes
        Route::group(['middleware' => ['merchantadmin']], function () {
            Route::get('/logout', 'Highwayns\Merchant\Http\Controllers\SessionController@destroy')->defaults('_config', [
                'redirect' => 'merchantadmin.session.create'
            ])->name('merchantadmin.session.destroy');

            // Dashboard Route
            Route::get('dashboard', 'Highwayns\MerchantAdmin\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'merchantadmin::dashboard.index'
            ])->name('merchantadmin.dashboard.index');

            //Customer Management Routes
            Route::get('customers', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@index')->defaults('_config', [
                'view' => 'merchantadmin::customers.index'
            ])->name('merchantadmin.customer.index');

            Route::get('customers/create', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@create')->defaults('_config',[
                'view' => 'merchantadmin::customers.create'
            ])->name('merchantadmin.customer.create');

            Route::post('customers/create', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@store')->defaults('_config',[
                'redirect' => 'merchantadmin.customer.index'
            ])->name('merchantadmin.customer.store');

            Route::get('customers/edit/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@edit')->defaults('_config',[
                'view' => 'merchantadmin::customers.edit'
            ])->name('merchantadmin.customer.edit');

            Route::get('customers/note/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@createNote')->defaults('_config',[
                'view' => 'merchantadmin::customers.note'
            ])->name('merchantadmin.customer.note.create');

            Route::put('customers/note/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@storeNote')->defaults('_config',[
                'redirect' => 'merchantadmin.customer.index'
            ])->name('merchantadmin.customer.note.store');

            Route::put('customers/edit/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.index'
            ])->name('merchantadmin.customer.update');

            Route::post('customers/delete/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@destroy')->name('merchantadmin.customer.delete');

            Route::post('customers/masssdelete', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@massDestroy')->name('merchantadmin.customer.mass-delete');

            Route::post('customers/masssupdate', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerController@massUpdate')->name('merchantadmin.customer.mass-update');

            Route::get('reviews', 'Webkul\Product\Http\Controllers\ReviewController@index')->defaults('_config',[
                'view' => 'merchantadmin::customers.reviews.index'
            ])->name('merchantadmin.customer.review.index');

            //Customer's addresses routes
            Route::get('customers/{id}/addresses', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@index')->defaults('_config', [
                'view' => 'merchantadmin::customers.addresses.index'
            ])->name('merchantadmin.customer.addresses.index');

            Route::get('customers/{id}/addresses/create', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@create')->defaults('_config',[
                'view' => 'merchantadmin::customers.addresses.create'
            ])->name('merchantadmin.customer.addresses.create');

            Route::post('customers/{id}/addresses/create', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@store')->defaults('_config',[
                'redirect' => 'merchantadmin.customer.addresses.index'
            ])->name('merchantadmin.customer.addresses.store');

            Route::get('customers/addresses/edit/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@edit')->defaults('_config',[
                'view' => 'merchantadmin::customers.addresses.edit'
            ])->name('merchantadmin.customer.addresses.edit');

            Route::put('customers/addresses/edit/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.addresses.index'
            ])->name('merchantadmin.customer.addresses.update');

            Route::post('customers/addresses/delete/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@destroy')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.addresses.index'
            ])->name('merchantadmin.customer.addresses.delete');

            //mass destroy
            Route::post('customers/{id}/addresses', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\AddressController@massDestroy')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.addresses.index'
            ])->name('merchantadmin.customer.addresses.massdelete');

            // Configuration routes
            Route::get('configuration/{slug?}/{slug2?}', 'Highwayns\MerchantAdmin\Http\Controllers\ConfigurationController@index')->defaults('_config', [
                'view' => 'merchantadmin::configuration.index'
            ])->name('merchantadmin.configuration.index');

            Route::post('configuration/{slug?}/{slug2?}', 'Highwayns\MerchantAdmin\Http\Controllers\ConfigurationController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.configuration.index'
            ])->name('merchantadmin.configuration.index.store');

            Route::get('configuration/{slug?}/{slug2?}/{path}', 'Highwayns\MerchantAdmin\Http\Controllers\ConfigurationController@download')->defaults('_config', [
                'redirect' => 'merchantadmin.configuration.index'
            ])->name('merchantadmin.configuration.download');

            // Reviews Routes
            Route::get('reviews/edit/{id}', 'Webkul\Product\Http\Controllers\ReviewController@edit')->defaults('_config',[
                'view' => 'merchantadmin::customers.reviews.edit'
            ])->name('merchantadmin.customer.review.edit');

            Route::put('reviews/edit/{id}', 'Webkul\Product\Http\Controllers\ReviewController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.review.index'
            ])->name('merchantadmin.customer.review.update');

            Route::post('reviews/delete/{id}', 'Webkul\Product\Http\Controllers\ReviewController@destroy')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.review.index'
            ])->name('merchantadmin.customer.review.delete');

            //mass destroy
            Route::post('reviews/massdestroy', 'Webkul\Product\Http\Controllers\ReviewController@massDestroy')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.review.index'
            ])->name('merchantadmin.customer.review.massdelete');

            //mass update
            Route::post('reviews/massupdate', 'Webkul\Product\Http\Controllers\ReviewController@massUpdate')->defaults('_config', [
                'redirect' => 'merchantadmin.customer.review.index'
            ])->name('merchantadmin.customer.review.massupdate');

            // Customer Groups Routes
            Route::get('groups', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerGroupController@index')->defaults('_config',[
                'view' => 'merchantadmin::customers.groups.index'
            ])->name('merchantadmin.groups.index');

            Route::get('groups/create', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerGroupController@create')->defaults('_config',[
                'view' => 'merchantadmin::customers.groups.create'
            ])->name('merchantadmin.groups.create');

            Route::post('groups/create', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerGroupController@store')->defaults('_config',[
                'redirect' => 'merchantadmin.groups.index'
            ])->name('merchantadmin.groups.store');

            Route::get('groups/edit/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerGroupController@edit')->defaults('_config',[
                'view' => 'merchantadmin::customers.groups.edit'
            ])->name('merchantadmin.groups.edit');

            Route::put('groups/edit/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerGroupController@update')->defaults('_config',[
                'redirect' => 'merchantadmin.groups.index'
            ])->name('merchantadmin.groups.update');

            Route::post('groups/delete/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Customer\CustomerGroupController@destroy')->name('merchantadmin.groups.delete');


            // Sales Routes
            Route::prefix('sales')->group(function () {
                // Sales Order Routes
                Route::get('/orders', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\OrderController@index')->defaults('_config', [
                    'view' => 'merchantadmin::sales.orders.index'
                ])->name('merchantadmin.sales.orders.index');

                Route::get('/orders/view/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\OrderController@view')->defaults('_config', [
                    'view' => 'merchantadmin::sales.orders.view'
                ])->name('merchantadmin.sales.orders.view');

                Route::get('/orders/cancel/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\OrderController@cancel')->defaults('_config', [
                    'view' => 'merchantadmin::sales.orders.cancel'
                ])->name('merchantadmin.sales.orders.cancel');


                // Sales Invoices Routes
                Route::get('/invoices', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\InvoiceController@index')->defaults('_config', [
                    'view' => 'merchantadmin::sales.invoices.index'
                ])->name('merchantadmin.sales.invoices.index');

                Route::get('/invoices/create/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\InvoiceController@create')->defaults('_config', [
                    'view' => 'merchantadmin::sales.invoices.create'
                ])->name('merchantadmin.sales.invoices.create');

                Route::post('/invoices/create/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\InvoiceController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.sales.orders.view'
                ])->name('merchantadmin.sales.invoices.store');

                Route::get('/invoices/view/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\InvoiceController@view')->defaults('_config', [
                    'view' => 'merchantadmin::sales.invoices.view'
                ])->name('merchantadmin.sales.invoices.view');

                Route::get('/invoices/print/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\InvoiceController@print')->defaults('_config', [
                    'view' => 'merchantadmin::sales.invoices.print'
                ])->name('merchantadmin.sales.invoices.print');


                // Sales Shipments Routes
                Route::get('/shipments', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\ShipmentController@index')->defaults('_config', [
                    'view' => 'merchantadmin::sales.shipments.index'
                ])->name('merchantadmin.sales.shipments.index');

                Route::get('/shipments/create/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\ShipmentController@create')->defaults('_config', [
                    'view' => 'merchantadmin::sales.shipments.create'
                ])->name('merchantadmin.sales.shipments.create');

                Route::post('/shipments/create/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\ShipmentController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.sales.orders.view'
                ])->name('merchantadmin.sales.shipments.store');

                Route::get('/shipments/view/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\ShipmentController@view')->defaults('_config', [
                    'view' => 'merchantadmin::sales.shipments.view'
                ])->name('merchantadmin.sales.shipments.view');


                // Sales Redunds Routes
                Route::get('/refunds', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\RefundController@index')->defaults('_config', [
                    'view' => 'merchantadmin::sales.refunds.index'
                ])->name('merchantadmin.sales.refunds.index');

                Route::get('/refunds/create/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\RefundController@create')->defaults('_config', [
                    'view' => 'merchantadmin::sales.refunds.create'
                ])->name('merchantadmin.sales.refunds.create');

                Route::post('/refunds/create/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\RefundController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.sales.orders.view'
                ])->name('merchantadmin.sales.refunds.store');

                Route::post('/refunds/update-qty/{order_id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\RefundController@updateQty')->defaults('_config', [
                    'redirect' => 'merchantadmin.sales.orders.view'
                ])->name('merchantadmin.sales.refunds.update_qty');

                Route::get('/refunds/view/{id}', 'Highwayns\MerchantAdmin\Http\Controllers\Sales\RefundController@view')->defaults('_config', [
                    'view' => 'merchantadmin::sales.refunds.view'
                ])->name('merchantadmin.sales.refunds.view');
            });

            // Catalog Routes
            Route::prefix('catalog')->group(function () {
                Route::get('/sync', 'Webkul\Product\Http\Controllers\ProductController@sync');

                // Catalog Product Routes
                Route::get('/products', 'Webkul\Product\Http\Controllers\ProductController@index')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.products.index'
                ])->name('merchantadmin.catalog.products.index');

                Route::get('/products/create', 'Webkul\Product\Http\Controllers\ProductController@create')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.products.create'
                ])->name('merchantadmin.catalog.products.create');

                Route::post('/products/create', 'Webkul\Product\Http\Controllers\ProductController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.products.edit'
                ])->name('merchantadmin.catalog.products.store');

                Route::get('/products/edit/{id}', 'Webkul\Product\Http\Controllers\ProductController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.products.edit'
                ])->name('merchantadmin.catalog.products.edit');

                Route::put('/products/edit/{id}', 'Webkul\Product\Http\Controllers\ProductController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.products.index'
                ])->name('merchantadmin.catalog.products.update');

                Route::post('/products/upload-file/{id}', 'Webkul\Product\Http\Controllers\ProductController@uploadLink')->name('merchantadmin.catalog.products.upload_link');

                Route::post('/products/upload-sample/{id}', 'Webkul\Product\Http\Controllers\ProductController@uploadSample')->name('merchantadmin.catalog.products.upload_sample');

                //product delete
                Route::post('/products/delete/{id}', 'Webkul\Product\Http\Controllers\ProductController@destroy')->name('merchantadmin.catalog.products.delete');

                //product massaction
                Route::post('products/massaction', 'Webkul\Product\Http\Controllers\ProductController@massActionHandler')->name('merchantadmin.catalog.products.massaction');

                //product massdelete
                Route::post('products/massdelete', 'Webkul\Product\Http\Controllers\ProductController@massDestroy')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.products.index'
                ])->name('merchantadmin.catalog.products.massdelete');

                //product massupdate
                Route::post('products/massupdate', 'Webkul\Product\Http\Controllers\ProductController@massUpdate')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.products.index'
                ])->name('merchantadmin.catalog.products.massupdate');

                //product search for linked products
                Route::get('products/search', 'Webkul\Product\Http\Controllers\ProductController@productLinkSearch')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.products.edit'
                ])->name('merchantadmin.catalog.products.productlinksearch');

                Route::get('products/search-simple-products', 'Webkul\Product\Http\Controllers\ProductController@searchSimpleProducts')->name('merchantadmin.catalog.products.search_simple_product');

                Route::get('/products/{id}/{attribute_id}', 'Webkul\Product\Http\Controllers\ProductController@download')->defaults('_config', [
                    'view' => 'merchantadmin.catalog.products.edit'
                ])->name('merchantadmin.catalog.products.file.download');

                // Catalog Category Routes
                Route::get('/categories', 'Webkul\Category\Http\Controllers\CategoryController@index')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.categories.index'
                ])->name('merchantadmin.catalog.categories.index');

                Route::get('/categories/create', 'Webkul\Category\Http\Controllers\CategoryController@create')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.categories.create'
                ])->name('merchantadmin.catalog.categories.create');

                Route::post('/categories/create', 'Webkul\Category\Http\Controllers\CategoryController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.categories.index'
                ])->name('merchantadmin.catalog.categories.store');

                Route::get('/categories/edit/{id}', 'Webkul\Category\Http\Controllers\CategoryController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.categories.edit'
                ])->name('merchantadmin.catalog.categories.edit');

                Route::put('/categories/edit/{id}', 'Webkul\Category\Http\Controllers\CategoryController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.categories.index'
                ])->name('merchantadmin.catalog.categories.update');

                Route::post('/categories/delete/{id}', 'Webkul\Category\Http\Controllers\CategoryController@destroy')->name('merchantadmin.catalog.categories.delete');


                // Catalog Attribute Routes
                Route::get('/attributes', 'Webkul\Attribute\Http\Controllers\AttributeController@index')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.attributes.index'
                ])->name('merchantadmin.catalog.attributes.index');

                Route::get('/attributes/create', 'Webkul\Attribute\Http\Controllers\AttributeController@create')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.attributes.create'
                ])->name('merchantadmin.catalog.attributes.create');

                Route::post('/attributes/create', 'Webkul\Attribute\Http\Controllers\AttributeController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.attributes.index'
                ])->name('merchantadmin.catalog.attributes.store');

                Route::get('/attributes/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.attributes.edit'
                ])->name('merchantadmin.catalog.attributes.edit');

                Route::put('/attributes/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.attributes.index'
                ])->name('merchantadmin.catalog.attributes.update');

                Route::post('/attributes/delete/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@destroy')->name('merchantadmin.catalog.attributes.delete');

                Route::post('/attributes/massdelete', 'Webkul\Attribute\Http\Controllers\AttributeController@massDestroy')->name('merchantadmin.catalog.attributes.massdelete');

                // Catalog Family Routes
                Route::get('/families', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@index')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.families.index'
                ])->name('merchantadmin.catalog.families.index');

                Route::get('/families/create', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@create')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.families.create'
                ])->name('merchantadmin.catalog.families.create');

                Route::post('/families/create', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.families.index'
                ])->name('merchantadmin.catalog.families.store');

                Route::get('/families/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::catalog.families.edit'
                ])->name('merchantadmin.catalog.families.edit');

                Route::put('/families/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog.families.index'
                ])->name('merchantadmin.catalog.families.update');

                Route::post('/families/delete/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@destroy')->name('merchantadmin.catalog.families.delete');
            });

            // User Routes
            //datagrid for backend users
            Route::get('/users', 'Highwayns\Merchant\Http\Controllers\UserController@index')->defaults('_config', [
                'view' => 'merchantadmin::users.users.index'
            ])->name('merchantadmin.users.index');

            //create backend user get
            Route::get('/users/create', 'Highwayns\Merchant\Http\Controllers\UserController@create')->defaults('_config', [
                'view' => 'merchantadmin::users.users.create'
            ])->name('merchantadmin.users.create');

            //create backend user post
            Route::post('/users/create', 'Highwayns\Merchant\Http\Controllers\UserController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.users.index'
            ])->name('merchantadmin.users.store');

            //delete backend user view
            Route::get('/users/edit/{id}', 'Highwayns\Merchant\Http\Controllers\UserController@edit')->defaults('_config', [
                'view' => 'merchantadmin::users.users.edit'
            ])->name('merchantadmin.users.edit');

            //edit backend user submit
            Route::put('/users/edit/{id}', 'Highwayns\Merchant\Http\Controllers\UserController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.users.index'
            ])->name('merchantadmin.users.update');

            //delete backend user
            Route::post('/users/delete/{id}', 'Highwayns\Merchant\Http\Controllers\UserController@destroy')->name('merchantadmin.users.delete');

            Route::post('/confirm/destroy', 'Highwayns\Merchant\Http\Controllers\UserController@destroySelf')->defaults('_config', [
                'redirect' => 'merchantadmin.users.index'
            ])->name('merchantadmin.users.confirm.destroy');

            // User Role Routes
            Route::get('/roles', 'Highwayns\Merchant\Http\Controllers\RoleController@index')->defaults('_config', [
                'view' => 'merchantadmin::users.roles.index'
            ])->name('merchantadmin.roles.index');

            Route::get('/roles/create', 'Highwayns\Merchant\Http\Controllers\RoleController@create')->defaults('_config', [
                'view' => 'merchantadmin::users.roles.create'
            ])->name('merchantadmin.roles.create');

            Route::post('/roles/create', 'Highwayns\Merchant\Http\Controllers\RoleController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.roles.index'
            ])->name('merchantadmin.roles.store');

            Route::get('/roles/edit/{id}', 'Highwayns\Merchant\Http\Controllers\RoleController@edit')->defaults('_config', [
                'view' => 'merchantadmin::users.roles.edit'
            ])->name('merchantadmin.roles.edit');

            Route::put('/roles/edit/{id}', 'Highwayns\Merchant\Http\Controllers\RoleController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.roles.index'
            ])->name('merchantadmin.roles.update');

            Route::post('/roles/delete/{id}', 'Highwayns\Merchant\Http\Controllers\RoleController@destroy')->name('merchantadmin.roles.delete');


            // Locale Routes
            Route::get('/locales', 'Webkul\Core\Http\Controllers\LocaleController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.locales.index'
            ])->name('merchantadmin.locales.index');

            Route::get('/locales/create', 'Webkul\Core\Http\Controllers\LocaleController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.locales.create'
            ])->name('merchantadmin.locales.create');

            Route::post('/locales/create', 'Webkul\Core\Http\Controllers\LocaleController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.locales.index'
            ])->name('merchantadmin.locales.store');

            Route::get('/locales/edit/{id}', 'Webkul\Core\Http\Controllers\LocaleController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.locales.edit'
            ])->name('merchantadmin.locales.edit');

            Route::put('/locales/edit/{id}', 'Webkul\Core\Http\Controllers\LocaleController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.locales.index'
            ])->name('merchantadmin.locales.update');

            Route::post('/locales/delete/{id}', 'Webkul\Core\Http\Controllers\LocaleController@destroy')->name('merchantadmin.locales.delete');


            // Currency Routes
            Route::get('/currencies', 'Webkul\Core\Http\Controllers\CurrencyController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.currencies.index'
            ])->name('merchantadmin.currencies.index');

            Route::get('/currencies/create', 'Webkul\Core\Http\Controllers\CurrencyController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.currencies.create'
            ])->name('merchantadmin.currencies.create');

            Route::post('/currencies/create', 'Webkul\Core\Http\Controllers\CurrencyController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.currencies.index'
            ])->name('merchantadmin.currencies.store');

            Route::get('/currencies/edit/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.currencies.edit'
            ])->name('merchantadmin.currencies.edit');

            Route::put('/currencies/edit/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.currencies.index'
            ])->name('merchantadmin.currencies.update');

            Route::post('/currencies/delete/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@destroy')->name('merchantadmin.currencies.delete');

            Route::post('/currencies/massdelete', 'Webkul\Core\Http\Controllers\CurrencyController@massDestroy')->name('merchantadmin.currencies.massdelete');


            // Exchange Rates Routes
            Route::get('/exchange_rates', 'Webkul\Core\Http\Controllers\ExchangeRateController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.exchange_rates.index'
            ])->name('merchantadmin.exchange_rates.index');

            Route::get('/exchange_rates/create', 'Webkul\Core\Http\Controllers\ExchangeRateController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.exchange_rates.create'
            ])->name('merchantadmin.exchange_rates.create');

            Route::post('/exchange_rates/create', 'Webkul\Core\Http\Controllers\ExchangeRateController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.exchange_rates.index'
            ])->name('merchantadmin.exchange_rates.store');

            Route::get('/exchange_rates/edit/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.exchange_rates.edit'
            ])->name('merchantadmin.exchange_rates.edit');

            Route::get('/exchange_rates/update-rates/{service}', 'Webkul\Core\Http\Controllers\ExchangeRateController@updateRates')->name('merchantadmin.exchange_rates.update-rates');

            Route::put('/exchange_rates/edit/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.exchange_rates.index'
            ])->name('merchantadmin.exchange_rates.update');

            Route::post('/exchange_rates/delete/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@destroy')->name('merchantadmin.exchange_rates.delete');


            // Inventory Source Routes
            Route::get('/inventory_sources', 'Webkul\Inventory\Http\Controllers\InventorySourceController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.inventory_sources.index'
            ])->name('merchantadmin.inventory_sources.index');

            Route::get('/inventory_sources/create', 'Webkul\Inventory\Http\Controllers\InventorySourceController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.inventory_sources.create'
            ])->name('merchantadmin.inventory_sources.create');

            Route::post('/inventory_sources/create', 'Webkul\Inventory\Http\Controllers\InventorySourceController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.inventory_sources.index'
            ])->name('merchantadmin.inventory_sources.store');

            Route::get('/inventory_sources/edit/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.inventory_sources.edit'
            ])->name('merchantadmin.inventory_sources.edit');

            Route::put('/inventory_sources/edit/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.inventory_sources.index'
            ])->name('merchantadmin.inventory_sources.update');

            Route::post('/inventory_sources/delete/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@destroy')->name('merchantadmin.inventory_sources.delete');

            // Vendor Source Routes
            Route::get('/vendor_sources', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.vendor_sources.index'
            ])->name('merchantadmin.vendor_sources.index');

            Route::get('/vendor_sources/create', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.vendor_sources.create'
            ])->name('merchantadmin.vendor_sources.create');

            Route::post('/vendor_sources/create', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.vendor_sources.index'
            ])->name('merchantadmin.vendor_sources.store');

            Route::get('/vendor_sources/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.vendor_sources.edit'
            ])->name('merchantadmin.vendor_sources.edit');

            Route::put('/vendor_sources/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.vendor_sources.index'
            ])->name('merchantadmin.vendor_sources.update');

            Route::post('/vendor_sources/delete/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@destroy')->name('merchantadmin.vendor_sources.delete');

            Route::post('/vendorconfirm/destroy', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'merchantadmin.vendor_sources.index'
            ])->name('merchantadmin.vendors.confirm.destroy');

            // Vendor Role Routes
            Route::get('/vendorroles', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.vendor_roles.index'
            ])->name('merchantadmin.vendorroles.index');

            Route::get('/vendorroles/create', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.vendor_roles.create'
            ])->name('merchantadmin.vendorroles.create');

            Route::post('/vendorroles/create', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.vendorroles.index'
            ])->name('merchantadmin.vendorroles.store');

            Route::get('/vendorroles/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.vendor_roles.edit'
            ])->name('merchantadmin.vendorroles.edit');

            Route::put('/vendorroles/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.vendorroles.index'
            ])->name('merchantadmin.vendorroles.update');

            Route::post('/vendorroles/delete/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@destroy')->name('merchantadmin.vendorroles.delete');

            // Agent Source Routes
            Route::get('/merchant_sources', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.merchant_sources.index'
            ])->name('merchantadmin.merchant_sources.index');

            Route::get('/merchant_sources/create', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.merchant_sources.create'
            ])->name('merchantadmin.merchant_sources.create');

            Route::post('/merchant_sources/create', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.merchant_sources.index'
            ])->name('merchantadmin.merchant_sources.store');

            Route::get('/merchant_sources/edit/{id}', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.merchant_sources.edit'
            ])->name('merchantadmin.merchant_sources.edit');

            Route::put('/merchant_sources/edit/{id}', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.merchant_sources.index'
            ])->name('merchantadmin.merchant_sources.update');

            Route::post('/merchant_sources/delete/{id}', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@destroy')->name('merchantadmin.merchant_sources.delete');

            Route::post('/merchantconfirm/destroy', 'Highwayns\Merchant\Http\Controllers\AgentSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'merchantadmin.merchant_sources.index'
            ])->name('merchantadmin.merchants.confirm.destroy');

            // Agent Role Routes
            Route::get('/merchantroles', 'Highwayns\Merchant\Http\Controllers\AgentRoleController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.merchant_roles.index'
            ])->name('merchantadmin.merchantroles.index');

            Route::get('/merchantroles/create', 'Highwayns\Merchant\Http\Controllers\AgentRoleController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.merchant_roles.create'
            ])->name('merchantadmin.merchantroles.create');

            Route::post('/merchantroles/create', 'Highwayns\Merchant\Http\Controllers\AgentRoleController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.merchantroles.index'
            ])->name('merchantadmin.merchantroles.store');

            Route::get('/merchantroles/edit/{id}', 'Highwayns\Merchant\Http\Controllers\AgentRoleController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.merchant_roles.edit'
            ])->name('merchantadmin.merchantroles.edit');

            Route::put('/merchantroles/edit/{id}', 'Highwayns\Merchant\Http\Controllers\AgentRoleController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.merchantroles.index'
            ])->name('merchantadmin.merchantroles.update');

            Route::post('/merchantroles/delete/{id}', 'Highwayns\Merchant\Http\Controllers\AgentRoleController@destroy')->name('merchantadmin.merchantroles.delete');

            // Channel Routes
            Route::get('/channels', 'Webkul\Core\Http\Controllers\ChannelController@index')->defaults('_config', [
                'view' => 'merchantadmin::settings.channels.index'
            ])->name('merchantadmin.channels.index');

            Route::get('/channels/create', 'Webkul\Core\Http\Controllers\ChannelController@create')->defaults('_config', [
                'view' => 'merchantadmin::settings.channels.create'
            ])->name('merchantadmin.channels.create');

            Route::post('/channels/create', 'Webkul\Core\Http\Controllers\ChannelController@store')->defaults('_config', [
                'redirect' => 'merchantadmin.channels.index'
            ])->name('merchantadmin.channels.store');

            Route::get('/channels/edit/{id}', 'Webkul\Core\Http\Controllers\ChannelController@edit')->defaults('_config', [
                'view' => 'merchantadmin::settings.channels.edit'
            ])->name('merchantadmin.channels.edit');

            Route::put('/channels/edit/{id}', 'Webkul\Core\Http\Controllers\ChannelController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.channels.index'
            ])->name('merchantadmin.channels.update');

            Route::post('/channels/delete/{id}', 'Webkul\Core\Http\Controllers\ChannelController@destroy')->name('merchantadmin.channels.delete');


            // AgentAdmin Profile route
            Route::get('/account', 'Highwayns\Merchant\Http\Controllers\AccountController@edit')->defaults('_config', [
                'view' => 'merchantadmin::account.edit'
            ])->name('merchantadmin.account.edit');

            Route::put('/account', 'Highwayns\Merchant\Http\Controllers\AccountController@update')->name('merchantadmin.account.update');


            // Admin Store Front Settings Route
            Route::get('/subscribers','Webkul\Core\Http\Controllers\SubscriptionController@index')->defaults('_config',[
                'view' => 'merchantadmin::customers.subscribers.index'
            ])->name('merchantadmin.customers.subscribers.index');

            //destroy a newsletter subscription item
            Route::post('subscribers/delete/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@destroy')->name('merchantadmin.customers.subscribers.delete');

            Route::get('subscribers/edit/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@edit')->defaults('_config', [
                'view' => 'merchantadmin::customers.subscribers.edit'
            ])->name('merchantadmin.customers.subscribers.edit');

            Route::put('subscribers/update/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.customers.subscribers.index'
            ])->name('merchantadmin.customers.subscribers.update');

            //slider index
            Route::get('/slider','Webkul\Core\Http\Controllers\SliderController@index')->defaults('_config',[
                'view' => 'merchantadmin::settings.sliders.index'
            ])->name('merchantadmin.sliders.index');

            //slider create show
            Route::get('slider/create','Webkul\Core\Http\Controllers\SliderController@create')->defaults('_config',[
                'view' => 'merchantadmin::settings.sliders.create'
            ])->name('merchantadmin.sliders.create');

            //slider create show
            Route::post('slider/create','Webkul\Core\Http\Controllers\SliderController@store')->defaults('_config',[
                'redirect' => 'merchantadmin.sliders.index'
            ])->name('merchantadmin.sliders.store');

            //slider edit show
            Route::get('slider/edit/{id}','Webkul\Core\Http\Controllers\SliderController@edit')->defaults('_config',[
                'view' => 'merchantadmin::settings.sliders.edit'
            ])->name('merchantadmin.sliders.edit');

            //slider edit update
            Route::post('slider/edit/{id}','Webkul\Core\Http\Controllers\SliderController@update')->defaults('_config',[
                'redirect' => 'merchantadmin.sliders.index'
            ])->name('merchantadmin.sliders.update');

            //destroy a slider item
            Route::post('slider/delete/{id}', 'Webkul\Core\Http\Controllers\SliderController@destroy')->name('merchantadmin.sliders.delete');

            //tax routes
            Route::get('/tax-categories', 'Webkul\Tax\Http\Controllers\TaxController@index')->defaults('_config', [
                'view' => 'merchantadmin::tax.tax-categories.index'
            ])->name('merchantadmin.tax-categories.index');


            // tax category routes
            Route::get('/tax-categories/create', 'Webkul\Tax\Http\Controllers\TaxCategoryController@show')->defaults('_config', [
                'view' => 'merchantadmin::tax.tax-categories.create'
            ])->name('merchantadmin.tax-categories.show');

            Route::post('/tax-categories/create', 'Webkul\Tax\Http\Controllers\TaxCategoryController@create')->defaults('_config', [
                'redirect' => 'merchantadmin.tax-categories.index'
            ])->name('merchantadmin.tax-categories.create');

            Route::get('/tax-categories/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@edit')->defaults('_config', [
                'view' => 'merchantadmin::tax.tax-categories.edit'
            ])->name('merchantadmin.tax-categories.edit');

            Route::put('/tax-categories/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.tax-categories.index'
            ])->name('merchantadmin.tax-categories.update');

            Route::post('/tax-categories/delete/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@destroy')->name('merchantadmin.tax-categories.delete');
            //tax category ends


            //tax rate
            Route::get('tax-rates', 'Webkul\Tax\Http\Controllers\TaxRateController@index')->defaults('_config', [
                'view' => 'merchantadmin::tax.tax-rates.index'
            ])->name('merchantadmin.tax-rates.index');

            Route::get('tax-rates/create', 'Webkul\Tax\Http\Controllers\TaxRateController@show')->defaults('_config', [
                'view' => 'merchantadmin::tax.tax-rates.create'
            ])->name('merchantadmin.tax-rates.show');

            Route::post('tax-rates/create', 'Webkul\Tax\Http\Controllers\TaxRateController@create')->defaults('_config', [
                'redirect' => 'merchantadmin.tax-rates.index'
            ])->name('merchantadmin.tax-rates.create');

            Route::get('tax-rates/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@edit')->defaults('_config', [
                'view' => 'merchantadmin::tax.tax-rates.edit'
            ])->name('merchantadmin.tax-rates.store');

            Route::put('tax-rates/update/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@update')->defaults('_config', [
                'redirect' => 'merchantadmin.tax-rates.index'
            ])->name('merchantadmin.tax-rates.update');

            Route::post('/tax-rates/delete/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@destroy')->name('merchantadmin.tax-rates.delete');

            Route::post('/tax-rates/import', 'Webkul\Tax\Http\Controllers\TaxRateController@import')->defaults('_config', [
                'redirect' => 'merchantadmin.tax-rates.index'
            ])->name('merchantadmin.tax-rates.import');
            //tax rate ends

            //DataGrid Export
            Route::post('merchantadmin/export', 'Highwayns\MerchantAdmin\Http\Controllers\ExportController@export')->name('merchantadmin.datagrid.export');

            Route::prefix('promotion')->group(function () {
                Route::get('/catalog-rules', 'Webkul\Discount\Http\Controllers\CatalogRuleController@index')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.catalog-rule.index'
                ])->name('merchantadmin.catalog-rule.index');

                Route::get('/catalog-rules/create', 'Webkul\Discount\Http\Controllers\CatalogRuleController@create')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.catalog-rule.create'
                ])->name('merchantadmin.catalog-rule.create');

                Route::post('/catalog-rules/create', 'Webkul\Discount\Http\Controllers\CatalogRuleController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog-rule.index'
                ])->name('merchantadmin.catalog-rule.store');

                Route::get('/catalog-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.catalog-rule.edit'
                ])->name('merchantadmin.catalog-rule.edit');

                Route::post('/catalog-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog-rule.index'
                ])->name('merchantadmin.catalog-rule.update');

                Route::get('/catalog-rules/apply', 'Webkul\Discount\Http\Controllers\CatalogRuleController@applyRules')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.catalog-rule.index'
                ])->name('merchantadmin.catalog-rule.apply');

                Route::post('/catalog-rules/delete/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@destroy')->name('merchantadmin.catalog-rule.delete');

                Route::get('/catalog-rules/declutter', 'Webkul\Discount\Http\Controllers\CatalogRuleController@deClutter')->defaults('_config', [
                    'redirect' => 'merchantadmin.catalog-rule.index'
                ])->name('merchantadmin.catalog-rule.declut');

                Route::post('fetch/options', 'Webkul\Discount\Http\Controllers\CatalogRuleController@fetchAttributeOptions')->name('merchantadmin.catalog-rule.options');

                Route::get('cart-rules', 'Webkul\Discount\Http\Controllers\CartRuleController@index')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.cart-rule.index'
                ])->name('merchantadmin.cart-rule.index');

                Route::get('cart-rules/create', 'Webkul\Discount\Http\Controllers\CartRuleController@create')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.cart-rule.create'
                ])->name('merchantadmin.cart-rule.create');

                Route::post('cart-rules/store', 'Webkul\Discount\Http\Controllers\CartRuleController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.cart-rule.index'
                ])->name('merchantadmin.cart-rule.store');

                Route::get('cart-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::promotions.cart-rule.edit'
                ])->name('merchantadmin.cart-rule.edit');

                Route::post('cart-rules/update/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.cart-rule.index'
                ])->name('merchantadmin.cart-rule.update');

                Route::post('cart-rules/delete/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@destroy')->name('merchantadmin.cart-rule.delete');
            });

            Route::prefix('cms')->group(function () {
                Route::get('/', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@index')->defaults('_config', [
                    'view' => 'merchantadmin::cms.index'
                ])->name('merchantadmin.cms.index');

                Route::get('preview/{url_key}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@preview')->name('merchantadmin.cms.preview');

                Route::get('create', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@create')->defaults('_config', [
                    'view' => 'merchantadmin::cms.create'
                ])->name('merchantadmin.cms.create');

                Route::post('create', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@store')->defaults('_config', [
                    'redirect' => 'merchantadmin.cms.index'
                ])->name('merchantadmin.cms.store');

                Route::get('update/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@edit')->defaults('_config', [
                    'view' => 'merchantadmin::cms.edit'
                ])->name('merchantadmin.cms.edit');

                Route::post('update/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@update')->defaults('_config', [
                    'redirect' => 'merchantadmin.cms.index'
                ])->name('merchantadmin.cms.update');

                Route::post('/delete/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@delete')->defaults('_config', [
                    'redirect' => 'merchantadmin.cms.index'
                ])->name('merchantadmin.cms.delete');

                Route::post('/massdelete', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@massDelete')->defaults('_config', [
                    'redirect' => 'merchantadmin.cms.index'
                ])->name('merchantadmin.cms.mass-delete');

                // Route::post('/delete/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@delete')->defaults('_config', [
                //     'redirect' => 'merchantadmin.cms.index'
                // ])->name('merchantadmin.cms.delete');
            });

            // Development settings
            Route::prefix('development')->group(function () {
                Route::get('/', 'Highwayns\MerchantAdmin\Http\Controllers\Development\DashboardController@index')
                    ->name('merchantadmin.development.index');
            });
        });
    });
});
