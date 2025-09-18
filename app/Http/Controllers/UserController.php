<?php

namespace App\Http\Controllers;

use App\Enums\Config as ConfigEnum;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Config;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use TheSeer\Tokenizer\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('pages.user', [
            'data' => User::render($request->search),
            'search' => $request->search,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            // Get all validated data
            $data = $request->validated();

            // Hash the password from the request input
            $data['password'] = Hash::make($request->password);

            // The 'role' is already included from validated() data
            // $data['role'] = $request->role; // This line is not needed as it's handled by validated()

            User::create($data);
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        try {
            $data = $request->validated();
            $data['is_active'] = isset($data['is_active']);

            // Handle password update
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                // Remove password from update data if not provided
                unset($data['password']);
            }

            // Handle reset_password functionality (keep existing functionality)
            if ($request->reset_password) {
                $data['password'] = Hash::make(Config::getValueByCode(ConfigEnum::DEFAULT_PASSWORD));
            }

            $user->update($data);
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();
            return back()->with('success', __('menu.general.success'));
        } catch (\Throwable $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
