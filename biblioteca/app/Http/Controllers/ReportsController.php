<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $activeLoans = Loan::where('returned', 0)->count();
        $overdueLoans = Loan::where('returned', 0)
                            ->where('return_date', '<', now())
                            ->count();
        $recentLoans = Loan::with(['user', 'book'])
                           ->orderBy('loan_date', 'desc')
                           ->take(5)
                           ->get();

        return view('admin.reports.index', compact(
            'totalUsers',
            'totalBooks',
            'activeLoans',
            'overdueLoans',
            'recentLoans'
        ));
    }

    public function generatePDF()
    {
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $activeLoans = Loan::where('returned', 0)->count();
        $overdueLoans = Loan::where('returned', 0)
                            ->where('return_date', '<', now())
                            ->count();
        $recentLoans = Loan::with(['user', 'book'])
                           ->orderBy('loan_date', 'desc')
                           ->take(5)
                           ->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'totalUsers',
            'totalBooks',
            'activeLoans',
            'overdueLoans',
            'recentLoans'
        ));

        return $pdf->download('library_report_' . now()->format('Ymd_His') . '.pdf');
    }
}