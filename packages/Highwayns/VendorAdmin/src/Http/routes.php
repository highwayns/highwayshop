<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('vendoradmin')->group(function () {

        Route::get('/', 'Webkul\VendorAdmin\Http\Controllers\Controller@redirectToLogin');

        // Login Routes
        Route::get('/login', 'Webkul\Vendor\Http\Controllers\SessionController@create')->defaults('_config', [
            'view' => 'vendoradmin::users.sessions.create'
        ])->name('vendoradmin.session.create');

        //login post route to admin auth controller
        Route::post('/login', 'Webkul\Vendor\Http\Controllers\SessionController@store')->defaults('_config', [
            'redirect' => 'vendoradmin.dashboard.index'
        ])->name('vendoradmin.session.store');

        // Forget Password Routes
        Route::get('/forget-password', 'Webkul\Vendor\Http\Controllers\ForgetPasswordController@create')->defaults('_config', [
            'view' => 'vendoradmin::users.forget-password.create'
        ])->name('vendoradmin.forget-password.create');

        Route::post('/forget-password', 'Webkul\Vendor\Http\Controllers\ForgetPasswordController@store')->name('vendoradmin.forget-password.store');

        // Reset Password Routes
        Route::get('/reset-password/{token}', 'Webkul\Vendor\Http\Controllers\ResetPasswordController@create')->defaults('_config', [
            'view' => 'vendoradmin::users.reset-password.create'
        ])->name('vendoradmin.reset-password.create');

        Route::post('/reset-password', 'Webkul\Vendor\Http\Controllers\ResetPasswordController@store')->defaults('_config', [
            'redirect' => 'vendoradmin.dashboard.index'
        ])->name('vendoradmin.reset-password.store');


        // Admin Routes
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/logout', 'Webkul\Vendor\Http\Controllers\SessionController@destroy')->defaults('_config', [
                'redirect' => 'vendoradmin.session.create'
            ])->name('vendoradmin.session.destroy');

            // Dashboard Route
            Route::get('dashboard', 'Webkul\VendorAdmin\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'vendoradmin::dashboard.index'
            ])->name('vendoradmin.dashboard.index');

            //Customer Management Routes
            Route::get('customers', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@index')->defaults('_config', [
                'view' => 'vendoradmin::customers.index'
            ])->name('vendoradmin.customer.index');

            Route::get('customers/create', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@create')->defaults('_config',[
                'view' => 'vendoradmin::customers.create'
            ])->name('vendoradmin.customer.create');

            Route::post('customers/create', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@store')->defaults('_config',[
                'redirect' => 'vendoradmin.customer.index'
            ])->name('vendoradmin.customer.store');

            Route::get('customers/edit/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@edit')->defaults('_config',[
                'view' => 'vendoradmin::customers.edit'
            ])->name('vendoradmin.customer.edit');

            Route::get('customers/note/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@createNote')->defaults('_config',[
                'view' => 'vendoradmin::customers.note'
            ])->name('vendoradmin.customer.note.create');

            Route::put('customers/note/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@storeNote')->defaults('_config',[
                'redirect' => 'vendoradmin.customer.index'
            ])->name('vendoradmin.customer.note.store');

            Route::put('customers/edit/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.index'
            ])->name('vendoradmin.customer.update');

            Route::post('customers/delete/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@destroy')->name('vendoradmin.customer.delete');

            Route::post('customers/masssdelete', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@massDestroy')->name('vendoradmin.customer.mass-delete');

            Route::post('customers/masssupdate', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerController@massUpdate')->name('vendoradmin.customer.mass-update');

            Route::get('reviews', 'Webkul\Product\Http\Controllers\ReviewController@index')->defaults('_config',[
                'view' => 'vendoradmin::customers.reviews.index'
            ])->name('vendoradmin.customer.review.index');

            //Customer's addresses routes
            Route::get('customers/{id}/addresses', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@index')->defaults('_config', [
                'view' => 'vendoradmin::customers.addresses.index'
            ])->name('vendoradmin.customer.addresses.index');

            Route::get('customers/{id}/addresses/create', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@create')->defaults('_config',[
                'view' => 'vendoradmin::customers.addresses.create'
            ])->name('vendoradmin.customer.addresses.create');

            Route::post('customers/{id}/addresses/create', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@store')->defaults('_config',[
                'redirect' => 'vendoradmin.customer.addresses.index'
            ])->name('vendoradmin.customer.addresses.store');

            Route::get('customers/addresses/edit/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@edit')->defaults('_config',[
                'view' => 'vendoradmin::customers.addresses.edit'
            ])->name('vendoradmin.customer.addresses.edit');

            Route::put('customers/addresses/edit/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.addresses.index'
            ])->name('vendoradmin.customer.addresses.update');

            Route::post('customers/addresses/delete/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@destroy')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.addresses.index'
            ])->name('vendoradmin.customer.addresses.delete');

            //mass destroy
            Route::post('customers/{id}/addresses', 'Webkul\VendorAdmin\Http\Controllers\Customer\AddressController@massDestroy')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.addresses.index'
            ])->name('vendoradmin.customer.addresses.massdelete');

            // Configuration routes
            Route::get('configuration/{slug?}/{slug2?}', 'Webkul\VendorAdmin\Http\Controllers\ConfigurationController@index')->defaults('_config', [
                'view' => 'vendoradmin::configuration.index'
            ])->name('vendoradmin.configuration.index');

            Route::post('configuration/{slug?}/{slug2?}', 'Webkul\VendorAdmin\Http\Controllers\ConfigurationController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.configuration.index'
            ])->name('vendoradmin.configuration.index.store');

            Route::get('configuration/{slug?}/{slug2?}/{path}', 'Webkul\VendorAdmin\Http\Controllers\ConfigurationController@download')->defaults('_config', [
                'redirect' => 'vendoradmin.configuration.index'
            ])->name('vendoradmin.configuration.download');

            // Reviews Routes
            Route::get('reviews/edit/{id}', 'Webkul\Product\Http\Controllers\ReviewController@edit')->defaults('_config',[
                'view' => 'vendoradmin::customers.reviews.edit'
            ])->name('vendoradmin.customer.review.edit');

            Route::put('reviews/edit/{id}', 'Webkul\Product\Http\Controllers\ReviewController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.review.index'
            ])->name('vendoradmin.customer.review.update');

            Route::post('reviews/delete/{id}', 'Webkul\Product\Http\Controllers\ReviewController@destroy')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.review.index'
            ])->name('vendoradmin.customer.review.delete');

            //mass destroy
            Route::post('reviews/massdestroy', 'Webkul\Product\Http\Controllers\ReviewController@massDestroy')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.review.index'
            ])->name('vendoradmin.customer.review.massdelete');

            //mass update
            Route::post('reviews/massupdate', 'Webkul\Product\Http\Controllers\ReviewController@massUpdate')->defaults('_config', [
                'redirect' => 'vendoradmin.customer.review.index'
            ])->name('vendoradmin.customer.review.massupdate');

            // Customer Groups Routes
            Route::get('groups', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerGroupController@index')->defaults('_config',[
                'view' => 'vendoradmin::customers.groups.index'
            ])->name('vendoradmin.groups.index');

            Route::get('groups/create', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerGroupController@create')->defaults('_config',[
                'view' => 'vendoradmin::customers.groups.create'
            ])->name('vendoradmin.groups.create');

            Route::post('groups/create', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerGroupController@store')->defaults('_config',[
                'redirect' => 'vendoradmin.groups.index'
            ])->name('vendoradmin.groups.store');

            Route::get('groups/edit/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerGroupController@edit')->defaults('_config',[
                'view' => 'vendoradmin::customers.groups.edit'
            ])->name('vendoradmin.groups.edit');

            Route::put('groups/edit/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerGroupController@update')->defaults('_config',[
                'redirect' => 'vendoradmin.groups.index'
            ])->name('vendoradmin.groups.update');

            Route::post('groups/delete/{id}', 'Webkul\VendorAdmin\Http\Controllers\Customer\CustomerGroupController@destroy')->name('vendoradmin.groups.delete');


            // Sales Routes
            Route::prefix('sales')->group(function () {
                // Sales Order Routes
                Route::get('/orders', 'Webkul\VendorAdmin\Http\Controllers\Sales\OrderController@index')->defaults('_config', [
                    'view' => 'vendoradmin::sales.orders.index'
                ])->name('vendoradmin.sales.orders.index');

                Route::get('/orders/view/{id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\OrderController@view')->defaults('_config', [
                    'view' => 'vendoradmin::sales.orders.view'
                ])->name('vendoradmin.sales.orders.view');

                Route::get('/orders/cancel/{id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\OrderController@cancel')->defaults('_config', [
                    'view' => 'vendoradmin::sales.orders.cancel'
                ])->name('vendoradmin.sales.orders.cancel');


                // Sales Invoices Routes
                Route::get('/invoices', 'Webkul\VendorAdmin\Http\Controllers\Sales\InvoiceController@index')->defaults('_config', [
                    'view' => 'vendoradmin::sales.invoices.index'
                ])->name('vendoradmin.sales.invoices.index');

                Route::get('/invoices/create/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\InvoiceController@create')->defaults('_config', [
                    'view' => 'vendoradmin::sales.invoices.create'
                ])->name('vendoradmin.sales.invoices.create');

                Route::post('/invoices/create/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\InvoiceController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.sales.orders.view'
                ])->name('vendoradmin.sales.invoices.store');

                Route::get('/invoices/view/{id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\InvoiceController@view')->defaults('_config', [
                    'view' => 'vendoradmin::sales.invoices.view'
                ])->name('vendoradmin.sales.invoices.view');

                Route::get('/invoices/print/{id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\InvoiceController@print')->defaults('_config', [
                    'view' => 'vendoradmin::sales.invoices.print'
                ])->name('vendoradmin.sales.invoices.print');


                // Sales Shipments Routes
                Route::get('/shipments', 'Webkul\VendorAdmin\Http\Controllers\Sales\ShipmentController@index')->defaults('_config', [
                    'view' => 'vendoradmin::sales.shipments.index'
                ])->name('vendoradmin.sales.shipments.index');

                Route::get('/shipments/create/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\ShipmentController@create')->defaults('_config', [
                    'view' => 'vendoradmin::sales.shipments.create'
                ])->name('vendoradmin.sales.shipments.create');

                Route::post('/shipments/create/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\ShipmentController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.sales.orders.view'
                ])->name('vendoradmin.sales.shipments.store');

                Route::get('/shipments/view/{id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\ShipmentController@view')->defaults('_config', [
                    'view' => 'vendoradmin::sales.shipments.view'
                ])->name('vendoradmin.sales.shipments.view');


                // Sales Redunds Routes
                Route::get('/refunds', 'Webkul\VendorAdmin\Http\Controllers\Sales\RefundController@index')->defaults('_config', [
                    'view' => 'vendoradmin::sales.refunds.index'
                ])->name('vendoradmin.sales.refunds.index');

                Route::get('/refunds/create/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\RefundController@create')->defaults('_config', [
                    'view' => 'vendoradmin::sales.refunds.create'
                ])->name('vendoradmin.sales.refunds.create');

                Route::post('/refunds/create/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\RefundController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.sales.orders.view'
                ])->name('vendoradmin.sales.refunds.store');

                Route::post('/refunds/update-qty/{order_id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\RefundController@updateQty')->defaults('_config', [
                    'redirect' => 'vendoradmin.sales.orders.view'
                ])->name('vendoradmin.sales.refunds.update_qty');

                Route::get('/refunds/view/{id}', 'Webkul\VendorAdmin\Http\Controllers\Sales\RefundController@view')->defaults('_config', [
                    'view' => 'vendoradmin::sales.refunds.view'
                ])->name('vendoradmin.sales.refunds.view');
            });

            // Catalog Routes
            Route::prefix('catalog')->group(function () {
                Route::get('/sync', 'Webkul\Product\Http\Controllers\ProductController@sync');

                // Catalog Product Routes
                Route::get('/products', 'Webkul\Product\Http\Controllers\ProductController@index')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.products.index'
                ])->name('vendoradmin.catalog.products.index');

                Route::get('/products/create', 'Webkul\Product\Http\Controllers\ProductController@create')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.products.create'
                ])->name('vendoradmin.catalog.products.create');

                Route::post('/products/create', 'Webkul\Product\Http\Controllers\ProductController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.products.edit'
                ])->name('vendoradmin.catalog.products.store');

                Route::get('/products/edit/{id}', 'Webkul\Product\Http\Controllers\ProductController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.products.edit'
                ])->name('vendoradmin.catalog.products.edit');

                Route::put('/products/edit/{id}', 'Webkul\Product\Http\Controllers\ProductController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.products.index'
                ])->name('vendoradmin.catalog.products.update');

                Route::post('/products/upload-file/{id}', 'Webkul\Product\Http\Controllers\ProductController@uploadLink')->name('vendoradmin.catalog.products.upload_link');

                Route::post('/products/upload-sample/{id}', 'Webkul\Product\Http\Controllers\ProductController@uploadSample')->name('vendoradmin.catalog.products.upload_sample');

                //product delete
                Route::post('/products/delete/{id}', 'Webkul\Product\Http\Controllers\ProductController@destroy')->name('vendoradmin.catalog.products.delete');

                //product massaction
                Route::post('products/massaction', 'Webkul\Product\Http\Controllers\ProductController@massActionHandler')->name('vendoradmin.catalog.products.massaction');

                //product massdelete
                Route::post('products/massdelete', 'Webkul\Product\Http\Controllers\ProductController@massDestroy')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.products.index'
                ])->name('vendoradmin.catalog.products.massdelete');

                //product massupdate
                Route::post('products/massupdate', 'Webkul\Product\Http\Controllers\ProductController@massUpdate')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.products.index'
                ])->name('vendoradmin.catalog.products.massupdate');

                //product search for linked products
                Route::get('products/search', 'Webkul\Product\Http\Controllers\ProductController@productLinkSearch')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.products.edit'
                ])->name('vendoradmin.catalog.products.productlinksearch');

                Route::get('products/search-simple-products', 'Webkul\Product\Http\Controllers\ProductController@searchSimpleProducts')->name('vendoradmin.catalog.products.search_simple_product');

                Route::get('/products/{id}/{attribute_id}', 'Webkul\Product\Http\Controllers\ProductController@download')->defaults('_config', [
                    'view' => 'vendoradmin.catalog.products.edit'
                ])->name('vendoradmin.catalog.products.file.download');

                // Catalog Category Routes
                Route::get('/categories', 'Webkul\Category\Http\Controllers\CategoryController@index')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.categories.index'
                ])->name('vendoradmin.catalog.categories.index');

                Route::get('/categories/create', 'Webkul\Category\Http\Controllers\CategoryController@create')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.categories.create'
                ])->name('vendoradmin.catalog.categories.create');

                Route::post('/categories/create', 'Webkul\Category\Http\Controllers\CategoryController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.categories.index'
                ])->name('vendoradmin.catalog.categories.store');

                Route::get('/categories/edit/{id}', 'Webkul\Category\Http\Controllers\CategoryController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.categories.edit'
                ])->name('vendoradmin.catalog.categories.edit');

                Route::put('/categories/edit/{id}', 'Webkul\Category\Http\Controllers\CategoryController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.categories.index'
                ])->name('vendoradmin.catalog.categories.update');

                Route::post('/categories/delete/{id}', 'Webkul\Category\Http\Controllers\CategoryController@destroy')->name('vendoradmin.catalog.categories.delete');


                // Catalog Attribute Routes
                Route::get('/attributes', 'Webkul\Attribute\Http\Controllers\AttributeController@index')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.attributes.index'
                ])->name('vendoradmin.catalog.attributes.index');

                Route::get('/attributes/create', 'Webkul\Attribute\Http\Controllers\AttributeController@create')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.attributes.create'
                ])->name('vendoradmin.catalog.attributes.create');

                Route::post('/attributes/create', 'Webkul\Attribute\Http\Controllers\AttributeController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.attributes.index'
                ])->name('vendoradmin.catalog.attributes.store');

                Route::get('/attributes/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.attributes.edit'
                ])->name('vendoradmin.catalog.attributes.edit');

                Route::put('/attributes/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.attributes.index'
                ])->name('vendoradmin.catalog.attributes.update');

                Route::post('/attributes/delete/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@destroy')->name('vendoradmin.catalog.attributes.delete');

                Route::post('/attributes/massdelete', 'Webkul\Attribute\Http\Controllers\AttributeController@massDestroy')->name('vendoradmin.catalog.attributes.massdelete');

                // Catalog Family Routes
                Route::get('/families', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@index')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.families.index'
                ])->name('vendoradmin.catalog.families.index');

                Route::get('/families/create', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@create')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.families.create'
                ])->name('vendoradmin.catalog.families.create');

                Route::post('/families/create', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.families.index'
                ])->name('vendoradmin.catalog.families.store');

                Route::get('/families/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::catalog.families.edit'
                ])->name('vendoradmin.catalog.families.edit');

                Route::put('/families/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog.families.index'
                ])->name('vendoradmin.catalog.families.update');

                Route::post('/families/delete/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@destroy')->name('vendoradmin.catalog.families.delete');
            });

            // User Routes
            //datagrid for backend users
            Route::get('/users', 'Webkul\Vendor\Http\Controllers\UserController@index')->defaults('_config', [
                'view' => 'vendoradmin::users.users.index'
            ])->name('vendoradmin.users.index');

            //create backend user get
            Route::get('/users/create', 'Webkul\Vendor\Http\Controllers\UserController@create')->defaults('_config', [
                'view' => 'vendoradmin::users.users.create'
            ])->name('vendoradmin.users.create');

            //create backend user post
            Route::post('/users/create', 'Webkul\Vendor\Http\Controllers\UserController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.users.index'
            ])->name('vendoradmin.users.store');

            //delete backend user view
            Route::get('/users/edit/{id}', 'Webkul\Vendor\Http\Controllers\UserController@edit')->defaults('_config', [
                'view' => 'vendoradmin::users.users.edit'
            ])->name('vendoradmin.users.edit');

            //edit backend user submit
            Route::put('/users/edit/{id}', 'Webkul\Vendor\Http\Controllers\UserController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.users.index'
            ])->name('vendoradmin.users.update');

            //delete backend user
            Route::post('/users/delete/{id}', 'Webkul\Vendor\Http\Controllers\UserController@destroy')->name('vendoradmin.users.delete');

            Route::post('/confirm/destroy', 'Webkul\Vendor\Http\Controllers\UserController@destroySelf')->defaults('_config', [
                'redirect' => 'vendoradmin.users.index'
            ])->name('vendoradmin.users.confirm.destroy');

            // User Role Routes
            Route::get('/roles', 'Webkul\Vendor\Http\Controllers\RoleController@index')->defaults('_config', [
                'view' => 'vendoradmin::users.roles.index'
            ])->name('vendoradmin.roles.index');

            Route::get('/roles/create', 'Webkul\Vendor\Http\Controllers\RoleController@create')->defaults('_config', [
                'view' => 'vendoradmin::users.roles.create'
            ])->name('vendoradmin.roles.create');

            Route::post('/roles/create', 'Webkul\Vendor\Http\Controllers\RoleController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.roles.index'
            ])->name('vendoradmin.roles.store');

            Route::get('/roles/edit/{id}', 'Webkul\Vendor\Http\Controllers\RoleController@edit')->defaults('_config', [
                'view' => 'vendoradmin::users.roles.edit'
            ])->name('vendoradmin.roles.edit');

            Route::put('/roles/edit/{id}', 'Webkul\Vendor\Http\Controllers\RoleController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.roles.index'
            ])->name('vendoradmin.roles.update');

            Route::post('/roles/delete/{id}', 'Webkul\Vendor\Http\Controllers\RoleController@destroy')->name('vendoradmin.roles.delete');


            // Locale Routes
            Route::get('/locales', 'Webkul\Core\Http\Controllers\LocaleController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.locales.index'
            ])->name('vendoradmin.locales.index');

            Route::get('/locales/create', 'Webkul\Core\Http\Controllers\LocaleController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.locales.create'
            ])->name('vendoradmin.locales.create');

            Route::post('/locales/create', 'Webkul\Core\Http\Controllers\LocaleController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.locales.index'
            ])->name('vendoradmin.locales.store');

            Route::get('/locales/edit/{id}', 'Webkul\Core\Http\Controllers\LocaleController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.locales.edit'
            ])->name('vendoradmin.locales.edit');

            Route::put('/locales/edit/{id}', 'Webkul\Core\Http\Controllers\LocaleController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.locales.index'
            ])->name('vendoradmin.locales.update');

            Route::post('/locales/delete/{id}', 'Webkul\Core\Http\Controllers\LocaleController@destroy')->name('vendoradmin.locales.delete');


            // Currency Routes
            Route::get('/currencies', 'Webkul\Core\Http\Controllers\CurrencyController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.currencies.index'
            ])->name('vendoradmin.currencies.index');

            Route::get('/currencies/create', 'Webkul\Core\Http\Controllers\CurrencyController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.currencies.create'
            ])->name('vendoradmin.currencies.create');

            Route::post('/currencies/create', 'Webkul\Core\Http\Controllers\CurrencyController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.currencies.index'
            ])->name('vendoradmin.currencies.store');

            Route::get('/currencies/edit/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.currencies.edit'
            ])->name('vendoradmin.currencies.edit');

            Route::put('/currencies/edit/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.currencies.index'
            ])->name('vendoradmin.currencies.update');

            Route::post('/currencies/delete/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@destroy')->name('vendoradmin.currencies.delete');

            Route::post('/currencies/massdelete', 'Webkul\Core\Http\Controllers\CurrencyController@massDestroy')->name('vendoradmin.currencies.massdelete');


            // Exchange Rates Routes
            Route::get('/exchange_rates', 'Webkul\Core\Http\Controllers\ExchangeRateController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.exchange_rates.index'
            ])->name('vendoradmin.exchange_rates.index');

            Route::get('/exchange_rates/create', 'Webkul\Core\Http\Controllers\ExchangeRateController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.exchange_rates.create'
            ])->name('vendoradmin.exchange_rates.create');

            Route::post('/exchange_rates/create', 'Webkul\Core\Http\Controllers\ExchangeRateController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.exchange_rates.index'
            ])->name('vendoradmin.exchange_rates.store');

            Route::get('/exchange_rates/edit/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.exchange_rates.edit'
            ])->name('vendoradmin.exchange_rates.edit');

            Route::get('/exchange_rates/update-rates/{service}', 'Webkul\Core\Http\Controllers\ExchangeRateController@updateRates')->name('vendoradmin.exchange_rates.update-rates');

            Route::put('/exchange_rates/edit/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.exchange_rates.index'
            ])->name('vendoradmin.exchange_rates.update');

            Route::post('/exchange_rates/delete/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@destroy')->name('vendoradmin.exchange_rates.delete');


            // Inventory Source Routes
            Route::get('/inventory_sources', 'Webkul\Inventory\Http\Controllers\InventorySourceController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.inventory_sources.index'
            ])->name('vendoradmin.inventory_sources.index');

            Route::get('/inventory_sources/create', 'Webkul\Inventory\Http\Controllers\InventorySourceController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.inventory_sources.create'
            ])->name('vendoradmin.inventory_sources.create');

            Route::post('/inventory_sources/create', 'Webkul\Inventory\Http\Controllers\InventorySourceController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.inventory_sources.index'
            ])->name('vendoradmin.inventory_sources.store');

            Route::get('/inventory_sources/edit/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.inventory_sources.edit'
            ])->name('vendoradmin.inventory_sources.edit');

            Route::put('/inventory_sources/edit/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.inventory_sources.index'
            ])->name('vendoradmin.inventory_sources.update');

            Route::post('/inventory_sources/delete/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@destroy')->name('vendoradmin.inventory_sources.delete');

            // Vendor Source Routes
            Route::get('/vendor_sources', 'Webkul\Vendor\Http\Controllers\VendorSourceController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.vendor_sources.index'
            ])->name('vendoradmin.vendor_sources.index');

            Route::get('/vendor_sources/create', 'Webkul\Vendor\Http\Controllers\VendorSourceController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.vendor_sources.create'
            ])->name('vendoradmin.vendor_sources.create');

            Route::post('/vendor_sources/create', 'Webkul\Vendor\Http\Controllers\VendorSourceController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.vendor_sources.index'
            ])->name('vendoradmin.vendor_sources.store');

            Route::get('/vendor_sources/edit/{id}', 'Webkul\Vendor\Http\Controllers\VendorSourceController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.vendor_sources.edit'
            ])->name('vendoradmin.vendor_sources.edit');

            Route::put('/vendor_sources/edit/{id}', 'Webkul\Vendor\Http\Controllers\VendorSourceController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.vendor_sources.index'
            ])->name('vendoradmin.vendor_sources.update');

            Route::post('/vendor_sources/delete/{id}', 'Webkul\Vendor\Http\Controllers\VendorSourceController@destroy')->name('vendoradmin.vendor_sources.delete');

            Route::post('/vendorconfirm/destroy', 'Webkul\Vendor\Http\Controllers\VendorSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'vendoradmin.vendor_sources.index'
            ])->name('vendoradmin.vendors.confirm.destroy');

            // Vendor Role Routes
            Route::get('/vendorroles', 'Webkul\Vendor\Http\Controllers\VendorRoleController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.vendor_roles.index'
            ])->name('vendoradmin.vendorroles.index');

            Route::get('/vendorroles/create', 'Webkul\Vendor\Http\Controllers\VendorRoleController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.vendor_roles.create'
            ])->name('vendoradmin.vendorroles.create');

            Route::post('/vendorroles/create', 'Webkul\Vendor\Http\Controllers\VendorRoleController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.vendorroles.index'
            ])->name('vendoradmin.vendorroles.store');

            Route::get('/vendorroles/edit/{id}', 'Webkul\Vendor\Http\Controllers\VendorRoleController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.vendor_roles.edit'
            ])->name('vendoradmin.vendorroles.edit');

            Route::put('/vendorroles/edit/{id}', 'Webkul\Vendor\Http\Controllers\VendorRoleController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.vendorroles.index'
            ])->name('vendoradmin.vendorroles.update');

            Route::post('/vendorroles/delete/{id}', 'Webkul\Vendor\Http\Controllers\VendorRoleController@destroy')->name('vendoradmin.vendorroles.delete');

            // Agent Source Routes
            Route::get('/agent_sources', 'Webkul\Agent\Http\Controllers\AgentSourceController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.agent_sources.index'
            ])->name('vendoradmin.agent_sources.index');

            Route::get('/agent_sources/create', 'Webkul\Agent\Http\Controllers\AgentSourceController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.agent_sources.create'
            ])->name('vendoradmin.agent_sources.create');

            Route::post('/agent_sources/create', 'Webkul\Agent\Http\Controllers\AgentSourceController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.agent_sources.index'
            ])->name('vendoradmin.agent_sources.store');

            Route::get('/agent_sources/edit/{id}', 'Webkul\Agent\Http\Controllers\AgentSourceController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.agent_sources.edit'
            ])->name('vendoradmin.agent_sources.edit');

            Route::put('/agent_sources/edit/{id}', 'Webkul\Agent\Http\Controllers\AgentSourceController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.agent_sources.index'
            ])->name('vendoradmin.agent_sources.update');

            Route::post('/agent_sources/delete/{id}', 'Webkul\Agent\Http\Controllers\AgentSourceController@destroy')->name('vendoradmin.agent_sources.delete');

            Route::post('/agentconfirm/destroy', 'Webkul\Agent\Http\Controllers\AgentSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'vendoradmin.agent_sources.index'
            ])->name('vendoradmin.agents.confirm.destroy');

            // Agent Role Routes
            Route::get('/agentroles', 'Webkul\Agent\Http\Controllers\AgentRoleController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.agent_roles.index'
            ])->name('vendoradmin.agentroles.index');

            Route::get('/agentroles/create', 'Webkul\Agent\Http\Controllers\AgentRoleController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.agent_roles.create'
            ])->name('vendoradmin.agentroles.create');

            Route::post('/agentroles/create', 'Webkul\Agent\Http\Controllers\AgentRoleController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.agentroles.index'
            ])->name('vendoradmin.agentroles.store');

            Route::get('/agentroles/edit/{id}', 'Webkul\Agent\Http\Controllers\AgentRoleController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.agent_roles.edit'
            ])->name('vendoradmin.agentroles.edit');

            Route::put('/agentroles/edit/{id}', 'Webkul\Agent\Http\Controllers\AgentRoleController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.agentroles.index'
            ])->name('vendoradmin.agentroles.update');

            Route::post('/agentroles/delete/{id}', 'Webkul\Agent\Http\Controllers\AgentRoleController@destroy')->name('vendoradmin.agentroles.delete');

            // Channel Routes
            Route::get('/channels', 'Webkul\Core\Http\Controllers\ChannelController@index')->defaults('_config', [
                'view' => 'vendoradmin::settings.channels.index'
            ])->name('vendoradmin.channels.index');

            Route::get('/channels/create', 'Webkul\Core\Http\Controllers\ChannelController@create')->defaults('_config', [
                'view' => 'vendoradmin::settings.channels.create'
            ])->name('vendoradmin.channels.create');

            Route::post('/channels/create', 'Webkul\Core\Http\Controllers\ChannelController@store')->defaults('_config', [
                'redirect' => 'vendoradmin.channels.index'
            ])->name('vendoradmin.channels.store');

            Route::get('/channels/edit/{id}', 'Webkul\Core\Http\Controllers\ChannelController@edit')->defaults('_config', [
                'view' => 'vendoradmin::settings.channels.edit'
            ])->name('vendoradmin.channels.edit');

            Route::put('/channels/edit/{id}', 'Webkul\Core\Http\Controllers\ChannelController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.channels.index'
            ])->name('vendoradmin.channels.update');

            Route::post('/channels/delete/{id}', 'Webkul\Core\Http\Controllers\ChannelController@destroy')->name('vendoradmin.channels.delete');


            // Admin Profile route
            Route::get('/account', 'Webkul\Vendor\Http\Controllers\AccountController@edit')->defaults('_config', [
                'view' => 'vendoradmin::account.edit'
            ])->name('vendoradmin.account.edit');

            Route::put('/account', 'Webkul\Vendor\Http\Controllers\AccountController@update')->name('vendoradmin.account.update');


            // Admin Store Front Settings Route
            Route::get('/subscribers','Webkul\Core\Http\Controllers\SubscriptionController@index')->defaults('_config',[
                'view' => 'vendoradmin::customers.subscribers.index'
            ])->name('vendoradmin.customers.subscribers.index');

            //destroy a newsletter subscription item
            Route::post('subscribers/delete/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@destroy')->name('vendoradmin.customers.subscribers.delete');

            Route::get('subscribers/edit/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@edit')->defaults('_config', [
                'view' => 'vendoradmin::customers.subscribers.edit'
            ])->name('vendoradmin.customers.subscribers.edit');

            Route::put('subscribers/update/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.customers.subscribers.index'
            ])->name('vendoradmin.customers.subscribers.update');

            //slider index
            Route::get('/slider','Webkul\Core\Http\Controllers\SliderController@index')->defaults('_config',[
                'view' => 'vendoradmin::settings.sliders.index'
            ])->name('vendoradmin.sliders.index');

            //slider create show
            Route::get('slider/create','Webkul\Core\Http\Controllers\SliderController@create')->defaults('_config',[
                'view' => 'vendoradmin::settings.sliders.create'
            ])->name('vendoradmin.sliders.create');

            //slider create show
            Route::post('slider/create','Webkul\Core\Http\Controllers\SliderController@store')->defaults('_config',[
                'redirect' => 'vendoradmin.sliders.index'
            ])->name('vendoradmin.sliders.store');

            //slider edit show
            Route::get('slider/edit/{id}','Webkul\Core\Http\Controllers\SliderController@edit')->defaults('_config',[
                'view' => 'vendoradmin::settings.sliders.edit'
            ])->name('vendoradmin.sliders.edit');

            //slider edit update
            Route::post('slider/edit/{id}','Webkul\Core\Http\Controllers\SliderController@update')->defaults('_config',[
                'redirect' => 'vendoradmin.sliders.index'
            ])->name('vendoradmin.sliders.update');

            //destroy a slider item
            Route::post('slider/delete/{id}', 'Webkul\Core\Http\Controllers\SliderController@destroy')->name('vendoradmin.sliders.delete');

            //tax routes
            Route::get('/tax-categories', 'Webkul\Tax\Http\Controllers\TaxController@index')->defaults('_config', [
                'view' => 'vendoradmin::tax.tax-categories.index'
            ])->name('vendoradmin.tax-categories.index');


            // tax category routes
            Route::get('/tax-categories/create', 'Webkul\Tax\Http\Controllers\TaxCategoryController@show')->defaults('_config', [
                'view' => 'vendoradmin::tax.tax-categories.create'
            ])->name('vendoradmin.tax-categories.show');

            Route::post('/tax-categories/create', 'Webkul\Tax\Http\Controllers\TaxCategoryController@create')->defaults('_config', [
                'redirect' => 'vendoradmin.tax-categories.index'
            ])->name('vendoradmin.tax-categories.create');

            Route::get('/tax-categories/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@edit')->defaults('_config', [
                'view' => 'vendoradmin::tax.tax-categories.edit'
            ])->name('vendoradmin.tax-categories.edit');

            Route::put('/tax-categories/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.tax-categories.index'
            ])->name('vendoradmin.tax-categories.update');

            Route::post('/tax-categories/delete/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@destroy')->name('vendoradmin.tax-categories.delete');
            //tax category ends


            //tax rate
            Route::get('tax-rates', 'Webkul\Tax\Http\Controllers\TaxRateController@index')->defaults('_config', [
                'view' => 'vendoradmin::tax.tax-rates.index'
            ])->name('vendoradmin.tax-rates.index');

            Route::get('tax-rates/create', 'Webkul\Tax\Http\Controllers\TaxRateController@show')->defaults('_config', [
                'view' => 'vendoradmin::tax.tax-rates.create'
            ])->name('vendoradmin.tax-rates.show');

            Route::post('tax-rates/create', 'Webkul\Tax\Http\Controllers\TaxRateController@create')->defaults('_config', [
                'redirect' => 'vendoradmin.tax-rates.index'
            ])->name('vendoradmin.tax-rates.create');

            Route::get('tax-rates/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@edit')->defaults('_config', [
                'view' => 'vendoradmin::tax.tax-rates.edit'
            ])->name('vendoradmin.tax-rates.store');

            Route::put('tax-rates/update/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@update')->defaults('_config', [
                'redirect' => 'vendoradmin.tax-rates.index'
            ])->name('vendoradmin.tax-rates.update');

            Route::post('/tax-rates/delete/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@destroy')->name('vendoradmin.tax-rates.delete');

            Route::post('/tax-rates/import', 'Webkul\Tax\Http\Controllers\TaxRateController@import')->defaults('_config', [
                'redirect' => 'vendoradmin.tax-rates.index'
            ])->name('vendoradmin.tax-rates.import');
            //tax rate ends

            //DataGrid Export
            Route::post('vendoradmin/export', 'Webkul\VendorAdmin\Http\Controllers\ExportController@export')->name('vendoradmin.datagrid.export');

            Route::prefix('promotion')->group(function () {
                Route::get('/catalog-rules', 'Webkul\Discount\Http\Controllers\CatalogRuleController@index')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.catalog-rule.index'
                ])->name('vendoradmin.catalog-rule.index');

                Route::get('/catalog-rules/create', 'Webkul\Discount\Http\Controllers\CatalogRuleController@create')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.catalog-rule.create'
                ])->name('vendoradmin.catalog-rule.create');

                Route::post('/catalog-rules/create', 'Webkul\Discount\Http\Controllers\CatalogRuleController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog-rule.index'
                ])->name('vendoradmin.catalog-rule.store');

                Route::get('/catalog-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.catalog-rule.edit'
                ])->name('vendoradmin.catalog-rule.edit');

                Route::post('/catalog-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog-rule.index'
                ])->name('vendoradmin.catalog-rule.update');

                Route::get('/catalog-rules/apply', 'Webkul\Discount\Http\Controllers\CatalogRuleController@applyRules')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.catalog-rule.index'
                ])->name('vendoradmin.catalog-rule.apply');

                Route::post('/catalog-rules/delete/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@destroy')->name('vendoradmin.catalog-rule.delete');

                Route::get('/catalog-rules/declutter', 'Webkul\Discount\Http\Controllers\CatalogRuleController@deClutter')->defaults('_config', [
                    'redirect' => 'vendoradmin.catalog-rule.index'
                ])->name('vendoradmin.catalog-rule.declut');

                Route::post('fetch/options', 'Webkul\Discount\Http\Controllers\CatalogRuleController@fetchAttributeOptions')->name('vendoradmin.catalog-rule.options');

                Route::get('cart-rules', 'Webkul\Discount\Http\Controllers\CartRuleController@index')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.cart-rule.index'
                ])->name('vendoradmin.cart-rule.index');

                Route::get('cart-rules/create', 'Webkul\Discount\Http\Controllers\CartRuleController@create')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.cart-rule.create'
                ])->name('vendoradmin.cart-rule.create');

                Route::post('cart-rules/store', 'Webkul\Discount\Http\Controllers\CartRuleController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.cart-rule.index'
                ])->name('vendoradmin.cart-rule.store');

                Route::get('cart-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::promotions.cart-rule.edit'
                ])->name('vendoradmin.cart-rule.edit');

                Route::post('cart-rules/update/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.cart-rule.index'
                ])->name('vendoradmin.cart-rule.update');

                Route::post('cart-rules/delete/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@destroy')->name('vendoradmin.cart-rule.delete');
            });

            Route::prefix('cms')->group(function () {
                Route::get('/', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@index')->defaults('_config', [
                    'view' => 'vendoradmin::cms.index'
                ])->name('vendoradmin.cms.index');

                Route::get('preview/{url_key}', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@preview')->name('vendoradmin.cms.preview');

                Route::get('create', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@create')->defaults('_config', [
                    'view' => 'vendoradmin::cms.create'
                ])->name('vendoradmin.cms.create');

                Route::post('create', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@store')->defaults('_config', [
                    'redirect' => 'vendoradmin.cms.index'
                ])->name('vendoradmin.cms.store');

                Route::get('update/{id}', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@edit')->defaults('_config', [
                    'view' => 'vendoradmin::cms.edit'
                ])->name('vendoradmin.cms.edit');

                Route::post('update/{id}', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@update')->defaults('_config', [
                    'redirect' => 'vendoradmin.cms.index'
                ])->name('vendoradmin.cms.update');

                Route::post('/delete/{id}', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@delete')->defaults('_config', [
                    'redirect' => 'vendoradmin.cms.index'
                ])->name('vendoradmin.cms.delete');

                Route::post('/massdelete', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@massDelete')->defaults('_config', [
                    'redirect' => 'vendoradmin.cms.index'
                ])->name('vendoradmin.cms.mass-delete');

                // Route::post('/delete/{id}', 'Webkul\CMS\Http\Controllers\VendorAdmin\PageController@delete')->defaults('_config', [
                //     'redirect' => 'vendoradmin.cms.index'
                // ])->name('vendoradmin.cms.delete');
            });

            // Development settings
            Route::prefix('development')->group(function () {
                Route::get('/', 'Webkul\VendorAdmin\Http\Controllers\Development\DashboardController@index')
                    ->name('vendoradmin.development.index');
            });
        });
    });
});
