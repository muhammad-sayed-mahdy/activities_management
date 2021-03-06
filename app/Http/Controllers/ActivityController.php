<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Attachment;
use App\Customer;
use App\Task;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function show(Request $request)
    {
        $validator = validator(
            $request->all(),[
                'activityId' => 'integer|exists:activities,id',
                'taskId' => 'integer|exists:tasks,id'
        ]);
        if ($validator->fails())
             return response($validator->errors(), 400);

        if ($request->has('activityId'))
            return Activity::with('attachments:activity_id,id,name')->find($request['activityId']);
        if ($request->has('taskId'))
            return Task::find($request['taskId']);

        return view('activities_management', [
            'activities' => Activity::all(), 
            'tasks' => Task::all(),
            'customers' => Customer::all()
        ]);
    }

    public function store(Request $request)
    {
        if ($request->has('task_id') && Task::find($request['task_id'])->ended) {
            return redirect('/')->withErrors([
                'activity' => 'This task has already ended and cannot add a new activity for it'
            ]);
        }
        Activity::create();
        return redirect('/');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:activities',
            'task_id' => 'nullable|integer|exists:tasks,id',
            'customer_id' => 'nullable|integer|exists:customers,id',
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'points' => 'nullable|string',
            'attachments' => 'array',
            'attachments.*' => 'file'
        ]);
        $validated['title'] = request('title', 'New Activity');

        $activity = Activity::find($request['id']);
        if ($activity->ended_at != null) {
            return redirect('/')->withErrors(['activity' => 'This activity has already ended and cannot be updated']);
        }
        if ($request->has('task_id') && Task::find($request['task_id'])->ended) {
            return redirect('/')->withErrors([
                'activity' => 'This task has already ended and cannot add a new activity for it'
            ]);
        }

        $activity->update($validated);
        if ($request->has('attachments')) {
            foreach ($request['attachments'] as $file) {
                $path = $file->store('attachments');
                Attachment::create([
                    'path' => $path,
                    'activity_id' => $activity->id,
                    'name' => $file->getClientOriginalName()
                ]);
            }
        }

        if ($request->has('action')) {
            if ($request['action'] == 'startActivity') {
                $activity->started_at = now();
            } elseif ($request['action'] == 'endActivity') {
                if ($activity->started_at == null)
                    return redirect('/')->withErrors([
                        'activity' => "The activity hasn't started yet and cannot be ended"
                    ]);
                $activity->ended_at = now();
            } elseif ($request['action'] == 'endTask') {
                $activity->task->ended = true;
            }
            $activity->save();
        }
        return redirect('/');
    }

}
