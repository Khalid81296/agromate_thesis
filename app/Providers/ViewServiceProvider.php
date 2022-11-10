<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Providers\AppServiceProvider;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Message;

class ViewServiceProvider extends AppServiceProvider
{
        public function boot()
    {
        // $this->messages_inc_search();

        // $this->composeFooter();
        // Schema::defaultstringLength(191);
        // Paginator::useBootstrap();

        // view()->composer('home', function ($view)
        // {
        //     $users = Auth::user()->id;

        //     $view->with('users', $users);
        // });

       

        
        view()->composer('messages.inc.search', function ($view)
        {
            $roleID = Auth::user()->role_id;
            $officeInfo = user_office_info();
            // Dorpdown
            $upazilas = NULL;
            $courts = DB::table('court')->select('id', 'court_name')->get();
            $divisions = DB::table('division')->select('id', 'division_name_bn')->get();
            $user_role = DB::table('role')->select('id', 'role_name')->get();

            

            $gp_users = DB::table('users')->select('id', 'name')->where('role_id', 13)->get();

            $view->with([
                'upazilas' => $upazilas,
                'courts' => $courts,
                'divisions' => $divisions,
                'gp_users' => $gp_users,
                'user_role' => $user_role,
            ]);

        });

        view()->composer('layouts.base.aside', function ($view)
        {
            $notification_count = 0;
            $case_status = [];
            $rm_case_status = [];
            $officeInfo = user_office_info();
            $roleID = Auth::user()->role_id;
            $districtID = Auth::user()->district_id;

            if( $roleID == 2 || $roleID == 27 ) {
                $CaseResultCount = DB::table('animal_register')
                    ->get()
                    ->count();

                

                
                // dd($dfsdf);  

                $notification_count = $CaseResultCount ;
            } else {
                //for role id : 5,6,7,8,13
                $case_status = DB::table('animal_register')
                    ->select('animal_register.type_id', DB::raw('COUNT(animal_register.id) as total_case'))
                    ->where('animal_register.district_id','=', Auth::user()->district_id)
                    ->where('animal_register.action_user_group_id', $roleID)
                    ->get();
               

                // dd($rm_case_status);   
            }

           if( $roleID != 2 && $roleID != 27 ){
                foreach ($case_status as $row){
                     $notification_count += $row->total_case;
                }

                $view->with([
                    'notification_count' => $notification_count,
                    'case_status' => $case_status,
                ]);

            } else {
                $view->with([
                    'notification_count' => $notification_count,
                    'CaseResultCount' => $CaseResultCount,
                ]);
            }
            //

            //Message Notification --- start
            $NewMessagesCount = Message::select('id')
                ->where('user_receiver', Auth::user()->id)
                ->where('receiver_seen', 0)
                ->where('msg_reqest', 0)
                ->count();
            $msg_request_count = Message::orderby('id', 'DESC')
                // ->select('user_sender', 'user_receiver', 'msg_reqest')
                ->Where('user_receiver', [Auth::user()->id])
                ->Where('msg_reqest', 1)
                ->groupby('user_sender')
                ->count();
            $Ncount = $NewMessagesCount + $msg_request_count;

            $view->with([
                'Ncount' => $Ncount,
                'NewMessagesCount' => $NewMessagesCount,
                'msg_request_count' => $msg_request_count,
            ]);
            //Message Notification  --- End



        });


    }
    public function register()
    {
        //
    }

}
