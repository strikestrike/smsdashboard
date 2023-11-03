<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyLeadRequest;
use App\Http\Requests\MassTagLeadRequest;
use App\Http\Requests\MassExcludeLeadRequest;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Country;
use App\Models\Exclusion;
use App\Models\Lead;
use App\Models\SendingServer;
use App\Models\Tag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DataTables;

class LeadController extends Controller
{

    public function index(Request $request)
    {
//        abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lead::query()->select(sprintf('%s.*', (new Lead())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('country', '&nbsp;');
            $table->addColumn('used_campaigns', '&nbsp;');
            $table->addColumn('tag_names', '&nbsp;');
            $table->addColumn('exclusion_names', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('country', function ($row) {
                $country = $row->country?->name;
                return $country;
            });
            $table->editColumn('used_campaigns', function ($row) {
                $campaigns = $row->campaigns()->pluck('name')->implode(', ');
                return $campaigns;
            });
            $table->editColumn('tag_names', function ($row) {
                $tags = $row->tags->pluck('name')->implode(', ');
                return $tags;
            });
            $table->editColumn('exclusion_names', function ($row) {
                $exclusions = $row->excludedServers()->pluck('name')->implode(', ');
                return $exclusions;
            });
            $table->editColumn('actions', function ($row) {
                $viewGate = 'lead_show';
                $editGate = 'lead_edit';
                $deleteGate = 'lead_delete';
                $crudRoutePart = 'leads';

                return view('components.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d') : '';
            });

            $table->rawColumns(['placeholder', 'used_campaigns', 'tag_names', 'exclusion_names', 'actions']);

            return $table->make(true);
        }

        $tags = Tag::all();
        $servers = SendingServer::all();

        return view('admin.leads.index', compact('tags', 'servers'));
    }

    public function create()
    {
//        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::all();
        $servers = SendingServer::all();
        $countries = Country::all();

        return view('admin.leads.create', compact('tags', 'servers', 'countries'));
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->all());

        // Sync lead tags
        $tagTexts = $request->input('tags');
        $tagIds = [];

        if (!empty($tagTexts)) {
            foreach ($tagTexts as $tagText) {
                $tag = Tag::firstOrCreate(['name' => $tagText]);
                $tagIds[] = $tag->id;
            }
        }

        if (!empty($tagIds)) {
            $lead->tags()->attach($tagIds);
        }

        // Retrieve the selected server IDs
        $selectedServerIds = $request->input('servers');

        // Add new exclusions with the lead's phone number and selected server IDs
        if (!empty($selectedServerIds)) {
            foreach ($selectedServerIds as $serverId) {
                Exclusion::create([
                    'lead_number' => $lead->phone,
                    'sending_server_id' => $serverId,
                ]);
            }
        }

        return redirect()->route('admin.leads.index');
    }

    public function edit(Lead $lead)
    {
//        abort_if(Gate::denies('lead_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::all();
        $servers = SendingServer::all();
        $countries = Country::all();

        return view('admin.leads.edit', compact('lead', 'tags', 'servers', 'countries'));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());

        // Sync lead tags
        $tagTexts = $request->input('tags');
        $tagIds = [];

        if (!empty($tagTexts)) {
            foreach ($tagTexts as $tagText) {
                $tag = Tag::firstOrCreate(['name' => $tagText]);
                $tagIds[] = $tag->id;
            }
        }

        $lead->tags()->detach();
        if (!empty($tagIds)) {
            $lead->tags()->attach($tagIds);
        }

        // Retrieve the selected server IDs
        $selectedServerIds = $request->input('servers');

        // Remove existing exclusions for the lead's phone number
        Exclusion::where('lead_number', $lead->phone)->delete();

        // Add new exclusions with the lead's phone number and selected server IDs
        if (!empty($selectedServerIds)) {
            foreach ($selectedServerIds as $serverId) {
                Exclusion::create([
                    'lead_number' => $lead->phone,
                    'sending_server_id' => $serverId,
                ]);
            }
        }

        return redirect()->route('admin.leads.index');
    }

    public function show(Lead $lead)
    {
//        abort_if(Gate::denies('lead_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leads.show', compact('lead'));
    }

    public function destroy(Lead $lead)
    {
//        abort_if(Gate::denies('lead_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeadRequest $request)
    {
        Lead::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function assignTags(MassTagLeadRequest $request)
    {
        $leadIds = $request->input('lead_ids');
        $tagIds = $request->input('tag_ids');

        Lead::whereIn('id', $leadIds)->each(function ($lead) use ($tagIds) {
            $lead->tags()->detach();
            $lead->tags()->attach($tagIds);
        });

        return response()->json(['message' => 'Tags assigned successfully']);
    }

    public function assignExclusions(MassExcludeLeadRequest $request)
    {
        $leadIds = $request->input('lead_ids');
        $serverIds = $request->input('server_ids');

        foreach ($leadIds as $leadId) {
            $lead = Lead::find($leadId);
            $lead->servers()->detach();
            foreach ($serverIds as $serverId) {
                $lead->servers()->attach($serverId);
            }
        }

        return response()->json(['message' => 'Exclusions assigned successfully']);
    }

}
