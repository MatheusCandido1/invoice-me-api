<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Address;
use App\Models\Account;

use App\Http\Resources\Companies\CompanyResource;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function store(StoreCompanyRequest $request) {
        try {

            DB::beginTransaction();

            $company = new Company;

            $company->name = $request->name;
            $company->code = $request->code;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->fantasy_name = $request->fantasy_name;

            $company->save();

            $address = new Address;

            $address->zipcode = $request->address['zipcode'];
            $address->state = $request->address['state'];
            $address->city = $request->address['city'];
            $address->neighborhood = $request->address['neighborhood'];
            $address->address = $request->address['address'];
            $address->number = $request->address['number'];
            $address->complement = $request->address['complement'] ?? null;

            $company->address()->save($address);

            $account = new Account;
            $account->number = $request->account['number'];
            $account->beneficiary = $request->account['beneficiary'];
            $account->bic_code = $request->account['bic_code'];

            $company->account()->save($account);

            DB::commit();

            return response()->json([
                'message' => 'Company created'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Company $company, UpdateCompanyRequest $request) {
        try {
            DB::beginTransaction();

            $company->name = $request->name;
            $company->code = $request->code;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->fantasy_name = $request->fantasy_name;

            $company->save();

            $address = Address::find($company->address->id);

            $address->zipcode = $request->address['zipcode'];
            $address->state = $request->address['state'];
            $address->city = $request->address['city'];
            $address->neighborhood = $request->address['neighborhood'];
            $address->address = $request->address['address'];
            $address->number = $request->address['number'];
            $address->complement = $request->address['complement'] ?? null;
            $address->save();

            DB::commit();

            return response()->json([
                'message' => 'Company updated'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Company $company) {
        try {
            return new CompanyResource($company);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Company $company) {
        try {

            $company->address()->delete();
            $company->delete();

            return response()->json([
                'message' => 'Company deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
}
