<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\SmsLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function dashboard(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (empty($startDate)) {
            $startDate = Carbon::now()->subDays(29)->startOfDay();
        }
        if (empty($endDate)) {
            $endDate = Carbon::now()->endOfDay();
        }

        $leads_count = Lead::whereBetween('created_at', [$startDate, $endDate])->count();

        $leads_count_with_successful_sms = Lead::leadsWithSuccessfulSMSHistory()
            ->whereHas('campaignsWithSMSHistory', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('campaigns.created_at', [$startDate, $endDate]);
            })
            ->count();

        $outbound_sms_count = SmsLog::sentSMSLogs()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $inbound_sms_count = SmsLog::receivedSMSLogs()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $ongoing_campaigns_count = Campaign::ongoingCampaigns()
            ->whereBetween('scheduled_at', [$startDate, $endDate])
            ->count();

        $unsubscribed_campaigns_count = Campaign::unsubscribedCampaigns()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return view('dashboard',
                        compact('startDate',
              'endDate',
                        'leads_count',
                        'leads_count_with_successful_sms',
                        'outbound_sms_count',
                        'inbound_sms_count',
                        'ongoing_campaigns_count',
                        'unsubscribed_campaigns_count'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
