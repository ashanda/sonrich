<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AutoRemoveCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoremove:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $autoRemoveNotBuyUsers = DB::table('users')
        ->leftJoin("user_oder_counts", function($join){
          $join->on("users.id", "=", "user_oder_counts.user_id");
          })
          ->where('users.role',0)
          ->whereNull("user_oder_counts.user_id")
          ->select("users.id","users.fname", "users.lname", "users.email", "users.created_at")
          ->get();
      foreach($autoRemoveNotBuyUsers as $autoRemoveNotBuyUser){
        $row_id = $autoRemoveNotBuyUser->uid;
        User::where("id", $row_id)->update(["status" => 0]);
      } 
    }
}
