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

            $todaySentCount = SmsLog::where('type', 'out')
                ->where('status', 'sent')
                ->whereDate('created_at', now()->toDateString())
                ->count();
            if ($sendingServer->limits != -1 && $todaySentCount >= $sendingServer->limits) {
                continue;
            }

            if ($this->attemptSending($campaign, $sendingServer)) {
                $campaign->update(['completed_at' => now()]);
                break;
            }
        }
    }

    private function attemptSending(Campaign $campaign, SendingServer $sendingServer): bool
    {
        $client = new TextClient($sendingServer->api_key ?? $sendingServer->product_token);

        $leads = $campaign->associatedLeads();
        $reference = $campaign->name . '_' . $campaign->id;

        try {
            foreach ($leads as $lead) {
                $leadSentCount = SmsLog::where('lead_id', $lead->id)
                                    ->where('campaign_id', $campaign->id)
                                    ->where('type', 'out')
                                    ->where('status', 'sent')
                                    ->count();
                if ($leadSentCount > 0) {
                    continue;
                }

                $recipientPhoneNumber = '00' . $lead->phone;
                $messageText = str_replace("[name]", $lead->name, $campaign->template);

                $result = $client->SendMessage($messageText, $sendingServer->phone_number, [$recipientPhoneNumber], $reference);
                Log::info('sending sms: recipients: ' . $recipientPhoneNumber . ' msg: ' . $messageText . ' result:' . $result->statusCode);
                if ($result->statusCode == TextClientStatusCodes::OK) {
                    $this->info('SMS campaigns sent successfully.');

                    SmsLog::insert([
                        'campaign_id' => $campaign->id,
                        'lead_id' => $lead->id,
                        'sending_server_id' => $sendingServer->id,
                        'status' => 'sent',
                        'type' => 'out',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                }
            }

            return TRUE;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return FALSE;
    }
}
