<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroySendingServerRequest;
use App\Http\Requests\StoreSendingServerRequest;
use App\Http\Requests\UpdateSendingServerRequest;
use App\Models\SendingServer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use DataTables;

class SendingServerController extends Controller
{

    public function index(Request $request)
    {
//        abort_if(Gate::denies('sending_server_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SendingServer::query()->select(sprintf('%s.*', (new SendingServer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sending_server_show';
                $editGate = 'sending_server_edit';
                $deleteGate = 'sending_server_delete';
                $crudRoutePart = 'sendingservers';

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

            $table->rawColumns(['placeholder', 'actions']);

            return $table->make(true);
        }

        return view('admin.sendingserver.index');
    }

    public function create()
    {
//        abort_if(Gate::denies('sending_server_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sendingserver.create');
    }

    public function store(StoreSendingServerRequest $request)
    {
        $sendingserver = SendingServer::create($request->all());

        return redirect()->route('admin.sendingservers.index');
    }

    public function edit(SendingServer $sendingserver)
    {
//        abort_if(Gate::denies('sending_server_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sendingserver.edit', compact('sendingserver'));
    }

    public function update(UpdateSendingServerRequest $request, SendingServer $sendingserver)
    {
        $sendingserver->update($request->all());

        return redirect()->route('admin.sendingservers.index');
    }

    public function show(SendingServer $sendingserver)
    {
//        abort_if(Gate::denies('sending_server_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sendingserver.show', compact('sendingserver'));
    }

    public function destroy(SendingServer $sendingserver)
    {
//        abort_if(Gate::denies('sending_server_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sendingserver->delete();

        return back();
    }

    public function massDestroy(MassDestroySendingServerRequest $request)
    {
        SendingServer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
