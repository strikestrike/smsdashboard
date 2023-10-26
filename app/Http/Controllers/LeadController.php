<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyLeadRequest;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Lead;
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

            $table->editColumn('created_at', function ($row) {
                return $row->created_at ? $row->created_at->format('Y-m-d') : '';
            });

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', function ($row) {
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

            $table->rawColumns(['placeholder', 'actions']);

            return $table->make(true);
        }

        return view('admin.leads.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leads.create');
    }

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->all());

        return redirect()->route('admin.leads.index');
    }

    public function edit(Lead $lead)
    {
//        abort_if(Gate::denies('lead_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.leads.edit', compact('lead'));
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $lead->update($request->all());

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
}
