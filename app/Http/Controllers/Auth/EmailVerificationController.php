<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        // Find user by ID
        $user = User::findOrFail($request->route('id'));

         if (! hash_equals((string) $user->getKey(), (string) $request->route('id'))) {
            return false;
        }

        if (! hash_equals(sha1(  $user ->getEmailForVerification()), (string)  $request->route('hash')  )) {
			   return false;
			
		}
            

        // Check if already verified
        if ($user->hasVerifiedEmail()) {
            return redirect(config('fortify.home'))->with('status', 'Email already verified');
        }

        // Mark as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect(config('fortify.home'))->with('status', 'Email verified successfully!');
    }
}