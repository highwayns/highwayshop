<?php

return [
    'security-warning' => '不審活動が見つかりました!!!',
    'nothing-to-delete' => '削除しません',

    'layouts' => [
        'my-account' => 'まいアカウント',
        'profile' => 'プロファイル',
        'address' => 'アドレス',
        'reviews' => 'レビュー一覧',
        'wishlist' => '要望リスト',
        'orders' => '注文一覧',
        'downloadable-products' => 'ダウンロード可能商品一覧',
    ],

    'common' => [
        'error' => 'エラー発生しました、後ほど試してください.',
        'no-result-found' => 'レコードが見つかりません.'
    ],

    'home' => [
        'page-title' => config('app.name') . ' - ホーム',
        'featured-products' => '商品特集',
        'new-products' => '新商品一覧',
        'verify-email' => 'Eメールを確認してください',
        'resend-verify-email' => '確認メール再送信'
    ],

    'header' => [
        'title' => 'アカウント',
        'dropdown-text' => 'カート, 注文 & 要望を管理する',
        'sign-in' => 'ログイン',
        'sign-up' => '登録',
        'account' => 'アカウント',
        'cart' => 'カート',
        'profile' => 'プロファイル',
        'wishlist' => '要望',
        'cart' => 'カート',
        'logout' => 'ログアウト',
        'search-text' => '商品検索'
    ],

    'minicart' => [
        'view-cart' => 'カートを見る',
        'checkout' => 'お会計',
        'cart' => 'カート',
        'zero' => '0'
    ],

    'footer' => [
        'subscribe-newsletter' => 'ニュースサブスクリプト',
        'subscribe' => 'サブスクリプト',
        'locale' => 'ローカル',
        'currency' => '通貨',
    ],

    'subscription' => [
        'unsubscribe' => 'サブスクリプト取消',
        'subscribe' => 'サブスクリプト',
        'subscribed' => 'サブスクリプトが成功しました.',
        'not-subscribed' => 'サブスクリプトが失敗しました,後ほど試してください.',
        'already' => 'すでにサブスクリプトしました.',
        'unsubscribed' => 'サブスクリプト取消成功しました.',
        'already-unsub' => 'すでにサブスクリプト取消しました.',
        'not-subscribed' => 'エラー! メール送信エラーが発生しました, 後ほど試してください.'
    ],

    'search' => [
        'no-results' => '検索結果なし',
        'page-title' => config('app.name') . ' - 検索',
        'found-results' => '検索結果一覧',
        'found-result' => '検索結果'
    ],

    'reviews' => [
        'title' => 'タイトル',
        'add-review-page-title' => 'レビュー追加',
        'write-review' => 'レビュー作成',
        'review-title' => 'レビュータイトル',
        'product-review-page-title' => '商品レビュー',
        'rating-reviews' => '評価 & レビュー',
        'submit' => '提出',
        'delete-all' => 'すべてレビューを削除しました',
        'ratingreviews' => ':rating 評価 & :review レビュー',
        'star' => '★',
        'percentage' => ':percentage %',
        'id-star' => '★',
        'name' => '名前'
    ],

    'customer' => [
        'signup-text' => [
            'account_exists' => 'アカウントすでに存在している',
            'title' => 'ログイン'
        ],

        'signup-form' => [
            'page-title' => '顧客 - 新規登録',
            'title' => '新規登録',
            'firstname' => '姓',
            'lastname' => '名',
            'email' => 'Eメール',
            'password' => 'パスワード',
            'confirm_pass' => 'パスワード（確認）',
            'button_title' => '登録',
            'agree' => '同意',
            'terms' => '利用規約',
            'conditions' => '条件',
            'using' => 'このウェブサイト使用には',
            'agreement' => '同意',
            'success' => 'アカウント作成成功.',
            'success-verify' => 'アカウント作成成功, 確認メールをご覧ください。.',
            'success-verify-email-unsent' => 'アカウント作成成功, 確認メール送信しません.',
            'failed' => 'エラー! アカウント作成失敗, 後ほど試してください.',
            'already-verified' => 'アカウントすでに確認中、または確認メール再送信してください.',
            'verification-not-sent' => '確認メール送信エラー, 後ほど試してください.',
            'verification-sent' => '確認メール送信成功',
            'verified' => 'アカウント確認完了, ログインしてみましょう.',
            'verify-failed' => 'Eメール確認ができません.',
            'dont-have-account' => 'アカウントが存在しません.',
            'success' => 'アカウント作成成功',
            'success-verify' => 'アカウント作成成功, メールで確認してください.',
            'success-verify-email-unsent' => 'アカウント作成成功, メール送信しない',
            'failed' => 'アカウント作成失敗, 後ほど試してください',
            'already-verified' => 'アカウント確認完了、または確認メール再送信してください',
            'verification-not-sent' => '確認メール送信失敗、後ほど試してください',
            'verification-sent' => '確認メール送信完了',
            'verified' => 'アカウント確認完了, ログインしてみましょう',
            'verify-failed' => 'Eメール確認ができません',
            'dont-have-account' => 'アカウントが存在しません',
            'customer-registration' => '顧客登録成功'
        ],

        'login-text' => [
            'no_account' => 'アカウントが存在しません',
            'title' => '新規登録',
        ],

        'login-form' => [
            'page-title' => '顧客 - ログイン',
            'title' => 'ログイン',
            'email' => 'Eメール',
            'password' => 'パスワード',
            'forgot_pass' => 'パスワードが忘れ?',
            'button_title' => 'ログイン',
            'remember' => '保存',
            'footer' => '© Copyright :year Webkul Software, All rights reserved',
            'invalid-creds' => '資格を確認して、再試してください.',
            'verify-first' => 'Eメール確認してください.',
            'not-activated' => '管理者に連絡してください',
            'resend-verification' => '確認メール再送信してください'
        ],

        'forgot-password' => [
            'title' => 'パスワードが忘れ',
            'email' => 'Eメール',
            'submit' => 'パスワード再設定メール送信',
            'page_title' => '顧客 - パスワードが忘れ'
        ],

        'reset-password' => [
            'title' => 'パスワード再設定',
            'email' => 'Eメール',
            'password' => 'パスワード',
            'confirm-password' => 'パスワード（確認）',
            'back-link-title' => 'ログインへ',
            'submit-btn-title' => 'パスワード再設定'
        ],

        'account' => [
            'dashboard' => '顧客 - プロファイル編集',
            'menu' => 'メニュー',

            'profile' => [
                'index' => [
                    'page-title' => '顧客 - プロファイル',
                    'title' => 'プロファイル',
                    'edit' => '編集',
                ],

                'edit-success' => 'プロファイル更新成功.',
                'edit-fail' => 'プロファイル更新失敗, 後ほど試してください.',
                'unmatch' => '元パスワードと一致しません.',

                'fname' => '姓',
                'lname' => '名',
                'gender' => '性別',
                'dob' => '生年月日',
                'phone' => '電話',
                'email' => 'Eメール',
                'opassword' => '元パスワード',
                'password' => 'パスワード',
                'cpassword' => 'パスワード（確認）',
                'submit' => 'プロファイル更新',

                'edit-profile' => [
                    'title' => 'プロファイル編集',
                    'page-title' => '顧客 - プロファイル更新'
                ]
            ],

            'address' => [
                'index' => [
                    'page-title' => '顧客 - アドレス',
                    'title' => 'アドレス',
                    'add' => 'アドレス追加',
                    'edit' => '編集',
                    'empty' => 'アドレスがありません, アドレスを追加しましょう。',
                    'create' => 'アドレス作成',
                    'delete' => '削除',
                    'make-default' => '初期に設定',
                    'default' => '初期',
                    'contact' => '宛先',
                    'confirm-delete' =>  'すべてアドレス削除してよろしいでしょうか。?',
                    'default-delete' => '初期アドレス変更ができません.',
                    'enter-password' => 'パスワードを入力してください.',
                ],

                'create' => [
                    'page-title' => '顧客 - アドレス',
                    'title' => 'アドレス追加',
                    'street-address' => '市区町村',
                    'country' => '国',
                    'state' => '都道府県',
                    'select-state' => '都道府県を選択してください',
                    'city' => '城市',
                    'postcode' => '郵便番号',
                    'phone' => '電話',
                    'submit' => 'アドレス保存',
                    'success' => 'アドレス保存成功.',
                    'error' => 'アドレス保存失敗.'
                ],

                'edit' => [
                    'page-title' => '顧客 - アドレス編集',
                    'title' => 'アドレス編集',
                    'street-address' => '市区町村',
                    'submit' => 'アドレス保存',
                    'success' => 'アドレス更新成功.',
                ],
                'delete' => [
                    'success' => 'アドレス削除成功',
                    'failure' => 'アドレス削除失敗',
                    'wrong-password' => 'パスワードが不正 !'
                ]
            ],

            'order' => [
                'index' => [
                    'page-title' => '顧客 - 注文一覧',
                    'title' => '注文一覧',
                    'order_id' => '注文番号',
                    'date' => '日付',
                    'status' => 'ステータス',
                    'total' => '合計',
                    'order_number' => 'ソート順'
                ],

                'view' => [
                    'page-tile' => '注文 #:order_id',
                    'info' => '情報',
                    'placed-on' => '所定の場所',
                    'products-ordered' => '注文済み',
                    'invoices' => '請求一覧',
                    'shipments' => '運輸一覧',
                    'SKU' => 'SKU',
                    'product-name' => '商品名',
                    'qty' => '数量',
                    'item-status' => 'ステータス',
                    'item-ordered' => '注文済み (:qty_ordered)',
                    'item-invoice' => '請求済み (:qty_invoiced)',
                    'item-shipped' => '運輸済み (:qty_shipped)',
                    'item-canceled' => '取消済み (:qty_canceled)',
                    'item-refunded' => '返金済み (:qty_refunded)',
                    'price' => '価格',
                    'total' => '合計',
                    'subtotal' => '小計',
                    'shipping-handling' => '運輸 & 処理',
                    'tax' => '税金',
                    'discount' => '割引',
                    'tax-percent' => '税金パーセント',
                    'tax-amount' => '税金額',
                    'discount-amount' => '割引額',
                    'grand-total' => '総計',
                    'total-paid' => '総支払済み額',
                    'total-refunded' => '総返金額',
                    'total-due' => '総費用',
                    'shipping-address' => '運輸アドレス',
                    'billing-address' => '請求アドレス',
                    'shipping-method' => '運輸方式',
                    'payment-method' => '支払方式',
                    'individual-invoice' => '請求番号 #:invoice_id',
                    'individual-shipment' => '運輸番号 #:shipment_id',
                    'print' => '印刷',
                    'invoice-id' => '請求番号',
                    'order-id' => '注文番号',
                    'order-date' => '注文日付',
                    'bill-to' => '請求先',
                    'ship-to' => '運輸先',
                    'contact' => '連絡者',
                    'refunds' => '返金一覧',
                    'individual-refund' => '返金番号 #:refund_id',
                    'adjustment-refund' => '返金調整',
                    'adjustment-fee' => '調整費用',
                ]
            ],

            'wishlist' => [
                'page-title' => '顧客 - 希望リスト',
                'title' => '希望リスト',
                'deleteall' => 'すべて削除',
                'moveall' => 'すべて商品をカートに移動',
                'move-to-cart' => 'カートに移動',
                'error' => '希望リストをカートに移動が失敗, 後ほど試してください',
                'add' => '希望リストに追加成功',
                'remove' => '希望リストから削除成功',
                'moved' => 'カートに追加成功',
                'option-missing' => '商品オプションが見つかりません,希望リスト一覧に移動できません.',
                'move-error' => '希望リスト一覧に移動できません, 後ほど試してください',
                'success' => '希望リスト一覧に追加成功',
                'failure' => '希望リスト一覧に移動できません, 後ほど試してください',
                'already' => '希望リスト一覧にすでに存在しています',
                'removed' => '希望リスト一覧から削除成功',
                'remove-fail' => '希望リスト一覧から削除失敗, 後ほど試してください',
                'empty' => '希望リスト一覧に項目なし',
                'remove-all-success' => '希望リスト削除成功',
            ],

            'downloadable_products' => [
                'title' => 'ダウンロード可能商品一覧',
                'order-id' => '注文番号',
                'date' => '日付',
                'name' => 'タイトル',
                'status' => 'ステータス',
                'pending' => '保留中',
                'available' => '有効',
                'expired' => '期限切れ',
                'remaining-downloads' => 'ダウンロード',
                'unlimited' => '制限なし',
                'download-error' => 'ダウンロードリンク期限切れ.'
            ],

            'review' => [
                'index' => [
                    'title' => 'レビュー一覧',
                    'page-title' => '顧客 - レビュー一覧'
                ],

                'view' => [
                    'page-tile' => 'レビュー番号 #:id',
                ]
            ]
        ]
    ],

    'products' => [
        'layered-nav-title' => '提供ショプ',
        'price-label' => '最低価格',
        'remove-filter-link-title' => 'すべてクリア',
        'sort-by' => 'ソート',
        'from-a-z' => 'From A-Z',
        'from-z-a' => 'From Z-A',
        'newest-first' => '最新',
        'oldest-first' => '最旧',
        'cheapest-first' => '再安価',
        'expensive-first' => '高価',
        'show' => '表示',
        'pager-info' => '表示 :showing / :total 項目',
        'description' => '説明',
        'specification' => '規格',
        'total-reviews' => ':total レビュー',
        'total-rating' => ':total_rating 格付け & :total_reviews レビュー',
        'by' => 'By :name',
        'up-sell-title' => '好き可能な商品を見つかった!',
        'related-product-title' => '関連商品一覧',
        'cross-sell-title' => '選択…',
        'reviews-title' => '格付 & レビュー',
        'write-review-btn' => 'レビューを書く',
        'choose-option' => 'オプション選択',
        'sale' => '売る',
        'new' => '新規',
        'empty' => 'カテゴリに商品なし',
        'add-to-cart' => 'カートに追加',
        'buy-now' => 'すぐ買う',
        'whoops' => 'Whoops!',
        'quantity' => '数量',
        'in-stock' => '在庫あり',
        'out-of-stock' => '在庫なし',
        'view-all' => 'すべて閲覧',
        'select-above-options' => 'オプションを選択してください.',
        'less-quantity' => '数量は１より大きい.',
        'samples' => 'サンプル一覧',
        'links' => 'リンク一覧',
        'sample' => 'サンプル',
        'name' => '名称',
        'qty' => '数量',
        'starting-at' => '開始',
        'customize-options' => 'オプションカスタマイズ',
        'choose-selection' => '選択',
        'your-customization' => 'あなたのカスタマイズ',
        'total-amount' => '総額',
        'none' => 'なし'
    ],

    // 'reviews' => [
    //     'empty' => 'You Have Not Reviewed Any Of Product Yet'
    // ]

    'buynow' => [
        'no-options' => 'Please select options before buying this product.'
    ],

    'checkout' => [
        'cart' => [
            'integrity' => [
                'missing_fields' => '商品の必須項目入力していない.',
                'missing_options' => 'オプション入力していない.',
                'missing_links' => 'ダウンロード可能リンクを入力していない.',
                'qty_missing' => '少なくとも１商品の件数１より大きい.'
            ],
            'create-error' => 'カート作成エラー発生しました.',
            'title' => 'カート',
            'empty' => 'カートが空いている',
            'update-cart' => 'カート更新',
            'continue-shopping' => '続けて買う',
            'proceed-to-checkout' => 'お会計',
            'remove' => '削除',
            'remove-link' => 'リンク削除',
            'move-to-wishlist' => '要望リストに移動',
            'move-to-wishlist-success' => '要望リストに移動成功.',
            'move-to-wishlist-error' => '要望リストに移動, 後ほど試してください.',
            'add-config-warning' => 'カートに追加する前、オプションを選択してください.',
            'quantity' => [
                'quantity' => '数量',
                'success' => 'カート項目更新成功.',
                'illegal' => '数量は１より大きく必要.',
                'inventory_warning' => '要求数量不正, 後ほど試してください.',
                'error' => '項目更新失敗, 後ほど試してください.'
            ],

            'item' => [
                'error_remove' => 'カート項目削除失敗.',
                'success' => 'カート項目追加成功.',
                'success-remove' => 'カート項目削除成功.',
                'error-add' => 'カート項目追加失敗, 後ほど試してください.',
            ],
            'quantity-error' => '要求数量不正.',
            'cart-subtotal' => 'カート小計',
            'cart-remove-action' => 'よろしいでしょうか ?',
            'partial-cart-update' => '部分項目更新しました',
            'link-missing' => ''
        ],

        'onepage' => [
            'title' => 'お会計',
            'information' => '情報',
            'shipping' => '運輸',
            'payment' => '支払',
            'complete' => '完了',
            'billing-address' => '請求アドレス',
            'sign-in' => 'ログイン',
            'first-name' => '姓',
            'last-name' => '名',
            'email' => 'Eメール',
            'address1' => '町アドレス',
            'city' => '都市',
            'state' => '都道府県',
            'select-state' => '都道府県選択.',
            'postcode' => '郵便番号',
            'phone' => '電話番号',
            'country' => '国',
            'order-summary' => '注文合計',
            'shipping-address' => '運輸アドレス',
            'use_for_shipping' => '運輸アドレス',
            'continue' => '続く',
            'shipping-method' => '運輸方式選択',
            'payment-methods' => '支払方式選択',
            'payment-method' => '支払方式',
            'summary' => '注文合計',
            'price' => '単価',
            'quantity' => '数量',
            'billing-address' => '請求アドレス',
            'shipping-address' => '運輸アドレス',
            'contact' => '契約',
            'place-order' => '注文',
            'new-address' => '新アドレス追加',
            'save_as_address' => 'アドレス保存',
            'apply-coupon' => '割引券適用',
            'amt-payable' => '支払可能数量',
            'got' => 'Got',
            'free' => 'Free',
            'coupon-used' => '割引券適用済み',
            'applied' => '券適用済み',
            'back' => '戻る',
            'cash-desc' => '代金引換',
            'money-desc' => '振り込み',
            'paypal-desc' => 'Paypal 支払',
            'free-desc' => '運輸無料',
            'flat-desc' => '料金固定',
            'password' => 'パスワード',
            'login-exist-message' => 'アカウントすでにあり,ログインまたはゲストとして使用.'
        ],

        'total' => [
            'order-summary' => '注文合計',
            'sub-total' => '小計',
            'grand-total' => '総計',
            'delivery-charges' => '代金引換',
            'tax' => '税金',
            'discount' => '割引',
            'price' => '単価',
            'disc-amount' => '割引額',
            'new-grand-total' => '新総額',
            'coupon' => '割引',
            'coupon-applied' => '割引適用済み',
            'remove-coupon' => '割引削除',
            'cannot-apply-coupon' => '割引適用できません'
        ],

        'success' => [
            'title' => '注文完了しました',
            'thanks' => 'ありがとうございます!',
            'order-id-info' => '注文番号 #:order_id',
            'info' => 'Eメール注文情報を確認しましよう'
        ]
    ],

    'mail' => [
        'order' => [
            'subject' => '注文確認',
            'heading' => '注文確認!',
            'dear' => 'Dear :customer_name',
            'dear-admin' => 'Dear :admin_name',
            'greeting' => 'ご注文ありがとうございます。 注文番号 :order_id 注文日付 :created_at',
            'greeting-admin' => '注文番号 :order_id 注文日付 :created_at',
            'summary' => '注文内容',
            'shipping-address' => '運輸アドレス',
            'billing-address' => '請求アドレス',
            'contact' => '契約',
            'shipping' => '運輸方式',
            'payment' => '支払方式',
            'price' => '単価',
            'quantity' => '数量',
            'subtotal' => '小計',
            'shipping-handling' => '運輸 & 処理',
            'tax' => '税金',
            'discount' => '割引',
            'grand-total' => '総計',
            'final-summary' => 'ありがとうございます。発送しましたらまた連絡します',
            'help' => '問題がある場合、 :support_emailで連絡しましょう',
            'thanks' => 'ありがとうございます!',
            'cancel' => [
                'subject' => '注文取消',
                'heading' => '注文取消済み',
                'dear' => 'Dear :customer_name',
                'greeting' => '注文取消しました。注文番号 #:order_id 注文日付 :created_at ',
                'summary' => '注文内容',
                'shipping-address' => '運輸アドレス',
                'billing-address' => '請求アドレス',
                'contact' => '契約',
                'shipping' => '運輸方式',
                'payment' => '支払方式',
                'subtotal' => '小計',
                'shipping-handling' => '運輸 & 処理',
                'tax' => '税金',
                'discount' => '割引',
                'grand-total' => '総計',
                'final-summary' => 'ご利用ありがとうございます。',
                'help' => '問題がある場合、 :support_emailで連絡しましょう',
                'thanks' => 'ありがとうございます!',
            ]
        ],

        'invoice' => [
            'heading' => '請求番号 #:invoice_id 注文番号 #:order_id',
            'subject' => '注文番号 #:order_idを請求します',
            'summary' => '請求内容',
        ],

        'shipment' => [
            'heading' => '注文番号 #:order_idの運輸番号 #:shipment_id  生成しました',
            'inventory-heading' => '注文番 #:order_idの運輸番号 #:shipment_id  生成しました',
            'subject' => '注文番号 #:order_idの運輸',
            'inventory-subject' => '注文番号 #:order_idの運輸生成しました',
            'summary' => '運輸内容',
            'carrier' => '運輸会社',
            'tracking-number' => '追跡番号',
            'greeting' => '注文番号 :order_id 注文日付 :created_at',
        ],

        'refund' => [
            'heading' => '返金番号 #:refund_id 注文番号 #:order_id',
            'subject' => '注文番号 #:order_id返金',
            'summary' => '返金内容',
            'adjustment-refund' => '返金調整',
            'adjustment-fee' => '調整費用'
        ],

        'forget-password' => [
            'subject' => 'パスワードが忘れ',
            'dear' => 'Dear :name',
            'info' => 'パスワード再設定要求しましたので、このメールを送信します',
            'reset-password' => 'パスワード再設定',
            'final-summary' => 'パスワード再設定要求しない場合, 何も操作が必要ない',
            'thanks' => 'ありがとうございます!'
        ],

        'customer' => [
            'new' => [
                'dear' => 'Dear :customer_name',
                'username-email' => '顧客名/Eメール',
                'subject' => '顧客新規登録',
                'password' => 'パスワード',
                'summary' => 'アカウントを作成成功.
                アカウント詳細: ',
                'thanks' => 'ありがとうございます!',
            ],

            'registration' => [
                'subject' => '顧客新規登録',
                'customer-registration' => '顧客新規登録成功',
                'dear' => 'Dear :customer_name',
                'greeting' => 'ご登録ありがとうございます!',
                'summary' => '顧客新規登録成功しました、ログインしてください.',
                'thanks' => 'ありがとうございます!',
            ],

            'verification' => [
                'heading' => config('app.name') . ' - Eメール確認',
                'subject' => 'Eメール確認',
                'verify' => 'アカウント確認',
                'summary' => 'Eメール確認ため、このメールを送信しました.
                あなたのアカウントボタンをクリックして、メールを確認しましよう.'
            ],

            'subscription' => [
                'subject' => 'サブスクリプトメール',
                'greeting' => ' よこそ ' . config('app.name') . ' - Eメールサブスクリプト',
                'unsubscribe' => 'サブスクリプト取消',
                'summary' => 'サブスクリプトしてありがとうございます.  ' . config('app.name') . ' はいつもみんな好きの情報を配信しています.好きではない、
                下記のボタンをクリックしましょう.'
            ]
        ]
    ],

    'webkul' => [
        'copy-right' => '© Copyright :year Webkul Software, All rights reserved',
    ],

    'response' => [
        'create-success' => ':name 作成成功.',
        'update-success' => ':name 更新成功.',
        'delete-success' => ':name 削除成功.',
        'submit-success' => ':name サブミット成功.'
    ],
];
