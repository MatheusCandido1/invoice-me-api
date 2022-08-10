<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Company;

use App\Http\Resources\Accounts\AccountResource;

use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Http\Requests\Accounts\UpdateAccountRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function store(StoreAccountRequest $request) {
        try {

            DB::beginTransaction();

            $account = new Account;

            $account->number = $request->number;
            $account->beneficiary = $request->beneficiary;
            $account->bic_code = $request->bic_code;

            $account->save();

            DB::commit();

            return response()->json([
                'message' => 'Account created',
                'data' => new AccountResource($account)
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function index() {
        try {
            $accounts = Account::byCurrentCompany()->get();

            return AccountResource::collection($accounts);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Account $account) {
        try {

            return new AccountResource($account);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Account $account, UpdateAccountRequest $request) {
        try {
            DB::beginTransaction();

            $account->number = $request->number;
            $account->beneficiary = $request->beneficiary;
            $account->bic_code = $request->bic_code;

            $account->save();

            DB::commit();

            return response()->json([
                'message' => 'Account updated',
                'data' => new AccountResource($account)
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Account $account) {
        try {
            $account->delete();

            return response()->json([
                'message' => 'Account deleted',
                'data' => new AccountResource($account)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

}
