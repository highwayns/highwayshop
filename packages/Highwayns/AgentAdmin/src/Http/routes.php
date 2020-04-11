<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('agentadmin')->group(function () {

        Route::get('/', 'Highwayns\AgentAdmin\Http\Controllers\Controller@redirectToLogin');

        // Login Routes
        Route::get('/login', 'Highwayns\Agent\Http\Controllers\SessionController@create')->defaults('_config', [
            'view' => 'agentadmin::users.sessions.create'
        ])->name('agentadmin.session.create');

        //login post route to admin auth controller
        Route::post('/login', 'Highwayns\Agent\Http\Controllers\SessionController@store')->defaults('_config', [
            'redirect' => 'agentadmin.dashboard.index'
        ])->name('agentadmin.session.store');

        // Forget Password Routes
        Route::get('/forget-password', 'Highwayns\Agent\Http\Controllers\ForgetPasswordController@create')->defaults('_config', [
            'view' => 'agentadmin::users.forget-password.create'
        ])->name('agentadmin.forget-password.create');

        Route::post('/forget-password', 'Highwayns\Agent\Http\Controllers\ForgetPasswordController@store')->name('agentadmin.forget-password.store');

        // Reset Password Routes
        Route::get('/reset-password/{token}', 'Highwayns\Agent\Http\Controllers\ResetPasswordController@create')->defaults('_config', [
            'view' => 'agentadmin::users.reset-password.create'
        ])->name('agentadmin.reset-password.create');

        Route::post('/reset-password', 'Highwayns\Agent\Http\Controllers\ResetPasswordController@store')->defaults('_config', [
            'redirect' => 'agentadmin.dashboard.index'
        ])->name('agentadmin.reset-password.store');


        // Admin Routes
        Route::group(['middleware' => ['agentadmin']], function () {
            Route::get('/logout', 'Highwayns\Agent\Http\Controllers\SessionController@destroy')->defaults('_config', [
                'redirect' => 'agentadmin.session.create'
            ])->name('agentadmin.session.destroy');

            // Dashboard Route
            Route::get('dashboard', 'Highwayns\AgentAdmin\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'agentadmin::dashboard.index'
            ])->name('agentadmin.dashboard.index');

            //Customer Management Routes
            Route::get('customers', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@index')->defaults('_config', [
                'view' => 'agentadmin::customers.index'
            ])->name('agentadmin.customer.index');

            Route::get('customers/create', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@create')->defaults('_config',[
                'view' => 'agentadmin::customers.create'
            ])->name('agentadmin.customer.create');

            Route::post('customers/create', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@store')->defaults('_config',[
                'redirect' => 'agentadmin.customer.index'
            ])->name('agentadmin.customer.store');

            Route::get('customers/edit/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@edit')->defaults('_config',[
                'view' => 'agentadmin::customers.edit'
            ])->name('agentadmin.customer.edit');

            Route::get('customers/note/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@createNote')->defaults('_config',[
                'view' => 'agentadmin::customers.note'
            ])->name('agentadmin.customer.note.create');

            Route::put('customers/note/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@storeNote')->defaults('_config',[
                'redirect' => 'agentadmin.customer.index'
            ])->name('agentadmin.customer.note.store');

            Route::put('customers/edit/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@update')->defaults('_config', [
                'redirect' => 'agentadmin.customer.index'
            ])->name('agentadmin.customer.update');

            Route::post('customers/delete/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@destroy')->name('agentadmin.customer.delete');

            Route::post('customers/masssdelete', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@massDestroy')->name('agentadmin.customer.mass-delete');

            Route::post('customers/masssupdate', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerController@massUpdate')->name('agentadmin.customer.mass-update');

            Route::get('reviews', 'Webkul\Product\Http\Controllers\ReviewController@index')->defaults('_config',[
                'view' => 'agentadmin::customers.reviews.index'
            ])->name('agentadmin.customer.review.index');

            //Customer's addresses routes
            Route::get('customers/{id}/addresses', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@index')->defaults('_config', [
                'view' => 'agentadmin::customers.addresses.index'
            ])->name('agentadmin.customer.addresses.index');

            Route::get('customers/{id}/addresses/create', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@create')->defaults('_config',[
                'view' => 'agentadmin::customers.addresses.create'
            ])->name('agentadmin.customer.addresses.create');

            Route::post('customers/{id}/addresses/create', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@store')->defaults('_config',[
                'redirect' => 'agentadmin.customer.addresses.index'
            ])->name('agentadmin.customer.addresses.store');

            Route::get('customers/addresses/edit/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@edit')->defaults('_config',[
                'view' => 'agentadmin::customers.addresses.edit'
            ])->name('agentadmin.customer.addresses.edit');

            Route::put('customers/addresses/edit/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@update')->defaults('_config', [
                'redirect' => 'agentadmin.customer.addresses.index'
            ])->name('agentadmin.customer.addresses.update');

            Route::post('customers/addresses/delete/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@destroy')->defaults('_config', [
                'redirect' => 'agentadmin.customer.addresses.index'
            ])->name('agentadmin.customer.addresses.delete');

            //mass destroy
            Route::post('customers/{id}/addresses', 'Highwayns\AgentAdmin\Http\Controllers\Customer\AddressController@massDestroy')->defaults('_config', [
                'redirect' => 'agentadmin.customer.addresses.index'
            ])->name('agentadmin.customer.addresses.massdelete');

            // Configuration routes
            Route::get('configuration/{slug?}/{slug2?}', 'Highwayns\AgentAdmin\Http\Controllers\ConfigurationController@index')->defaults('_config', [
                'view' => 'agentadmin::configuration.index'
            ])->name('agentadmin.configuration.index');

            Route::post('configuration/{slug?}/{slug2?}', 'Highwayns\AgentAdmin\Http\Controllers\ConfigurationController@store')->defaults('_config', [
                'redirect' => 'agentadmin.configuration.index'
            ])->name('agentadmin.configuration.index.store');

            Route::get('configuration/{slug?}/{slug2?}/{path}', 'Highwayns\AgentAdmin\Http\Controllers\ConfigurationController@download')->defaults('_config', [
                'redirect' => 'agentadmin.configuration.index'
            ])->name('agentadmin.configuration.download');

            // Reviews Routes
            Route::get('reviews/edit/{id}', 'Webkul\Product\Http\Controllers\ReviewController@edit')->defaults('_config',[
                'view' => 'agentadmin::customers.reviews.edit'
            ])->name('agentadmin.customer.review.edit');

            Route::put('reviews/edit/{id}', 'Webkul\Product\Http\Controllers\ReviewController@update')->defaults('_config', [
                'redirect' => 'agentadmin.customer.review.index'
            ])->name('agentadmin.customer.review.update');

            Route::post('reviews/delete/{id}', 'Webkul\Product\Http\Controllers\ReviewController@destroy')->defaults('_config', [
                'redirect' => 'agentadmin.customer.review.index'
            ])->name('agentadmin.customer.review.delete');

            //mass destroy
            Route::post('reviews/massdestroy', 'Webkul\Product\Http\Controllers\ReviewController@massDestroy')->defaults('_config', [
                'redirect' => 'agentadmin.customer.review.index'
            ])->name('agentadmin.customer.review.massdelete');

            //mass update
            Route::post('reviews/massupdate', 'Webkul\Product\Http\Controllers\ReviewController@massUpdate')->defaults('_config', [
                'redirect' => 'agentadmin.customer.review.index'
            ])->name('agentadmin.customer.review.massupdate');

            // Customer Groups Routes
            Route::get('groups', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerGroupController@index')->defaults('_config',[
                'view' => 'agentadmin::customers.groups.index'
            ])->name('agentadmin.groups.index');

            Route::get('groups/create', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerGroupController@create')->defaults('_config',[
                'view' => 'agentadmin::customers.groups.create'
            ])->name('agentadmin.groups.create');

            Route::post('groups/create', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerGroupController@store')->defaults('_config',[
                'redirect' => 'agentadmin.groups.index'
            ])->name('agentadmin.groups.store');

            Route::get('groups/edit/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerGroupController@edit')->defaults('_config',[
                'view' => 'agentadmin::customers.groups.edit'
            ])->name('agentadmin.groups.edit');

            Route::put('groups/edit/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerGroupController@update')->defaults('_config',[
                'redirect' => 'agentadmin.groups.index'
            ])->name('agentadmin.groups.update');

            Route::post('groups/delete/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Customer\CustomerGroupController@destroy')->name('agentadmin.groups.delete');


            // Sales Routes
            Route::prefix('sales')->group(function () {
                // Sales Order Routes
                Route::get('/orders', 'Highwayns\AgentAdmin\Http\Controllers\Sales\OrderController@index')->defaults('_config', [
                    'view' => 'agentadmin::sales.orders.index'
                ])->name('agentadmin.sales.orders.index');

                Route::get('/orders/view/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\OrderController@view')->defaults('_config', [
                    'view' => 'agentadmin::sales.orders.view'
                ])->name('agentadmin.sales.orders.view');

                Route::get('/orders/cancel/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\OrderController@cancel')->defaults('_config', [
                    'view' => 'agentadmin::sales.orders.cancel'
                ])->name('agentadmin.sales.orders.cancel');


                // Sales Invoices Routes
                Route::get('/invoices', 'Highwayns\AgentAdmin\Http\Controllers\Sales\InvoiceController@index')->defaults('_config', [
                    'view' => 'agentadmin::sales.invoices.index'
                ])->name('agentadmin.sales.invoices.index');

                Route::get('/invoices/create/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\InvoiceController@create')->defaults('_config', [
                    'view' => 'agentadmin::sales.invoices.create'
                ])->name('agentadmin.sales.invoices.create');

                Route::post('/invoices/create/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\InvoiceController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.sales.orders.view'
                ])->name('agentadmin.sales.invoices.store');

                Route::get('/invoices/view/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\InvoiceController@view')->defaults('_config', [
                    'view' => 'agentadmin::sales.invoices.view'
                ])->name('agentadmin.sales.invoices.view');

                Route::get('/invoices/print/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\InvoiceController@print')->defaults('_config', [
                    'view' => 'agentadmin::sales.invoices.print'
                ])->name('agentadmin.sales.invoices.print');


                // Sales Shipments Routes
                Route::get('/shipments', 'Highwayns\AgentAdmin\Http\Controllers\Sales\ShipmentController@index')->defaults('_config', [
                    'view' => 'agentadmin::sales.shipments.index'
                ])->name('agentadmin.sales.shipments.index');

                Route::get('/shipments/create/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\ShipmentController@create')->defaults('_config', [
                    'view' => 'agentadmin::sales.shipments.create'
                ])->name('agentadmin.sales.shipments.create');

                Route::post('/shipments/create/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\ShipmentController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.sales.orders.view'
                ])->name('agentadmin.sales.shipments.store');

                Route::get('/shipments/view/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\ShipmentController@view')->defaults('_config', [
                    'view' => 'agentadmin::sales.shipments.view'
                ])->name('agentadmin.sales.shipments.view');


                // Sales Redunds Routes
                Route::get('/refunds', 'Highwayns\AgentAdmin\Http\Controllers\Sales\RefundController@index')->defaults('_config', [
                    'view' => 'agentadmin::sales.refunds.index'
                ])->name('agentadmin.sales.refunds.index');

                Route::get('/refunds/create/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\RefundController@create')->defaults('_config', [
                    'view' => 'agentadmin::sales.refunds.create'
                ])->name('agentadmin.sales.refunds.create');

                Route::post('/refunds/create/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\RefundController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.sales.orders.view'
                ])->name('agentadmin.sales.refunds.store');

                Route::post('/refunds/update-qty/{order_id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\RefundController@updateQty')->defaults('_config', [
                    'redirect' => 'agentadmin.sales.orders.view'
                ])->name('agentadmin.sales.refunds.update_qty');

                Route::get('/refunds/view/{id}', 'Highwayns\AgentAdmin\Http\Controllers\Sales\RefundController@view')->defaults('_config', [
                    'view' => 'agentadmin::sales.refunds.view'
                ])->name('agentadmin.sales.refunds.view');
            });

            // Catalog Routes
            Route::prefix('catalog')->group(function () {
                Route::get('/sync', 'Webkul\Product\Http\Controllers\ProductController@sync');

                // Catalog Product Routes
                Route::get('/products', 'Webkul\Product\Http\Controllers\ProductController@index')->defaults('_config', [
                    'view' => 'agentadmin::catalog.products.index'
                ])->name('agentadmin.catalog.products.index');

                Route::get('/products/create', 'Webkul\Product\Http\Controllers\ProductController@create')->defaults('_config', [
                    'view' => 'agentadmin::catalog.products.create'
                ])->name('agentadmin.catalog.products.create');

                Route::post('/products/create', 'Webkul\Product\Http\Controllers\ProductController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.products.edit'
                ])->name('agentadmin.catalog.products.store');

                Route::get('/products/edit/{id}', 'Webkul\Product\Http\Controllers\ProductController@edit')->defaults('_config', [
                    'view' => 'agentadmin::catalog.products.edit'
                ])->name('agentadmin.catalog.products.edit');

                Route::put('/products/edit/{id}', 'Webkul\Product\Http\Controllers\ProductController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.products.index'
                ])->name('agentadmin.catalog.products.update');

                Route::post('/products/upload-file/{id}', 'Webkul\Product\Http\Controllers\ProductController@uploadLink')->name('agentadmin.catalog.products.upload_link');

                Route::post('/products/upload-sample/{id}', 'Webkul\Product\Http\Controllers\ProductController@uploadSample')->name('agentadmin.catalog.products.upload_sample');

                //product delete
                Route::post('/products/delete/{id}', 'Webkul\Product\Http\Controllers\ProductController@destroy')->name('agentadmin.catalog.products.delete');

                //product massaction
                Route::post('products/massaction', 'Webkul\Product\Http\Controllers\ProductController@massActionHandler')->name('agentadmin.catalog.products.massaction');

                //product massdelete
                Route::post('products/massdelete', 'Webkul\Product\Http\Controllers\ProductController@massDestroy')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.products.index'
                ])->name('agentadmin.catalog.products.massdelete');

                //product massupdate
                Route::post('products/massupdate', 'Webkul\Product\Http\Controllers\ProductController@massUpdate')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.products.index'
                ])->name('agentadmin.catalog.products.massupdate');

                //product search for linked products
                Route::get('products/search', 'Webkul\Product\Http\Controllers\ProductController@productLinkSearch')->defaults('_config', [
                    'view' => 'agentadmin::catalog.products.edit'
                ])->name('agentadmin.catalog.products.productlinksearch');

                Route::get('products/search-simple-products', 'Webkul\Product\Http\Controllers\ProductController@searchSimpleProducts')->name('agentadmin.catalog.products.search_simple_product');

                Route::get('/products/{id}/{attribute_id}', 'Webkul\Product\Http\Controllers\ProductController@download')->defaults('_config', [
                    'view' => 'agentadmin.catalog.products.edit'
                ])->name('agentadmin.catalog.products.file.download');

                // Catalog Category Routes
                Route::get('/categories', 'Webkul\Category\Http\Controllers\CategoryController@index')->defaults('_config', [
                    'view' => 'agentadmin::catalog.categories.index'
                ])->name('agentadmin.catalog.categories.index');

                Route::get('/categories/create', 'Webkul\Category\Http\Controllers\CategoryController@create')->defaults('_config', [
                    'view' => 'agentadmin::catalog.categories.create'
                ])->name('agentadmin.catalog.categories.create');

                Route::post('/categories/create', 'Webkul\Category\Http\Controllers\CategoryController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.categories.index'
                ])->name('agentadmin.catalog.categories.store');

                Route::get('/categories/edit/{id}', 'Webkul\Category\Http\Controllers\CategoryController@edit')->defaults('_config', [
                    'view' => 'agentadmin::catalog.categories.edit'
                ])->name('agentadmin.catalog.categories.edit');

                Route::put('/categories/edit/{id}', 'Webkul\Category\Http\Controllers\CategoryController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.categories.index'
                ])->name('agentadmin.catalog.categories.update');

                Route::post('/categories/delete/{id}', 'Webkul\Category\Http\Controllers\CategoryController@destroy')->name('agentadmin.catalog.categories.delete');


                // Catalog Attribute Routes
                Route::get('/attributes', 'Webkul\Attribute\Http\Controllers\AttributeController@index')->defaults('_config', [
                    'view' => 'agentadmin::catalog.attributes.index'
                ])->name('agentadmin.catalog.attributes.index');

                Route::get('/attributes/create', 'Webkul\Attribute\Http\Controllers\AttributeController@create')->defaults('_config', [
                    'view' => 'agentadmin::catalog.attributes.create'
                ])->name('agentadmin.catalog.attributes.create');

                Route::post('/attributes/create', 'Webkul\Attribute\Http\Controllers\AttributeController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.attributes.index'
                ])->name('agentadmin.catalog.attributes.store');

                Route::get('/attributes/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@edit')->defaults('_config', [
                    'view' => 'agentadmin::catalog.attributes.edit'
                ])->name('agentadmin.catalog.attributes.edit');

                Route::put('/attributes/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.attributes.index'
                ])->name('agentadmin.catalog.attributes.update');

                Route::post('/attributes/delete/{id}', 'Webkul\Attribute\Http\Controllers\AttributeController@destroy')->name('agentadmin.catalog.attributes.delete');

                Route::post('/attributes/massdelete', 'Webkul\Attribute\Http\Controllers\AttributeController@massDestroy')->name('agentadmin.catalog.attributes.massdelete');

                // Catalog Family Routes
                Route::get('/families', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@index')->defaults('_config', [
                    'view' => 'agentadmin::catalog.families.index'
                ])->name('agentadmin.catalog.families.index');

                Route::get('/families/create', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@create')->defaults('_config', [
                    'view' => 'agentadmin::catalog.families.create'
                ])->name('agentadmin.catalog.families.create');

                Route::post('/families/create', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.families.index'
                ])->name('agentadmin.catalog.families.store');

                Route::get('/families/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@edit')->defaults('_config', [
                    'view' => 'agentadmin::catalog.families.edit'
                ])->name('agentadmin.catalog.families.edit');

                Route::put('/families/edit/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog.families.index'
                ])->name('agentadmin.catalog.families.update');

                Route::post('/families/delete/{id}', 'Webkul\Attribute\Http\Controllers\AttributeFamilyController@destroy')->name('agentadmin.catalog.families.delete');
            });

            // User Routes
            //datagrid for backend users
            Route::get('/users', 'Highwayns\Agent\Http\Controllers\UserController@index')->defaults('_config', [
                'view' => 'agentadmin::users.users.index'
            ])->name('agentadmin.users.index');

            //create backend user get
            Route::get('/users/create', 'Highwayns\Agent\Http\Controllers\UserController@create')->defaults('_config', [
                'view' => 'agentadmin::users.users.create'
            ])->name('agentadmin.users.create');

            //create backend user post
            Route::post('/users/create', 'Highwayns\Agent\Http\Controllers\UserController@store')->defaults('_config', [
                'redirect' => 'agentadmin.users.index'
            ])->name('agentadmin.users.store');

            //delete backend user view
            Route::get('/users/edit/{id}', 'Highwayns\Agent\Http\Controllers\UserController@edit')->defaults('_config', [
                'view' => 'agentadmin::users.users.edit'
            ])->name('agentadmin.users.edit');

            //edit backend user submit
            Route::put('/users/edit/{id}', 'Highwayns\Agent\Http\Controllers\UserController@update')->defaults('_config', [
                'redirect' => 'agentadmin.users.index'
            ])->name('agentadmin.users.update');

            //delete backend user
            Route::post('/users/delete/{id}', 'Highwayns\Agent\Http\Controllers\UserController@destroy')->name('agentadmin.users.delete');

            Route::post('/confirm/destroy', 'Highwayns\Agent\Http\Controllers\UserController@destroySelf')->defaults('_config', [
                'redirect' => 'agentadmin.users.index'
            ])->name('agentadmin.users.confirm.destroy');

            // User Role Routes
            Route::get('/roles', 'Highwayns\Agent\Http\Controllers\RoleController@index')->defaults('_config', [
                'view' => 'agentadmin::users.roles.index'
            ])->name('agentadmin.roles.index');

            Route::get('/roles/create', 'Highwayns\Agent\Http\Controllers\RoleController@create')->defaults('_config', [
                'view' => 'agentadmin::users.roles.create'
            ])->name('agentadmin.roles.create');

            Route::post('/roles/create', 'Highwayns\Agent\Http\Controllers\RoleController@store')->defaults('_config', [
                'redirect' => 'agentadmin.roles.index'
            ])->name('agentadmin.roles.store');

            Route::get('/roles/edit/{id}', 'Highwayns\Agent\Http\Controllers\RoleController@edit')->defaults('_config', [
                'view' => 'agentadmin::users.roles.edit'
            ])->name('agentadmin.roles.edit');

            Route::put('/roles/edit/{id}', 'Highwayns\Agent\Http\Controllers\RoleController@update')->defaults('_config', [
                'redirect' => 'agentadmin.roles.index'
            ])->name('agentadmin.roles.update');

            Route::post('/roles/delete/{id}', 'Highwayns\Agent\Http\Controllers\RoleController@destroy')->name('agentadmin.roles.delete');


            // Locale Routes
            Route::get('/locales', 'Webkul\Core\Http\Controllers\LocaleController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.locales.index'
            ])->name('agentadmin.locales.index');

            Route::get('/locales/create', 'Webkul\Core\Http\Controllers\LocaleController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.locales.create'
            ])->name('agentadmin.locales.create');

            Route::post('/locales/create', 'Webkul\Core\Http\Controllers\LocaleController@store')->defaults('_config', [
                'redirect' => 'agentadmin.locales.index'
            ])->name('agentadmin.locales.store');

            Route::get('/locales/edit/{id}', 'Webkul\Core\Http\Controllers\LocaleController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.locales.edit'
            ])->name('agentadmin.locales.edit');

            Route::put('/locales/edit/{id}', 'Webkul\Core\Http\Controllers\LocaleController@update')->defaults('_config', [
                'redirect' => 'agentadmin.locales.index'
            ])->name('agentadmin.locales.update');

            Route::post('/locales/delete/{id}', 'Webkul\Core\Http\Controllers\LocaleController@destroy')->name('agentadmin.locales.delete');


            // Currency Routes
            Route::get('/currencies', 'Webkul\Core\Http\Controllers\CurrencyController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.currencies.index'
            ])->name('agentadmin.currencies.index');

            Route::get('/currencies/create', 'Webkul\Core\Http\Controllers\CurrencyController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.currencies.create'
            ])->name('agentadmin.currencies.create');

            Route::post('/currencies/create', 'Webkul\Core\Http\Controllers\CurrencyController@store')->defaults('_config', [
                'redirect' => 'agentadmin.currencies.index'
            ])->name('agentadmin.currencies.store');

            Route::get('/currencies/edit/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.currencies.edit'
            ])->name('agentadmin.currencies.edit');

            Route::put('/currencies/edit/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@update')->defaults('_config', [
                'redirect' => 'agentadmin.currencies.index'
            ])->name('agentadmin.currencies.update');

            Route::post('/currencies/delete/{id}', 'Webkul\Core\Http\Controllers\CurrencyController@destroy')->name('agentadmin.currencies.delete');

            Route::post('/currencies/massdelete', 'Webkul\Core\Http\Controllers\CurrencyController@massDestroy')->name('agentadmin.currencies.massdelete');


            // Exchange Rates Routes
            Route::get('/exchange_rates', 'Webkul\Core\Http\Controllers\ExchangeRateController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.exchange_rates.index'
            ])->name('agentadmin.exchange_rates.index');

            Route::get('/exchange_rates/create', 'Webkul\Core\Http\Controllers\ExchangeRateController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.exchange_rates.create'
            ])->name('agentadmin.exchange_rates.create');

            Route::post('/exchange_rates/create', 'Webkul\Core\Http\Controllers\ExchangeRateController@store')->defaults('_config', [
                'redirect' => 'agentadmin.exchange_rates.index'
            ])->name('agentadmin.exchange_rates.store');

            Route::get('/exchange_rates/edit/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.exchange_rates.edit'
            ])->name('agentadmin.exchange_rates.edit');

            Route::get('/exchange_rates/update-rates/{service}', 'Webkul\Core\Http\Controllers\ExchangeRateController@updateRates')->name('agentadmin.exchange_rates.update-rates');

            Route::put('/exchange_rates/edit/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@update')->defaults('_config', [
                'redirect' => 'agentadmin.exchange_rates.index'
            ])->name('agentadmin.exchange_rates.update');

            Route::post('/exchange_rates/delete/{id}', 'Webkul\Core\Http\Controllers\ExchangeRateController@destroy')->name('agentadmin.exchange_rates.delete');


            // Inventory Source Routes
            Route::get('/inventory_sources', 'Webkul\Inventory\Http\Controllers\InventorySourceController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.inventory_sources.index'
            ])->name('agentadmin.inventory_sources.index');

            Route::get('/inventory_sources/create', 'Webkul\Inventory\Http\Controllers\InventorySourceController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.inventory_sources.create'
            ])->name('agentadmin.inventory_sources.create');

            Route::post('/inventory_sources/create', 'Webkul\Inventory\Http\Controllers\InventorySourceController@store')->defaults('_config', [
                'redirect' => 'agentadmin.inventory_sources.index'
            ])->name('agentadmin.inventory_sources.store');

            Route::get('/inventory_sources/edit/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.inventory_sources.edit'
            ])->name('agentadmin.inventory_sources.edit');

            Route::put('/inventory_sources/edit/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@update')->defaults('_config', [
                'redirect' => 'agentadmin.inventory_sources.index'
            ])->name('agentadmin.inventory_sources.update');

            Route::post('/inventory_sources/delete/{id}', 'Webkul\Inventory\Http\Controllers\InventorySourceController@destroy')->name('agentadmin.inventory_sources.delete');

            // Vendor Source Routes
            Route::get('/vendor_sources', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.vendor_sources.index'
            ])->name('agentadmin.vendor_sources.index');

            Route::get('/vendor_sources/create', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.vendor_sources.create'
            ])->name('agentadmin.vendor_sources.create');

            Route::post('/vendor_sources/create', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@store')->defaults('_config', [
                'redirect' => 'agentadmin.vendor_sources.index'
            ])->name('agentadmin.vendor_sources.store');

            Route::get('/vendor_sources/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.vendor_sources.edit'
            ])->name('agentadmin.vendor_sources.edit');

            Route::put('/vendor_sources/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@update')->defaults('_config', [
                'redirect' => 'agentadmin.vendor_sources.index'
            ])->name('agentadmin.vendor_sources.update');

            Route::post('/vendor_sources/delete/{id}', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@destroy')->name('agentadmin.vendor_sources.delete');

            Route::post('/vendorconfirm/destroy', 'Highwayns\Vendor\Http\Controllers\VendorSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'agentadmin.vendor_sources.index'
            ])->name('agentadmin.vendors.confirm.destroy');

            // Vendor Role Routes
            Route::get('/vendorroles', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.vendor_roles.index'
            ])->name('agentadmin.vendorroles.index');

            Route::get('/vendorroles/create', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.vendor_roles.create'
            ])->name('agentadmin.vendorroles.create');

            Route::post('/vendorroles/create', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@store')->defaults('_config', [
                'redirect' => 'agentadmin.vendorroles.index'
            ])->name('agentadmin.vendorroles.store');

            Route::get('/vendorroles/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.vendor_roles.edit'
            ])->name('agentadmin.vendorroles.edit');

            Route::put('/vendorroles/edit/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@update')->defaults('_config', [
                'redirect' => 'agentadmin.vendorroles.index'
            ])->name('agentadmin.vendorroles.update');

            Route::post('/vendorroles/delete/{id}', 'Highwayns\Vendor\Http\Controllers\VendorRoleController@destroy')->name('agentadmin.vendorroles.delete');

            // Agent Source Routes
            Route::get('/agent_sources', 'Highwayns\Agent\Http\Controllers\AgentSourceController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.agent_sources.index'
            ])->name('agentadmin.agent_sources.index');

            Route::get('/agent_sources/create', 'Highwayns\Agent\Http\Controllers\AgentSourceController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.agent_sources.create'
            ])->name('agentadmin.agent_sources.create');

            Route::post('/agent_sources/create', 'Highwayns\Agent\Http\Controllers\AgentSourceController@store')->defaults('_config', [
                'redirect' => 'agentadmin.agent_sources.index'
            ])->name('agentadmin.agent_sources.store');

            Route::get('/agent_sources/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentSourceController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.agent_sources.edit'
            ])->name('agentadmin.agent_sources.edit');

            Route::put('/agent_sources/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentSourceController@update')->defaults('_config', [
                'redirect' => 'agentadmin.agent_sources.index'
            ])->name('agentadmin.agent_sources.update');

            Route::post('/agent_sources/delete/{id}', 'Highwayns\Agent\Http\Controllers\AgentSourceController@destroy')->name('agentadmin.agent_sources.delete');

            Route::post('/agentconfirm/destroy', 'Highwayns\Agent\Http\Controllers\AgentSourceController@destroySelf')->defaults('_config', [
                'redirect' => 'agentadmin.agent_sources.index'
            ])->name('agentadmin.agents.confirm.destroy');

            // Agent Role Routes
            Route::get('/agentroles', 'Highwayns\Agent\Http\Controllers\AgentRoleController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.agent_roles.index'
            ])->name('agentadmin.agentroles.index');

            Route::get('/agentroles/create', 'Highwayns\Agent\Http\Controllers\AgentRoleController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.agent_roles.create'
            ])->name('agentadmin.agentroles.create');

            Route::post('/agentroles/create', 'Highwayns\Agent\Http\Controllers\AgentRoleController@store')->defaults('_config', [
                'redirect' => 'agentadmin.agentroles.index'
            ])->name('agentadmin.agentroles.store');

            Route::get('/agentroles/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentRoleController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.agent_roles.edit'
            ])->name('agentadmin.agentroles.edit');

            Route::put('/agentroles/edit/{id}', 'Highwayns\Agent\Http\Controllers\AgentRoleController@update')->defaults('_config', [
                'redirect' => 'agentadmin.agentroles.index'
            ])->name('agentadmin.agentroles.update');

            Route::post('/agentroles/delete/{id}', 'Highwayns\Agent\Http\Controllers\AgentRoleController@destroy')->name('agentadmin.agentroles.delete');

            // Channel Routes
            Route::get('/channels', 'Webkul\Core\Http\Controllers\ChannelController@index')->defaults('_config', [
                'view' => 'agentadmin::settings.channels.index'
            ])->name('agentadmin.channels.index');

            Route::get('/channels/create', 'Webkul\Core\Http\Controllers\ChannelController@create')->defaults('_config', [
                'view' => 'agentadmin::settings.channels.create'
            ])->name('agentadmin.channels.create');

            Route::post('/channels/create', 'Webkul\Core\Http\Controllers\ChannelController@store')->defaults('_config', [
                'redirect' => 'agentadmin.channels.index'
            ])->name('agentadmin.channels.store');

            Route::get('/channels/edit/{id}', 'Webkul\Core\Http\Controllers\ChannelController@edit')->defaults('_config', [
                'view' => 'agentadmin::settings.channels.edit'
            ])->name('agentadmin.channels.edit');

            Route::put('/channels/edit/{id}', 'Webkul\Core\Http\Controllers\ChannelController@update')->defaults('_config', [
                'redirect' => 'agentadmin.channels.index'
            ])->name('agentadmin.channels.update');

            Route::post('/channels/delete/{id}', 'Webkul\Core\Http\Controllers\ChannelController@destroy')->name('agentadmin.channels.delete');


            // AgentAdmin Profile route
            Route::get('/account', 'Highwayns\Agent\Http\Controllers\AccountController@edit')->defaults('_config', [
                'view' => 'agentadmin::account.edit'
            ])->name('agentadmin.account.edit');

            Route::put('/account', 'Highwayns\Agent\Http\Controllers\AccountController@update')->name('agentadmin.account.update');


            // Admin Store Front Settings Route
            Route::get('/subscribers','Webkul\Core\Http\Controllers\SubscriptionController@index')->defaults('_config',[
                'view' => 'agentadmin::customers.subscribers.index'
            ])->name('agentadmin.customers.subscribers.index');

            //destroy a newsletter subscription item
            Route::post('subscribers/delete/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@destroy')->name('agentadmin.customers.subscribers.delete');

            Route::get('subscribers/edit/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@edit')->defaults('_config', [
                'view' => 'agentadmin::customers.subscribers.edit'
            ])->name('agentadmin.customers.subscribers.edit');

            Route::put('subscribers/update/{id}', 'Webkul\Core\Http\Controllers\SubscriptionController@update')->defaults('_config', [
                'redirect' => 'agentadmin.customers.subscribers.index'
            ])->name('agentadmin.customers.subscribers.update');

            //slider index
            Route::get('/slider','Webkul\Core\Http\Controllers\SliderController@index')->defaults('_config',[
                'view' => 'agentadmin::settings.sliders.index'
            ])->name('agentadmin.sliders.index');

            //slider create show
            Route::get('slider/create','Webkul\Core\Http\Controllers\SliderController@create')->defaults('_config',[
                'view' => 'agentadmin::settings.sliders.create'
            ])->name('agentadmin.sliders.create');

            //slider create show
            Route::post('slider/create','Webkul\Core\Http\Controllers\SliderController@store')->defaults('_config',[
                'redirect' => 'agentadmin.sliders.index'
            ])->name('agentadmin.sliders.store');

            //slider edit show
            Route::get('slider/edit/{id}','Webkul\Core\Http\Controllers\SliderController@edit')->defaults('_config',[
                'view' => 'agentadmin::settings.sliders.edit'
            ])->name('agentadmin.sliders.edit');

            //slider edit update
            Route::post('slider/edit/{id}','Webkul\Core\Http\Controllers\SliderController@update')->defaults('_config',[
                'redirect' => 'agentadmin.sliders.index'
            ])->name('agentadmin.sliders.update');

            //destroy a slider item
            Route::post('slider/delete/{id}', 'Webkul\Core\Http\Controllers\SliderController@destroy')->name('agentadmin.sliders.delete');

            //tax routes
            Route::get('/tax-categories', 'Webkul\Tax\Http\Controllers\TaxController@index')->defaults('_config', [
                'view' => 'agentadmin::tax.tax-categories.index'
            ])->name('agentadmin.tax-categories.index');


            // tax category routes
            Route::get('/tax-categories/create', 'Webkul\Tax\Http\Controllers\TaxCategoryController@show')->defaults('_config', [
                'view' => 'agentadmin::tax.tax-categories.create'
            ])->name('agentadmin.tax-categories.show');

            Route::post('/tax-categories/create', 'Webkul\Tax\Http\Controllers\TaxCategoryController@create')->defaults('_config', [
                'redirect' => 'agentadmin.tax-categories.index'
            ])->name('agentadmin.tax-categories.create');

            Route::get('/tax-categories/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@edit')->defaults('_config', [
                'view' => 'agentadmin::tax.tax-categories.edit'
            ])->name('agentadmin.tax-categories.edit');

            Route::put('/tax-categories/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@update')->defaults('_config', [
                'redirect' => 'agentadmin.tax-categories.index'
            ])->name('agentadmin.tax-categories.update');

            Route::post('/tax-categories/delete/{id}', 'Webkul\Tax\Http\Controllers\TaxCategoryController@destroy')->name('agentadmin.tax-categories.delete');
            //tax category ends


            //tax rate
            Route::get('tax-rates', 'Webkul\Tax\Http\Controllers\TaxRateController@index')->defaults('_config', [
                'view' => 'agentadmin::tax.tax-rates.index'
            ])->name('agentadmin.tax-rates.index');

            Route::get('tax-rates/create', 'Webkul\Tax\Http\Controllers\TaxRateController@show')->defaults('_config', [
                'view' => 'agentadmin::tax.tax-rates.create'
            ])->name('agentadmin.tax-rates.show');

            Route::post('tax-rates/create', 'Webkul\Tax\Http\Controllers\TaxRateController@create')->defaults('_config', [
                'redirect' => 'agentadmin.tax-rates.index'
            ])->name('agentadmin.tax-rates.create');

            Route::get('tax-rates/edit/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@edit')->defaults('_config', [
                'view' => 'agentadmin::tax.tax-rates.edit'
            ])->name('agentadmin.tax-rates.store');

            Route::put('tax-rates/update/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@update')->defaults('_config', [
                'redirect' => 'agentadmin.tax-rates.index'
            ])->name('agentadmin.tax-rates.update');

            Route::post('/tax-rates/delete/{id}', 'Webkul\Tax\Http\Controllers\TaxRateController@destroy')->name('agentadmin.tax-rates.delete');

            Route::post('/tax-rates/import', 'Webkul\Tax\Http\Controllers\TaxRateController@import')->defaults('_config', [
                'redirect' => 'agentadmin.tax-rates.index'
            ])->name('agentadmin.tax-rates.import');
            //tax rate ends

            //DataGrid Export
            Route::post('agentadmin/export', 'Highwayns\AgentAdmin\Http\Controllers\ExportController@export')->name('agentadmin.datagrid.export');

            Route::prefix('promotion')->group(function () {
                Route::get('/catalog-rules', 'Webkul\Discount\Http\Controllers\CatalogRuleController@index')->defaults('_config', [
                    'view' => 'agentadmin::promotions.catalog-rule.index'
                ])->name('agentadmin.catalog-rule.index');

                Route::get('/catalog-rules/create', 'Webkul\Discount\Http\Controllers\CatalogRuleController@create')->defaults('_config', [
                    'view' => 'agentadmin::promotions.catalog-rule.create'
                ])->name('agentadmin.catalog-rule.create');

                Route::post('/catalog-rules/create', 'Webkul\Discount\Http\Controllers\CatalogRuleController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog-rule.index'
                ])->name('agentadmin.catalog-rule.store');

                Route::get('/catalog-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@edit')->defaults('_config', [
                    'view' => 'agentadmin::promotions.catalog-rule.edit'
                ])->name('agentadmin.catalog-rule.edit');

                Route::post('/catalog-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog-rule.index'
                ])->name('agentadmin.catalog-rule.update');

                Route::get('/catalog-rules/apply', 'Webkul\Discount\Http\Controllers\CatalogRuleController@applyRules')->defaults('_config', [
                    'view' => 'agentadmin::promotions.catalog-rule.index'
                ])->name('agentadmin.catalog-rule.apply');

                Route::post('/catalog-rules/delete/{id}', 'Webkul\Discount\Http\Controllers\CatalogRuleController@destroy')->name('agentadmin.catalog-rule.delete');

                Route::get('/catalog-rules/declutter', 'Webkul\Discount\Http\Controllers\CatalogRuleController@deClutter')->defaults('_config', [
                    'redirect' => 'agentadmin.catalog-rule.index'
                ])->name('agentadmin.catalog-rule.declut');

                Route::post('fetch/options', 'Webkul\Discount\Http\Controllers\CatalogRuleController@fetchAttributeOptions')->name('agentadmin.catalog-rule.options');

                Route::get('cart-rules', 'Webkul\Discount\Http\Controllers\CartRuleController@index')->defaults('_config', [
                    'view' => 'agentadmin::promotions.cart-rule.index'
                ])->name('agentadmin.cart-rule.index');

                Route::get('cart-rules/create', 'Webkul\Discount\Http\Controllers\CartRuleController@create')->defaults('_config', [
                    'view' => 'agentadmin::promotions.cart-rule.create'
                ])->name('agentadmin.cart-rule.create');

                Route::post('cart-rules/store', 'Webkul\Discount\Http\Controllers\CartRuleController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.cart-rule.index'
                ])->name('agentadmin.cart-rule.store');

                Route::get('cart-rules/edit/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@edit')->defaults('_config', [
                    'view' => 'agentadmin::promotions.cart-rule.edit'
                ])->name('agentadmin.cart-rule.edit');

                Route::post('cart-rules/update/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.cart-rule.index'
                ])->name('agentadmin.cart-rule.update');

                Route::post('cart-rules/delete/{id}', 'Webkul\Discount\Http\Controllers\CartRuleController@destroy')->name('agentadmin.cart-rule.delete');
            });

            Route::prefix('cms')->group(function () {
                Route::get('/', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@index')->defaults('_config', [
                    'view' => 'agentadmin::cms.index'
                ])->name('agentadmin.cms.index');

                Route::get('preview/{url_key}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@preview')->name('agentadmin.cms.preview');

                Route::get('create', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@create')->defaults('_config', [
                    'view' => 'agentadmin::cms.create'
                ])->name('agentadmin.cms.create');

                Route::post('create', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@store')->defaults('_config', [
                    'redirect' => 'agentadmin.cms.index'
                ])->name('agentadmin.cms.store');

                Route::get('update/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@edit')->defaults('_config', [
                    'view' => 'agentadmin::cms.edit'
                ])->name('agentadmin.cms.edit');

                Route::post('update/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@update')->defaults('_config', [
                    'redirect' => 'agentadmin.cms.index'
                ])->name('agentadmin.cms.update');

                Route::post('/delete/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@delete')->defaults('_config', [
                    'redirect' => 'agentadmin.cms.index'
                ])->name('agentadmin.cms.delete');

                Route::post('/massdelete', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@massDelete')->defaults('_config', [
                    'redirect' => 'agentadmin.cms.index'
                ])->name('agentadmin.cms.mass-delete');

                // Route::post('/delete/{id}', 'Webkul\CMS\Http\Controllers\AgentAdmin\PageController@delete')->defaults('_config', [
                //     'redirect' => 'agentadmin.cms.index'
                // ])->name('agentadmin.cms.delete');
            });

            // Development settings
            Route::prefix('development')->group(function () {
                Route::get('/', 'Highwayns\AgentAdmin\Http\Controllers\Development\DashboardController@index')
                    ->name('agentadmin.development.index');
            });
        });
    });
});
