<?php

return [
    'layouts' => [
        'vendorroles' => 'ロール一覧',        
        'vendor-sources' => 'ベンダーソース一覧'
    ],

    'acl' => [
        'vendor-sources' => 'ベンダーソース一覧'
    ],

    'datagrid' => [
        'vendor-source' => 'ベンダーソース',
    ],

    'sales' => [

        'shipments' => [
            'vendor-source' => 'ベンダーソース'
        ]
    ],

    'settings' => [
        'vendor_sources' => [
            'title' => 'ベンダー一覧',
            'add-title' => 'ベンダー追加',
            'edit-title' => 'ベンダー編集',
            'save-btn-title' => 'ベンダー保存',
            'general' => '一般',
            'id' =>'ベンダーID',
            'email' => 'Eメール',
            'name' => '名称',
            'password' => 'パスワード',
            'confirm-password' => 'パスワード（確認）',
            'status-and-role' => 'ステータス＆ロール',
            'role' => 'ロール',
            'status' => 'ステータス',
            'account-is-active' => 'アカウントは活性化している',
            'vendor_id' => 'ベンダーID',
            'agency_group_id' => 'ベンダーグループID',
            'postal_code' => '郵便番号',
            'pref' => '都道府県',
            'city' => '市町村',
            'address' => '番地',
            'building_name' => '建物名',
            'tel' => '電話番号',
            'fax' => 'FAX番号',
            'agency_denki_shop_code' => 'SmartCISベンダーID',
            'created_at' => '作成日時',
            'created_user_id' => '作成ユーザーID',
            'updated_at' => '更新日時',
            'updated_user_id' => '更新ユーザーID',
            'create-success' => 'ベンダー作成成功.',
            'update-success' => 'ベンダー更新成功.',
            'delete-success' => 'ベンダー削除成功.',
            'last-delete-error' => '少なくとも１ベンダーが必要.',
        ]
    ],

    'admin' => [
        'system' => [
            'vendor' => 'ベンダー',
        ]
    ]
];
