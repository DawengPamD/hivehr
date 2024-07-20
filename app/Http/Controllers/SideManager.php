<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invitation;
use App\Mail\CompanyInvitation;     
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SideManager extends Controller
{
   // Show list of projects
   public function index()
   {
       $projects = Project::all(); // Retrieve all projects
       return view('dashboard', compact('projects')); // Pass projects to the view
   }

   // Show project details
   public function show($id)
   {
       $project = Project::findOrFail($id); // Retrieve a single project by its ID
       return view('dashboard', compact('project')); // Pass project to the view
   }

   // Show project overview
   public function overview()
   {
       // Fetch overview data if needed
       return view('dashboard'); // Return the overview view
   }

   // Create a new project form
   public function create()
   {
       return view('dashboard'); // Return the form view for creating a project
   }

   // Store a new project
   public function store(Request $request)
   {
       // Validate project data
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'start_date' => 'required|date',
           'end_date' => 'nullable|date',
       ]);

       // Create a new project
       $project = Project::create($request->all());

       return redirect()->route('dashboard')->with('success', 'Project created successfully!'); // Redirect to projects index with a success message
   }

   // Edit project form
   public function edit($id)
   {
       $project = Project::findOrFail($id); // Retrieve the project to edit
       return view('dashboard', compact('project')); // Return the edit form view
   }

   // Update a project
   public function update(Request $request, $id)
   {
       // Validate project data
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'start_date' => 'required|date',
           'end_date' => 'nullable|date',
       ]);

       $project = Project::findOrFail($id); // Retrieve the project to update
       $project->update($request->all()); // Update the project with the new data

       return redirect()->route('dashboard')->with('success', 'Project updated successfully!'); // Redirect to projects index with a success message
   }

   // Delete a project
   public function destroy($id)
   {
       $project = Project::findOrFail($id); // Retrieve the project to delete
       $project->delete(); // Delete the project

       return redirect()->route('dashboard')->with('success', 'Project deleted successfully!'); // Redirect to projects index with a success message
   }

   // Show project tasks
   public function tasks($projectId)
   {
       $project = Project::findOrFail($projectId); // Retrieve the project
       $tasks = $project->tasks; // Retrieve related tasks

       return view('dashboard', compact('project', 'tasks')); // Return view with project and tasks
   }

   // Add a new task to a project
   public function addTask(Request $request, $projectId)
   {
       $project = Project::findOrFail($projectId); // Retrieve the project

       // Validate task data
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'due_date' => 'nullable|date',
       ]);

       // Create a new task and associate with the project
       $task = new Task($request->all());
       $project->tasks()->save($task);

       return redirect()->route('dashboard', $projectId)->with('success', 'Task added successfully!'); // Redirect to project tasks view with a success message
   }

   // Delete a task from a project
   public function deleteTask($projectId, $taskId)
   {
       $project = Project::findOrFail($projectId); // Retrieve the project
       $task = $project->tasks()->findOrFail($taskId); // Retrieve the task to delete

       $task->delete(); // Delete the task

       return redirect()->route('dashboard', $projectId)->with('success', 'Task deleted successfully!'); // Redirect to project tasks view with a success message
   }
}


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('dashboard', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('dashboard', compact('task'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('dashboard', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        Task::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        return view('dashboard', compact('task', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Task updated successfully!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');
    }
}
