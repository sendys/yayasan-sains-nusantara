<?php

namespace App\Http\Controllers;

use App\Mail\AccountActivationMail;
use App\Models\Perusahaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::check() || !Auth::user()->can('manage user')) {
            abort(403, 'Anda tidak memiliki izin akses.');
        }

        $query = User::query();

        // Filter users based on logged in user's role
        if (Auth::user()->hasRole('super_admin')) {
            // Get all users if super admin
            $query->where('perusahaan_id', 0);

        } else {
            // Only get current user's data if not super admin
            $query->where('perusahaan_id', Auth::user()->perusahaan_id);
        }

        if ($request->has('search')) {
            $searchTerm = '%' . $request->input('search') . '%';
            $query->where(function ($q) use ($searchTerm) {
                // Base search conditions
                $q->where('name', 'like', $searchTerm)->orWhere(
                    'email',
                    'like',
                    $searchTerm,
                );
            });
        }

        $users = $query->paginate(10); // Paginate with 10 items per page

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->can('create user')) {
            return redirect()
                ->route('user.index')
                ->with(
                    'error',
                    'Anda tidak memiliki izin untuk menambah user.',
                );
        }

        $roles = Auth::user()->hasRole('super_admin')
            ? Role::all()
            : Role::where('name', '!=', 'super_admin')->get();

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:8',
            'roles' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'perusahaan_id' => Auth::user()->perusahaan_id,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->input('roles'));

        return redirect()
            ->route('user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Cek manual jika diperlukan:
        if (!Auth::check() || !Auth::user()->can('edit user')) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Anda tidak memiliki izin untuk edit user.');
        }

        // Tambahan: user hanya boleh edit dirinya sendiri
        if (!Auth::user()->hasRole('super_admin') && Auth::id() !== (int) $id) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Anda hanya bisa mengedit akun Anda sendiri.');
        }

        $user = User::findOrFail($id);

        $roles = Auth::user()->hasRole('super_admin')
            ? Role::all()
            : Role::where('name', '!=', 'super_admin')->get();

        $userRole = $user->getRoleNames()->toArray(); // ambil role user

        $userPermissions = $user->getPermissionNames()->toArray();
        $permissions = Permission::all()->groupBy('group');

        return view(
            'user.edit',
            compact(
                'user',
                'roles',
                'userRole',
                'permissions',
                'userPermissions',
            ),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|numeric',
            'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'roles' => 'required',
            'permissions' => 'nullable|array',
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->perusahaan_id = Auth::user()->perusahaan_id;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sync roles
        $user->syncRoles($request->roles);

        // Sync permissions (optional)
        $user->syncPermissions($request->permissions ?? []);

        return redirect()
            ->route('user.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cegah user menghapus dirinya sendiri
        if (Auth::id() === (int) $id) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        // Cek manual jika diperlukan:
        if (!Auth::check() || !Auth::user()->can('delete user')) {
            return redirect()
                ->route('user.index')
                ->with(
                    'error',
                    'Anda tidak memiliki izin untuk menghapus user.',
                );
        }

        // Cegah user menghapus dirinya sendiri
        // Cegah user menghapus dirinya sendiri
        if (Auth::id() === (int) $id) {
            return redirect()
                ->route('user.index')
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun Anda sendiri.',
                );
        }

        $user = User::findOrFail($id);

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'User deleted successfully');
    }

    public function register()
    {
        return view('user.daftar');
    }

    public function daftar(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                ],
                'phone' => 'required|numeric|digits_between:10,15',
                'perusahaan' => 'required|string|max:255|unique:perusahaan,name',
            ], [
                'email.required' => 'Email wajib diisi.',
                'email.unique' => 'Email sudah terdaftar.',
                'perusahaan.required' => 'Nama perusahaan wajib diisi.',
                'perusahaan.unique' => 'Nama perusahaan sudah terdaftar.',
                'password.regex' => 'Password harus mengandung huruf besar, kecil, angka, dan simbol.',
            ]);

            $perusahaan = Perusahaan::create([
                'name' => $request->perusahaan,
                'email' => $request->email,
                'phone' => $request->phone,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'is_status' => true,
                'is_premium' => false,
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'perusahaan_id' => $perusahaan->id,
                'activation_token' => Str::random(64),
                'activation_token_expires_at' => now()->addHours(24),
                'is_activated' => false,
            ]);

            $user->assignRole('admin');

            $activationUrl = route('account.activate', [
                'token' => $user->activation_token
            ]);

            Mail::to($user->email)
                ->send(new AccountActivationMail($user, $activationUrl));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil. Silakan cek email Anda di folder inbox atau spam untuk aktivasi akun.',
                'redirect_url' => route('login'),
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Registration failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Registrasi gagal. Email aktivasi tidak dapat dikirim. Silakan coba lagi.',
            ], 500);
        }
    }


    /**
     * Register a new user.
     */
    public function registerComplete(Request $request)
    {
        Log::info(
            'Starting registration completion'
        );

        $request->validate([
            'email' => $request->email,
        ]);

        /* $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'phone' => 'required|numeric|digits_between:10,15',
            'perusahaan' => 'required|string|max:255',
        ]); */

        DB::beginTransaction();

        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'password' => [
                        'required',
                        'string',
                        'min:8',
                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                    ],
                    'phone' => 'required|numeric|digits_between:10,15',
                    'email' => 'required|string|email|max:255|unique:users',
                    'perusahaan' => 'required|string|max:255|unique:perusahaan,name',
                ],
                [
                    'email.required' => 'Email wajib diisi.',
                    'email.unique' => 'Email sudah terdaftar, silakan gunakan email lain.',
                    'perusahaan.required' => 'Nama perusahaan wajib diisi.',
                    'perusahaan.unique' => 'Nama perusahaan sudah terdaftar, silakan gunakan nama lain.',
                ],
            );

            $perusahaans = Perusahaan::create([
                'name' => $request->perusahaan,
                'email' => $request->email,
                'phone' => $request->phone,
                'start_date' => now(),
                'end_date' => now()->addDays(90),
                'is_status' => '1',
                'is_premium' => '0',
            ]);

            // Generate activation token
            $activationToken = Str::random(64);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'perusahaan_id' => $perusahaans->id,
                'activation_token' => $activationToken,
                'activation_token_expires_at' => now()->addHours(24),
                'is_activated' => false,
            ]);

            $user->syncRoles(['admin']);

            // Generate activation URL
            $activationUrl = route('account.activate', [
                'token' => $user->activation_token,
            ]);

            // Kirim email aktivasi
            try {
                Mail::to($user->email)->send(
                    new AccountActivationMail($user, $activationUrl),
                );
            } catch (\Exception $e) {
                Log::error(
                    'Failed to send activation email: ' . $e->getMessage(),
                );
                // Lanjutkan proses meskipun email gagal dikirim
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil. Silakan cek email Anda untuk aktivasi akun.',
                'redirect_url' => route('login'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ],
                422,
            );
        }

        /* return redirect()->back()
         ->with('success', 'User created successfully.'); */
    }

    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists by email or google_id
            $existingUser = User::where('email', $googleUser->getEmail())
                ->orWhere('google_id', $googleUser->getId())
                ->first();

            if ($existingUser) {
                // If user exists but doesn't have google_id, update it
                if (!$existingUser->google_id) {
                    $existingUser->update([
                        'google_id' => $googleUser->getId(),
                        'email_verified_at' => now(), // Auto verify email for Google users
                    ]);
                }

                // Di method handleGoogleCallback, ganti bagian validasi lisensi:

                // Cek apakah user memiliki perusahaan dengan is_status = 0
                if (
                    $existingUser->perusahaan &&
                    $existingUser->perusahaan->is_status == '0'
                ) {
                    // Set session untuk menampilkan modal
                    session()->flash('show_expired_modal', true);
                    session()->flash(
                        'expired_company_name',
                        $existingUser->perusahaan->name,
                    );

                    // JANGAN login user, langsung redirect ke login dengan error
                    return redirect()->route('login');
                }

                // Tambahan: Cek apakah lisensi perusahaan sudah expired
                if (
                    $existingUser->perusahaan &&
                    $existingUser->perusahaan->isExpired()
                ) {
                    session()->flash('show_expired_modal', true);
                    session()->flash(
                        'expired_company_name',
                        $existingUser->perusahaan->name,
                    );

                    return redirect()->route('login');
                }

                // Login existing user
                Auth::login($existingUser);

                return redirect()
                    ->route('home')
                    ->with('success', 'Login berhasil dengan akun Google!');
            }

            // Create new user with Google account
            return view('user.complete-registration', [
                'googleUser' => $googleUser,
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        } catch (\Exception $e) {
            Log::error(
                'Google OAuth Error: ' . $e->getMessage(),
            );

            return redirect()
                ->route('user.register')
                ->with(
                    'error',
                    'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.',
                );
        }
    }

    /**
     * Complete registration with Google account
     */
    public function completeGoogleRegistration(Request $request)
    {
        Log::info(
            'Starting Google registration completion',
        );

        try {
            // Validasi input
            $request->validate(
                [
                    'google_id' => 'required|string',
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'nama' => 'required|string|max:255|unique:perusahaan,name',
                    /* 'phone' => 'required|string|max:20', */
                ],
                [
                    'nama.unique' => 'Nama perusahaan / usaha anda "' .
                        $request->nama .
                        '" sudah terdaftar. Silakan gunakan nama yang berbeda.',
                ],
            );

            Log::info(
                'Validation passed for Google registration',
            );

            // Cek apakah Google ID sudah ada
            $existingUser = User::where(
                'google_id',
                $request->google_id,
            )->first();
            if ($existingUser) {
                Log::warning(
                    'Google ID already exists',
                    ['google_id' => $request->google_id],
                );

                return response()->json([
                    'success' => false,
                    'message' => 'Akun Google ini sudah terdaftar.',
                ]);
            }

            Log::info(
                'Starting database transaction for Google registration',
            );
            DB::beginTransaction();

            // Buat perusahaan baru
            $perusahaan = Perusahaan::create([
                'name' => $request->nama,
                /* 'phone' => $request->phone, */
                'email' => $request->email,
                'start_date' => now(),
                'end_date' => now()->addDays(90),
                'is_status' => '1',
                'is_premium' => '0',
            ]);

            // dd($perusahaan);

            Log::info('Company created', [
                'perusahaan_id' => $perusahaan->id,
            ]);

            // Buat user baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'google_id' => $request->google_id,
                'perusahaan_id' => $perusahaan->id,
                'password' => Hash::make(Str::random(32)), // Password random untuk Google users
                'email_verified_at' => now(),
                'activation_token' => Str::random(60),
                'activation_token_expires_at' => now()->addHours(24),
                'is_activated' => false,
            ]);
            Log::info('User created', [
                'user_id' => $user->id,
            ]);

            // Assign role admin
            $user->assignRole('admin');
            Log::info(
                'Admin role assigned to user',
                ['user_id' => $user->id],
            );

            // Generate activation URL
            $activationUrl = route('account.activate', [
                'token' => $user->activation_token,
            ]);
            Log::info('Activation URL generated', [
                'url' => $activationUrl,
            ]);

            // Kirim email aktivasi
            try {
                Log::info(
                    'Attempting to send activation email',
                );
                Mail::to($user->email)->send(
                    new AccountActivationMail($user, $activationUrl),
                );
                Log::info(
                    'Activation email sent successfully',
                );
            } catch (\Exception $e) {
                Log::error(
                    'Failed to send activation email: ' . $e->getMessage(),
                    [
                        'exception' => $e->getTraceAsString(),
                    ],
                );
                // Lanjutkan proses meskipun email gagal dikirim
            }

            // Login user
            Auth::login($user);
            Log::info(
                'User logged in successfully',
                ['user_id' => $user->id],
            );

            DB::commit();
            Log::info(
                'Database transaction committed successfully',
            );

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Silakan cek email Anda untuk aktivasi akun sebelum login.',
                'redirect_url' => route('login'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error(
                'Validation error in Google registration',
                [
                    'errors' => $e->validator->errors()->all(),
                    'input' => $request->all(),
                ]
            );

            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(
                'Google registration error: ' . $e->getMessage(),
                [
                    'exception' => $e->getTraceAsString(),
                ],
            );

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.',
            ]);
        }
    }

    /**
     * Activate user account
     */
    public function activateAccount(Request $request, $token)
    {
        try {
            $user = User::where('activation_token', $token)
                ->where('activation_token_expires_at', '>', now())
                ->where('is_activated', false)
                ->first();

            if (!$user) {
                return redirect()
                    ->route('user.register')
                    ->with(
                        'error',
                        'Token aktivasi tidak valid atau sudah kedaluwarsa. Silakan daftar ulang.',
                    );
            }

            // Activate the account
            $user->update([
                'is_activated' => true,
                'activated_at' => now(),
                'activation_token' => null,
                'activation_token_expires_at' => null,
            ]);

            // Login the user if not already logged in
            if (!Auth::check()) {
                Auth::login($user);
            }

            return redirect()
                ->route('home')
                ->with(
                    'success',
                    'Akun Anda telah berhasil diaktivasi! Selamat datang di ' .
                    config('app.name'),
                );
        } catch (\Exception $e) {
            return redirect()
                ->route('user.register')
                ->with(
                    'error',
                    'Terjadi kesalahan saat mengaktivasi akun. Silakan coba lagi.',
                );
        }
    }

    /**
     * Resend activation email
     */
    public function resendActivationEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            $user = User::where('email', $request->email)
                ->where('is_activated', false)
                ->first();

            if (!$user) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Akun dengan email tersebut tidak ditemukan atau sudah diaktivasi.',
                    ],
                    404,
                );
            }

            // Generate new activation token
            $activationToken = Str::random(60);
            $activationExpiry = now()->addHours(24);

            $user->update([
                'activation_token' => $activationToken,
                'activation_token_expires_at' => $activationExpiry,
            ]);

            // Generate activation URL
            $activationUrl = route('account.activate', [
                'token' => $activationToken,
            ]);

            // Send activation email
            Mail::to($user->email)->send(
                new AccountActivationMail($user, $activationUrl),
            );

            return response()->json([
                'success' => true,
                'message' => 'Email aktivasi telah dikirim ulang ke ' . $user->email,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mengirim email aktivasi.',
                ],
                500,
            );
        }
    }
}
