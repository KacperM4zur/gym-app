<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Profile\CustomerProfileStoreRequest;
use App\Http\Requests\Profile\CustomerProfileUpdateRequest;
use App\Models\CustomerProfile;
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

    public function getAuthenticatedProfile()
    {
        try {
            $customer = auth()->user();
            $profile = CustomerProfile::where('customer_id', $customer->id)->first();

            if (!$profile) {
                return response()->json(['message' => 'Profile not found'], 404);
            }

            return response()->json(['status' => 200, 'data' => $profile]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function storeAuthenticatedProfile(Request $request)
    {
        try {
            $customer = auth()->user();

            // Walidacja danych z rzeczywistymi nazwami pól
            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'birthdate' => 'required|date',
                'address' => 'required|string|max:255'
            ]);

            // Tworzenie nowego profilu użytkownika
            $profile = CustomerProfile::create(array_merge($data, ['customer_id' => $customer->id]));

            return response()->json(['status' => 201, 'data' => $profile]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }


    public function updateAuthenticatedProfile(Request $request)
    {
        try {
            $customer = auth()->user();
            $profile = CustomerProfile::where('customer_id', $customer->id)->first();

            if (!$profile) {
                return response()->json(['error' => 'Profile not found'], 404);
            }

            $data = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'birthdate' => 'required|date',
                'address' => 'required|string|max:255',
            ]);

            $profile->update($data);

            return response()->json(['status' => 200, 'data' => $profile]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }


    public function deleteAuthenticatedProfile()
    {
        try {
            $customer = auth()->user();
            $profile = CustomerProfile::where('customer_id', $customer->id)->first();

            if (!$profile) {
                return response()->json(['message' => 'Profile not found'], 404);
            }

            $profile->delete();

            return response()->json(['status' => 200, 'message' => 'Profile deleted successfully']);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getProfile($id)
    {
        $profile = CustomerProfile::where('customer_id', $id)->first();
        return response()->json(['status' => 200, 'data' => $profile]);
    }

}
