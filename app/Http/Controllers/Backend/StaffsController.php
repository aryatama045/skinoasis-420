<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequestForm;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\SpatieRole;
use Spatie\Permission\Models\Role;
use Hash;

class StaffsController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:staffs'])->only('index');
        $this->middleware(['permission:add_staffs'])->only(['create', 'store']);
        $this->middleware(['permission:edit_staffs'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_staffs'])->only(['delete']);
    }

    # staff list
    public function index(Request $request)
    {
        $searchKey = null;
        $ownOrAllStaff = auth()->user()->can('own_staff') && auth()->user()->user_type != 'admin' ? true : false;
        $staffs = User::where('user_type', 'staff')->latest();
        if ($request->search != null) {
            $staffs = $staffs->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }
        if ($ownOrAllStaff) {

            $staffs = $staffs->where('created_by', auth()->user()->id);
        }
        $staffs = $staffs->where('id', '!=', auth()->user()->id)->paginate(paginationNumber());
        return view('backend.pages.staffs.index', compact('staffs', 'searchKey'));
    }

    # Dokter list
    public function dokter(Request $request)
    {
        $searchKey = null;
        $ownOrAllStaff = auth()->user()->can('own_staff') && auth()->user()->user_type != 'admin' ? true : false;
        $dokters = User::where('user_type', 'dokter')->latest();
        if ($request->search != null) {
            $dokters = $dokters->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }
        if ($ownOrAllStaff) {

            $dokters = $dokters->where('created_by', auth()->user()->id);
        }
        $dokters = $dokters->where('id', '!=', auth()->user()->id)->paginate(paginationNumber());
        return view('backend.pages.staffs.dokter.index', compact('dokters', 'searchKey'));
    }

    # Klinik list
    public function klinik(Request $request)
    {
        $searchKey = null;
        $ownOrAllStaff = auth()->user()->can('own_staff') && auth()->user()->user_type != 'admin' ? true : false;
        // $staffs = User::where('user_type', 'staff')->latest();
        $kliniks = User::where('user_type', 'klinik')->latest();
        if ($request->search != null) {
            $kliniks = $kliniks->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }
        if ($ownOrAllStaff) {

            $kliniks = $kliniks->where('created_by', auth()->user()->id);
        }
        $kliniks = $kliniks->where('id', '!=', auth()->user()->id)->paginate(paginationNumber());
        return view('backend.pages.staffs.klinik.index', compact('kliniks', 'searchKey'));
    }

    # Mitra list
    public function mitra(Request $request)
    {
        $searchKey = null;
        $ownOrAllStaff = auth()->user()->can('own_staff') && auth()->user()->user_type != 'admin' ? true : false;
        // $staffs = User::where('user_type', 'staff')->latest();
        $mitras = User::where('user_type', 'mitra')->latest();
        if ($request->search != null) {
            $mitras = $mitras->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }
        if ($ownOrAllStaff) {

            $mitras = $mitras->where('created_by', auth()->user()->id);
        }
        $mitras = $mitras->where('id', '!=', auth()->user()->id)->paginate(paginationNumber());
        return view('backend.pages.staffs.mitra.index', compact('mitras', 'searchKey'));
    }

    # return create form
    public function create()
    {
        $roles = SpatieRole::oldest()->where('id', '!=', 1)->isActive()->get();
        return view('backend.pages.staffs.create', compact('roles'));
    }

    # return create form
    public function createmitra()
    {
        $roles = SpatieRole::oldest()->where('id', '=', 2)->isActive()->get();
        $cities = City::get();
        return view('backend.pages.staffs.mitra.create', compact('roles', 'cities'));
    }

    # return create form
    public function createdokter()
    {
        $roles = SpatieRole::oldest()->where('id', '=', 3)->isActive()->get();
        $cities = City::get();
        return view('backend.pages.staffs.dokter.create', compact('roles', 'cities'));
    }

    # return create form
    public function createklinik()
    {
        $roles = SpatieRole::oldest()->where('id', '=', 4)->isActive()->get();
        $cities = City::get();
        return view('backend.pages.staffs.klinik.create', compact('roles', 'cities'));
    }

    # save new staff
    public function store(StaffRequestForm $request)
    {
        if($request->role_id == 2){
            $tipeuser = "mitra";
        }else if($request->role_id == 3){
            $tipeuser = "dokter";
        }else if($request->role_id == 4){
            $tipeuser = "klinik";
        }else{
            $tipeuser = "staff";
        }

        if (User::where('email', $request->email)->first() == null) {
            $user                   = new User;
            $user->name             = $request->name;
            $user->email            = $request->email;
            $user->shop_id          = auth()->user()->shop_id;
            $user->phone            = validatePhone($request->phone);
            $user->user_type        = $tipeuser;
            $user->password         = Hash::make($request->password);
            $user->role_id          = $request->role_id;
            $user->avatar           = $request->image;
            $user->created_by       = auth()->user()->id;
            $user->address          = $request->alamat;
            $user->infolain          = $request->infolain;
            $user->zona              = $request->zona;
            $user->save();
            $user->assignRole(SpatieRole::findOrFail($request->role_id)->name);

            flash(localize('Staff has been inserted successfully'))->success();

            if($request->role_id == 1 || $request->role_id == 5){
                return redirect()->route('admin.staffs.index');
            }else if($request->role_id == 2){
                return redirect()->route('admin.staffs.mitra');
            }else if($request->role_id == 3){
                return redirect()->route('admin.staffs.dokter');
            }else if($request->role_id == 4){
                return redirect()->route('admin.staffs.klinik');
            }
        }
        flash(localize('Email already used'))->error();
        return back();
    }

    # edit staff
    public function edit($id)
    {
        $user  = User::findOrFail($id);
        $roles = SpatieRole::latest()->where('id', '!=', 1)->isActive()->get();
        return view('backend.pages.staffs.edit', compact('user', 'roles'));
    }

    # edit mitra
    public function editmitra($id)
    {
        $user  = User::findOrFail($id);
        $roles = SpatieRole::oldest()->where('id', '=', 2)->isActive()->get();
        return view('backend.pages.staffs.mitra.edit', compact('user', 'roles'));
    }

    # edit dokter
    public function editdokter($id)
    {
        $user  = User::findOrFail($id);
        $roles = SpatieRole::oldest()->where('id', '=', 3)->isActive()->get();
        return view('backend.pages.staffs.dokter.edit', compact('user', 'roles'));
    }

    # edit klinik
    public function editklinik($id)
    {
        $user  = User::findOrFail($id);
        $roles = SpatieRole::oldest()->where('id', '=', 4)->isActive()->get();
        return view('backend.pages.staffs.klinik.edit', compact('user', 'roles'));
    }

    # update staff
    public function update(Request $request)
    {
        $exit_email = User::where('email', $request->email)->where('id', '!=', $request->id)->first();
        if ($exit_email) {
            flash(localize('This Email address already exit'))->warning();
            return redirect()->back();
        }
        $user             = User::findOrFail($request->id);
        $old_role_id      = $user->role_id;
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->phone      = validatePhone($request->phone);
        $user->role_id    = $request->role_id;

        $user->infolain          = $request->infolain;

        if ($request->filled('role_id')) {
            $user->role_id    = $request->role_id;
        }

        if (strlen($request->password) > 0) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->filled('role_id')) {
            if ($old_role_id != (int)$request->role_id) {
                $user->removeRole(SpatieRole::findOrFail($old_role_id)->name);
            }

            $user->assignRole(SpatieRole::findOrFail($request->role_id)->name);
        }
        flash(localize('Staff has been updated successfully'))->success();

        if($request->role_id == 1 || $request->role_id == 5){
            return redirect()->route('admin.staffs.index');
        }else if($request->role_id == 2){
            return redirect()->route('admin.staffs.mitra');
        }else if($request->role_id == 3){
            return redirect()->route('admin.staffs.dokter');
        }else if($request->role_id == 4){
            return redirect()->route('admin.staffs.klinik');
        }
    }

    # delete staff
    public function delete(Request $request ,$id)
    {
        User::where('id', $id)->forceDelete();
        flash(localize('Has been deleted successfully'))->success();

        if($request->role_id == 1 || $request->role_id == 5){
            return redirect()->route('admin.staffs.index');
        }else if($request->role_id == 2){
            return redirect()->route('admin.staffs.mitra');
        }else if($request->role_id == 3){
            return redirect()->route('admin.staffs.dokter');
        }else if($request->role_id == 4){
            return redirect()->route('admin.staffs.klinik');
        }
    }
}
