<?php

return [
    'admin' => [
        'system'   => [
            'velocity' => [
                'general'  => '一般',
                'category'  => 'カテゴリ',
                'settings'  => '設定',
                'extension_name' => 'Velocity テーマ',
                'error-module-inactive' => 'Warning: Velocity テーマは非活性化です',
            ],

            'settings' => [
                'channels'=> [
                    'subscription_bar' => 'サブスクリプト　バー　コンテンツ'
                ],
            ],

            'general' => [
                'status' => 'ステータス',
                'active' => '活性化',
                'inactive' => '非活性化',
            ],
            'category' => [
                'all' => 'すべて',
                'left' => '左',
                'right' => '右',
                'active' => '活性化',
                'custom' => '顧客',
                'inactive' => '非活性化',
                'image-alignment' => '画像並ぶ',
                'icon-status' => 'アイコンステータス',
                'image-status' => '画像ステータス',
                'sub-category-show' => 'サブカテゴリ表示',
                'image-height' => '画像の高さ [in Pixel]',
                'image-width' => '画像の広さ [in Pixel]',
                'show-tooltip' => 'カテゴリのツールチップ表示',
                'num-sub-category' => 'サブカテゴリ数',
            ]
        ],
        'layouts' => [
            'velocity' => 'Velocity',
            'cms-pages' => 'CMS ページ',
            'meta-data' => 'メタ―データ',
            'category-menu' => 'カテゴリメニュー',
            'header-content' => 'ヘッドコンテンツ',
        ],
        'contents' => [
            'self' => '自分',
            'active' => '活性化',
            'new-tab' => '新タブ',
            'inactive' => '非活性化',
            'title' => 'コンテンツ一覧',
            'select' => '-- 選択 --',
            'add-title' => 'コンテンツ追加',
            'btn-add-content' => '追加',
            'save-btn-title' => '保存',
            'autocomplete' => '[自動完了]',
            'no-result-found' => 'レコードなし',
            'search-hint' => '製品検索...',
            'mass-delete-success' => '選択されたコンテンツが削除しました.',
            'tab' => [
                'page' => 'ページ設定',
                'content' => 'コンテンツ設定',
                'meta_content' => 'メタデータ',
            ],
            'page' => [
                'title' => 'タイトル',
                'status' => 'ステータス',
                'position' => 'ポジション',
            ],
            'content' => [
                'content-type' => 'コンテンツタイプ',
                'custom-title' => 'タイトル',
                'category-slug' => 'カテゴリスラグ',
                'link-target' => 'ページリンクターゲット',
                'custom-product' => '製品一覧',
                'custom-heading' => 'ヘッド',
                'catalog-type' => '製品カテゴリタイプ',
                'static-description' => 'コンテンツ説明',
                'page-link' => 'ページリンク [e.g. http://example.com/../../]',
            ],
            'datagrid' => [
                'id' => 'Id',
                'title' => 'タイトル',
                'status' => 'ステータス',
                'position' => 'ポジション',
                'content-type' => 'コンテンツタイプ',
            ]
        ],
        'meta-data' => [
            'footer' => 'フッター',
            'title' => 'Velocity メタデータ',
            'activate-slider' => 'スレッド活性化',
            'home-page-content' => 'HPコンテンツ',
            'footer-left-content' => 'フッター左コンテンツ',
            'subscription-content' => 'サブスクリプトコンテンツ',
            'sidebar-categories' => 'サッドバーカテゴリ',
            'footer-left-raw-content' => '<p>私だちの目的は先端技術を利用して、素晴らしい製品を提供して、みんな安定の生活を守る.</p>',
            'slider-path' => 'スレッドパス',
            'category-logo' => 'カテゴリロゴ',
            'product-policy' => '製品ポリシー',
            'update-meta-data' => 'メタデータ更新',
            'product-view-image' => '製品画像',
            'advertisement-two' => '二画像広告',
            'advertisement-one' => '一画像広告',
            'footer-middle-content' => 'フッター真ん中コンテンツ',
            'advertisement-four' => '四画像広告',
            'advertisement-three' => '三画像広告',
            'images' => '画像一覧',
            'general' => '一般',
            'add-image-btn-title' => '画像追加'
        ],
        'category' => [
            'save-btn-title' => '保存',
            'title' => 'カテゴリメニュー一覧',
            'add-title' => 'メニューコンテンツ追加',
            'edit-title' => 'メニューコンテンツ編集',
            'btn-add-category' => 'カテゴリコンテンツ追加',
            'datagrid' => [
                'category-id' => 'カテゴリ Id',
                'category-name' => 'カテゴリ名称',
                'category-icon' => 'カテゴリアイコン',
                'category-status' => 'ステータス',
            ],
            'tab' => [
                'general' => '一般',
            ],
            'status' => 'ステータス',
            'active' => '活性化',
            'inactive' => '非活性化',
            'select' => '-- 選択 --',
            'icon-class' => 'アイコンClass',
            'select-category' => 'カテゴリ選択',
            'tooltip-content' => 'ツールチップコンテンツ',
            'mass-delete-success' => '選択されたカテゴリを削除しました.',
        ],
        'general' => [
            'locale_logo' => 'ローカルロゴ',
        ],
    ],

    'home' => [
        'view-all' => 'すべて閲覧',
        'add-to-cart' => 'カートに追加',
        'hot-categories' => 'ホットカテゴリ',
        'payment-methods' => '支払メソッド',
        'customer-reviews' => '顧客レビュー',
        'shipping-methods' => '運輸方式',
        'popular-categories' => '人気カテゴリ',
    ],

    'header' => [
        'cart' => 'カート',
        'cart' => 'カート',
        'guest' => 'げースト',
        'logout' => 'ログアウト',
        'title' => 'アカウント',
        'account' => 'アカウント',
        'profile' => 'プロファイル',
        'wishlist' => 'ウエットリスト',
        'all-categories' => 'すべてカテゴリ',
        'search-text' => '製品検索',
        'welcome-message' => 'よこそ, :customer_name',
        'dropdown-text' => 'カート, 注文 とウエットリスト管理',
    ],

    'menu-navbar' => [
        'text-more' => 'More',
        'text-category' => '商店カテゴリ',
    ],

    'minicart' => [
        'cart' => 'カート',
        'view-cart' => 'カート閲覧',
    ],

    'checkout' => [
        'qty' => 'Qty',
        'checkout' => 'お会計',
        'cart' => [
            'view-cart' => 'カート閲覧',
            'cart-summary' => 'カートサマリー',
        ],
        'qty' => 'Qty',
        'items' => '明細',
        'subtotal' => '小計',
        'sub-total' => '小計',
        'proceed' => 'お会計へ',
    ],

    'customer' => [
        'login-form' => [
            'sign-up' => '新規登録',
            'new-customer' => '新規顧客',
            'customer-login' => '顧客ログイン',
            'registered-user' => '登録したユーザー',
            'your-email-address' => 'メール',
            'form-login-text' => 'アカウントが持っている場合, Eメールを利用してログイン.',
        ],
        'signup-form' => [
            'login' => 'ログイン',
            'become-user' => 'ユーザーになる',
            'user-registration' => 'ユーザー登録',
            'form-sginup-text' => '新規ユーザーの場合, 会員になりましょう.',
        ],
        'forget-password' => [
            'login' => 'ログイン',
            'forgot-password' => 'パスワードが忘れ',
            'recover-password' => 'パスワード回復',
            'recover-password-text' => 'パスワードが忘れた場合, Eメールを入力して回復しましょう.',
        ]
    ],

    'error' => [
        'go-to-home' => 'ホームへ',
        'page-lost-short' => 'コンテンツなくなりました',
        'something-went-wrong' => 'エラー発生しました',
        'page-lost-description' => "探しているページが存在しません. 再検索してください。",
    ],

    'products' => [
        'text' => '製品一覧',
        'details' => '詳細',
        'reviews-title' => 'レビュー一覧',
        'reviewed' => 'レビュー済み',
        'review-by' => 'レビュー者',
        'quick-view' => '快速レビュー',
        'not-available' => '無効',
        'submit-review' => 'レビュー提出',
        'ratings' => ':totalRatings 比率',
        'reviews-count' => ':totalReviews レビュー数',
        'customer-rating' => '顧客比率',
        'more-infomation' => 'その他情報',
        'view-all-reviews' => 'レビュー閲覧',
        'write-your-review' => 'レビューを書き',
        'short-description' => 'ショート説明',
        'recently-viewed' => '最近レビュー製品',
        'be-first-review' => '最先レビュー者になりましょう',
    ],

    'shop' => [
        'gender' => [
            'male' => '男',
            'other' => 'その他',
            'female' => '女',
        ],
        'general' => [
            'view' => 'ビュー',
            'filter' => 'フィルター',
            'orders' => '注文一覧',
            'update' => '更新',
            'reviews' => 'レビュー一覧',
            'addresses' => 'アドレス',
            'top-brands' => 'トップブランド一覧',
            'new-password' => '新パスワード',
            'downloadables' => 'ダウンロード可能製品',
            'confirm-new-password' => 'パスワード確認',
            'enter-current-password' => '現在パスワードを入力',

            'alert' => [
                'info' => '情報',
                'error' => 'エラー',
                'success' => '成功',
                'warning' => '警告',
            ],
        ],
        'wishlist' => [
            'add-wishlist-text' => 'ウエットリストに製品を追加',
            'remove-wishlist-text' => 'ウエットリストに製品を削除'
        ]
    ],

    'responsive' => [
        'header' => [
            'greeting' => 'よこそ, :customer !',
        ]
    ],
]

?>
