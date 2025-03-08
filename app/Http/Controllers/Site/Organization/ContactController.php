<?php

namespace App\Http\Controllers\Site\Organization;

use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Contact\ContactRepo;
use App\Http\Requests\Contact\StoreRequest;

class ContactController extends Controller
{

    protected $modelName = 'Contact';
    protected $routeName = 'contacts.index';
    protected $isDestroyingAllowed;
    protected $model;
    protected $repo;

    public function __construct(Contact $model, ContactRepo $repo)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->isDestroyingAllowed = true;
    }

    public function index()
    {
        return view('site.contact.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        try {
            // return $request->all();

            $created =  $this->repo->createContact($request);
            if ($created) {
                return  $this->response($this->modelName . ' created successfully', ['data' => $created], true);
            }
        } catch (\Throwable $th) {
            return  $this->response($th->getMessage(), null, false);
        }
    }
}
