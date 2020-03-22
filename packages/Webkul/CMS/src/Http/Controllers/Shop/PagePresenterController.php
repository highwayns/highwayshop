<?php

namespace Webkul\CMS\Http\Controllers\Shop;

use Webkul\CMS\Http\Controllers\Controller;
use Webkul\CMS\Repositories\CmsRepository;

/**
 * PagePresenter controller
 *
 * @author  Tei Gun <tei952@hotmail.com>
 * @copyright 2019 Highwayns Software Tokyo Ltd (http://www.highwayns.com)
 */
class PagePresenterController extends Controller
{
    /**
     * CmsRepository object
     *
     * @var Object
     */
    protected $cmsRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\CMS\Repositories\CmsRepository $cmsRepository
     * @return void
     */
    public function __construct(CmsRepository $cmsRepository)
    {
        $this->cmsRepository = $cmsRepository;
    }

    /**
     * To extract the page content and load it in the respective view file
     *
     * @param string $urlKey
     * @return \Illuminate\View\View
     */
    public function presenter($urlKey)
    {
        $page = $this->cmsRepository->findByUrlKeyOrFail($urlKey);

        return view('shop::cms.page')->with('page', $page);
    }
}