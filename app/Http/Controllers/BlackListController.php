<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyBlackListRequest;
use App\Models\BlackList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use DataTables;

class BlackListController extends Controller
{

    public function index(Request $request)
    {
//        abort_if(Gate::denies('blacklist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BlackList::query()->select(sprintf('%s.*', (new BlackList())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $deleteGate = 'blacklist_delete';
                $crudRoutePart = 'blacklist';

                return view('components.datatablesActions', compact(
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

        return view('admin.blacklist.index');
    }


    public function destroy(BlackList $blacklist)
    {
//        abort_if(Gate::denies('blacklist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $blacklist->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlackListRequest $request)
    {
        BlackList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
