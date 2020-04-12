<?php

return [
    'layouts' => [
        'merchantroles' => 'ロール一覧',        
        'merchant-sources' => '製造業者ソース一覧'
    ],

    'acl' => [
        'merchant-sources' => '製造業者ソース一覧'
    ],

    'datagrid' => [
        'merchant-source' => '製造業者ソース',
    ],

    'sales' => [

        'shipments' => [
            'merchant-source' => '製造業者ソース'
        ]
    ],

    'settings' => [
        'merchant_sources' => [
            'title' => '製造業者一覧',
            'add-title' => '製造業者追加',
            'edit-title' => '製造業者編集',
            'save-btn-title' => '製造業者保存',
            'general' => '一般',
            'id' =>'製造業者ID',
            'email' => 'Eメール',
            'name' => '名称',
            'password' => 'パスワード',
            'confirm-password' => 'パスワード（確認）',
            'status-and-role' => 'ステータス＆ロール',
            'role' => 'ロール',
            'status' => 'ステータス',
            'account-is-active' => 'アカウントは活性化している',
            'vendor_id' => 'ベンダーID',
            'agency_group_id' => '製造業者グループID',
            'postal_code' => '郵便番号',
            'pref' => '都道府県',
            'city' => '市町村',
            'address' => '番地',
            'building_name' => '建物名',
            'tel' => '電話番号',
            'fax' => 'FAX番号',
            'agency_denki_shop_code' => 'SmartCIS製造業者ID',
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
            'merchant' => '製造業者',
        ]
    ]
];
