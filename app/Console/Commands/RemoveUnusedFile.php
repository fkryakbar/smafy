<?php

namespace App\Console\Commands;

use App\Models\Answer;
use App\Models\Slide;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveUnusedFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-unused-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove files that not referenced  in database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $localFiles = Storage::allFiles('storage/user');

        $localFiles = collect($localFiles);

        $databaseFiles = Slide::all()->pluck('image_path')->filter(function ($file) {
            return $file != null;
        });

        $fileAttachment =  Answer::whereHas('slide', function ($query) {
            $query->where('type', 'file_attachment');
        })->get()->pluck('answer');


        $databaseFiles =  $databaseFiles->merge($fileAttachment);
        $unusedFiles =  $localFiles->diff($databaseFiles);

        $unusedFiles->each(function ($item) {
            Storage::disk('public')->delete($item);
        });
        $this->info($unusedFiles->count() . ' Unused files deleted');
    }
}
