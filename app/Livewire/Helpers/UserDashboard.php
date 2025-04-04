<?php

namespace App\Livewire\Helpers;

use App\Models\Book;
use App\Models\DownloadHistory;
use App\Models\UploadHistory;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboard extends Component
{

    public $book;

    public $user;

    public $uploads;

    public $downloads;

    public $monthCount;

    public $weekCount;

    public $previousMonthCount;

    public $currentMonthCount;

    public $percentageIncrease;

    public $populars;



    private function popularBooks(){
        $pp = $this->downloads->groupby('book_id')
            ->filter(function ($group) {
                return $group->count() > 1;
            })->keys();
         return $this->downloads->whereIn('book_id', $pp)->take(1);
    }

    private function getPercentageIncrease()
    {
        $previousMonthCount = $this->downloads->filter(function ($download) {
            return
                Carbon::parse($download->created_at)->year == now()->subMonth()->year &&
                Carbon::parse($download->created_at)->month == now()->subMonth()->month;
        })->count();


        $currentMonthCount = $this->downloads->filter(function ($download) {
            return
                Carbon::parse($download->created_at)->year == now()->year &&
                Carbon::parse($download->created_at)->month == now()->month;
        })->count();

        // The percentage increase is not working so find a fix
        // dd(now()->month);
        // dd($currentMonthCount, $previousMonthCount);

        if ($previousMonthCount > 0) {
            $percentage = (($currentMonthCount - $previousMonthCount) / ($previousMonthCount)) * 100;
        } else {
            $percentage = $currentMonthCount > 0 ? 100 : 0;
        }
        return $percentage;
    }

    private function weekCounts()
    {
        $start = now()->startOfWeek();
        $end = now()->endOfWeek();

        $weekCount = $this->uploads->filter(function ($upload)
        use ($start, $end) {
            $createdAt = Carbon::parse($upload->created_at);
            return
                $createdAt->between($start, $end);
        })->count();

        return $weekCount;
    }

    public function mount()
    {
        $this->book = Book::all();
        $this->user = Auth::user();
        $this->downloads = $this->user->DownloadHistories;
        $this->uploads = $this->user->Uploads;

        $this->monthCount = $this->downloads->filter(function ($download) {
            return
                Carbon::parse($download->created_at)->year == now()->year &&
                Carbon::parse($download->created_at)->month == now()->month;
        })->count();
        $this->weekCount = $this->weekCounts();

        $this->percentageIncrease = $this->getPercentageIncrease();
        // dd($this->getPercentageIncrease());

        $this->populars = $this->popularBooks();
    }

    public function render()
    {
        if (!$this->user->can("visit_user")) {
            abort(403);
        }
        return view('livewire.helpers.user-dashboard', [
            'popular' => $this->downloads
        ]);
    }
}
