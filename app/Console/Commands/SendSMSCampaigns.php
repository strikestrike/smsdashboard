<?php

namespace App\Console\Commands;

use App\Models\BlackList;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\SendingServer;
use App\Models\SmsLog;
use CMText\TextClientStatusCodes;
use Illuminate\Console\Command;
use CMText\TextClient;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

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

        $leads = $campaign->associatedLeads();
        $reference = $campaign->name . '_' . $campaign->id;

        $todaySentCount = SmsLog::where('type', 'out')
            ->where('status', 'sent')
            ->whereDate('created_at', now()->toDateString())
            ->count();

        try {
            foreach ($leads as $lead) {

                if (!$this->isValidPhoneNumber($lead->phone)) {
                    $this->addToBlackList($lead->phone);
                    continue;
                }

                $leadSentCount = SmsLog::where('lead_id', $lead->id)
                                    ->where('campaign_id', $campaign->id)
                                    ->where('type', 'out')
                                    ->where('status', 'sent')
                                    ->count();
                if ($leadSentCount > 0) {
                    continue;
                }

                if ($sendingServer->limits != -1 && $todaySentCount * 1000 >= $sendingServer->limits) {
                    Log::info('The server(' . $sendingServer->name . ') reached limits for today. ' . $sendingServer->limits);
                    return FALSE;
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

                    $todaySentCount++;

                }
            }

            return TRUE;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return FALSE;
    }

    private function isValidPhoneNumber($phoneNumber): bool
    {
        if (empty($phoneNumber)) {
            return FALSE;
        }
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.cm.com/v1.1/numbervalidation/$phoneNumber?mnp_lookup=true", [
                'headers' => [
                    'X-CM-PRODUCTTOKEN' => 'f2531516-900a-408b-849c-3ac19e1c8b7a',
                    'Accept' => 'application/json',
                ],
            ]);

            // Get the response body as a JSON string
            $jsonResponse = $response->getBody()->getContents();

            // Decode the JSON string to an associative array
            $data = json_decode($jsonResponse, true);

            return $data['valid_number'] == 1;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return FALSE;
    }

    private function addToBlackList($phoneNumber)
    {
        Blacklist::firstOrCreate(
            ['phone_number' => $phoneNumber],
            ['created_at' => now(), 'updated_at' => now()]
        );;
    }
}
