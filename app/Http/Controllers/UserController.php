<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;
use App\Mail\AdminNotification;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email', // Email should be unique and properly formatted
            'password' => 'required|min:8', // Password must be at least 8 characters long
            'name' => 'required|string|min:3|max:50', // Name must be between 3 and 50 characters long
        ]);

        // If validation passes, create the user
        try {
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']), // Hash the password before saving
                'name' => $validated['name'],
            ]);

            // Send confirmation email to the user
            Mail::to($user->email)->send(new UserCreated($user));

            // Send a notification email to the system administrator
            $adminEmail = env('ADMIN_EMAIL'); // replace with your admin email
            Mail::to($adminEmail)->send(new AdminNotification($user));

            // Return a response with user data (without the password)
            return response()->json([
                'state_code' => 200,
                'state_message' => 'User created successfully!',
                'data' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'created_at' => $user->created_at->toISOString(),
                ]
            ], 200);

        } catch (\Exception $e) {
            // Log any errors
            Log::error('Error creating user: ' . $e->getMessage());

            // Return a generic error response
            return response()->json(['error' => 'User creation failed.'], 500);
        }
    }

    // Get Users API
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'created_at');
        $page = $request->input('page', 1);

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy($sortBy)
            ->paginate(10);

        // Menambahkan orders_count ke setiap user
        $users->getCollection()->transform(function ($user) {
            $user->orders_count = $user->orders()->count(); // Menggunakan relasi orders()
            return $user;
        });

        return response()->json([
            'page' => $page,
            'users' => $users->items(),
        ]);
    }
}
