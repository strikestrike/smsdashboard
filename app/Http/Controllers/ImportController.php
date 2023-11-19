<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Imports\LeadsImport;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Session;
use Validator;
use App\Jobs\ProcessCsvChunk;

class ImportController extends Controller
{

    public function index()
    {
        return view('admin.feeds.index');
    }

    public function postUploadExcel(Request $request)
    {
        set_time_limit(0);

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            return response()->json(['message' => 'file not uploaded']);
        }

        $fileReceived = $receiver->receive();

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('leads', $file, $fileName);

            // delete chunked file
            unlink($file->getPathname());

            try {
//                ProcessCsvChunk::dispatch($path);
                $import = new LeadsImport();
                Excel::queueImport($import, $path);
                $successCount = $import->getSuccessCount();
                $errorCount = $import->getErrorCount();
                Log::info("$successCount leads uploaded successfully. $errorCount leads returned errors.");

                return response()->json(['success' => TRUE, 'message' => "Operations successfully queued and will be imported soon."]);
            } catch (\Exception $e) {
                return response()->json(['success' => FALSE, 'message' => $e->getMessage()]);
            }
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
}
