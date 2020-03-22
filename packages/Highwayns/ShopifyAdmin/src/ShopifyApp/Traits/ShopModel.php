<?php

namespace Highwayns\ShopifyAdmin\Traits;

use Osiset\BasicShopifyAPI;
use Highwayns\ShopifyAdmin\Storage\Models\Plan;
use Illuminate\Database\Eloquent\SoftDeletes;
use Highwayns\ShopifyAdmin\Objects\Values\ShopId;
use Highwayns\ShopifyAdmin\Storage\Models\Charge;
use Highwayns\ShopifyAdmin\Objects\Values\ShopDomain;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Highwayns\ShopifyAdmin\Objects\Values\AccessToken;
use Highwayns\ShopifyAdmin\Storage\Scopes\Namespacing;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Highwayns\ShopifyAdmin\Contracts\ApiHelper as IApiHelper;
use Highwayns\ShopifyAdmin\Objects\Transfers\ApiSession as ApiSessionTransfer;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\ShopDomain as ShopDomainValue;
use Highwayns\ShopifyAdmin\Contracts\Objects\Values\AccessToken as AccessTokenValue;

/**
 * Responsible for reprecenting a shop record.
 */
trait ShopModel
{
    use SoftDeletes;

    /**
     * The API helper instance.
     *
     * @var IApiHelper
     */
    public $apiHelper;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new Namespacing());
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): ShopId
    {
        return new ShopId($this->id);
    }

    /**
     * {@inheritdoc}
     */
    public function getDomain(): ShopDomainValue
    {
        return new ShopDomain($this->name);
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(): AccessTokenValue
    {
        return new AccessToken($this->password);
    }

    /**
     * {@inheritdoc}
     */
    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }

    /**
     * {@inheritdoc}
     */
    public function hasCharges(): bool
    {
        return $this->charges->isNotEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * {@inheritdoc}
     */
    public function isGrandfathered(): bool
    {
        return ((bool) $this->shopify_grandfathered) === true;
    }

    /**
     * {@inheritdoc}
     */
    public function isFreemium(): bool
    {
        return ((bool) $this->shopify_freemium) === true;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOfflineAccess(): bool
    {
        return !$this->getToken()->isNull();
    }

    /**
     * {@inheritdoc}
     */
    public function apiHelper(): IApiHelper
    {
        if ($this->apiHelper === null) {
            // Set the session
            $session = new ApiSessionTransfer();
            $session->domain = $this->getDomain();
            $session->token = $this->getToken();

            $this->apiHelper = resolve(IApiHelper::class)->make($session);
        }

        return $this->apiHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function api(): BasicShopifyAPI
    {
        if ($this->apiHelper === null) {
            $this->apiHelper();
        }

        return $this->apiHelper->getApi();
    }
}
