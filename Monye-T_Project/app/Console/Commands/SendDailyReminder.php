<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReminder;
use App\Models\User;

class SendDailyReminder extends Command
{
    protected $signature = 'email:daily-reminder {time}';
    protected $description = 'Send daily reminder emails to users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $time = $this->argument('time');

        // Tentukan pesan berdasarkan waktu
        switch ($time) {
            case 'morning':
                $message = 'Ayo semangat hari ini dan jangan lupa isi catatan keuanganmu!';
                break;
            case 'evening':
                $message = 'Selamat malam, ayo rekap semua keuangan mu hari ini!';
                break;
            default:
                $message = 'Pesan tidak dikenali';
                break;
        }

        // Kirim email ke semua pengguna
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new DailyReminder($message));
        }

        $this->info('Daily reminder emails have been sent successfully!');
    }
}
