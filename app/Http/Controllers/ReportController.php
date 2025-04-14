<?php


namespace App\Http\Controllers;

use App\Models\Stockin;
use App\Models\Stockout;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Get 'from' and 'to' dates from the request
        $from = $request->input('from');
        $to = $request->input('to');

        // Query Stockin and Stockout based on the date filter
        $stockins = Stockin::when($from, fn($query) => $query->whereDate('created_at', '>=', $from))
                           ->when($to, fn($query) => $query->whereDate('created_at', '<=', $to))
                           ->with('product')
                           ->get();
    
        $stockouts = Stockout::when($from, fn($query) => $query->whereDate('created_at', '>=', $from))
                             ->when($to, fn($query) => $query->whereDate('created_at', '<=', $to))
                             ->with('product')
                             ->get();
    
        // Pass the data to the view
        return view('inventory.report', compact('stockins', 'stockouts', 'from', 'to'));
    }
}
?>