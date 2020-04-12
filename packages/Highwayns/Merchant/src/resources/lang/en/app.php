<?php

return [
    'layouts' => [
        'agentroles' => 'ロール一覧',        
        'agent-sources' => '代理店ソース一覧'
    ],

    'acl' => [
        'agent-sources' => '代理店ソース一覧'
    ],

    'datagrid' => [
        'agent-source' => '代理店ソース',
    ],

    'sales' => [

        'shipments' => [
            'agent-source' => '代理店ソース'
        ]
    ],

    'settings' => [
        'agent_sources' => [
            'title' => '代理店一覧',
            'add-title' => '代理店追加',
            'edit-title' => '代理店編集',
            'save-btn-title' => '代理店保存',
            'general' => '一般',
            'id' =>'代理店ID',
            'email' => 'Eメール',
            'name' => '名称',
            'password' => 'パスワード',
            'confirm-password' => 'パスワード（確認）',
            'status-and-role' => 'ステータス＆ロール',
            'role' => 'ロール',
            'status' => 'ステータス',
            'account-is-active' => 'アカウントは活性化している',
            'vendor_id' => 'ベンダーID',
            'agency_group_id' => '代理店グループID',
            'postal_code' => '郵便番号',
            'pref' => '都道府県',
            'city' => '市町村',
            'address' => '番地',
            'building_name' => '建物名',
            'tel' => '電話番号',
            'fax' => 'FAX番号',
            'agency_denki_shop_code' => 'SmartCIS代理店ID',
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
            'agent' => '代理店',
        ]
    ]
];
