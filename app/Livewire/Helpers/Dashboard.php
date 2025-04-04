<?php

namespace App\Livewire\Helpers;

use App\Models\Book;
use App\Models\DownloadHistory;
use App\Models\UploadHistory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $book;

    public $user;

    public $downloads;

    public $monthCount;

    public $weekCount;

    public $previousMonthCount;

    public $currentMonthCount;

    public $percentageIncrease;

    // public $uploads;

    private function getPercentageIncrease(){
        $previousMonthCount = DownloadHistory::whereYear('created_at', now()->subYear()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->count();
        $currentMonthCount = DownloadHistory::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        if ($previousMonthCount > 0){
            $percentage = (($currentMonthCount - $previousMonthCount) / ($previousMonthCount)) * 100;
        }else{
            $percentage = $currentMonthCount > 0 ? 100 : 0;
        }
        return $percentage;
    }

    public function mount()
    {
        $this->book = Book::all();
        $this->user = User::all();
        $this->downloads = DownloadHistory::all();
        $this->monthCount = User::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        $this->weekCount = Book::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        $this->percentageIncrease = $this->getPercentageIncrease();
    }

    public function render()
    {
        return view(
            'livewire.helpers.dashboard',
            [
                'uploads' => UploadHistory::orderBy('created_at', 'desc')->take(2)->get()
            ]
        );
    }
}
