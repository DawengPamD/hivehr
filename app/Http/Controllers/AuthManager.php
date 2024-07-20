<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invitation;
use App\Mail\CompanyInvitation;     
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
        public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        // Authentication failed
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the user session
        $request->session()->invalidate();

        // Regenerate the session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the home page or login page with a success message
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

        public function showRegistrationForm()
        {
            return view('login', [
            ])->with('key', 1010);        
        }
        
        public function register(Request $request)
        {
            // Validate registration form data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'token' => 'nullable|string',
                'company_id' => 'nullable|exists:companies,id',
                'role' => 'nullable|exists:roles,id',
            ]);
        
            if ($request->token) {
                // Handle registration via invitation token
                
                // Find the invitation
                $invitation = Invitation::where('token', $request->token)->firstOrFail();
                
                // Create a new user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
    
        
                // Log in the user
                Auth::login($user);
        
                // Attach the user to the company
        $company = Company::findOrFail($invitation->company_id);
        $user = auth()->user();
        $role_id = 1; // Default role ID
        $company->users()->attach($user->id, ['role_id' => $role_id]);
        
                return redirect()->route('dashboard')->with('success', 'Registration successful!');
            } else {
                // Direct registration without invitation token
                
                // Create a new user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
        
                // Log in the user
                Auth::login($user);
        
                return redirect()->route('company.create')->with('success', 'Registration successful!');
            }
        }
        
        

    public function dashboard()
    {
        return view('dashboard'); // Make sure this points to your dashboard Blade template
    }

    public function create()
    {
        return view('assign');
    }

    public function store_company(Request $request)
    {
        // Define custom validation messages
        $messages = [
            'name.required' => 'The company name is required.',
            'email.required' => 'The company email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'industry.required' => 'The industry is required.',
            'address.required' => 'The address is required.',
            'size.required' => 'The company size is required.',
        ];
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies',
            'industry' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'size' => 'string|max:255',
            'description' => 'nullable|string',
        ], [
            'size.in' => 'The selected size is invalid. Please select a valid option.',
        ]);
    
        try {
            // Create the company
            $company = Company::create($validatedData);
    
            // Optionally, add the creating user to the company
            $user = auth()->user();
            $role_id = 1; // Default role ID
    
            // Ensure that the user is associated with the company
            if ($user) {
                $company->users()->attach($user->id, ['role_id' => $role_id]);
            }

            if ($request->has('size')) {
                $company->update(['size' => $request->input('size')]);
            }

            // Redirect with success message
            return redirect()->route('company.showInviteForm', ['companyId' => $company->id])
                             ->with('success', 'Company created successfully!');
    
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error creating company: ' . $e->getMessage());
    
            // Redirect back with error message
            return redirect()->back()->withErrors('An error occurred while creating the company. Please try again later.')
                                     ->withInput();
        }
    }
    

    public function showInviteForm($companyId)
    {
    
        $company = Company::findOrFail($companyId);
        $roles = Role::all();
    
        return view('send_invitation', compact('company', 'roles'));
    }
    

    public function invite(Request $request, $companyId)
    {
        $company = Company::findOrFail($companyId);
        $role = Role::findByName($request->role);


        $invitation = Invitation::create([
            'companies' => $company->id,
            'email' => $request->email,
            'token' => Str::random(32),
            'role' => $role->id,
        ]);

        // Send invitation email
        try {
            Mail::to($request->email)->send(new CompanyInvitation($invitation));
            return redirect()->back()->with('success', 'Invitation sent successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return redirect()->back()->with('error', 'Failed to send invitation email.');
        }
        
    }

    public function acceptInvitation($token)
    {
    $invitation = Invitation::where('token', $token)->firstOrFail();
    $company = $invitation->company;

        // Show the registration form with pre-filled email
        return view('login', [
            'email' => $invitation->email,
            'role_id' => $invitation->role,
            'company' => $company,
            'token' => $token,
        ])->with('token', $token);

    }
}

