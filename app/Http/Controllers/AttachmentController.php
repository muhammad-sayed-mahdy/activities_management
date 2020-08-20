<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function destroy(Request $request)
    {
        $validator = validator($request->only('id'), ['id' => 'required|exists:attachments']);
        if ($validator->fails())
            return response($validator->errors(), 400);

        $attachment = Attachment::find($request['id']);
        Storage::delete($attachment->path);
        $attachment->delete();
        return response(['message' => 'The attachment is deleted successfully']);
    }

    public function show(Request $request)
    {
        $validator = validator($request->only('id'), ['id' => 'required|exists:attachments']);
        if ($validator->fails())
            return response($validator->errors(), 400);
        $attachment = Attachment::find($request['id']);
        return Storage::download($attachment->path);
    }
}
