<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyCampaignRequest;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Country;
use App\Models\Exclusion;
use App\Models\SendingServer;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use DataTables;

class CampaignController extends Controller
{

    public function index(Request $request)
    {
//        abort_if(Gate::denies('campaign_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Campaign::query()->select(sprintf('%s.*', (new Campaign())->table));

            $table_type = $request->input('type');
            if ($table_type == 'ongoing') {
                $query->whereNull('completed_at');
            }
            $table = Datatables::of($query);

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d') : '';
            });

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('tag_names', '&nbsp;');
            $table->addColumn('server_names', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('tag_names', function ($row) {
                $tags = $row->tags->pluck('name')->implode(', ');
                return $tags;
            });
            $table->editColumn('server_names', function ($row) {
                $servers = $row->sendingServers->pluck('name')->implode(', ');
                return $servers;
            });

            $table->editColumn('actions', function ($row) {
                $viewGate = 'campaign_show';
                $editGate = 'campaign_edit';
                $deleteGate = 'campaign_delete';
                $crudRoutePart = 'campaigns';

                return view('components.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->rawColumns(['placeholder', 'tag_names', 'server_names', 'actions']);

            return $table->make(true);
        }

        return view('admin.campaign.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('campaign_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::all();
        $servers = SendingServer::all();
        $countries = Country::all();

        return view('admin.campaign.create', compact('tags', 'servers', 'countries'));
    }

    public function store(StoreCampaignRequest $request)
    {
        $campaign = Campaign::create($request->all());

        $this->syncCampaignRelations($campaign, $request);

        return redirect()->route('admin.campaigns.index');
    }

    public function edit(Campaign $campaign)
    {
//        abort_if(Gate::denies('campaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::all();
        $servers = SendingServer::all();
        $countries = Country::all();

        return view('admin.campaign.edit', compact('campaign', 'tags', 'servers', 'countries'));
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->all());

        $campaign->tags()->detach();
        $campaign->countries()->detach();
        $campaign->sendingServers()->detach();
        $campaign->exclusions()->detach();
        $this->syncCampaignRelations($campaign, $request);

        return redirect()->route('admin.campaigns.index');
    }

    public function show(Campaign $campaign)
    {
//        abort_if(Gate::denies('campaign_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.campaign.show', compact('campaign'));
    }

    public function destroy(Campaign $campaign)
    {
//        abort_if(Gate::denies('campaign_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $campaign->delete();

        return back();
    }

    public function massDestroy(MassDestroyCampaignRequest $request)
    {
        Campaign::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    private function syncCampaignRelations(Campaign $campaign, Request $request)
    {
        $tagIds = $request->input('tags');
        if (!empty($tagIds)) {
            $campaign->tags()->attach($tagIds);
        }

        $countryIds = $request->input('countries');
        if (!empty($countryIds)) {
            $campaign->countries()->attach($countryIds);
        }

        $serverIds = $request->input('servers');
        if (!empty($serverIds)) {
            $campaign->sendingServers()->attach($serverIds);
        }

        $exclusionIds = $request->input('exclusions');
        if (!empty($exclusionIds)) {
            $campaign->exclusions()->attach($exclusionIds);
        }
    }
}
