<?php  namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $registrations = Ticket::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.registrations', compact('registrations'));
    }

    public function exportCsv()
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=registrations.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['First Name', 'Last Name', 'Email', 'Phone', 'Job Title', 'Company', 'Country', 'Registered At'];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            Ticket::chunk(100, function($tickets) use ($file) {
                foreach ($tickets as $ticket) {
                    fputcsv($file, [
                        $ticket->first_name,
                        $ticket->last_name,
                        $ticket->email,
                        $ticket->phone,
                        $ticket->job_title,
                        $ticket->company,
                        $ticket->country,
                        $ticket->created_at->format('Y-m-d H:i:s'),
                    ]);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
?>