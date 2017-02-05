<?php

namespace App\Http\Controllers;

use App\Affiliates\Affiliate;
use App\Affiliates\AffiliatesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class AffiliatesController extends Controller
{

    /**
     * @var AffiliatesRepository
     */
    private $repository;

    public function __construct(AffiliatesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $affiliates = $this->repository->allPublished();

        return view('front.affiliates.index')->with(compact('affiliates'));
    }

    public function show($slug)
    {
        $affiliate = $this->repository->bySlug($slug);
        $nextAffiliate = $this->repository->getNextInLineAfter($affiliate);
        return view('front.affiliates.show')->with(compact('affiliate', 'nextAffiliate'));
    }
}
