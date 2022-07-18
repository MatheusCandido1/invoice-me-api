<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;

use App\Http\Resources\Customers\CustomerResource;

use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index() {
        try {
            $customers = Customer::get();

            return CustomerResource::collection($customers);

        } catch (\Exception $e) {

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreCustomerRequest $request) {
        try {

            DB::beginTransaction();

            $customer = new Customer;

            $customer->name = $request->name;
            $customer->code = $request->code;
            $customer->email = $request->email;

            $customer->save();

            $address = new Address;

            $address->zipcode = $request->address['zipcode'];
            $address->state = $request->address['state'];
            $address->city = $request->address['city'];
            $address->neighborhood = $request->address['neighborhood'] ?? null;;
            $address->address = $request->address['address'];
            $address->number = $request->address['number'];
            $address->complement = $request->address['complement'] ?? null;

            $customer->address()->save($address);

            DB::commit();

            return response()->json([
                'message' => 'Customer created'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Customer $customer) {
        try {
            return new CustomerResource($customer);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Customer $customer, UpdateCustomerRequest $request) {
        try {
            DB::beginTransaction();

            $customer->name = $request->name;
            $customer->code = $request->code;
            $customer->email = $request->email;

            $customer->save();

            $address = Address::find($customer->address->id);

            $address->zipcode = $request->address['zipcode'];
            $address->state = $request->address['state'];
            $address->city = $request->address['city'];
            $address->neighborhood = $request->address['neighborhood'] ?? null;;
            $address->address = $request->address['address'];
            $address->number = $request->address['number'];
            $address->complement = $request->address['complement'] ?? null;
            $address->save();

            DB::commit();

            return response()->json([
                'message' => 'Customer updated'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Customer $customer) {
        try {

            $customer->address()->delete();
            $customer->delete();

            return response()->json([
                'message' => 'Customer deleted'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage(),
            ], 500);
        }
    }
}
