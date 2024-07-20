<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invitation;
use App\Mail\CompanyInvitation;    
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
            $query = Company::query();
            
            // Handle search filtering
            if ($search = $request->input('search')) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('industry', 'like', '%' . $search . '%')
                      ->orWhere('size', 'like', '%' . $search . '%')
                      ->orWhere('rating', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
                });
            }
            
            // Handle sorting
            if ($filterBy = $request->input('filter_by')) {
                switch ($filterBy) {
                    case 'Company Name':
                        $query->orderBy('name');
                        break;
                    case 'Industry':
                        $query->orderBy('industry');
                        break;
                    case 'Size':
                        $query->orderBy('size');
                        break;
                    case 'Rating':
                        $query->orderBy('rating', 'desc');
                        break;
                    default:
                        // Default sort order if needed
                        break;
                }
            }
    
            $companies = $query->get();
    
            return view('company_list', compact('companies'));

    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies_list', compact('company'));
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies_list', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:companies,email,' . $id,
            'industry' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect()->route('companies_list')->with('success', 'Company updated successfully!');
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies_list')->with('success', 'Company deleted successfully!');
    }
    public function export(Request $request)
    {
        $search = $request->input('search');
        $filterBy = $request->input('filter_by');

        $companiesQuery = Company::query();

        if ($search) {
            $companiesQuery->where('name', 'like', "%{$search}%")
                           ->orWhere('industry', 'like', "%{$search}%");
        }

        if ($filterBy === 'Company Name') {
            $companiesQuery->orderBy('name');
        } elseif ($filterBy === 'Industry') {
            $companiesQuery->orderBy('industry');
        } elseif ($filterBy === 'Size') {
            $companiesQuery->orderBy('size');
        } elseif ($filterBy === 'Rating') {
            $companiesQuery->orderBy('rating');
        }

        $companies = $companiesQuery->get();

        $csvFileName = 'companies_export_' . date('Ymd_His') . '.csv';

        $response = new StreamedResponse(function () use ($companies) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Company Name', 'Industry', 'Email', 'Size', 'Collaboration History', 'Rating']);

            foreach ($companies as $company) {
                fputcsv($handle, [
                    $company->name,
                    $company->industry,
                    $company->email,
                    $company->size,
                    $company->collaboration_history,
                    $company->rating
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $csvFileName . '"');

        return $response;
    }

}
