<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Lead;
use App\Models\SendingServer;
use App\Models\SmsLog;
use CMText\TextClientStatusCodes;
use Illuminate\Console\Command;
use CMText\TextClient;
use Illuminate\Support\Facades\Log;

class SendSMSCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-s-m-s-campaigns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get campaigns scheduled for the current time
        Log::error('starting');
        $campaigns = Campaign::where('scheduled_at', '<=', now())->ongoingCampaigns()->get();
        Log::error('count' . count($campaigns));
        foreach ($campaigns as $campaign) {
            $this->sendSMSCampaign($campaign);
        }
    }

    private function sendSMSCampaign(Campaign $campaign)
    {
        // Get the sending servers associated with the campaign
        $sendingServers = $campaign->sendingServers;

        foreach ($sendingServers as $sendingServer) {
            if ($this->attemptSending($campaign, $sendingServer)) {
                $campaign->update(['completed_at' => now()]);
                break;
            }
        }
    }

    private function attemptSending(Campaign $campaign, SendingServer $sendingServer): bool
    {
        $client = new TextClient($sendingServer->api_key ?? $sendingServer->product_token);

        $messageText = $campaign->template;
        $leads = $campaign->associatedLeads();
        $recipientPhoneNumbers = $leads->pluck('phone')->toArray();
        $reference = $campaign->name . '_' . $campaign->id;

        try {
            $result = $client->SendMessage($messageText, $sendingServer->phone_number, $recipientPhoneNumbers, $reference);
            Log::info('sending sms: ' . $sendingServer->phone_number . ' ' . implode(',', $recipientPhoneNumbers) . ', api_key:' . $sendingServer->api_key . ' result:' . $result->statusCode);
            if ($result->statusCode == TextClientStatusCodes::OK) {
                $this->info('SMS campaigns sent successfully.');

                // SMS sent successfully, collect data for batch insertion
                $smsLogsData = [];

                foreach ($leads as $lead) {
                    // Add data for batch insertion
                    $smsLogsData[] = [
                        'campaign_id' => $campaign->id,
                        'lead_id' => $lead->id,
                        'status' => 'sent',
                        'type' => 'out',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // Batch insert SMS logs
                SmsLog::insert($smsLogsData);

                return TRUE;
            }
            return FALSE;
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return FALSE;
        }
    }
}
