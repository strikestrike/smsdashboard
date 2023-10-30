<?php

namespace App\Http\Controllers;

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
            $table = Datatables::of($query);

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d') : '';
            });

            return $table->make(true);
        }

        return view('admin.campaign.ongoing');
    }

    public function create()
    {
//        abort_if(Gate::denies('campaign_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.campaign.create');
    }

    public function store(StoreCampaignRequest $request)
    {
        $campaign = Campaign::create($request->all());

        return redirect()->route('admin.campaign.index');
    }

    public function edit(Campaign $campaign)
    {
//        abort_if(Gate::denies('campaign_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.campaign.edit', compact('campaign'));
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->all());

        return redirect()->route('admin.campaign.index');
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

    public function ongoing(Request $request)
    {
        return view('admin.campaign.ongoing');
    }

    public function history(Request $request)
    {
        return view('admin.campaign.history');
    }
}
