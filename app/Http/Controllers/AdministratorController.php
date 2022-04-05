<?php

namespace App\Http\Controllers;

use App\Models\ServiceTypeModel;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceDetailModel;

class AdministratorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->serviceTypeModel = new ServiceTypeModel();
        $this->serviceDetailModel = new ServiceDetailModel();
    }

    public function show($id)
    {
        $dataService = $this->serviceTypeModel->where('service_id',$id)->get();
        $dataDetail = $this->serviceDetailModel->where('service_id',$id)->get();
        return view('administrator.detail',compact('dataService','dataDetail'));
        // return view('administrator.detail');
    }
    /**
     * Show the va list page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = $this->serviceTypeModel->all();
        return view('administrator.index', compact('data'));

        // return view('administrator.index');
    }

    public function create()
    {
        return view ('administrator.addVA');
    }

    public function store(Request $request)
    {
        // validate request
        $this->validate($request, [
            'name' => 'required',
            'bankname' => 'required',
        ]);

        try {
            // save to database
            $service_id = Uuid::uuid4()->toString();
            $serviceTable = $this->serviceTypeModel->create([
                // service_id using uuid
                'service_id' => $service_id,
                'service_type' => 'va',
                'bank_name' => $request->bankname,
            ]);

            $dataDetail = $this->serviceDetailModel->create([
                'service_detail_id' => Uuid::uuid4(),
                'service_id' => $service_id,
                'service_name' => $request->name,
            ]);
            // redirect to list page
            return redirect()->route('administrator.index')->withErrors(['success', 'VA has been added']);

        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            return redirect()->route('administrator.index')->with('error', 'VA has not been added');
        }

    }
    public function detail()
    {
        return view ('administrator.detail');
    }

    public function edit($id)
    {
        $dataService = $this->serviceTypeModel->where('service_id',$id)->get();
        $dataDetail = $this->serviceDetailModel->where('service_id',$id)->get();
        return view('administrator.edit',compact('dataService','dataDetail'));
        // return view ('administrator.edit');
    }

    public function destroy($id)
    {
        $dataService = $this->serviceTypeModel->where('service_id',$id);

        $dataService->delete();
        return redirect()->route('administrator.index')->withErrors(['success', 'VA has been deleted']);
    }

    public function update($id)
    {
        // TODO using trycatch
        try {
            $data = request()->all();
            $servideTypeUpdate['bank_name'] = $data['bank_name'];
            $dataDetail['service_name'] = $data['name'];
            $serviceType = $this->serviceTypeModel->where('service_id',$id);
            $serviceType->update($servideTypeUpdate);
    
            $serviceDetail = $this->serviceDetailModel->where('service_id',$id);
            $serviceDetail->update($dataDetail);
    
    
            return redirect()->route('administrator.index')->withErrors(['success', 'VA has been updated']);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('administrator.index')->withStatus(__('VA Name failed to update.'));
        }
    }
}
