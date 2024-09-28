<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Profile\CustomerProfileStoreRequest;
use App\Http\Requests\Profile\CustomerProfileUpdateRequest;
use App\Services\CustomerProfileService;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    private CustomerProfileService $customerProfileService;

    public function __construct(CustomerProfileService $customerProfileService)
    {
        $this->customerProfileService = $customerProfileService;
    }

    public function get()
    {
        try {
            $data = $this->customerProfileService->getCustomerProfiles();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }

    public function store(CustomerProfileStoreRequest $request)
    {
        try {
            $data = $this->customerProfileService->createCustomerProfile($request->toArray());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        try {
            $data = $this->customerProfileService->showCustomerProfile($id);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }

    public function update(CustomerProfileUpdateRequest $request, $id)
    {
        try {
            $data = $this->customerProfileService->updateCustomerProfile($request->toArray(), $id);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        try {
            $data = $this->customerProfileService->deleteCustomerProfile($id);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }
}
